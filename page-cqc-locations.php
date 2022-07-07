<?php
// Get start time
$executionStartTime = microtime(true);

$GET_I_C = $_GET["inspection-category"];

// Query CQC API
$api_response = json_decode(hw_feedback_cqc_api_query_locations(array(
      'localAuthority' => 'Buckinghamshire',
      'page' => '1',
      'perPage' => '600',
      'primaryInspectionCategoryCode' => $GET_I_C,
      'partnerCode' => 'HW_BUCKS'
    )));

// Convert "JSON object" to array
$locations = array_values($api_response->locations);

// get the total count of results
$total = $api_response->total;
$registered_counter = 0;
$matched_count = 0;

// Clean out anything not Registered
foreach ($locations as $key => $current_location) {
  $current_location_id = $current_location->locationId;
  // get the location details
  $current_location_detail = json_decode(hw_feedback_cqc_api_query_by_id('locations',$current_location->locationId));
  if ($current_location_detail->registrationStatus != 'Registered') {
    //echo '<p>'. $current_location->locationName . ' (<a href="https://www.cqc.org.uk/location/' . $current_location->locationId . '" target="_blank">' . $current_location->locationId . '</a>)</p>';
    unset($locations[$key]);
    continue;
  }
  $registered_counter++;
}
// Reindex array - THIS IS CRITICAL!
$locations = array_values($locations);

echo '<h1>CQC Locations</h1>';
echo '<p>API Query: <a href="https://api.cqc.org.uk/public/v1' . $api_response->firstPageUri . '" target="_blank">https://api.cqc.org.uk/public/v1' . $api_response->firstPageUri . '</a>)</p>';

// query all local_services posts regardless of status
$my_query = new WP_Query( array(
  'posts_per_page' => -1,
  'post_type' => 'local_services',
  'meta_key' => 'hw_services_cqc_location',
  'orderby' => 'meta_value'
  )
);

echo '<h2>Matched in hw-feedback</h2>';
// loop the posts
while ($my_query->have_posts()) {
  $my_query->the_post();
  // get the CQC Location ID from post_meta
  $our_location_id = get_post_meta( $post->ID, 'hw_services_cqc_location', true );
  // search for the location_id in $locations
  $result = array_search($our_location_id, array_column($locations, 'locationId'));
  // $result can return empty which PHP can read as [0] - so check it is not empty
  if ($result !== false){
    $current_location_name = $locations[$result]->locationName;
    $current_location_id = $locations[$result]->locationId;
    echo '<p>'. $current_location_name . ' (<a href="https://www.cqc.org.uk/location/' . $current_location_id . '" target="_blank">' . $current_location_id . '</a>)</p>';
    // count the match
    $matched_count ++;
    // remove the service from $locations
    unset($locations[$result]);
  }
}
echo '<p>Matched: ' . $matched_count . '/' . $registered_counter . '</p>';
// Reindex array - THIS IS CRITICAL!
$locations = array_values($locations);

echo '<h2>Un-matched / To be added</h2>';
// loop the remaning $locations
foreach ($locations as $location) {
  echo '<p>'. $location->locationName . ' (<a href="https://www.cqc.org.uk/location/' . $location->locationId . '" target="_blank">' . $location->locationId . '</a>)</p>';
}
echo '<p>Un-matched: ' . count($locations) . '/' . $registered_counter . '</p>';
// Get finish time
$executionEndTime = microtime(true);
// The result will be in seconds and milliseconds.
$seconds = $executionEndTime - $executionStartTime;
// Print it out
echo "<p>This script took $seconds seconds to execute.</p>";

?>
