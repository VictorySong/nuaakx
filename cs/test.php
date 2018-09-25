<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

$in = "aaaabb34234243324324234234234234bbccccdddd";
$key = "abcdefgh01234567";
$aes = new Aes($key, 'ECB');

$y = $aes->encrypt($in);
$x = $aes->decrypt($y);

//echo base64_encode($y);
echo bin2hex($y);
//echo $x;

?>