<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

//$in = "0D0AE143183F0D553F39D2CAF8E83F3B";
$in = "[{\"num\":\"3860\",\"vue\":\"10\"}{\"num\":\"3853\",\"vue\":\"10\"}{\"num\":\"3725\",\"vue\":\"10\"}{\"num\":\"3584\",\"vue\":\"10\"}{\"num\":\"3654\",\"vue\":\"10\"}{\"num\":\"3735\",\"vue\":\"10\"}{\"num\":\"3762\",\"vue\":\"10\"}{\"num\":\"3616\",\"vue\":\"10\"}{\"num\":\"3675\",\"vue\":\"10\"}{\"num\":\"3616\",\"vue\":\"10\"}{\"num\":\"3787\",\"vue\":\"10\"}{\"num\":\"3680\",\"vue\":\"10\"}{\"num\":\"3560\",\"vue\":\"10\"}{\"num\":\"3544\",\"vue\":\"10\"}{\"num\":\"3616\",\"vue\":\"10\"}{\"num\":\"3693\",\"vue\":\"10\"}{\"num\":\"4052\",\"vue\":\"10\"}{\"num\":\"3905\",\"vue\":\"10\"}{\"num\":\"3644\",\"vue\":\"10\"}{\"num\":\"3627\",\"vue\":\"10\"}{\"num\":\"3655\",\"vue\":\"10\"}{\"num\":\"3848\",\"vue\":\"10\"}{\"num\":\"3723\",\"vue\":\"10\"}{\"num\":\"3667\",\"vue\":\"10\"}{\"num\":\"3620\",\"vue\":\"10\"}{\"num\":\"3837\",\"vue\":\"10\"}{\"num\":\"3633\",\"vue\":\"10\"}{\"num\":\"3744\",\"vue\":\"10\"}{\"num\":\"3631\",\"vue\":\"10\"}{\"num\":\"3645\",\"vue\":\"10\"}{\"num\":\"3630\",\"vue\":\"10\"}{\"num\":\"3768\",\"vue\":\"10\"}{\"num\":\"3700\",\"vue\":\"10\"}{\"num\":\"3725\",\"vue\":\"10\"}{\"num\":\"3672\",\"vue\":\"10\"}{\"num\":\"3560\",\"vue\":\"10\"}{\"num\":\"3596\",\"vue\":\"10\"}{\"num\":\"3935\",\"vue\":\"10\"}{\"num\":\"3673\",\"vue\":\"10\"}{\"num\":\"3755\",\"vue\":\"10\"}{\"num\":\"3680\",\"vue\":\"10\"}{\"num\":\"3646\",\"vue\":\"10\"}{\"num\":\"3863\",\"vue\":\"10\"}{\"num\":\"3576\",\"vue\":\"10\"}{\"num\":\"3787\",\"vue\":\"10\"}{\"num\":\"3749\",\"vue\":\"10\"}{\"num\":\"3776\",\"vue\":\"10\"}{\"num\":\"3679\",\"vue\":\"10\"}{\"num\":\"3805\",\"vue\":\"10\"}{\"num\":\"3576\",\"vue\":\"10\"}{\"num\":\"3678\",\"vue\":\"10\"}{\"num\":\"3847\",\"vue\":\"10\"}{\"num\":\"3739\",\"vue\":\"10\"}{\"num\":\"3730\",\"vue\":\"10\"}{\"num\":\"3682\",\"vue\":\"10\"}{\"num\":\"3827\",\"vue\":\"10\"}{\"num\":\"3598\",\"vue\":\"10\"}{\"num\":\"3633\",\"vue\":\"10\"}{\"num\":\"3678\",\"vue\":\"10\"}{\"num\":\"3664\",\"vue\":\"10\"}{\"num\":\"3711\",\"vue\":\"10\"}{\"num\":\"3603\",\"vue\":\"10\"}{\"num\":\"3791\",\"vue\":\"10\"}{\"num\":\"3859\",\"vue\":\"10\"}{\"num\":\"3728\",\"vue\":\"10\"}{\"num\":\"3715\",\"vue\":\"10\"}{\"num\":\"3712\",\"vue\":\"10\"}{\"num\":\"3696\",\"vue\":\"10\"}{\"num\":\"3520\",\"vue\":\"10\"}{\"num\":\"3637\",\"vue\":\"10\"}{\"num\":\"3818\",\"vue\":\"10\"}{\"num\":\"3654\",\"vue\":\"10\"}{\"num\":\"3760\",\"vue\":\"10\"}{\"num\":\"3504\",\"vue\":\"10\"}{\"num\":\"3699\",\"vue\":\"10\"}{\"num\":\"3795\",\"vue\":\"10\"}{\"num\":\"3595\",\"vue\":\"10\"}{\"num\":\"3515\",\"vue\":\"10\"}{\"num\":\"3906\",\"vue\":\"10\"}{\"num\":\"3698\",\"vue\":\"10\"}{\"num\":\"3725\",\"vue\":\"10\"}{\"num\":\"3705\",\"vue\":\"10\"}{\"num\":\"3807\",\"vue\":\"10\"}{\"num\":\"3734\",\"vue\":\"10\"}{\"num\":\"3623\",\"vue\":\"10\"}{\"num\":\"3847\",\"vue\":\"10\"}{\"num\":\"3655\",\"vue\":\"10\"}{\"num\":\"3645\",\"vue\":\"10\"}{\"num\":\"3642\",\"vue\":\"10\"}{\"num\":\"3546\",\"vue\":\"10\"}{\"num\":\"3585\",\"vue\":\"10\"}{\"num\":\"3553\",\"vue\":\"10\"}{\"num\":\"3776\",\"vue\":\"10\"}{\"num\":\"3750\",\"vue\":\"10\"}{\"num\":\"3761\",\"vue\":\"10\"}{\"num\":\"3744\",\"vue\":\"10\"}{\"num\":\"3782\",\"vue\":\"10\"}{\"num\":\"3799\",\"vue\":\"10\"}{\"num\":\"3771\",\"vue\":\"10\"}{\"num\":\"3759\",\"vue\":\"10\"}{\"num\":\"3816\",\"vue\":\"10\"}{\"num\":\"3840\",\"vue\":\"10\"}{\"num\":\"3731\",\"vue\":\"10\"}{\"num\":\"3711\",\"vue\":\"10\"}{\"num\":\"3788\",\"vue\":\"10\"}{\"num\":\"3704\",\"vue\":\"10\"}{\"num\":\"3577\",\"vue\":\"10\"}{\"num\":\"3811\",\"vue\":\"10\"}{\"num\":\"3681\",\"vue\":\"10\"}{\"num\":\"3701\",\"vue\":\"10\"}{\"num\":\"3576\",\"vue\":\"10\"}{\"num\":\"3556\",\"vue\":\"10\"}{\"num\":\"3649\",\"vue\":\"10\"}{\"num\":\"3693\",\"vue\":\"10\"}{\"num\":\"3704\",\"vue\":\"10\"}{\"num\":\"3805\",\"vue\":\"10\"}{\"num\":\"3807\",\"vue\":\"10\"}{\"num\":\"3600\",\"vue\":\"10\"}{\"num\":\"3554\",\"vue\":\"10\"}{\"num\":\"3832\",\"vue\":\"10\"}{\"num\":\"3659\",\"vue\":\"10\"}{\"num\":\"3547\",\"vue\":\"10\"}{\"num\":\"3835\",\"vue\":\"10\"}{\"num\":\"3733\",\"vue\":\"10\"}{\"num\":\"3765\",\"vue\":\"10\"}{\"num\":\"3913\",\"vue\":\"10\"}{\"num\":\"3820\",\"vue\":\"10\"}{\"num\":\"3719\",\"vue\":\"10\"}{\"num\":\"3887\",\"vue\":\"10\"}{\"num\":\"3683\",\"vue\":\"10\"}{\"num\":\"3635\",\"vue\":\"10\"}{\"num\":\"3776\",\"vue\":\"10\"}{\"num\":\"3641\",\"vue\":\"10\"}{\"num\":\"3609\",\"vue\":\"10\"}{\"num\":\"3776\",\"vue\":\"10\"}{\"num\":\"3720\",\"vue\":\"10\"}{\"num\":\"3876\",\"vue\":\"10\"}{\"num\":\"3676\",\"vue\":\"10\"}{\"num\":\"3589\",\"vue\":\"10\"}{\"num\":\"3622\",\"vue\":\"10\"}{\"num\":\"3712\",\"vue\":\"10\"}{\"num\":\"3834\",\"vue\":\"10\"}{\"num\":\"3632\",\"vue\":\"10\"}{\"num\":\"3709\",\"vue\":\"10\"}{\"num\":\"3773\",\"vue\":\"10\"}{\"num\":\"3639\",\"vue\":\"10\"}{\"num\":\"3586\",\"vue\":\"10\"}{\"num\":\"3591\",\"vue\":\"10\"}{\"num\":\"3768\",\"vue\":\"10\"}{\"num\":\"3854\",\"vue\":\"10\"}]";
$key = "abcdefgh01234567";
$aes = new Aes($key, 'ECB');

//$y = hex2bin($in);
$y = $aes->encrypt($in);
//$x = $aes->decrypt($y);

echo base64_encode($y);
//echo bin2hex($y);
echo $x;

?>