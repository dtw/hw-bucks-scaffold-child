<?php
  //set the DateTimeZone
  date_default_timezone_set('Europe/London');

  //response generation function
  $response = "";

  //function to generate response
  function your_story_generate_response($type, $message){

    global $response;

    //if($type == "success") $response = "<div class='success'>{$message}</div>";
    //else $response = "<div class='error'>{$message}</div>";
    if($type == "success") $response = "<div class='alert alert-success' role='alert'>{$message}</div>";
    else $response = "<div class='alert alert-danger' role='alert'>{$message}</div>";

  }

  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please mandatory information.";
  $email_invalid   = "Email address format invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your story has been sent.";

  //user posted variables
  $name = $_POST['message_name'];
  $email = $_POST['message_email'];
  $phone = $_POST['message_phone'];
  $message = $_POST['message_text'];
  $human = $_POST['message_human'];

  //php mailer variables
  $to = get_option('admin_email');
  $subject = "Someone sent a story via ".get_bloginfo('name');
  //set headers to allow HTML
  $headers = array('Content-Type: text/html; charset=UTF-8');

  if(!$human == 0){
    if($human != 2) your_story_generate_response("error", $not_human); //not human!
    else {
      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        your_story_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of message
        if(empty($message)){
          your_story_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          $formatted_message = '<strong>My story</strong><br>' . strip_tags($message) .'<br><br><strong>Email: </strong>' . $email . '<br><br><strong>Phone: </strong>' . strip_tags($phone) . '<br><br><strong>Sent at: </strong>' . date('d/m/Y h:i:s a', time());
          $sent = wp_mail($to, $subject, $formatted_message, $headers);
          if($sent) your_story_generate_response("success", $message_sent); //message sent!
          else your_story_generate_response("error", $message_unsent); //message wasn't sent
        }
      }
    }
  }
  else if ($_POST['submitted']) your_story_generate_response("error", $missing_content);

?>
<?php get_header(); ?>
  <div class="container">
    <div id="content" role="main" class="col-md-12 col-sm-12">
      <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

              <div class="entry-content">
                <?php the_content(); ?>
                <div id="respond">
                  <?php echo $response; ?>
                  <form class="your-story" action="<?php the_permalink(); ?>" method="post">
                    <p class="comment-form-comment">
                      <label for="comment">What happened?</label>
                      <p>Please tell us what happened. If you can, please make suggestions for improvements. Please do not include any personal information like names or detailed health information.</p>
                      <textarea required tabindex="1" id="comment" name="message_text" type="text" cols="45" rows="4" aria-required="true"><?php echo esc_textarea($_POST['message_text']); ?></textarea>
                    </p>
                    <hr />
                    <h2>Your contact details</h2>
                    <p>If you would like us to contact you about your story, please provide your details below.</p>
                    <p class="comment-form-author">
                      <label for="message_name">Your name</label>
                      <input placeholder="Your first and last names (optional)" id="author" name="message_name" type="text" size="30" tabindex="2" value="<?php echo esc_attr($_POST['message_name']); ?>"/>
                    </p>
                    <p class="comment-form-email">
                      <label for="message_email">Email</label>
                      <input placeholder="Your email address (optional)" id="email" name="message_email" type="text" size="30" tabindex="3" value="<?php echo esc_attr($_POST['message_email']); ?>"/>
                    </p>
                    <p class="comment-form-phone">
                      <label for="message_phone">Phone</label>
                      <input placeholder="Your phone number (optional)" id="phone" name="message_phone" type="text" size="30" tabindex="4" value="<?php echo esc_attr($_POST['message_phone']); ?>"/>
                    </p>
                    <h2>Privacy</h2>
                    <p>Please review our <a href="https://www.healthwatchbucks.co.uk/data-protection-privacy-policy/" target="_blank">data protection policy</a>. By completing this form, you agree that you have read and understood the privacy information provided, and confirm you are over 18.</p>
                    <p class="comment-form-verification">
                      <label for="message_human">Human Verification</label>
                      <input required class="no-asterisk" id="verification" name="message_human" type="text" tabindex="5" aria-required="true"> + 3 = 5
                    </p>
                    <input type="hidden" name="submitted" value="1">
                    <p class="form-submit">
                      <input name="submit" type="submit" id="submit" class="submit" value="Send your story" />
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
