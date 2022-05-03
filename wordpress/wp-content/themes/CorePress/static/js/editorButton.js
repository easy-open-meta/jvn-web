(function ($) {
    $('#edit-slug-box').on('click','#btn-link-cntoen',function (e){
        $('#edit-slug-buttons button').click();
        var text = $('#new-post-slug').val();

        if (text == undefined) {
            alert('先点击编辑在点击转换');
            return;
        }
        text = $('#title').val();
        $.post(ajaxobj.ajax_url, {action: 'corepress_getfirstspell', text: text}, function (data) {
            var obj = JSON.parse(data);
            if (obj.code == 1) {
                $('#new-post-slug').val(obj.data.toLowerCase());
            }
        });
    });
    tinymce.PluginManager.add('gh-addShortCode', function (editor, url) {
        editor.on("click", function (e) {
            var dom = e.path[1];
            if ($(dom).attr('id') == 'corepress-editbtn') {

                var code = $(e.path[2]).text();
                var codedom = $(e.path[2]).find("#corepress-editbtn").parent().find('code');
                editcode(code, codedom);
            } else if ($(dom).attr('id') == 'corepress-delbtn') {
                layer.confirm('确定删除本行代码？', {
                    title: '删除提示',
                    btn: ['确定', '取消'] //按钮
                }, function (index) {
                    $(e.path[2]).remove();
                    layer.close(index);
                });
            }
            $(dom).find("#corepress-editbtn").remove();
            $(dom).find("#corepress-delbtn").remove();
            if ($(e.path[0])[0].tagName == 'PRE') {
                $(e.path[0]).append('<div id="corepress-editbtn" title="编辑"><span class="dashicons dashicons-welcome-write-blog"></span></div>');
                $(e.path[0]).append('<div id="corepress-delbtn" title="删除"><span class="dashicons dashicons-no"></span></div>');
            }
        })
    });
})(jQuery);
