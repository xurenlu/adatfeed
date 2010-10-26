<?php
/*
Plugin Name: AdAtFeed
Plugin URI: http://www.162cm.com/
Description: Add add at feed;
Version: 1.0.0
Author: 162cm 一米六二 
Author URI: http://www.162cm.com

*/

$aaf_ad_content=get_option("aaf.ad_content");

function aaf_insert_feed_ad($post_content) {
	global $aaf_ad_content;
	global $post;
		return $post_content."<hr>$aaf_ad_content";
	return $post_content;
}
/*** {{{  aaf_settings 
*/ 
function aaf_setting()
{
    global $aaf_ad_content,$aaf_db;
    if($_SERVER["REQUEST_METHOD"]=="GET"){
    echo '<div class="aaf_setting">';
    echo '<h3>您目前的Ad@Feed设置</h3>';
    echo '<form Method="POST">';
    echo '<p>您的Feed广告:<br><textarea rows="5" cols="60" name="aaf_ad_content" >'.htmlspecialchars($aaf_ad_content).'</textarea></p>';
    echo '<p><button type="submit">修改</button></p>';
    echo '</div>';
    }
    else{
        update_option("aaf.ad_content",trim($_POST["aaf_ad_content"]));
        echo '<div style="color:green;padding:50px;">修改成功!        <br>  <br> <a href="'.$_SERVER["REQUEST_URI"].'">返回</a></div>';

    }

}
/** }}} */
/*** {{{ aaf_add_tab
 */
function aaf_add_tab( $s ) {
    add_submenu_page( 'index.php', 'Ad@Feed', 'Feed广告', 1, __FILE__, 'aaf_setting' ); 
    return $s;
}
/** }}} */

add_action( 'admin_menu', 'aaf_add_tab' );

add_filter('the_content_feed', 'aaf_insert_feed_ad');

?>
