<?php
$to = "0549112267@vtext.com";
$from = "mtckobby@gmail.com";
$message = "This is a text message \n New line";
$headers = "From: $from\n"
mail($to, '', $message, $headers);
?>