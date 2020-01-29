<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>
</main>
<!-- メインコンテンツ終了 -->

<!-- フッター -->
<footer id="footer" class="sec">
<div class="wrap">
<h2 class="txt-c">
<a href="<?php echo $home; ?>/">
<img src="<?php echo $wp_url; ?>/lib/images/logo.svg" alt="<?php bloginfo('name'); ?>">
</a>
</h2>
<ul class="txt-c foot-link">
<li class="d-i-block"><a href="<?php echo $home; ?>/">トップ</a></li>
<li class="d-i-block"><a href="https://www.estorage.co.jp/?utm_source=shunomagazine&utm_medium=owned&utm_campaign=shunomagazine_owned" target="_blank">運営会社</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/site-map/">サイトマップ</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/privacy-policy/">プライバシーポリシー</a></li>
</ul>
<p class="m-0 txt-c">
<small>©2019 <a href="<?php echo $home; ?>/"><?php bloginfo('name'); ?></a></small>
</p>
</div>
</footer>
<!-- フッター終了 -->
<?php wp_footer(); ?>
</body>
</html>