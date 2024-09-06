ob_start();
  echo do_shortcode('[posts_like_dislike id='.get_the_ID().']');
  $output = ob_get_contents();
  ob_end_clean();
