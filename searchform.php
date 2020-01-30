<?php
$lang = ICL_LANGUAGE_CODE;
if ($lang === 'en') {
    $words = 'Search';
} elseif ($lang === 'ko') {
    $words = '신경이 쓰이는 키워드를 입력';
} elseif ($lang === 'zh-hans') {
    $words = '输入您关心的关键字';
} elseif ($lang === 'zh-hant') {
    $words = '輸入您關心的關鍵字';
} else {
    $words = '気になるキーワードを入力';
}
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
<div class="search-form">
<input id="s" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo $words; ?>">
<span id="search-sbmit" class="bg-sky relative"><i class="fas fa-search color-white abs-c"></i></span>
</div>
</form>
