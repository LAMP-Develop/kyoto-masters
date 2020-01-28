<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>

<nav class="pc-nav bg-gray-a pc-only">
<div class="wrap">
<ul>
<li><a class="modaal" href="#irui-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_irui.png" alt="衣類の種類から"><span>衣類の種類から<br>探す</span></a></li>
<li><a class="modaal" href="#sozai-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_sozai.png" alt="素材から"><span>素材から<br>探す</span></a></li>
<li><a class="modaal" href="#brand-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_brand.png" alt="ブランド名から"><span>ブランド名から<br>探す</span></a></li>
<li><a class="modaal" href="#nayami-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_keyword.png" alt="お悩みワードから"><span>お悩みワードから<br>探す</span></a></li>
<li><a class="modaal" href="#clothes-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_other.png" alt="洋服以外の種類から"><span>洋服以外の種類から<br>探す</span></a></li>
<li><a class="modaal" href="#relation-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_reco.png" alt="関連キーワードから"><span>関連キーワードから<br>探す</span></a></li>
</ul>
</div>
</nav>

<div id="irui-search" class="modaal-wrap">
<div class="form-wrap mb-1 relative">
<input class="search" type="text">
</div>
<ul class="target-area list area-1">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'parent' => 1,
  'hide_empty' => 1
);
$categories = get_categories($args);
if (count($categories) != 0):
foreach ($categories as $category): ?>
<li><a class="cats" href="<?php echo $home.'/irui/'.$category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<?php else: ?>
<li>まだ検索キーワードが登録されていません。</li>
<?php endif; ?>
</ul>
</div>

<div id="sozai-search" class="modaal-wrap">
<div class="form-wrap mb-1 relative">
<input class="search" type="text">
</div>
<ul class="target-area list area-2">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'parent' => 454,
  'hide_empty' => 1
);
$categories = get_categories($args);
if (count($categories) != 0):
foreach ($categories as $category): ?>
<li><a class="cats" href="<?php echo $home.'/material/'.$category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<?php else: ?>
<li>まだ検索キーワードが登録されていません。</li>
<?php endif; ?>
</ul>
</div>

<div id="brand-search" class="modaal-wrap">
<div class="form-wrap mb-1 relative">
<input class="search" type="text">
</div>
<ul class="target-area list area-3">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'parent' => 455,
  'hide_empty' => 1
);
$categories = get_categories($args);
if (count($categories) != 0):
foreach ($categories as $category): ?>
<li><a class="cats" href="<?php echo $home.'/brand/'.$category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<?php else: ?>
<li>まだ検索キーワードが登録されていません。</li>
<?php endif; ?>
</ul>
</div>

<div id="nayami-search" class="modaal-wrap">
<div class="form-wrap mb-1 relative">
<input class="search" type="text">
</div>
<ul class="target-area list area-4">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'parent' => 457,
  'hide_empty' => 1
);
$categories = get_categories($args);
if (count($categories) != 0):
foreach ($categories as $category): ?>
<li><a class="cats" href="<?php echo $home.'/trouble/'.$category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<?php else: ?>
<li>まだ検索キーワードが登録されていません。</li>
<?php endif; ?>
</ul>
</div>

<div id="clothes-search" class="modaal-wrap">
<div class="form-wrap mb-1 relative">
<input class="search" type="text">
</div>
<ul class="target-area list area-5">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'parent' => 456,
  'hide_empty' => 1
);
$categories = get_categories($args);
if (count($categories) != 0):
foreach ($categories as $category): ?>
<li><a class="cats" href="<?php echo $home.'/clothes/'.$category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<?php else: ?>
<li>まだ検索キーワードが登録されていません。</li>
<?php endif; ?>
</ul>
</div>

<div id="relation-search" class="modaal-wrap">
<div class="form-wrap mb-1 relative">
<input class="search" type="text">
</div>
<ul class="target-area list area-6">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'DESC',
  'parent' => 458,
  'hide_empty' => 1
);
$categories = get_categories($args);
if (count($categories) != 0):
foreach ($categories as $category): ?>
<li><a class="cats" href="<?php echo $home.'/relation/'.$category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<?php else: ?>
<li>まだ検索キーワードが登録されていません。</li>
<?php endif; ?>
</ul>
</div>