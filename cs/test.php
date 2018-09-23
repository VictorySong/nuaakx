<?php
use PhpAes\Aes;

$aes = new Aes('abcdefgh01234567', 'CBC', '1234567890abcdef');

$y = $aes->encrypt('hello world!');
$x = $aes->decrypt($y);

echo base64_encode($y);
echo $x;

?>