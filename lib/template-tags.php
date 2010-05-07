<?php

function the_comment_shortbord($comment=null) {
	echo apply_filters('the_comment_shortbord',get_comment_shortbord($comment));
}

function get_comment_shortbord($comment=null) {
	global $Shortbord;
	return apply_filters('get_comment_shortbord',$Shortbord->getEndorsement($comment));
}

function the_post_shortbord($post=null) {
	echo apply_filters('the_post_shortbord',get_post_shortbord($post));
}

function get_post_shortbord($post=null) {
	global $Shortbord;
	return apply_filters('get_post_shortbord',$Shortbord->getPostEndorsement($post));
}