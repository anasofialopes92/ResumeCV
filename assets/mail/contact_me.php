<?php
require_once "Mail.php";
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "resumecv@sofialopes.pt"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Website Contact Form:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
$header = "From: noreply@sofialopes.pt\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";	
print phpinfo();  
/*if(!mail($to, $subject, $body, $header))
  http_response_code(500);*/

$host = "ssl://authsmtp.securemail.pro";                   // Endereço do Servidor e Encriptação SSL
$port = "465"; // SMTP Port
$username = "smtp@sofialopes.ext";        // Nome do Utilizador, Por exemplo se o seu dominio é oseudominio.pt terá de preencher com smtp@oseudominio.pt $password = "Password";           // Utilize a password definida para a conta Smtp através da Area de cliente Amen.pt

 $headers = array ('From' => $from,
 'To' => $to,
 'Subject' => $subject);
 $smtp = Mail::factory('smtp',
 array ('host' => $host,
 'port' => $port,
 'auth' => true,
 'username' => $username,
 'password' => $password));
 echo "send mail ...";
 $mail = $smtp->send($to, $headers, $body);
 echo "mail sent.";
 if (PEAR::isError($mail)) {
 http_response_code(500);
 } else {
 http_response_code(200);
 }
?>
