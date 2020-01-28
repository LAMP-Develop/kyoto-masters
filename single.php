<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();
if (have_posts()): the_post();

// 記事情報
$t = get_the_title();
$p = get_the_permalink();
$id = get_the_ID();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
// カテゴリー
$category = get_the_category();
// タグ
$tags = get_the_tags();
// PVつける
setPostViews($id);
?>
<section class="sec">
<div id="single-wrap" class="wrap main-wrap">
<article id="main-content" class="post-main">
<h2 class="postttl"><?php echo $t; ?></h2>
<div class="meta">
<time class="color-sky" datetime="<?php the_time('Y-m-d'); ?>"><i class="far fa-clock"></i> <?php the_time('Y.m.d'); ?></time>
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="ml-1 single-cat color-white bg-sky"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
</div>
<div class="i-catch">
<?php if (in_category('recipe')): ?>
<div class="youtube-wrap">
<iframe data-src="https://www.youtube.com/embed/<?php the_field('youtube_id', $id); ?>?playsinline=1&rel=0&iv_load_policy=3"></iframe>
</div>
<?php else: ?>
<?php if (has_post_thumbnail()): ?>
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<?php endif; ?>
<?php endif; ?>
</div>
<div class="post-inner mb-3">
<?php if (in_category('recipe')): ?>
<?php if (get_field('recipe_lead', $id)): ?>
<div class="youtube-txt mb-2">
<p class="m-0"><?php the_field('recipe_lead', $id); ?></p>
</div>
<?php endif; ?>
<div class="must-items bg-none">
<h3>洗濯前に洗濯表示をチェック！</h3>
<p class="m-0">洗濯表示一覧は <a href="<?php echo $home; ?>/mark-list/" target="_blank">こちら</a> からご確認下さい！</p>
</div>
<?php
// 必要なものリスト 始まり
$must_items = explode("\n", get_field('must_items', $id));
if (count($must_items) != 0): ?>
<div class="must-items">
<h3>● 必要なものリスト</h3>
<ul>
<?php  foreach ($must_items as $item): ?>
<li><?php echo $item; ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; // 必要なものリスト 終わり ?>
<div class="sentaku-step">
<?php
// 洗濯のステップ 始まり
for ($i=1; $i <= 10; $i++):
$step = get_field('step_'.$i, $id);
if ($step['step_img'] == '' && $step['step_ttl'] == '' && $step['step_txt'] == '') break; ?>
<div class="steps">
<div class="img">
<img src="<?php echo $step['step_img']; ?>" alt="<?php echo $step['step_ttl']; ?>">
</div>
<div class="txt">
<h4><?php echo $i.'. '.$step['step_ttl']; ?></h4>
<?php echo $step['step_txt']; ?>
</div>
<?php if ($step['point'] != ''): ?>
<p class="point"><?php echo $step['point']; ?></p>
<?php endif; ?>
</div>
<?php endfor; // 洗濯のステップ 終わり ?>
</div>
<?php else: ?>
<?php the_content(); ?>
<?php endif; ?>
</div>
<?php if (get_field('craftsman_ttl', $id)):
$illustrator = get_field('craftsman_illustrator', $id);
if ($illustrator == '男性') {
    $illust = $wp_url.'/lib/images/man_illust.png';
} else {
    $illust = $wp_url.'/lib/images/woman_illust.png';
}
?>
<div class="craftsman mb-3">
<h3 class="txt-c mb-1"><!--<img src="<?php echo $wp_url; ?>/lib/images/lightbulb-regular.png" alt="クリーニング職人さんからのアドバイス">-->
クリーニング職人さんからの<br class="pc">コメント</h3>
<div class="txt-c mb-1"><i class="fas fa-chevron-down"></i></div>
<div class="inner mb-1">
<img src="<?php echo $illust; ?>" alt="職人さん" class="craftsman-img">
<div class="txt-l craftsman-info">
<h4><?php echo get_field('craftsman_ttl', $id); ?></h4>
<p class="color-blue-2"><small>宅配クリーニング「リナビス」</small><br>職人 Aさん</p>
</div>
</div>
<p class="main-txt"><?php echo get_field('craftsman_txt', $id); ?></p>
</div>
<?php endif; ?>
<?php if ($tags != ''): ?>
<div class="single-tags">
<h3>この記事のタグ</h3>
<ul>
<?php foreach ($tags as $key => $tag): ?>
<li>
<a href="<?php echo $home.'/tag/'.$tag->slug; ?>" class="bg-sky color-white"><?php echo $tag->name; ?></a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
<!-- <div class="adsense mt-2">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9618133012525488" data-ad-slot="6422530866" data-ad-format="auto" data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> -->
<div class="sns-share mt-3">
<p class="mb-1 txt-c sns-share-str">この記事が気に入ったら<span>SNSでシェアしよう！</span></p>
<ul class="txt-c">
<li class="fb">
<a href="https://www.facebook.com/sharer.php?src=bm&u=<?php echo $p; ?>&t=<?php echo $t; ?>" target="_blank">
<img src="<?php echo $wp_url; ?>/lib/images/sns/ico_fb.png" alt="フェイスブックでシェアする">
</a>
</li>
<li class="tw">
<a href="https://twitter.com/intent/tweet?url=<?php echo $p; ?>&text=<?php echo $t; ?>" target="_blank">
<img src="<?php echo $wp_url; ?>/lib/images/sns/ico_tw.png" alt="ツイッターでシェアする">
</a>
</li>
<li class="li">
<a href="https://line.me/R/msg/text/?<?php echo $t.'%0A'.$p?>" target="_blank">
<img src="<?php echo $wp_url; ?>/lib/images/sns/ico_line.png" alt="LINEでシェアする">
</a>
</li>
<li class="ht">
<a href="http://b.hatena.ne.jp/entry/panel/?url=<?php echo $p; ?>&btitle=<?php echo $t; ?>" target="_blank">
<img src="<?php echo $wp_url; ?>/lib/images/sns/ico_hatena.png" alt="はてなブックマークに追加する">
</a>
</li>
</ul>
</div>
<hr class="common-hr">
<section id="relation-post">
<h3 class="ttl3">関連記事</h3>
<ul class="post-list">
<?php
$catkwds = [];
foreach ($category as $cat) {
    $catkwds[] = $cat->term_id;
}
$args = array(
  'post_type' => 'post',
  'posts_per_page' => '4',
  'cat' => '-549',
  'post__not_in' =>array($id),
  'category__in' => $catkwds,
  'orderby' => 'rand',
);
$my_query = new WP_Query($args);
while ($my_query->have_posts()) : $my_query->the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt">
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<time datetime="<?php echo $time; ?>"><i class="far fa-clock"></i> <?php echo $time; ?></time>
</div>
</div>
</a>
</li>
<?php endwhile; wp_reset_postdata(); ?>
</ul>
</section>
</article>
<!-- サイドバー -->
<?php get_sidebar(); ?>
</div>
</section>
<?php endif; get_footer();
