<?php
define('THEME_NAME', 'CorePress');
define('THEME_VERSION', 67);
define('THEME_DOWNURL', 'https://www.lovestu.com/corepress.html');
define('THEME_VERSIONNAME', '5.8.6');
define('THEME_PATH', get_template_directory());
define('THEME_STATIC_PATH', get_template_directory_uri() . '/static');
define('THEME_CSS_PATH', THEME_STATIC_PATH . '/css');
define('THEME_JS_PATH', THEME_STATIC_PATH . '/js');
define('THEME_LIB_PATH', THEME_STATIC_PATH . '/lib');
define('THEME_IMG_PATH', THEME_STATIC_PATH . '/img');
define('FRAMEWORK_PATH', THEME_PATH . '/geekframe');
$upload = wp_upload_dir();
$upload_dir = $upload['basedir'];
define('AVATAR_DIR', $upload_dir . '/corepress_avatar/');
define('FRAMEWORK_URI', get_template_directory_uri() . '/geekframe');
define('AJAX_URL', admin_url('admin-ajax.php'));
require_once(FRAMEWORK_PATH . '/options.php');
$set = options::getInstance()->getdata();
require_once(FRAMEWORK_PATH . '/utils.php');
require_once(FRAMEWORK_PATH . '/support.php');
require_once(FRAMEWORK_PATH . '/users.php');
require_once(FRAMEWORK_PATH . '/ajax.php');
require_once(FRAMEWORK_PATH . '/loadfiles.php');
require_once(FRAMEWORK_PATH . '/seo/category.php');
require_once(FRAMEWORK_PATH . '/comment-pro.php');
require_once(THEME_PATH . '/widgets/comments.php');
require_once(THEME_PATH . '/widgets/author.php');
require_once(THEME_PATH . '/widgets/hot-post.php');
require_once(THEME_PATH . '/widgets/tag-cloud.php');
require_once(THEME_PATH . '/widgets/sentence.php');
require_once(FRAMEWORK_PATH . '/shortcode.php');
add_editor_style('static/css/editor-style.css');
error_reporting(0);
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
require_once(FRAMEWORK_PATH . '/compatible.php');
WP_Filesystem();
if ( ! function_exists( 'get_cravatar_url' ) ) {
    /**
     * 替换 Gravatar 头像为 Cravatar 头像
     *
     * Cravatar 是 Gravatar 在中国的完美替代方案，你可以在 https://cravatar.cn 更新你的头像
     */
    function get_cravatar_url( $url ) {
        $sources = array(
            'www.gravatar.com',
            '0.gravatar.com',
            '1.gravatar.com',
            '2.gravatar.com',
            'secure.gravatar.com',
            'cn.gravatar.com',
            'gravatar.com',
        );
        return str_replace( $sources, 'cravatar.cn', $url );
    }
    add_filter( 'um_user_avatar_url_filter', 'get_cravatar_url', 1 );
    add_filter( 'bp_gravatar_url', 'get_cravatar_url', 1 );
    add_filter( 'get_avatar_url', 'get_cravatar_url', 1 );
}
if ( ! function_exists( 'set_defaults_for_cravatar' ) ) {
    /**
     * 替换 WordPress 讨论设置中的默认头像
     */
    function set_defaults_for_cravatar( $avatar_defaults ) {
        $avatar_defaults['gravatar_default'] = 'Cravatar 标志';
        return $avatar_defaults;
    }
    add_filter( 'avatar_defaults', 'set_defaults_for_cravatar', 1 );
}
if ( ! function_exists( 'set_user_profile_picture_for_cravatar' ) ) {
    /**
     * 替换个人资料卡中的头像上传地址
     */
    function set_user_profile_picture_for_cravatar() {
        return '<a href="https://cravatar.cn" target="_blank">您可以在 Cravatar 修改您的资料图片</a>';
    }
    add_filter( 'user_profile_picture_description', 'set_user_profile_picture_for_cravatar', 1 );
}