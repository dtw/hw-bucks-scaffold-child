<?php

// Redirect to thank you post after comment on local_services

add_action('comment_post_redirect', 'redirect_to_thank_page', 10, 2);

function redirect_to_thank_page($location, $commentdata)
{
  $the_url = site_url();
  $post_id = $commentdata->comment_post_ID;
  $cid = $commentdata->comment_ID;
  if ('local_services' == get_post_type($post_id)) {
    // set a cookie with the comment id in it - we need this on the next page
    setcookie('comment_id', $cid, time() + HOUR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    return $the_url . '/about-you/';
  }
  return $location;
}
