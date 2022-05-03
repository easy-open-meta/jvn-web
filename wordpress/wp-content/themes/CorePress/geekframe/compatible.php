<?php

if (is_plugin_active('wpjam-basic/wpjam-basic.php')) {
    remove_filter('pre_get_avatar_data', array('WPJAM_Gravatar_Service', 'filter_pre_data'), 10);
    remove_filter('get_avatar_url', 'wpjam_get_avatar_url', 10);
}
if (is_plugin_active('wp-editormd/wp-editormd.php')) {
    wp_deregister_script('jQuery-CDN');
}
