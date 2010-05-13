<?php
/*
 Plugin Name: Shortbord
 Plugin URI: http://shortbord.com
 Author: Nick Ohrn of Plugin-Developer.com
 Author URI: http://plugin-developer.com
 Description: Quickly and easily integrate the Shortbord sponsorship platform.
 Version: 1.0.4
 */

if(!class_exists('Shortbord')) {
	class Shortbord {

		var $_option_Name = 'Shortbord Settings';
		var $_option_Defaults = array('post-size'=>64, 'title-method'=>'manual', 'privacy'=>0,'send-content'=>1,'position'=>'right','size'=>'64','failimage'=>'fullsize','method'=>'automatic','styling'=>".shortbord {\n\tfloat: right;\n\tmargin: 1px 12px 0px 0px;\n\1px solid #47453a;\n}");
		var $settings = null;
		var $previouslyAppendedToPostTitle = false;

		function Shortbord() {
			$this->addActions();
			$this->addFilters();
		}

		function addActions() {
			add_action('admin_init',array(&$this,'processSubmissions'));
			add_action('admin_menu',array(&$this,'addAdministrativeItems'));

			add_action('init',array(&$this,'enqueueScript'));
			add_action('parse_request',array(&$this,'loadCSS'));

			add_action('widgets_init',array(&$this,'registerWidget'));
		}

		function addFilters() {
			$settings = $this->getSettings();
			if($settings['method']=='automatic') {
				add_filter('get_comment_author_link',array(&$this,'appendEndorsement'));
			}
			if($settings['title-method']=='automatic') {
				add_filter('the_title',array(&$this,'appendTitleEndorsement'),10,2);
			}
		}

		/// CALLBACKS

		function addAdministrativeItems() {
			$hook = add_options_page(__('Shortbord'),__('Shortbord'),'manage_options','shortbord',array(&$this,'displaySettingsPage'));
			add_action('admin_print_styles-'.$hook,array($this,'enqueueAdministrativeScript'));
		}

		function appendEndorsement($text) {
			$settings = $this->getSettings();

			if(!is_admin() && !empty($settings['partner'])) {
				$script = $this->getEndorsement();
				return $script.$text;
			} else {
				return $text;
			}
		}

		function appendTitleEndorsement($text, $id=null) {
			$settings = $this->getSettings();

			global $wp_query;
			$queried = $wp_query->get_queried_object_id();
			if(is_singular() && ($id == $queried) && !empty($settings['partner']) && in_the_loop() && !$this->previouslyAppendedToPostTitle) {
				$this->previouslyAppendedToPostTitle = true;
				$script = $this->getEndorsement();
				return $script.$text;
			} else {
				return $text;
			}
		}

		function getEndorsement($_comment=null) {
			if(null===$_comment) {
				global $comment;
				$_comment = $comment;
			}
			$settings = $this->getSettings();
			ob_start();
			include('resources/shortbord.js.php');
			$script = ob_get_clean();
			return $script;
		}

		function getPostEndorsement($_post=null) {
			if(null===$_post) {
				global $post;
				$_post = $post;
			}
			$settings = $this->getSettings();
			ob_start();
			include('resources/shortbord-post.js.php');
			$script = ob_get_clean();
			return $script;
		}

		function enqueueAdministrativeScript() {
			wp_enqueue_script('shortbord',plugins_url('resources/shortbord.js',__FILE__),array('jquery'));
		}

		function enqueueScript() {
			$settings = $this->getSettings();
			if(!is_admin() && !empty($settings['partner'])) {
				wp_enqueue_script('shortbord',"http://www.shortbord.com/javascripts/partners/{$settings['partner']}.js",array('jquery'));
				if(!empty($settings['styling'])) {
					wp_enqueue_style('shortbord',site_url('?shortbord-css=1'));
				}
			}
		}

		function loadCSS() {
			if($_GET['shortbord-css']==1) {
				header('Content-type: text/css');
				$settings = $this->getSettings();
				echo $settings['styling'];
				exit();
			}
		}

		function processSubmissions() {
			if(isset($_POST['save-shortbord-settings']) && check_admin_referer('save-shortbord-settings')) {
				$settings = array_map('trim',stripslashes_deep($_POST['shortbord']));
				$this->saveSettings($settings);
				wp_redirect(admin_url('options-general.php?page=shortbord&updated=true'));
			}
		}

		function registerWidget() {
			register_widget('Shortbord_Widget');
		}

		/// DISPLAY

		function displaySettingsPage() {
			include('views/settings.php');
		}

		/// SETTINGS

		function getSettings() {
			if(null===$this->settings) {
				$this->settings = get_option($this->_option_Name, $this->_option_Defaults);
			}
			return $this->settings;
		}

		function saveSettings($settings) {
			if(is_array($settings)) {
				$this->settings = $settings;
				update_option($this->_option_Name, $this->settings);
			}
		}
	}

	class Shortbord_Widget extends WP_Widget {
		function Shortbord_Widget() {
			$this->WP_Widget('shortbord-widget',__('Shortbord'));
		}

		function widget($args, $instance) {
			if(empty($instance['email'])) { return; }
			extract($args);
			include('views/widget.php');
		}

		function update($new_instance, $old_instance) {
			$instance = array(
				'title'=>strip_tags($new_instance['title']),
				'email'=>strip_tags($new_instance['email']),
				'size'=>intval($new_instance['size'])
			);
			return $instance;
		}

		function form($instance) {
			$instance = wp_parse_args($instance,array('title'=>__('Endorsement'),'email'=>'','size'=>64));
			include('views/control.php');
		}
	}

	global $Shortbord;
	$Shortbord = new Shortbord;
	include('lib/template-tags.php');


}