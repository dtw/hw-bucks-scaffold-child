<?php

function getUrls($string)
{
    $regex = '/(<a[a-z =\-"]*href="([^"]+)">([^<]+)<\/a>)/mi';
    //$regex = '/(<li>(.*) - Read <a.*\n<a[a-z =\-"]*href="https:\/\/community([^"]+)">([^<]+)<\/a>)/mi';
        preg_match_all($regex, $string, $matches,PREG_SET_ORDER);
    return ($matches);
}

$the_query = new WP_Query(array(
  'posts_per_page' => -1,
  'post_status' => 'publish',
  // post, page, signposts, local_services
  'post_type' => 'page',
  //'p' => '46209'
));

$counter = 0;
echo 'ID,Post URL,Post Title,Post URL HTML,Post Edit URL,Full Anchor,Anchor,URL<br />';
while ($the_query->have_posts())
{
    $the_query->the_post();
    $_post_id = get_the_id();
    $_post_title = get_the_title();
    $_post_content = get_post_field( 'post_content', $_post_id);

    $urls = getUrls($_post_content);
    foreach($urls as $url)
    {
      //echo $counter . ',' . get_permalink() . ',' . $url[2] . '<br />';
      //$counter++;
        //if (substr($url[2], 0, 40) == "https://healthwatchbucks.sharepoint.com/") {
        if (substr($url[2], 0, 45) == "https://communityimpactbucks1.sharepoint.com/") {
            $counter++;
            //echo $counter . ') <a href="' . get_permalink(). '">' . get_permalink(). '</a><br />';
            echo $counter . ',' . get_permalink() . ',"' . $_post_title . '",' . '<a href="' . get_permalink(). '">' . get_permalink(). '</a>,' . 'https://www.healthwatchbucks.co.uk/wp-admin/post.php?post=' . $_post_id . '&action=edit,' .  htmlspecialchars($url[1]) . ',"' .  $url[3] . '",' .  $url[2] . '<br />';
            //echo $counter . ',"' .  htmlspecialchars($url[0]) . '","' .  htmlspecialchars($url[1]) . '","' .  $url[2] . '","https://community' .  $url[3] . '"<br />';
          }
    }

}

wp_reset_postdata();

?>
