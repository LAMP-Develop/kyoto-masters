<?php

// 記事一覧アイキャッチ表示
function customize_manage_posts_columns($columns)
{
    $columns['thumbnail'] = __('Thumbnail');
    return $columns;
}
add_filter('manage_posts_columns', 'customize_manage_posts_columns');

function customize_manage_posts_custom_column($column_name, $post_id)
{
    if ('thumbnail' == $column_name) {
        $thum = get_the_post_thumbnail($post_id, 'thumbnail', array('style'=>'width:100px;height:auto'));
    }
    if (isset($thum) && $thum) {
        echo $thum;
    }
}
add_action('manage_posts_custom_column', 'customize_manage_posts_custom_column', 10, 2);


function extend_tiny_mce_before_init($mce_init)
{
    $mce_init['cache_suffix'] = 'v='.time();
    return $mce_init;
}
add_filter('tiny_mce_before_init', 'extend_tiny_mce_before_init');

// embedのカスタマイズ
function set_thumbnail_size()
{
    return 'medium';
}
add_filter('embed_thumbnail_image_size', 'set_thumbnail_size');

function set_thumbnail_image_shape()
{
    return 'square';
}
add_filter('embed_thumbnail_image_shape', 'set_thumbnail_image_shape');

remove_action('embed_head', 'print_embed_styles');
remove_action('embed_footer', 'print_embed_sharing_dialog');

function my_embed_styles()
{
    wp_enqueue_style('wp-oembed-embed', get_template_directory_uri().'/lib/css/wp-oembed-embed.css');
}
add_action('embed_head', 'my_embed_styles');


//本文抜粋を取得する関数
function get_the_custom_excerpt($content, $length)
{
    $length = ($length ? $length : 70);
    $content =  preg_replace('/<!--more-->.+/is', "", $content);
    $content =  strip_shortcodes($content);
    $content =  strip_tags($content);
    $content =  str_replace("&nbsp;", "", $content);
    $content =  mb_substr($content, 0, $length);
    return $content;
}


// ブログカード
function nlink_scode($atts)
{
    extract(shortcode_atts(array(
        'url'=>"",
        'title'=>"",
    ), $atts));
    $id = url_to_postid($url);
    if (empty($title)) {
        $title = esc_html(get_the_title($id));
    }
    if (has_post_thumbnail($id)) {
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'thumbnail');
        $img_tag = "<img src='".$img[0]."' alt='{$title}' width=".$img[1]." height=".$img[2].">";
    }
    $nlink .='
<div class="blog-card">
<a href="'.$url.'" target="_blank">
<div class="blog-card-thumbnail">'.$img_tag.'</div>
<div class="blog-card-content"><p>'.$title.'</p></div>
<span class="clear"></span>
</a>
</div>';
    return $nlink;
}
add_shortcode('nlink', 'nlink_scode');

//popular post からquery_posts生成
function get_popular_args($range = "weekly", $limit = 5)
{
    $shortcode = '[wpp';
    $atts = '
          post_html="{url},"
          wpp_start=""
          wpp_end=""
          order_by="views"
          post_type="post"
          stats_comments=0
          stats_views=1';
    $atts_2 = ' range='. $range;
    $atts_3 = ' limit='. $limit;
    $shortcode .= ' ' . $atts . $atts_2 . $atts_3 . ']';
    $result = explode(",", strip_tags(do_shortcode($shortcode)));
    $ranked_post_ids = [];
    foreach ($result as $_url) {
        if (!empty($_url) && trim($_url) != '') {
            $id_string = url_to_postid($_url);
            $ranked_post_ids[] = (int)$id_string;
        }
    }
    $args = [
        'posts_per_page' => $limit,
        'post__in' => $ranked_post_ids,
        'orderby' => 'post__in'
    ];

    return $args;
}

function get_popular_blooming($range = "weekly", $limit = 5, $post_type = 'flowering_info')
{
    $shortcode = '[wpp';
    $atts = '
          post_html="{url},"
          order_by="views"
          post_type="'.$post_type.'"
          stats_views=1';
    $atts_2 = ' range='. $range;
    $atts_3 = ' limit='. $limit;
    $shortcode .= ' ' . $atts . $atts_2 . $atts_3 . ']';
    $result = explode(",", strip_tags(do_shortcode($shortcode)));
    $ranked_post_ids = [];
    foreach ($result as $_url) {
        if (!empty($_url) && trim($_url) != '') {
            $id_string = url_to_postid($_url);
            $ranked_post_ids[] = (int)$id_string;
        }
    }
    $args = [
        'posts_per_page' => $limit,
        'post_type' => 'flowering_info',
        'post__in' => $ranked_post_ids,
        'orderby' => 'post__in'
    ];
    return $args;
}
