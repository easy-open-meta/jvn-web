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
        <div class="crumbs-plane-body">
            <?php
            if (is_single()) {
                if ($set['theme']['crumbs'] == 1) {
                    ?>
                    <div class="crumbs-plane">
                        <?php
                        the_breadcrumb();
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="post-content">
            <h1 class="post-title">
                <?php the_title();
                ?>
            </h1>
            <div class="post-info">
                <div class="post-info-left">
                    <?php
                    $author = get_the_author_meta('ID');
                    $author_url = get_author_posts_url($author);
                    $author_name = get_the_author();
                    ?>
                    <a class="nickname url fn j-user-card" data-user="<?php echo $author; ?>"
                       href="<?php echo $author_url; ?>"><i class="fa fa-user"
                                                            aria-hidden="true"></i><?php echo $author_name; ?>
                    </a>
                    <span class="dot">•</span>
                    <time class="entry-date published"
                          datetime="<?php echo get_post_time('c', false, $post); ?>>" pubdate><i
                                class="far fa-clock"></i>
                        <?php echo format_date(get_post_time('U', false, $post)); ?>
                    </time>
                    <span class="dot">•</span><i class="fas fa-folder"></i>
                    <?php the_category(', ', '', false); ?>
                    <?php if (function_exists('the_views')) {
                        $views = intval(get_post_meta($post->ID, 'views', true));
                        ?>
                        <span class="dot">•</span>
                        <span><i class="fa fa-eye"
                                 aria-hidden="true"></i><?php echo sprintf('%s 阅读', $views); ?></span>
                    <?php }
                    if (get_edit_post_link() != null) {

                        ?>
                        <span class="dot">•</span>
                        <a href="<?php echo get_edit_post_link(); ?>"><i class="fas fa-edit"></i> 编辑</a>
                        <?php
                    }
                    ?>
                </div>
                <div class="post-info-right">
            <span title="关闭或显示侧边栏" class="post-info-switch-sidebar post-info-switch-sidebar-show"><i
                        class="fas fa-toggle-on"></i></span>
                </div>
            </div>
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
                    ?>
                </div>
                <div class="post-end-tools">
                    <?php if ($set['post']['copyright_show'] == 1) {
                        ?>
                        <div class="post-copyright">
                            <?php if ($set['post']['copyright'] == null) {
                                ?>
                                <p>版权声明：
                                    <br>作者：<?php echo $author_name ?>
                                    <br>链接：<span><u><a href="<?php echo get_permalink(); ?>"
                                                       target="_blank"><?php echo get_permalink(); ?></a></u></span>
                                    <br>来源：<?php bloginfo('name'); ?>
                                    <br>文章版权归作者所有，未经允许请勿转载。
                                </p>
                                <?php
                            } else {
                                echo corepress_replace_copyright(base64_decode($set['post']['copyright']));
                            }
                            ?>
                        </div>
                        <?php
                    } ?>
                    <div class="post-end-dividing">
                        THE END
                    </div>
                    <div class="post-tags">
                        <?php
                        the_tags('<span class="post-tags-icon"><i class="fas fa-tags"></i></span>', '');
                        ?>
                    </div>

                    <div class="post-end-tool-btns">
                        <div class="post-share-btn post-end-tool-btn-item"
                             onclick="showplane('.post-share-btn','#share-plane',event)">
                            <?php file_echo_svg('share-btn.svg') ?>
                            分享
                        </div>
                        <div class="post-qrcode-btn post-end-tool-btn-item"
                             onclick="showplane('.post-qrcode-btn','#qrcode-plane',event)">
                            <?php file_echo_svg('svg-ewm.svg') ?>
                            二维码
                        </div>
                        <?php if ($set['post']['reward1'] != null || $set['post']['reward2'] != null) {
                            ?>
                            <div class="post-reward-btn post-end-tool-btn-item"
                                 onclick="showplane('.post-reward-btn','#reward-plane',event)">
                                <?php file_echo_svg('reward.svg') ?>
                                打赏
                            </div>
                            <?php
                        } ?>

                        <?php
                        $description = str_replace("\n", "", mb_strimwidth(strip_tags(get_the_content()), 0, 200, "…", 'utf-8'));
                        ?>
                        <div id="share-plane" class="post-pop-plane">
                            <div class="post-share-list">
                                <a href="<?php echo get_share_url('qq', get_the_title(), $description) ?>"
                                   target="_blank">
                                    <?php file_echo_svg('share-qq.svg') ?>
                                </a>
                                <a href="<?php echo get_share_url('qzone', get_the_title(), $description) ?>"
                                   target="_blank">
                                    <?php file_echo_svg('share-qzone.svg') ?>
                                </a>
                                <a href="<?php echo get_share_url('weibo', get_the_title(), $description) ?>"
                                   target="_blank">
                                    <?php file_echo_svg('share-weibo.svg') ?>
                                </a>
                            </div>
                        </div>
                        <div id="qrcode-plane" class="post-pop-plane">
                            <div id="qrcode-img"></div>
                        </div>
                        <div id="reward-plane" class="post-pop-plane">
                            <img src="<?php echo $set['post']['reward1'] ?>" alt="">
                            <img src="<?php echo $set['post']['reward2'] ?>" alt="">
                        </div>
                    </div>


                    <?php
                    if ($set['theme']['postcontent']['turn_page_plane'] == 1) {
                        ?>
                        <div class="post-turn-page-plane">
                            <?php
                            $post_previous = get_previous_post(0);
                            $post_obj['title'] = get_the_title($post_previous);
                            $post_obj['thumbnail'] = get_the_post_thumbnail_url($post_previous);
                            $post_obj['url'] = get_the_permalink($post_previous);

                            if (has_post_thumbnail($post_previous)) {
                                $post_obj['thumbnail'] = get_the_post_thumbnail_url($post_previous, 'full');
                            } else if ($post_obj['post_meta']['thumbnail'] != '') {
                                $post_obj['thumbnail'] = $post_obj['post_meta']['thumbnail'];
                            } else if ($set['routine']['autothumbnail'] == 1) {
                                $preg = '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i';
                                preg_match($preg, $post_previous->post_content, $imgArr);
                                if (count($imgArr) != 0) {
                                    $post_obj['thumbnail'] = $imgArr[1];
                                }
                            }
                            if ($post_obj['thumbnail'] == null) {
                                $post_obj['thumbnail'] = $set['routine']['defaultthumbnail'];
                            }

                            ?>
                            <div class="post-turn-page post-turn-page-previous"
                                 style="background-image:url(<?php echo $post_obj['thumbnail'] ?>)">
                                <div class="post-turn-page-main">
                                    <div>
                                        <a href="<?php echo $post_obj['url']; ?>"><?php echo $post_obj['title']; ?></a>
                                    </div>
                                    <div class="post-turn-page-link-pre">
                                        <a href="<?php echo $post_obj['url']; ?>">
                                            <
                                            <上一篇
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $post_next = get_next_post(0);
                            $post_obj['title'] = get_the_title($post_next);
                            $post_obj['thumbnail'] = get_the_post_thumbnail_url($post_next);
                            $post_obj['url'] = get_the_permalink($post_next);
                            $post_obj['post_meta'] = json_decode(get_post_meta($post_next->ID, 'corepress_post_meta', true), true);


                            if (has_post_thumbnail($post_next)) {
                                $post_obj['thumbnail'] = get_the_post_thumbnail_url($post_next, 'full');
                            } else if ($post_obj['post_meta']['thumbnail'] != '') {
                                $post_obj['thumbnail'] = $post_obj['post_meta']['thumbnail'];
                            } else if ($set['routine']['autothumbnail'] == 1) {
                                $preg = '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i';
                                preg_match($preg, $post_next->post_content, $imgArr);
                                if (count($imgArr) != 0) {
                                    $post_obj['thumbnail'] = $imgArr[1];
                                }
                            }
                            if ($post_obj['thumbnail'] == null) {
                                $post_obj['thumbnail'] = $set['routine']['defaultthumbnail'];
                            }

                            ?>
                            <div class="post-turn-page post-turn-page-next"
                                 style="background-image:url(<?php echo $post_obj['thumbnail'] ?>)">
                                <div class="post-turn-page-main">
                                    <div>
                                        <a href="<?php echo $post_obj['url']; ?>"><?php echo $post_obj['title']; ?></a>
                                    </div>
                                    <div class="post-turn-page-link-next">
                                        <a href="<?php echo $post_obj['url']; ?>">下一篇>></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>

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
if ($set['post']['relevanceplane'] == 1) {
    ?>
    <div class="relevant-plane">
        <div class="plane-title">
            相关内容
        </div>
        <div>
            <ul class="relevant-list">
                <?php
                $catobj = get_the_category(get_the_ID());
                $catid = $catobj[0]->term_id;
                $arr = array(
                    'numberposts' => 6,
                    'category' => $catid,
                );
                $postlist = get_posts($arr);
                foreach ($postlist as $item) {
                    echo '<li><a href="' . get_the_permalink($item) . '">' . get_the_title($item) . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
}
?>

<?php
comments_template();
?>