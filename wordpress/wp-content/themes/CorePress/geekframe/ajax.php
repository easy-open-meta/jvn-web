<?php
function CorePress_saveThemeset()
{
    global $set;
    $data['code'] = 200;
    $setdata['version'] = THEME_VERSION;
    $json = json_decode(base64_decode($_POST['save']), true);
    if ($json) {
        $setdata['option'] = json_encode($json);
        if (options::saveData($setdata)) {
            $data['code'] = 1;
        } else {
            $data['code'] = 0;
        }
    } else {
        $data['code'] = 503;
    }
    wp_die(json_encode($data));
}

function CorePress_login()
{
    global $set;
    session_start();
    $array = array();
    $array['user_login'] = $_POST['user'];
    $array['user_password'] = $_POST['pass'];
    $array['remember'] = $_POST['remember'];
    $code = $_POST['code'];
    if ($set['user']['VerificationCode'] == 1) {
        if (strtoupper($code) != $_SESSION['authcode']) {
            $json['code'] = 0;
            $json['msg'] = '登录失败，验证码错误';
            wp_die(json_encode($json));
        }
    }
    $user = wp_signon($array);

    if (is_wp_error($user)) {
        $json['code'] = 0;
        $json['msg'] = '登录失败，账号或密码错误';
    } else {
        $userid = $user->data->ID;
        $json['code'] = 1;
        $json['msg'] = '登录成功';
    }
    wp_die(json_encode($json));
}

function CorePress_reguser()
{
    global $set;
    session_start();
    $array = array();
    $array['user_login'] = $_POST['user'];
    $array['user_pass'] = $_POST['pass'];
    $array['user_nicename'] = $_POST['user'];
    $array['user_email'] = $_POST['mail'];
    $code = $_POST['code'];

    if ($set['user']['regpageVerificationCode'] == 1) {
        if (strtoupper($code) != $_SESSION['authcode']) {
            $json['code'] = 0;
            $json['msg'] = '注册失败，验证码错误';
            wp_die(json_encode($json));
        }
    }

    if (email_exists($array['user_email']) != false) {
        $recode = CorePress_useractive('email', $array['user_email']);
        if ($recode == 1) {
            $json['code'] = 0;
            $json['msg'] = '注册失败，邮箱已存在!';
            wp_die(json_encode($json));
        } else if ($recode == 2) {
            $json['code'] = 0;
            $json['msg'] = '用户已存在，请前往激活!';
            wp_die(json_encode($json));
        }

    }
    if (username_exists($array['user_login']) != null) {
        $recode = CorePress_useractive('user_login', $array['user_login']);

        if ($recode == 1) {
            $json['code'] = 0;
            $json['msg'] = '注册失败，用户名已存在!';
            wp_die(json_encode($json));
        } else if ($recode == 2) {
            $json['code'] = 0;
            $json['msg'] = '用户已存在，请前往激活!';
            wp_die(json_encode($json));
        }
    }

    $res = wp_insert_user($array);
    if ($res) {
        if ($set['user']['regapproved'] == 'approved') {
            $json['code'] = 1;
            $json['msg'] = '注册成功!';
        } else if ($set['user']['regapproved'] == 'manualapprov') {
            //update_user_meta($res, 'corepress_approve', 1);
            $json['code'] = 2;
            $json['msg'] = '注册成功!请等待管理员审核后方可登陆';
        } else if ($set['user']['regapproved'] == 'mailapproved') {
            $json['code'] = 2;
            $json['msg'] = '注册成功!我们给您邮箱发送了一封激活邮件，请按照邮件提示激活用户';
        }
        wp_die(json_encode($json));
    } else {
        $json['code'] = 0;
        $json['msg'] = '注册失败!';
        wp_die(json_encode($json));
    }
}


/**
 * @param $field
 * @param $text
 * @return int 返回1已存在激活用户,0用户失效，重新注册；2用户已注册还没激活
 */
function CorePress_useractive($field, $text)
{
    //查看是否激活并且重新注册
    $userObj = get_user_by($field, $text);

    if (get_user_meta($userObj->ID, 'corepress_approve', true) == 0) {
        return 1;
    } else {

        $activation_key = $userObj->user_activation_key;

        if ($activation_key != null && strpos($activation_key, ":") != false) {
            $arr = explode(":", $activation_key);
            $time = $arr[0];
            $activation_key = $arr[1];
            $nowtime = time();

            if (($nowtime - $time) > 86400 || ($nowtime - $time) < -86400) {
                wp_delete_user($userObj->ID);
                return 0;
            } else {
                return 2;
            }
        }
    }
    return 1;
}

function CorePress_edit_window_html()
{
    get_template_part('geekframe/edit-power');
    wp_die();
}

function corepress_save_post_meta($post_id)
{
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容
    if (!isset($_POST['corepress_meta_box_nonce'])) {
        return;
    }
    // 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['corepress_meta_box_nonce'], 'corepress_meta_box')) {
        return;
    }
    // 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // 判断 Meta Box 是否为空
    if (!isset($_POST['corepress_post_meta'])) {
        return;
    }
    update_post_meta($post_id, 'corepress_post_meta', $_POST['corepress_post_meta']);
}

function corepress_resetuser()
{
    global $set;
    if (isset($_GET['pwd'])) {
        $pwd = $_GET['pwd'];
        if ($pwd == $set['user']['reuserpwd']) {
            $set['user']['loginpage'] = 0;
            $setdata['option'] = json_encode($set);
            $setdata['version'] = THEME_VERSION;
            options::saveData($setdata);

            wp_die('已关闭自定义登录页面');
        } else {

            wp_die('密码错误');

        }
    } else {
        wp_die('参数错误');
    }
}


function corepress_mailtest()
{
    global $set;
    $set['testmail']['user'] = $_POST['user'];
    $set['testmail']['pwd'] = $_POST['pwd'];
    $set['testmail']['host'] = $_POST['host'];
    $set['testmail']['port'] = $_POST['port'];
    $set['testmail']['name'] = $_POST['name'];
    $set['testmail']['type'] = $_POST['type'];
    $set['testmail']['testmail'] = $_POST['testmail'];
    add_action('phpmailer_init', 'corepress_mail_test', 10);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $mailre = wp_mail($set['testmail']['testmail'], 'CorePress主题测试邮件', '这是一封测试邮件，如果你看到这一条邮件，说明主题的SMTP服务器配置成功', $headers);
    remove_action('phpmailer_init', 'corepress_mail_test', 10);
    if ($mailre == 1) {
        $data['code'] = 200;
        $data['msg'] = '发送成功';
    } else {
        $data['code'] = 500;
        $data['msg'] = '发送失败';
    }
    wp_die(json_encode($data));
}

function corepress_mail_test($phpmailer)
{
    global $set;
    $phpmailer->From = $set['testmail']['user']; //发件人邮箱
    $phpmailer->FromName = $set['testmail']['name']; //发件人昵称
    $phpmailer->Host = $set['testmail']['host']; //SMTP服务器地址
    $phpmailer->Port = $set['testmail']['port']; //SMTP端口，常用端口有25、465、587
    $phpmailer->SMTPSecure = $set['testmail']['type']; //SMTP加密方式，常用的有SSL/TLS
    $phpmailer->Username = $set['testmail']['user']; //邮箱帐号
    $phpmailer->Password = $set['testmail']['pwd']; //邮箱密码。如果上面是qq邮箱这里就是QQ邮箱授权码。
    $phpmailer->IsSMTP(); //使用SMTP发送
    $phpmailer->SMTPAuth = true; //启用SMTPAuth服务
}

function corepress_approveuser()
{
    if (islogin()) {
        corepress_jmp_message('你已经登录！即将跳转首页...', get_bloginfo('url'));
        wp_die();
    } else {
        if (isset($_GET['key']) && $_GET['id']) {
            $key = $_GET['key'];
            $userid = $_GET['id'];
            if (get_user_meta($userid, 'corepress_approve', true) == 1) {
                $userObj = get_user_by('ID', $userid);
                $activation_key = $userObj->user_activation_key;
                if ($activation_key != null && strpos($activation_key, ":") == true) {
                    $arr = explode(":", $activation_key);
                    $time = $arr[0];
                    $activation_key = $arr[1];
                    $nowtime = time();
                    if ($nowtime - $time > 86400 || $nowtime - $time < -86400) {
                        wp_die('激活过期，请重新注册');
                    } else {
                        if ($key == $activation_key) {
                            update_user_meta($userid, 'corepress_approve', 0);
                            corepress_jmp_message('激活成功！请登陆账号,即将跳转登录页...', wp_login_url());
                            wp_die();
                        } else {
                            corepress_jmp_message('激活错误！即将跳转首页...', get_bloginfo('url'));
                            wp_die('激活错误');
                        }
                    }
                }

            } else {
                corepress_jmp_message('正常账户，请登陆，即将跳转登录页...', wp_login_url());
            }
        }
    }
}

function CorePress_lostpass()
{
    global $set;
    if (islogin()) {
        ajax_die('你已经登录');
    } else {
        session_start();
        if (isset($_POST['key']) && $_POST['user']) {
            $code = $_POST['key'];
            $user = $_POST['user'];
            if (strtoupper($code) != $_SESSION['authcode']) {
                ajax_die('验证码错误');

            } else {
                if (strpos($user, '@')) { //判断用户提交的是邮件还是用户名
                    $user_data = get_user_by_email($user); //通过Email获取用户数据
                    if (empty($user_data)) {
                        ajax_die('此邮箱无效');
                    } else {
                        if (reset_user_password($user_data) == 1) {
                            ajax_die('已经发送一封重置密码链接到您的邮箱', 1);
                        }

                    }
                } else {
                    $user_data = get_user_by('login', $user); //通过用户名获取用户数据
                    if (empty($user_data)) { //排除管理员
                        ajax_die('用户名无效');
                    } else if ($set['user']['repassword_admin'] == 1 && $user_data->caps['administrator'] == 1) {
                        ajax_die('用户名无效');
                    } else {
                        if (reset_user_password($user_data) == 1) {
                            ajax_die('已经发送一封重置密码链接到您的邮箱', 1);
                        }
                    }

                }
                ajax_die('发送邮件失败');
            }
        } else {
            wp_die('非法访问');
        }

    }

}

function CorePress_resetpwd()
{
    if (isset($_POST['key']) && isset($_POST['pwd']) && isset($_POST['userid'])) {
        $userid = $_POST['userid'];
        $key = $_POST['key'];
        $pwd = $_POST['pwd'];
        $userObj = get_user_by('ID', $userid);
        $activation_key = $userObj->user_activation_key;
        if ($activation_key != null && strpos($activation_key, ":") == true) {
            $arr = explode(":", $activation_key);
            $time = $arr[0];
            $activation_key = $arr[1];
            $nowtime = time();
            if ($nowtime - $time > 86400 || $nowtime - $time < -86400) {
                ajax_die('验证过期');
            } else {
                if ($key == $activation_key) {

                    $userdata = array(
                        'ID' => $userid,
                        'user_pass' => $pwd
                    );
                    $id = wp_update_user($userdata);
                    if ($id == $userid) {
                        $json['code'] = 1;
                        $json['msg'] = '已成功重置密码，请重新登录';
                        wp_die(json_encode($json));
                    } else {
                        ajax_die('未知错误');
                    }

                } else {
                    ajax_die('验证失败');
                }
            }

        } else {
            ajax_die('验证失败');

        }

    } else {
        ajax_die('参数错误');

    }
}

function CorePress_updateUserInfo()
{
    if (isset($_POST['user']) && isset($_POST['description'])) {
        $user = $_POST['user'];
        $description = $_POST['description'];
        $currentUser = wp_get_current_user();
        wp_update_user(array('ID' => $currentUser->ID, 'display_name' => $user));
        update_user_meta($currentUser->ID, 'description', $description);
        ajax_die('更新成功', 1);

    } else {
        ajax_die('参数错误');

    }
}

function CorePress_getpwdmailcode()
{
    session_start();
    $time = time();

    if (!isset($_POST['type'])) {
        ajax_die('参数错误');
    }
    $type = $_POST['type'];
    $currentUser = wp_get_current_user();
    $key = md5($time);
    $key = substr($key, -4);

    if ($type == 'changepwd') {
        $session_name = 'time_changepwd';
        if (isset($_SESSION[$session_name]) && $time - $_SESSION[$session_name] < 60) {
            ajax_die('发送频繁，请稍后再试');
        }

        $_SESSION['pwdmailcode'] = $key;
        $mail = $currentUser->user_email;
        $mail_content = '您好，您在本网站进行修改密码操作，你的验证码为：<span style="color: red">' . $key . '</span>【本验证码30分钟内有效，如果不是您的操作，请忽略】<br>';
        $mail_title = '[修改密码验证码]';

    } elseif ($type == 'changemail') {
        $session_name = 'time_changemail';
        if (isset($_SESSION[$session_name]) && $time - $_SESSION[$session_name] < 60) {
            ajax_die('发送频繁，请稍后再试');

        }

        $_SESSION['changemailcode'] = $key;
        $mail = $currentUser->user_email;
        $mail_content = '您好，您在本网站进行更换邮箱操作，你的验证码为：<span style="color: red">' . $key . '</span>【本验证码30分钟内有效，如果不是您的操作，请忽略】<br>';
        $mail_title = '[更换邮箱验证码]';


    } elseif ($type == 'bindemail') {
        $re_arry = parameter_verification(array('oldcode', 'mail'), 1);
        $session_name = 'time_bindemail';
        if (isset($_SESSION[$session_name]) && $time - $_SESSION[$session_name] < 60) {
            ajax_die('发送频繁，请稍后再试');
        }
        $oldcode = $_POST['oldcode'];
        if ($time - $_SESSION['time_changemail'] > 1800) {
            ajax_die('原始邮箱验证码超时');
        }

        if ($oldcode != $_SESSION['changemailcode']) {
            ajax_die('原始邮箱验证码错误');
        }

        $_SESSION['bindemailcode'] = $key;
        $mail = $_POST['mail'];
        $_SESSION['bindemail'] = $mail;
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            ajax_die('邮箱格式错误');
        }
        if (email_exists($mail)) {
            ajax_die('邮箱已经被绑定');
        }
        $mail_content = '您好，您在本网站进行绑定邮箱操作，你的验证码为：<span style="color: red">' . $key . '</span>【本验证码30分钟内有效，如果不是您的操作，请忽略】<br>';
        $mail_title = '[绑定邮箱验证码]';
    } else {
        ajax_die('参数错误');
    }
    $_SESSION[$session_name] = $time;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $mailre = wp_mail($mail, get_option('blogname', '【CorePress】') . $mail_title, $mail_content, $headers);
    if ($mailre == 1) {
        ajax_die('发送成功', 1);

    } else {
        ajax_die('发送失败');
    }
}

function CorePress_changepwd()
{
    session_start();
    $time = time();
    if (!isset($_POST['oldpwd']) || !isset($_POST['newpwd']) || !isset($_POST['mailcode'])) {
        $json['code'] = 0;
        $json['msg'] = '参数错误';
        wp_die(json_encode($json));
    }
    $oldpwd = $_POST['oldpwd'];
    $newpwd = $_POST['newpwd'];
    $mailcode = $_POST['mailcode'];
    if (isset($_SESSION['time_changepwd']) && $time - $_SESSION['time_changepwd'] < 1800) {
        if ($_SESSION['pwdmailcode'] != $mailcode) {
            $json['code'] = 0;
            $json['msg'] = '验证码错误';
            wp_die(json_encode($json));
        }
        $currentUser = wp_get_current_user();

        if (!wp_check_password($oldpwd, $currentUser->user_pass)) {
            $json['code'] = 0;
            $json['msg'] = '旧密码错误';
            wp_die(json_encode($json));
        } else {

            if (!ctype_alnum($newpwd) || strlen($newpwd) < 8 || preg_match("/([\x81-\xfe][\x40-\xfe])/", $newpwd, $match) == true) {
                $json['code'] = 0;
                $json['msg'] = '密码不符合要求';
                wp_die(json_encode($json));
            }

            wp_update_user(array('ID' => $currentUser->ID, 'user_pass' => $newpwd));
            $json['code'] = 1;
            $json['msg'] = '密码修改成功！';
            $_SESSION['pwdmailcode'] = '';
            $_SESSION['time_changepwd'] = 0;
            wp_die(json_encode($json));
        }

    } else {
        $json['code'] = 0;
        $json['msg'] = '验证码超时';
        wp_die(json_encode($json));
    }
}

function CorePress_changebind()
{
    session_start();
    $re_arry = parameter_verification(array('old_mail_code', 'new_mail_code', 'bind_mail', 'type'), 1);
    if ($re_arry['type'] == 'bindemail') {
        $time = time();
        $changemailcode = $_SESSION['changemailcode'];

        $changemailcode_time = $_SESSION['time_changemail'];
        $bindemailcode = $_SESSION['bindemailcode'];
        $bindemailcode_time = $_SESSION['time_bindemail'];
        $bind_mail = $re_arry['bind_mail'];
        if ($time - $changemailcode_time > 1800) {
            ajax_die('原始邮箱验证码超时' . $changemailcode_time);
        }
        if ($time - $bindemailcode_time > 1800) {
            ajax_die('新邮箱验证码超时');
        }
        if ($changemailcode != $re_arry['old_mail_code'] || $_SESSION['bindemail'] != $bind_mail) {
            ajax_die('原始邮箱验证码错误');
        }
        if ($bindemailcode != $re_arry['new_mail_code']) {
            ajax_die('新邮箱验证码错误');
        }

        $currentUser = wp_get_current_user();
        wp_update_user(array('ID' => $currentUser->ID, 'user_email' => $bind_mail));
        ajax_die('更换邮箱成功！', 1);
        $_SESSION['bindemailcode'] = null;
        $_SESSION['changemailcode'] = null;

    } else {
        ajax_die('类型错误');
    }
}

function corepress_getfirstspell()
{
    $text = replace_symbol($_POST['text']);
    $json['code'] = 1;
    $json['data'] = corepress_pinyin_long($text);
    wp_die(json_encode($json));
}

function corepress_load_post()
{
    $per_page = get_option('posts_per_page');
    global $wp_posts;
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $cat = isset($_POST['cat']) ? $_POST['cat'] : '0';
    $sticky = get_option('sticky_posts');
    $page = $page ? $page : 1;
    $wp_posts = new WP_Query(array(
        'posts_per_page' => $per_page,
        'paged' => $page,
        'post_type' => 'post',
        'cat' => $cat,
        'post_status' => array('publish'),
        'ignore_sticky_posts' => 0,
        'post__not_in' => $sticky,
    ));
    if ($wp_posts->have_posts()) {
        while ($wp_posts->have_posts()) {
            $wp_posts->the_post();
            get_template_part('component/post-list-item');
        }
        wp_reset_postdata();
    }
    exit;
}

function corepress_load_post_by_tabs()
{
    //修改列表循环
    global $paged;
    $paged = 1;
    $per_page = get_option('posts_per_page');
    if (!isset($_POST['cat'])) {
        die('参数错误');
    }
    $cat = $_POST['cat'];
    $sticky = get_option('sticky_posts');
    if ($paged == 1) {
        if (count($sticky) > 0) {
            $wp_posts_sticky = new WP_Query(array(
                    'post__in' => $sticky,
                    'caller_get_posts' => 1,
                    'cat' => $cat
                )
            );
            if ($wp_posts_sticky->have_posts()) {
                while ($wp_posts_sticky->have_posts()) {
                    $wp_posts_sticky->the_post();
                    get_template_part('component/post-list-item');
                }
                wp_reset_postdata();
            }
        }
    }

    $wp_posts = new WP_Query(array(
        'cat' => $cat,
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'post_type' => 'post',
        'post_status' => array('publish'),
        'post__not_in' => $sticky,
        'ignore_sticky_posts' => 1
    ));
    if ($wp_posts->have_posts()) {
        while ($wp_posts->have_posts()) {
            $wp_posts->the_post();
            get_template_part('component/post-list-item');
        }
        wp_reset_postdata();
    }
    exit;
}

function corepress_update_avatar()
{
    global $set;
    if ($set['user']['upload_avatar'] != 1) {
        ajax_die('未开启图片上传');
    }
    corepress_avatar_dir_init();
    $currentUser = wp_get_current_user();
    $filename = $currentUser->ID;
    $img = $_POST['img'];
    if (strlen($img) > 13000000) {
        ajax_die('图片过大');
    }
    global $wp_filesystem;
    if ($wp_filesystem->put_contents(AVATAR_DIR . $filename . '.jpg', base64_decode($img), FS_CHMOD_FILE)) {
        ajax_die('上传成功', 1);
    } else {
        ajax_die('保存失败');
    }

}

function corepress_unset_thirdparty()
{
    if (!isset($_POST['type'])) {
        ajax_die('type参数错误');
    }
    $type = $_POST['type'];
    $currentUser = wp_get_current_user();
    if ($type == 'qq') {
        if (update_user_meta($currentUser->ID, 'corepress_thirdparty_qq', '') != false) {
            ajax_die('解绑成功', 1);
        } else {
            ajax_die('解绑失败');
        }
    }
    ajax_die('参数错误');
}

function corepress_get_widget_sentence()
{
    $type = $_GET['type'];
    $data = [];
    $data['code'] = 200;
    if ($type == 'djt') {
        $data['data'] = file_get_contents('https://api.lovestu.com/corepress/sentence/?action=sentence&type=1');
    } elseif ($type == 'tg') {
        $data['data'] = file_get_contents('https://api.lovestu.com/corepress/sentence/?action=sentence&type=2');
    } elseif ($type == 'yy') {
        $data['data'] = file_get_contents('https://api.lovestu.com/corepress/sentence/?action=sentence&type=3');
    } elseif ($type == 'sh') {
        $data['data'] = file_get_contents('https://api.lovestu.com/corepress/sentence/?action=sentence&type=4');
    } else {
        $data['data'] = file_get_contents('https://api.lovestu.com/corepress/sentence/?action=sentence&type=1');
    }
    wp_die(json_encode($data));
}

add_action('wp_ajax_corepress_get_widget_sentence', 'corepress_get_widget_sentence');
add_action('wp_ajax_nopriv_corepress_get_widget_sentence', 'corepress_get_widget_sentence');

add_action('wp_ajax_corepress_load_post_by_tabs', 'corepress_load_post_by_tabs');
add_action('wp_ajax_nopriv_corepress_load_post_by_tabs', 'corepress_load_post_by_tabs');

add_action('wp_ajax_corepress_unset_thirdparty', 'corepress_unset_thirdparty');

add_action('wp_ajax_corepress_update_avatar', 'corepress_update_avatar');

add_action('wp_ajax_corepress_load_post', 'corepress_load_post');

add_action('wp_ajax_nopriv_corepress_load_post', 'corepress_load_post');

add_action('wp_ajax_corepress_getfirstspell', 'corepress_getfirstspell');

add_action('wp_ajax_corepress_changebind', 'CorePress_changebind');
add_action('wp_ajax_corepress_changepwd', 'CorePress_changepwd');
add_action('wp_ajax_corepress_getpwdmailcode', 'CorePress_getpwdmailcode');

add_action('wp_ajax_corepress_updateuserinfo', 'CorePress_updateUserInfo');

add_action('wp_ajax_nopriv_corepress_resetpwd', 'CorePress_resetpwd');
add_action('wp_ajax_corepress_resetpwd', 'CorePress_resetpwd');


add_action('wp_ajax_nopriv_corepress_lostpass', 'CorePress_lostpass');
add_action('wp_ajax_corepress_lostpass', 'CorePress_lostpass');

add_action('wp_ajax_corepress_approveuser', 'corepress_approveuser');
add_action('wp_ajax_nopriv_corepress_approveuser', 'corepress_approveuser');
add_action('wp_ajax_corepress_mailtest', 'corepress_mailtest');
add_action('wp_ajax_nopriv_resetuser', 'corepress_resetuser');
add_action('wp_ajax_nopriv_corepress_login', 'CorePress_login');
add_action('wp_ajax_nopriv_corepress_reguser', 'CorePress_reguser');
add_action('wp_ajax_corepress_reguser', 'CorePress_reguser');

add_action('wp_ajax_save', 'CorePress_saveThemeset');//管理员调用
add_action('wp_ajax_geteditwindowhtml', 'CorePress_edit_window_html');//管理员调用
add_action('save_post', 'corepress_save_post_meta');
