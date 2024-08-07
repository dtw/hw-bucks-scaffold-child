<?php
  //set the DateTimeZone
  date_default_timezone_set('Europe/London');

  //response generation function
  $response = "";
  $page_title_msg ="";

  //function to generate response
  function your_story_generate_response($type, $message){

    global $response;
    global $page_title_msg;

    //if($type == "success") $response = "<div class='success'>{$message}</div>";
    //else $response = "<div class='error'>{$message}</div>";
    if ($type == "success") {
      $response = "<div class='alert alert-success alert-relative' role='alert'>{$message}</div>";
      $page_title_msg = "Success - ";
    } else {
      $response = "<div class='alert alert-danger alert-relative' role='alert'>{$message}</div>";
      $page_title_msg = "Error - ";
    }
  }

  //response messages
  $not_human       = "Error - Robot check incorrect";
  $missing_content = "Error - Please fill in your story";
  $missing_recaptcha = "Error - Please complete the Robot check";
  $email_invalid   = "Error - Email address format invalid";
  $message_unsent  = "Error - Message was not sent. Try Again.";
  $message_sent    = "Success - Thanks, your story has been sent!";

  // user posted variables
  // names should only contain basic ascii characters
  $name = isset( $_POST['message_name'] ) ? filter_var($_POST['message_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_BACKTICK) : '';
  // sanitise email below
  $email = isset( $_POST['message_email'] ) ? $_POST['message_email'] : '';
  $phone = isset( $_POST['message_phone'] ) ? filter_var($_POST['message_phone'], FILTER_SANITIZE_NUMBER_INT) : '';
  $message  = isset( $_POST['message_text'] ) ? filter_var($_POST['message_text'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_BACKTICK) : '';  

  $recaptcha_response = isset( $_POST['g-recaptcha-response'] ) ? filter_var($_POST['g-recaptcha-response'], FILTER_SANITIZE_STRING) : '';

  //php mailer variables
  // get plugin settings/options
  $options = get_option('hw_feedback_options');
  if ( $options['hw_feedback_field_email_notifications_targets'] != "") {
    $to = $options['hw_feedback_field_email_notifications_targets'];
  } else {
    $to = get_option('admin_email');
  }
  $subject = "Someone sent a story via ".get_bloginfo('name');
  //set headers to allow HTML
  $headers = array('Content-Type: text/html; charset=UTF-8');

  //validate $recaptcha_response is not empty
  if ( !empty($recaptcha_response) ) {
    // send request
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = array(
      'secret' => '6LevMM0UAAAAAL2L_FW_OK7mq8s-aUs7z5bsOFCk',
      'response' => $recaptcha_response
    );
    $recaptcha_options = array(
      'http' => array (
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($recaptcha_data)
      )
    );
    $recaptcha_context  = stream_context_create($recaptcha_options);
    $recaptcha_verify = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $captcha_success = json_decode($recaptcha_verify);
    //check response from Google
    if ( $captcha_success->success==false ) {
      your_story_generate_response("error", $not_human); //not human!
    } else {
      //validate email
      if ( !$email == 0 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        your_story_generate_response("error", $email_invalid);
      } else {
        // email valid so sanitize email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        //validate presence of message
        if ( empty($message) ) {
          your_story_generate_response("error", $missing_content);
        } else {
          //ready to go!
          $formatted_message = '<strong>My story</strong><br>' . $message .'<br><br><strong>Name: </strong>' . $name . '<br><br><strong>Email: </strong>' . $email . '<br><br><strong>Phone: </strong>' . $phone . '<br><br><strong>Sent at: </strong>' . date('d/m/Y h:i:s a', time());
          $sent = wp_mail($to, $subject, stripslashes($formatted_message), $headers);
          if ($sent) {
            your_story_generate_response("success", $message_sent); //message sent!
            $_POST=array(); // blank the form
          } else {
            your_story_generate_response("error", $message_unsent); //message wasn't sent
          }
        }
      }
    }
  }
  else if ( isset($_POST['submitted']) ) {
    your_story_generate_response("error", $missing_recaptcha);
  }

?>
<?php /* Update the page title */
function modify_page_title($title) {
    //return $page_title_msg;
    global $page_title_msg;
    return $page_title_msg.$title;
}
add_filter( 'pre_get_document_title', 'modify_page_title', 999, 1 );
?>
<?php get_header(); ?>
  <div class="container">
    <div id="content" role="main" class="col-md-12 col-sm-12">
      <?php echo $response; ?>
      <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

              <div class="entry-content">
                <?php the_content(); ?>
                <div id="respond">
                  <form class="your-story" action="<?php the_permalink(); ?>" method="post">
                    <p class="comment-form-comment">
                      <label for="comment">What happened?</label>
                      <p>Please tell us what happened. If you can, please make suggestions for improvements. Please do not include any personal information like names or detailed health information.</p>
                      <textarea tabindex="0" id="comment" name="message_text" type="text" cols="45" rows="4" required="required"><?php echo isset( $_POST['message_text'] ) ? esc_textarea($_POST['message_text']) : ''; ?></textarea>
                    </p>
                    <h2>Your contact details</h2>
                    <p>If you would like us to contact you about your story, please provide your details below. You can also <a href="https://www.healthwatchbucks.co.uk/how-we-work/contact-us/">contact us</a>.</p>
                    <p class="comment-form-author">
                      <label for="message_name">Your name</label>
                      <input placeholder="Your first and last names (optional)" id="author" name="message_name" autocomplete="off" type="text" size="30" tabindex="0" value="<?php echo isset( $_POST['message_name'] ) ? esc_attr($_POST['message_name']) : ''; ?>"/>
                    </p>
                    <p class="comment-form-email">
                      <label for="message_email">Email</label>
                      <input placeholder="Your email address (optional)" id="email" name="message_email" autocomplete="off" type="text" size="30" tabindex="0" value="<?php echo isset( $_POST['message_email'] ) ? esc_attr($_POST['message_email']) : ''; ?>"/>
                    </p>
                    <p class="comment-form-phone">
                      <label for="message_phone">Phone</label>
                      <input placeholder="Your phone number (optional)" id="phone" name="message_phone" autocomplete="off" type="text" size="30" tabindex="0" value="<?php echo isset( $_POST['message_phone'] ) ? esc_attr($_POST['message_phone']) : ''; ?>"/>
                    </p>
                    <h2>Privacy</h2>
                    <p>Please review our <a href="<?php echo get_site_url() ?>/privacy/" target="_blank">privacy policy</a>. By ticking the box, you agree that you have read and understood the privacy information provided, and confirm you are over 18.</p>
                    <p class="comment-form-privacy">
                      <label class="inline-label" for="message_privacy">I agree</label>
                      <input class="no-asterisk regular-checkbox" id="privacy" name="message_privacy" type="checkbox" tabindex="0" required="required">
                    </p>
                    <h2>Robot check</h2>
                    <div class="comment-form-captcha">
                      <div class="g-recaptcha" data-sitekey="6LevMM0UAAAAADjh6PhzQFSWGWXtoOF1D061Ch78"></div>
                    </div>
                    <input type="hidden" name="submitted" value="1">
                    <p class="form-submit">
                      <input name="submit" type="submit" id="submit" class="submit" tabindex="0" value="Send your story" />
                    </p>
                  </form>
                </div>

              </div><!-- .entry-content -->

            </article><!-- #post -->

        <?php endwhile; // end of the loop. ?>
      </div><!-- .row -->
    </div><!-- #content -->
  </div><!-- .container -->
<?php get_footer(); ?>
