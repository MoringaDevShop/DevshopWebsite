<?php
// use actual sendgrid username and password in this section
$url = 'https://api.sendgrid.com/'; 
$user = ''; // place SG username here
$pass = ''; // place SG password here


// grabs HTML form's post data; if you customize the form.html parameters then you will need to reference their new new names here
$firstname = $_POST['firstname']; 
$lastname = $_POST['lastname']; 
$email = $_POST['email']; 
$phone = $_POST['phone'];
$appliedBefore = $_POST['appliedBefore'];
$interests = $_POST['interests'];
$experience = $_POST['experience'];


// note the above parameters now referenced in the 'subject', 'html', and 'text' sections
// make the to email be your own address or where ever you would like the contact form info sent
$params = array(
    'api_user'  => "$user",
    'api_key'   => "$pass",
    'to'        => "ben@moringadevshop.com", // set TO address to have the contact form's email content sent to
    'subject'   => "moringaschool", // Either give a subject for each submission, or set to $subject
    'html'      => "<html><head><title> Contact Form</title><body>
     name: $name\n<br>
     tel: $tel\n<br>
     email: $email\n<br>
     message: $message <body></title></head></html>", // Set HTML here.  Will still need to make sure to reference post data names
    'text'      => "
    name: $name\n<br>
     tel: $tel\n<br>
     email: $email\n<br>
     message: $message
    $message",
    'from'      => "ben@moringadevshop.com", // set from address here, it can really be anything
  );



$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// Redirect to thank you page upon successfull completion, will want to build one if you don't alreday have one available


header("Location:contact.html");
exit();

// print everything out
print_r($response);

?>
