<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

//$in = "0D0AE143183F0D553F39D2CAF8E83F3B";
$in = "[{"num":"4095","";
$key = "abcdefgh01234567";
$aes = new Aes($key, 'ECB');

//$y = hex2bin($in);
$y = $aes->encrypt($in);
$x = $aes->decrypt($y);

//echo base64_encode($y);
echo bin2hex($y);
echo $x;

?>