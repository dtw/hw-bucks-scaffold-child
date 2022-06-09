<?
	// check for src in the URL
	if ( isset($_GET['src']) ) {
		$src = $_GET['src'];
		// delete the cookie when we come back from SM
		unset($_COOKIE['comment_id']);
    // set a cookie with the src
    setcookie('src', $src, time()+HOUR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    nocache_headers();
		$location = $the_url . '/thanks-' . $src . '/';
    wp_safe_redirect( $location, 303 );
    exit;
	} else {
		echo "No src detected.";
	}

?>
