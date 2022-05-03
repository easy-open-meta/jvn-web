<h3>输出优化</h3>
<div class="set-plane">
    <div class="set-title">
        自动英文固定链接
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.autoenfixedtitle"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        写文章的时候，如果是中文标题，固定链接也默认为中文，开启后，默认会设置中文为首拼字母
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        移除版本号
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.removeversion"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        开启以后网页不再显示WordPress版本号标识符，建议移除，以免遭受版本号攻击
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        去除头部加载dns-prefetch
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.removednsprefetch"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        移除网页头部dns-prefetch，DNS预加载s.w.org相关的内容，但国内无法访问，建议移除
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        去除头部加载json链接
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.removejson"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        开启以后网页不再显示json链接，建议移除
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        移除文章页面前后页meta信息
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.removemeta"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        头部有前后文章链接，对SEO帮助不大，建议移除
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        移除文章头部feed
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.removefeed"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        RSS订阅，容易被采集，可以关闭
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        移除wp-block-library-css
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.removewpblock"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        WordPress 5.0以后加载的古腾堡编辑器样式，前端不需要
    </div>
</div>
<h3>函数禁用</h3>
<div class="set-plane">
    <div class="set-title">
        禁止 translations_api
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.banfun.translations_api"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        没卵用的功能，进入设置后，会访问WordPress.org查询翻译，非常慢
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        禁止 wp_check_php_version
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.banfun.wp_check_php_version"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        没卵用的功能，进入设置后，会访问WordPress.org查询提服务器PHP版本
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        禁止 wp_check_browser_version
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.banfun.wp_check_browser_version"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        没卵用的功能，WordPress会时不时提交你的浏览器版本
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        禁止 current_screen
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.banfun.current_screen"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        识别屏幕的必要元素函数，可以关闭
    </div>
</div>


<h3>功能开关</h3>


<div class="set-plane">
    <div class="set-title">
        屏蔽 REST API
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.closerest"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        没有小程序等APP功能的，可以关闭
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        禁用Emoji表情
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.closeemoji"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        Emoji表情为wordpress默认表情功能，会在页面加载静态资源
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        关闭WordPress更新
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.closeupdate"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        禁止WordPress检查更新，加快运行速度
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        禁止新版古藤堡编辑器
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.closegutenberg"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        本主题在经典编辑器有增强功能。建议关闭新版本的古藤堡编辑器。
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        禁止缩放分辨率
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.banimgresolving"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        WordPress5.3 开始会对大分辨率的图片进行缩放处理，并且添加后缀scaled，禁止后不会缩放
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        关闭修改密码和邮箱邮件通知
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.notification_changepwdandmail_email"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        关闭网站用户注册邮件通知
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.notification_reg_email"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        WordPress在用户修改密码和邮箱，用户注册会发送邮件给站长邮箱，建议关闭
    </div>
</div>

<div class="set-plane">
    <div class="set-title">
        关闭保存修订版本
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.revisions_to_keep"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        修订版本占用数据库，打乱文章ID，可以关闭
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        关闭XML-RPC接口
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.optimization.xmlrpc"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        WordPress对接第三方应用接口，没有可以关闭
    </div>
</div>
<h3>CDN公共库加速</h3>

<div class="set-plane">
    <div class="set-title">
        头像服务器
    </div>
    <div class="set-object">
        <el-radio v-model="set.optimization.gravatarsite" label="cn">cn子域名</el-radio>
        <el-radio v-model="set.optimization.gravatarsite" label="geek">极客CDN</el-radio>
        <el-radio v-model="set.optimization.gravatarsite" label="chinayes">Cravatar CDN[推荐]</el-radio>
        <el-radio v-model="set.optimization.gravatarsite" label="v2ex">v2exCDN</el-radio>
        <el-radio v-model="set.optimization.gravatarsite" label="qiniu">七牛CDN</el-radio>
        <el-radio v-model="set.optimization.gravatarsite" label="loli">loli CDN</el-radio>
        <el-radio v-model="set.optimization.gravatarsite" label="no">不加速</el-radio>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        评论默认头像使用的Gravatar，国内打开非常缓慢，拖累系统速度，建议使用CDN加速 <br>
        <a href="https://cravatar.cn" target="_blank">cravatar.cn</a> 为国内镜像，支持Gravatar所有的功能
    </div>
</div>


<div class="set-plane">
    <div class="set-title">
        自定义CDN地址
    </div>
    <div class="set-object">
        <el-input placeholder="" v-model="set.optimization.themecdnurl" size="small">
        </el-input>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        主题github公共库为：
        <a href="https://github.com/ghboke/corepresscdn" target="_blank">https://github.com/ghboke/corepresscdn</a>
        <br>
        下载此库文件，然后上传到你自己的空间，修改地址为你的CDN域名即可。<a href="https://www.yuque.com/applek/corepress/customcdn"
                                             target="_blank">使用教程</a>
    </div>
</div>
