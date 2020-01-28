<?php
// スマホ判定
function is_mobile()
{
    $useragents = array('iPhone','iPod','Android','dream','CUPCAKE','blackberry9500','blackberry9530','blackberry9520','blackberry9550','blackberry9800','webOS','incognito','webmate');
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

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

// 人気記事出力用
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0';
    }
    return $count;
}
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count=='') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// エディタースタイル
if (!function_exists('initialize_tinymce_styles')) {
    function initialize_tinymce_styles($init_array)
    {
        $style_formats = array(
          array(
            'title' => 'ボタン',
            'inline' => 'span',
            'classes' => 'post-btn',
          ),
          array(
            'title' => 'ポイント',
            'block' => 'p',
            'classes' => 'point',
          ),
          array(
            'title' => '囲み（グレー）',
            'block' => 'p',
            'classes' => 'border-gray',
          ),
        );
        $init_array['style_formats'] = json_encode($style_formats);
        $init_array['table_resize_bars'] = false;
        $init_array['object_resizing'] = 'img';

        return $init_array;
    }
}
add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);

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

// 検索結果カテゴリ除外
function SearchExcludeCategoryFilter($query)
{
    if ($query->is_search) {
        $query->set('cat', '-549');
    }
    return $query;
}
add_filter('pre_get_posts', 'SearchExcludeCategoryFilter');

function custom_should_index_post($should_index, WP_Post $post)
{
    $categories_to_exclude = array(549);
    if (false === $should_index) {
        return $should_index;
    }

    if ($post->post_type !== 'page') {
        return $should_index;
    }


    $post_category_ids = wp_get_post_categories($post->ID);
    $remaining_category_ids = array_diff($post_category_ids, $categories_to_exclude);
    if (count($remaining_category_ids) === 0) {
        return false;
    }
    return $should_index;
}
add_filter('algolia_should_index_post', 'custom_should_index_post', 10, 2);
add_filter('algolia_should_index_searchable_post', 'custom_should_index_post', 10, 2);

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

function add_add_shortcode_button_plugin($plugin_array)
{
    $plugin_array[ 'example_shortcode_button_plugin' ] = get_template_directory_uri().'/lib/js/editor-button.js';
    return $plugin_array;
}
add_filter('mce_external_plugins', 'add_add_shortcode_button_plugin');

function add_shortcode_button($buttons)
{
    $buttons[] = 'nlink';
    return $buttons;
}
add_filter('mce_buttons', 'add_shortcode_button');

// テーブルのスタイルを消す
function customize_tinymce_settings($mceInit)
{
    $mceInit['table_resize_bars'] = false;
    $mceInit['object_resizing'] = "img";
    return $mceInit;
}
add_filter('tiny_mce_before_init', 'customize_tinymce_settings', 0);

//popular post からquery_posts生成
function get_popular_args($range= "weekly", $limit = 5)
{
    $shortcode = '[wpp';
    $atts = '
          post_html="{url},"
          wpp_start=""
          wpp_end=""
          order_by="views"
          post_type="post"
          stats_comments=0
          stats_views=1
            ';
    $atts_2 = ' range='. $range;
    $atts_3 = ' limit='. $limit;
    $shortcode .= ' ' . $atts . $atts_2 . $atts_3 . ']';
    $result = explode(",", strip_tags(do_shortcode($shortcode)));
    $ranked_post_ids = array();
    foreach ($result as $_url) {
        if (!empty($_url) && trim($_url) != '') {
            $id_string = url_to_postid($_url);
            array_push($ranked_post_ids, intval($id_string));
        }
    }
    $args = array(
    'posts_per_page' => $limit,
    'post__in' => $ranked_post_ids,
    'orderby' => 'post__in'
  );

    return $args;
}
