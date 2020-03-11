<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>
</main>
<!-- メインコンテンツ終了 -->

<!-- CTA -->
<?php get_template_part('templates/cta-foot'); ?>

<!-- フッター -->
<footer id="footer" class="sec">
<div class="wrap">
<h2 class="txt-c"><a href="<?php echo $home; ?>"><img src="<?php echo $wp_url; ?>/lib/images/logo.svg" alt="<?php bloginfo('name'); ?>"></a></h2>
<ul class="txt-c foot-link mb-2">
<li class="d-i-block"><a href="<?php echo $home; ?>">TOP</a></li>
<li class="d-i-block"><a href="https://lamp.jp" target="_blank">Company</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/privacy-policy/">Privacy Policy</a></li>
</ul>
<p class="m-0 txt-c"><small>©2017 <a href="<?php echo $home; ?>"><?php bloginfo('name'); ?></a></small></p>
</div>
</footer>
<!-- フッター終了 -->
<?php wp_footer(); ?>
</body>
</html>