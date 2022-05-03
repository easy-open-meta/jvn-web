<?php
global $corepress_post_meta, $set;
if ($corepress_post_meta['postrighttag']['open'] == 1) {
    ?>
    <style>
        .crumbs-plane-body:before {
            content: "";
            position: absolute;
            right: 0;
            top: 0;
            color: #fff;
            width: 0;
            height: 0;
            border-top: 80px solid<?php echo $corepress_post_meta['postrighttag']['color']?>;
            border-left: 80px solid transparent;
            z-index: 10;
        }

        .crumbs-plane-body:after {
            content: "<?php echo $corepress_post_meta['postrighttag']['text']?>";
            color: #fff;
            position: absolute;
            right: 10px;
            top: 14px;
            z-index: 9;
            transform: rotate(45deg);
            z-index: 10;

        }
    </style>
    <?php
}
?>
    <div class="post-content-body">
        <div class="post-content">
            <h1 class="post-title">
                <?php the_title();
                ?>
            </h1>
            <?php
            if (wp_is_mobile()) {
                if ($set['ad']['post_2_phone'] != null) {
                    ?>
                    <div class="ad-plane-post-in">
                        <?php echo base64_decode($set['ad']['post_2_phone']); ?>
                    </div>
                    <?php
                }
            } else {
                if ($set['ad']['post_2'] != null) {
                    ?>
                    <div class="ad-plane-post-in">
                        <?php echo base64_decode($set['ad']['post_2']); ?>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="post-content-post">
                <div class="post-content-content">
                    <?php
                    the_content();
                    if (is_page_template('page-links.php')) {
                        get_template_part('component/page/template-links');
                    } elseif (is_page_template('page-friends.php')) {
                        get_template_part('component/page/template-friends');
                    }
                    ?>
                </div>

                <div class="post-tool-plane">
                    <?php
                    if ($corepress_post_meta['catalog'] == 1) {
                        file_load_lib('layer/layer.js', 'js');
                        ?>
                        <div id="post-catalog">
                            <div class="catalog-title">文章目录</div>
                            <div id="post-catalog-list">
                            </div>
                            <div class="catalog-close" onclick="close_show(0)">关闭</div>
                        </div>
                        <div id="post-catalog-bar" onclick="close_show(1)" class="post-catalog-bar-left-minborder">
                            <i class="far fa-book-open" style="font-size: 10px"></i> 目 录
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            if (wp_is_mobile()) {
                if ($set['ad']['post_3_phone'] != null) {
                    ?>
                    <div class="ad-plane-post-in">
                        <?php echo base64_decode($set['ad']['post_3_phone']); ?>
                    </div>
                    <?php
                }
            } else {
                if ($set['ad']['post_3'] != null) {
                    ?>
                    <div class="ad-plane-post-in">
                        <?php echo base64_decode($set['ad']['post_3']); ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

<?php
comments_template();
?>