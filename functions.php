<?php

define('DEV','http://webperso.iut.univ-paris8.fr/~ewang/ProjetWeb/Record/');
define('FOND','http://img651.imageshack.us/img651/4572/170590xfloatdeivdiablo3.jpg');
define('imgD3','http://img692.imageshack.us/img692/1814/talesofd3copie.png');
define('imgTyrael', 'http://img845.imageshack.us/img845/8540/diabloiiityraelicon2byi.png');

function html($string){
	return utf8_encode(htmlspecialchars($string, ENT_QUOTES));
}

function sgbd($str){
	return mysql_escape_string(utf8_decode($str));
}

function url_format($string){
	$string = str_replace(' ', '-', strtolower($string));
	return html(preg_replace('#[^a-z0-9-]#', '', $string));
}

function generic_autoload($class){
	require_once str_replace('_', '/', $class).'.php';
}

function connecte() {
	return isset($_SESSION['id']);
}

function estAdmin() {
	return ($_SESSION['droit']==1 || $_SESSION['droit']==2);
}

function estSuperAdmin() {
	return $_SESSION['droit']==2;
}

function estProprietaire($idjoueur) {
	return $_SESSION['id']==$idjoueur;
}



function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',  str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}
?>
