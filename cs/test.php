<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

$aes = new Aes('abcdefgh01234567', 'ECB');
$in[16] = "Hello, World!";

$y = $aes->encrypt($in);
$x = $aes->decrypt($y);

//echo base64_encode($y);
echo bin2hex($y);
//echo $x;

?>