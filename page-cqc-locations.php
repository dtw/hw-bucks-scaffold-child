<?php

$executionStartTime = microtime(true);

$api_response = json_decode(hw_feedback_cqc_api_query_locations(array(
      'localAuthority' => 'Buckinghamshire',
      'page' => '1',
      'perPage' => '20',
      'primaryInspectionCategoryCode' => 'P2',
      'partnerCode' => 'HW_BUCKS'
    )));

echo '<h1>CQC Locations</h1>';
echo '<p>API Query: <a href="https://api.cqc.org.uk/public/v1' . $api_response->firstPageUri . '" target="_blank">https://api.cqc.org.uk/public/v1' . $api_response->firstPageUri . '</a>)</p>';
echo '<h2>Matched</h2>';
// get the total count of results
$total = $api_response->total;
$registered_counter = 0;
$matched_count = 0;

$my_query = new WP_Query( array(
  'posts_per_page' => -1,
  'post_type' => 'local_services',
  'meta_key' => 'hw_services_cqc_location',
  'orderby' => 'meta_value'
  )
);

$locations = array_values($api_response->locations);
foreach ($locations as $key => $current_location) {
  $current_location_id = $current_location->locationId;
  // get the location details
  $current_location_detail = json_decode(hw_feedback_cqc_api_query_by_id('locations',$current_location_id));
  // get the reg status
  $current_location_status = $current_location_detail->registrationStatus;
  $current_location_type = $current_location_detail->inspectionDirectorate;

  if ($current_location_status == 'Registered') {
    $registered_counter++;
    // otherwise
    $current_location_name = $current_location_detail->name;
    while ($my_query->have_posts()) {
      $my_query->the_post();
      $our_location_id = get_post_meta( $post->ID, 'hw_services_cqc_location', true );
      if ($current_location_id == $our_location_id) {
        echo '<p>'. $current_location_name . ' (<a href="https://www.cqc.org.uk/location/' . $current_location_id . '" target="_blank">' . $current_location_id . '</a>)</p>';
        $matched_count ++;
        // this really is a thing - if we just break the loop, we stay at the same point in the query results, so we need to rollback to the start of the query
        $my_query->rewind_posts();
        unset($locations[$key]);
        break 1;
      }
    }
  } else {
    // it's not Registered
    unset($locations[$key]);
  }
}
echo '<p>Matched: ' . $matched_count . '/' . $registered_counter . '</p>';
echo '<h2>Un-matched</h2>';

//$unmatched_locations = $api_response->locations;
foreach ($locations as $location) {
  echo '<p>'. $location->locationName . ' (<a href="https://www.cqc.org.uk/location/' . $location->locationId . '" target="_blank">' . $location->locationId . '</a>)</p>';
}

$executionEndTime = microtime(true);

// The result will be in seconds and milliseconds.
$seconds = $executionEndTime - $executionStartTime;
// Print it out
echo "<p>This script took $seconds seconds to execute.</p>";

?>
