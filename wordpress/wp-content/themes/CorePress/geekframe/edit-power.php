<?php

?>
<div id="corepress-edit-window">
    <div class="corepress-edit-window">
        <el-tabs v-model="activeName" type="card">
            <el-tab-pane label="短代码" name="1">
                <div class="short-plane-list">
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="title-plane">标题面板
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/title-plane.png') ?>"
                                     width="150">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <div class="short-btn-plane">
                        <button slot="reference"
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="icon-url">图标超链接
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/icon-url.png') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="zd-plane">折叠面板
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/zd-plane.png') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="loginshow">登录可见
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/loginshow.png') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <br><br>
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="clickshow">点击可见
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/clickshow.gif') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="pwdshow">密码可见
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/pwdshow.png') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="replyread">回复可见
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/replyread.png') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <div class="short-btn-plane">
                        <button
                                class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                                shortcode="selectbox">勾选框
                        </button>
                        <el-popover
                                placement="top-start"
                                title="预览样式"
                                width="50"
                                trigger="click">
                            <div class="shortcode-preview">
                                <img src="<?php echo file_get_img_url('shortcode/preview/selectbox.png') ?>" alt="">
                            </div>
                            <i slot="reference" class="el-icon-question"></i>
                        </el-popover>
                    </div>
                    <el-button @click="dialog.dh=true" size="small">导航图标</el-button>
                    <el-dialog title="插入导航图标" :visible.sync="dialog.dh" :modal="false" :close-on-click-modal="false">
                        <el-form :model="cvideo_form">
                            <el-form-item label="网站地址" label-width="120px">
                                <el-input size="small" v-model="dh_form.url" autocomplete="off"></el-input>
                            </el-form-item>
                            <el-form-item label="网站名称" label-width="120px">
                                <el-input size="small" v-model="dh_form.title" autocomplete="off"></el-input>
                            </el-form-item>
                            <el-form-item label="网站描述" label-width="120px">
                                <el-input size="small" v-model="dh_form.des" autocomplete="off"></el-input>
                            </el-form-item>
                            <el-form-item label="网站图片地址" label-width="120px">
                                <el-input size="small" v-model="dh_form.icon" autocomplete="off"
                                          placeholder="可空"></el-input>
                                <el-button icon="el-icon-upload" size="small" @click="slectimg('dh_form.icon')">
                                    选择
                                </el-button>
                            </el-form-item>

                        </el-form>
                        <div slot="footer" class="dialog-footer">
                            <el-button @click="dialog.dh = false">取 消</el-button>
                            <el-button type="primary" @click="insertshortcode('dh')">确 定</el-button>
                        </div>
                    </el-dialog>

                    <br> <br>
                    <el-button @click="insertshortcode('bvideo')" size="small">B站视频</el-button>
                    <el-button @click="dialog.cvideo=true" size="small">普通视频</el-button>
                    <el-dialog title="普通视频" :visible.sync="dialog.cvideo" :modal="false" :close-on-click-modal="false">
                        <el-form :model="cvideo_form">
                            <el-form-item label="视频地址" label-width="120px">
                                <el-input size="small" v-model="cvideo_form.videourl" autocomplete="off"></el-input>
                                <el-button icon="el-icon-upload" size="small" @click="slectimg('cvideo_form.videourl')">
                                    选择
                                </el-button>
                            </el-form-item>
                            <el-form-item label="视频封面" label-width="120px">
                                <el-input size="small" v-model="cvideo_form.imgurl" autocomplete="off"
                                          placeholder="可空"></el-input>
                                <el-button icon="el-icon-upload" size="small" @click="slectimg('cvideo_form.imgurl')">
                                    选择
                                </el-button>
                            </el-form-item>
                            <el-form-item label="视频封面" label-width="120px">
                                <el-select size="small" v-model="cvideo_form.type" placeholder="请选择">
                                    <el-option
                                            label="video/mp4"
                                            value="video/mp4">
                                    </el-option>
                                    <el-option
                                            label="video/webm"
                                            value="video/webm">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-form>
                        <div slot="footer" class="dialog-footer">
                            <el-button @click="dialog.cvideo = false">取 消</el-button>
                            <el-button type="primary" @click="insertshortcode('cvideo')">确 定</el-button>
                        </div>
                    </el-dialog>
                </div>
            </el-tab-pane>
            <el-tab-pane label="多功能面板" name="2">
                <div class="short-plane">
                    <div>标星面板：
                        <select class="select-start-plane">
                            <option value="1">黄色</option>
                            <option value="2">蓝色</option>
                            <option value="3">红色</option>
                            <option value="4">灰色</option>
                        </select>
                    </div>
                    <button class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                            shortcode="start-plane">插入标星面板
                    </button>
                </div>
                <div class="short-plane">
                    <div>提示面板：
                        <select class="select-c-alert">
                            <option value="info">默认</option>
                            <option value="success">成功</option>
                            <option value="warning">警告</option>
                            <option value="error">错误</option>
                        </select>
                    </div>
                    <button class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                            shortcode="c-alert">插入提示面板
                    </button>
                </div>

                <div class="short-plane">
                    <div>下载面板：
                        <select class="select-c-downbtn">
                            <option value="default">默认</option>
                            <option value="bd">百度</option>
                            <option value="al">阿里云盘</option>
                            <option value="ty">天翼</option>
                            <option value="ct">诚通</option>
                            <option value="lz">蓝奏</option>
                            <option value="360">360</option>
                            <option value="wy">微云</option>
                            <option value="xl">迅雷</option>
                            <option value="github">Github</option>
                        </select>
                    </div>
                    <button class="add-shortcode-btn el-button el-button--default el-button--small corepress-edit-window-btn"
                            shortcode="c-downbtn">插入下载面板
                    </button>
                </div>
            </el-tab-pane>
            <el-tab-pane label="代码高亮" name="3">
                <button class="el-button el-button--default el-button--small corepress-edit-window-btn"
                        onclick="addshortcode('corepress-code')">代码高亮
                </button>

                <button class="el-button el-button--default el-button--small corepress-edit-window-btn"
                        onclick="addshortcode('corepress-code-line')">行内代码
                </button>
            </el-tab-pane>
        </el-tabs>
        <p>
            <a href="https://www.yuque.com/applek/corepress/shortcode" target="_blank">相关说明</a>
        </p>
    </div>
    <script>
        var edit_window = new Vue({
            el: '#corepress-edit-window',
            data: {
                activeName: '1',
                cvideo_form: {
                    videourl: '',
                    imgurl: '',
                    type: 'video/mp4'
                },
                dh_form: {
                    url: '',
                    title: '',
                    des: '',
                    icon: ''
                },
                dialog: {
                    cvideo: false,
                    dh: false
                }
            },
            methods: {
                insertshortcode(type) {
                    if (type == 'bvideo') {
                        this.$prompt('请输入BV号', '提示', {
                            confirmButtonText: '确定',
                            cancelButtonText: '取消',
                        }).then(({value}) => {
                            addshortcode('bvideo', value)
                        });
                    } else if (type == 'cvideo') {
                        this.dialog.cvideo = false;
                        addContentToEditer(1, '[c-video url="' + this.cvideo_form.videourl + '" img="' + this.cvideo_form.imgurl + '" type="' + this.cvideo_form.type + '"][/c-video]');
                    } else if (type == 'dh') {
                        this.dialog.dh = false;
                        addContentToEditer(1, '[dh url="' + this.dh_form.url + '" icon="' + this.dh_form.icon + '" des="' + this.dh_form.des + '"]' + this.dh_form.title + '[/dh]');
                    }
                },
                slectimg(mark) {
                    var upload_frame;
                    upload_frame = wp.media({
                        title: '选择图片',
                        button: {
                            text: '插入',
                        },
                        multiple: false
                    });
                    upload_frame.on('select', function () {
                        attachment = upload_frame.state().get('selection').first().toJSON();
                        if (mark === 'cvideo_form.imgurl') {
                            edit_window.cvideo_form.imgurl = attachment.url;
                        } else if (mark === 'cvideo_form.videourl') {
                            edit_window.cvideo_form.videourl = attachment.url;
                        } else if (mark === 'dh_form.icon') {
                            edit_window.dh_form.icon = attachment.url;
                        }
                    });
                    upload_frame.open();
                }
            }
        });
        jQuery('.add-shortcode-btn').click(function () {
            var shortcodename = jQuery(this).attr('shortcode');
            if (shortcodename == 'title-plane') {
                addshortcode('title-plane')
            } else if (shortcodename == 'icon-url') {
                addshortcode('icon-url')
            } else if (shortcodename == 'zd-plane') {
                addshortcode('zd-plane')
            } else if (shortcodename == 'clickshow') {
                addshortcode('clickshow')
            } else if (shortcodename == 'loginshow') {
                addshortcode('loginshow')
            } else if (shortcodename == 'selectbox') {
                addshortcode('selectbox')
            } else if (shortcodename == 'pwdshow') {
                addshortcode('pwdshow')
            } else if (shortcodename == 'start-plane') {
                $type = jQuery('.select-start-plane option:selected').val();
                addshortcode('start-plane', $type);
            } else if (shortcodename == 'c-alert') {
                $type = jQuery('.select-c-alert option:selected').val();
                addshortcode('c-alert', $type)
            } else if (shortcodename == 'c-downbtn') {
                $type = jQuery('.select-c-downbtn option:selected').val();
                addshortcode('c-downbtn', $type)
            } else if (shortcodename == 'replyread') {
                addshortcode('replyread')
            } else if (shortcodename == 'c-video') {
                addshortcode('c-video')
            }
        })
    </script>
</div>