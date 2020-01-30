<?php

// カスタム投稿
function create_post_type()
{
    $supports = [
        'title',
        'editor',
        'thumbnail',
        'revisions',
        'custom-fields'
    ];
    register_post_type(
        'flowering',
        [
            'label' => '開花情報',
            'labels' => [
                'all_items' => '開花情報一覧',
            ],
            'description' => '開花情報一覧',
            'public' => true,
            'has_archive' => true,
            'supports' => $supports,
            'show_in_rest' => true,
            'menu_position' => 5
        ]
    );
    register_taxonomy(
        'flowering_cat',
        'flowering',
        [
            'label' => 'カテゴリー',
            'labels' => [
                'all_items' => 'カテゴリー一覧',
                'add_new_item' => 'カテゴリーを追加'
            ],
            'rewrite' => [
              'slug' => 'flowering',
              'with_front' => true,
              'hierarchical' => true,
            ],
            'show_in_rest' => true
        ]
    );
    flush_rewrite_rules(true);
}
add_action('init', 'create_post_type');
