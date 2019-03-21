<?php
if(isset($_POST['email'])) {
 
    $email_to = "contact@inkhigh.com";
    $email_subject = "Website contact submission";
 
    function died($error) {
        echo "Sorry, these error(s) were found in the form you submitted: ";
        echo $error."<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Sorry, but there is a problem with the form you submitted.');       
    }
 
    $name = $_POST['name']; // required
    $phone_no = $_POST['phone_no']; // required
    $email_from = $_POST['email']; // required
    $purpose = $_POST['purpose']; // not required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
  }
 
  if(preg_match($string_exp,$phone_no)) {
    $error_message .= 'The phone number you entered does not appear to be valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'Please type a valid message.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Phone number: ".clean_string($phone_no)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Purpose: ".clean_string($purpose)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
Thanks for getting in touch! We'll be in touch with you very soon :)
 
<?php
 
}
?>