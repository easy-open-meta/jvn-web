function addshortcode(name, type) {
    if (name == 'title-plane') {
        addContentToEditer(1, '[title-plane title="标题"]内容[/title-plane]');
    } else if (name == 'start-plane') {
        addContentToEditer(1, '[start-plane type="' + type + '"]内容[/start-plane]');
    } else if (name == 'icon-url') {
        addContentToEditer(1, '[icon-url href="网址" target="_blank"]网址[/icon-url]');
    } else if (name == 'loginshow') {
        addContentToEditer(1, '[loginshow]登录可见的内容[/loginshow]');
    } else if (name == 'zd-plane') {
        addContentToEditer(1, '[zd-plane title="折叠标题"]折叠内容[/zd-plane]');
    } else if (name == 'clickshow') {
        addContentToEditer(1, '[clickshow]点击可见内容[/clickshow]');
    } else if (name == 'c-alert') {
        addContentToEditer(1, '[c-alert type="' + type + '"]提示面板内容[/c-alert]');
    } else if (name == 'pwdshow') {
        addContentToEditer(1, '[pwdshow pwd="密码"]密码可见内容[/pwdshow]');
    } else if (name == 'c-downbtn') {
        addContentToEditer(1, '[c-downbtn type="' + type + '" url="" pwd=""]资源文件下载[/c-downbtn]');
    } else if (name == 'selectbox') {
        addContentToEditer(1, '[selectbox type="1"]');
    } else if (name == 'replyread') {
        addContentToEditer(1, '[reply]回复可见内容[/reply]');
    } else if (name == 'bvideo') {
        addContentToEditer(1, '[bvideo bv="' + type + '"][/bvideo]');
    } else if (name == 'corepress-code') {
        layer.open({
            type: 1,
            title: '插入代码',
            shadeClose: true,
            shade: false,
            area: ['500px', '500px'],
            content: `<div><div class="corepress-edit-window">
                       <textarea class="corepress-edit-code"></textarea>
                        
                       <button class="el-button el-button--default el-button--small " onclick="corepress_addcode(1)">插入代码</button>
                       <button class="el-button el-button--default el-button--small " onclick="corepress_clearcode()">清空内容</button>
                      </div> </div>
                        `
        });
    } else if (name == 'corepress-code-line') {
        layer.open({
            type: 1,
            title: '行内代码',
            shadeClose: true,
            shade: false,
            area: ['500px', '300px'],
            content: `<div><div class="corepress-edit-window">
                       <textarea class="corepress-edit-code-line"></textarea>
                       <button class="el-button el-button--default el-button--small " onclick="corepress_addcode(0)">插入代码</button>
                      </div> </div>
                        `
        });
    }
}

function corepress_clearcode() {
    jQuery('.corepress-edit-code').val('');
}

function corepress_addcode(type) {
    if (type == 0) {
        var code = jQuery('.corepress-edit-code-line').val();
        addContentToEditer(1, '<code>' + code + '</code>&nbsp;');
    } else {
        var code = jQuery('.corepress-edit-code').val();
        addContentToEditer(1, '<pre class="corepress-code-pre"><code>' + htmlEncodeByRegExp(code) + '</code></pre>&nbsp;');
    }
}

function corepress_updatecode() {
    window.$codedom.html(htmlEncodeByRegExp(jQuery('.corepress-edit-code').val()));
    layer.closeAll();
}

function editcode(text, dom) {
    window.$codedom = dom;
    layer.open({
        type: 1,
        title: '修改代码',
        shadeClose: true,
        shade: false,
        area: ['500px', '500px'],
        content: '<div class="corepress-edit-window"><textarea class="corepress-edit-code">' + text + '</textarea><br><button class="el-button el-button--default el-button--small" onclick="corepress_updatecode()">更新</button></div>'
    });
}

function addContentToEditer(type, content) {
    parent.tinymce.activeEditor.selection.setContent(content);
}



