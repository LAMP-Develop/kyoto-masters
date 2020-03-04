<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
$lang = ICL_LANGUAGE_CODE;
if ($lang === 'en') {
    $others = 'Seasonal other flowers';
} elseif ($lang === 'ko') {
    $others = '계절 다른 꽃';
} elseif ($lang === 'zh-hans') {
    $others = '时令他人花';
} elseif ($lang === 'zh-hant') {
    $others = '時令他人花';
} else {
    $others = '他のいま見頃の花';
}
?>

<aside id="sidebar">
<!-- others -->
<div class="inner">
<h3><?php echo $others; ?></h3>
<ul class="tag-list">
<?php
$now_month = (int)date('n');
$args = [
    'hide_empty' => false,
];
$terms = get_terms('other_flowers_cat', $args);
foreach ($terms as $term):
    $term_id = 'other_flowers_cat_'.$term->term_id;
    $best_month = (int)get_field('best_month', $term_id);
    if ($best_month === 0 || $now_month !== $best_month) {
        continue;
    }
    $flower_name = $term->name;
    $flower_slug = get_term_link($term->slug, 'other_flowers_cat');
?>
<li class="mb-05"><a href="<?php echo $flower_slug; ?>"><?php echo $flower_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</aside>
