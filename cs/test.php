<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

$aes = new Aes('abcdefgh01234567', 'ECB');

$y = $aes->encrypt('hello world!');
$x = $aes->decrypt($y);

//echo base64_encode($y);
echo $y;
echo $x;

?>