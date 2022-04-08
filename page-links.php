<?php

function getUrls($string)
{
    $regex = '/https?\:\/\/[^\" ]+/i';
    preg_match_all($regex, $string, $matches);
    return ($matches[0]);
}

$the_query = new WP_Query('posts_per_page=-1');
$counter = 0;
while ($the_query->have_posts())
{
    $the_query->the_post();
    $_post_id = get_the_id();
    $_post_content = get_post_field( 'post_content', $_post_id);

    $urls = getUrls($_post_content);

    foreach($urls as $url)
    {
        if (substr($url, 0, 45) == "https://communityimpactbucks1.sharepoint.com/") {
            $counter++;
            echo $counter . ') <a href="' . get_permalink(). '">' . get_permalink(). '</a><br />';
          }
    }

}

wp_reset_postdata();

?>
