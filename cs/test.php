<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

$key = "abcdefgh01234567";
$aes = new Aes($key, 'ECB');

$json = "[{\"num\":\"2383\",\"vue\":\"10\"},{\"num\":\"2472\",\"vue\":\"10\"},{\"num\":\"2548\",\"vue\":\"10\"},{\"num\":\"2555\",\"vue\":\"10\"},{\"num\":\"2496\",\"vue\":\"10\"},{\"num\":\"2347\",\"vue\":\"10\"},{\"num\":\"2169\",\"vue\":\"10\"},{\"num\":\"2065\",\"vue\":\"10\"},{\"num\":\"2038\",\"vue\":\"10\"},{\"num\":\"1967\",\"vue\":\"10\"},{\"num\":\"1882\",\"vue\":\"10\"},{\"num\":\"1791\",\"vue\":\"10\"},{\"num\":\"1832\",\"vue\":\"10\"},{\"num\":\"2039\",\"vue\":\"10\"},{\"num\":\"2269\",\"vue\":\"10\"},{\"num\":\"2481\",\"vue\":\"10\"},{\"num\":\"2640\",\"vue\":\"10\"},{\"num\":\"2696\",\"vue\":\"10\"},{\"num\":\"2667\",\"vue\":\"10\"},{\"num\":\"2562\",\"vue\":\"10\"},{\"num\":\"2370\",\"vue\":\"10\"},{\"num\":\"2237\",\"vue\":\"10\"},{\"num\":\"2200\",\"vue\":\"10\"},{\"num\":\"2203\",\"vue\":\"10\"},{\"num\":\"2201\",\"vue\":\"10\"},{\"num\":\"2217\",\"vue\":\"10\"},{\"num\":\"2237\",\"vue\":\"10\"},{\"num\":\"2255\",\"vue\":\"10\"},{\"num\":\"2237\",\"vue\":\"10\"},{\"num\":\"2212\",\"vue\":\"10\"},{\"num\":\"2277\",\"vue\":\"10\"},{\"num\":\"2600\",\"vue\":\"10\"},{\"num\":\"3319\",\"vue\":\"10\"},{\"num\":\"3527\",\"vue\":\"10\"},{\"num\":\"2956\",\"vue\":\"10\"},{\"num\":\"2607\",\"vue\":\"10\"},{\"num\":\"2627\",\"vue\":\"10\"},{\"num\":\"2768\",\"vue\":\"10\"},{\"num\":\"2654\",\"vue\":\"10\"},{\"num\":\"2164\",\"vue\":\"10\"},{\"num\":\"1552\",\"vue\":\"10\"},{\"num\":\"1009\",\"vue\":\"10\"},{\"num\":\"561\",\"vue\":\"10\"},{\"num\":\"280\",\"vue\":\"10\"},{\"num\":\"160\",\"vue\":\"10\"},{\"num\":\"217\",\"vue\":\"10\"},{\"num\":\"457\",\"vue\":\"10\"},{\"num\":\"855\",\"vue\":\"10\"},{\"num\":\"1275\",\"vue\":\"10\"},{\"num\":\"1622\",\"vue\":\"10\"},{\"num\":\"1861\",\"vue\":\"10\"},{\"num\":\"2058\",\"vue\":\"10\"},{\"num\":\"2267\",\"vue\":\"10\"},{\"num\":\"2476\",\"vue\":\"10\"},{\"num\":\"2656\",\"vue\":\"10\"},{\"num\":\"2736\",\"vue\":\"10\"},{\"num\":\"2723\",\"vue\":\"10\"},{\"num\":\"2634\",\"vue\":\"10\"},{\"num\":\"2478\",\"vue\":\"10\"},{\"num\":\"2254\",\"vue\":\"10\"},{\"num\":\"2058\",\"vue\":\"10\"},{\"num\":\"1939\",\"vue\":\"10\"},{\"num\":\"1873\",\"vue\":\"10\"},{\"num\":\"1821\",\"vue\":\"10\"},{\"num\":\"1778\",\"vue\":\"10\"},{\"num\":\"1778\",\"vue\":\"10\"},{\"num\":\"1804\",\"vue\":\"10\"},{\"num\":\"1849\",\"vue\":\"10\"},{\"num\":\"1929\",\"vue\":\"10\"},{\"num\":\"2026\",\"vue\":\"10\"},{\"num\":\"2119\",\"vue\":\"10\"},{\"num\":\"2159\",\"vue\":\"10\"},{\"num\":\"2118\",\"vue\":\"10\"},{\"num\":\"2061\",\"vue\":\"10\"},{\"num\":\"2039\",\"vue\":\"10\"},{\"num\":\"2034\",\"vue\":\"10\"},{\"num\":\"1998\",\"vue\":\"10\"},{\"num\":\"1909\",\"vue\":\"10\"},{\"num\":\"1823\",\"vue\":\"10\"},{\"num\":\"1763\",\"vue\":\"10\"},{\"num\":\"1728\",\"vue\":\"10\"},{\"num\":\"1696\",\"vue\":\"10\"},{\"num\":\"1660\",\"vue\":\"10\"},{\"num\":\"1679\",\"vue\":\"10\"},{\"num\":\"1778\",\"vue\":\"10\"},{\"num\":\"1939\",\"vue\":\"10\"},{\"num\":\"2103\",\"vue\":\"10\"},{\"num\":\"2164\",\"vue\":\"10\"},{\"num\":\"2207\",\"vue\":\"10\"},{\"num\":\"2214\",\"vue\":\"10\"},{\"num\":\"2170\",\"vue\":\"10\"},{\"num\":\"2115\",\"vue\":\"10\"},{\"num\":\"2059\",\"vue\":\"10\"},{\"num\":\"2042\",\"vue\":\"10\"},{\"num\":\"2093\",\"vue\":\"10\"},{\"num\":\"2237\",\"vue\":\"10\"},{\"num\":\"2425\",\"vue\":\"10\"},{\"num\":\"2549\",\"vue\":\"10\"},{\"num\":\"2551\",\"vue\":\"10\"},{\"num\":\"2438\",\"vue\":\"10\"},{\"num\":\"2251\",\"vue\":\"10\"},{\"num\":\"2063\",\"vue\":\"10\"},{\"num\":\"1930\",\"vue\":\"10\"},{\"num\":\"1899\",\"vue\":\"10\"},{\"num\":\"1960\",\"vue\":\"10\"},{\"num\":\"2055\",\"vue\":\"10\"},{\"num\":\"2134\",\"vue\":\"10\"},{\"num\":\"2152\",\"vue\":\"10\"},{\"num\":\"2138\",\"vue\":\"10\"},{\"num\":\"2116\",\"vue\":\"10\"},{\"num\":\"2106\",\"vue\":\"10\"},{\"num\":\"2161\",\"vue\":\"10\"},{\"num\":\"2255\",\"vue\":\"10\"},{\"num\":\"2340\",\"vue\":\"10\"},{\"num\":\"2369\",\"vue\":\"10\"},{\"num\":\"2322\",\"vue\":\"10\"},{\"num\":\"2197\",\"vue\":\"10\"},{\"num\":\"2056\",\"vue\":\"10\"},{\"num\":\"1874\",\"vue\":\"10\"},{\"num\":\"1735\",\"vue\":\"10\"},{\"num\":\"1659\",\"vue\":\"10\"},{\"num\":\"1703\",\"vue\":\"10\"},{\"num\":\"1869\",\"vue\":\"10\"},{\"num\":\"2079\",\"vue\":\"10\"},{\"num\":\"2259\",\"vue\":\"10\"},{\"num\":\"2357\",\"vue\":\"10\"},{\"num\":\"2323\",\"vue\":\"10\"},{\"num\":\"2170\",\"vue\":\"10\"},{\"num\":\"2024\",\"vue\":\"10\"},{\"num\":\"1919\",\"vue\":\"10\"},{\"num\":\"1867\",\"vue\":\"10\"},{\"num\":\"1897\",\"vue\":\"10\"},{\"num\":\"1959\",\"vue\":\"10\"},{\"num\":\"2023\",\"vue\":\"10\"},{\"num\":\"2068\",\"vue\":\"10\"},{\"num\":\"1992\",\"vue\":\"10\"},{\"num\":\"1863\",\"vue\":\"10\"},{\"num\":\"1721\",\"vue\":\"10\"},{\"num\":\"1672\",\"vue\":\"10\"},{\"num\":\"1753\",\"vue\":\"10\"},{\"num\":\"1971\",\"vue\":\"10\"},{\"num\":\"2283\",\"vue\":\"10\"},{\"num\":\"2527\",\"vue\":\"10\"},{\"num\":\"2576\",\"vue\":\"10\"},{\"num\":\"2440\",\"vue\":\"10\"},{\"num\":\"2190\",\"vue\":\"10\"},{\"num\":\"1905\",\"vue\":\"10\"},{\"num\":\"1691\",\"vue\":\"10\"},{\"num\":\"1582\",\"vue\":\"10\"},{\"num\":\"1620\",\"vue\":\"10\"}]";
$en = $aes->encrypt($json);
echo bin2hex($en);
echo '</br></br>';
echo $aes->decrypt($en);

//echo base64_encode($y);
echo '</br></br>';

$hex = "754e7d17ab3803e29ab9321b36ee2042b90cabfdf857023788417c2ffec9dd288ebe33c164ff0eac598a8b1d5213523de408a98298ea46c54f05dbedfc052719bf4c121082d808b7a85cf11296d8abb1d96ee789937c3060f8e302c237cae31a4810914aede57c16251908a00214a461b6ba08222bda0219a25c45ae1b5b79440a0533f24f78e30d4704fbedd54113ee3ddd9f52db961b174f9e66b9ee0a05f512320341e9fc800d6740d1ccf4206d36c6e48f15741fb959eae8b0176d6eb03221715afc091d1e040ef312add51bb19b442d8174f9692df019805c821cfeeec1b90cabfdf857023788417c2ffec9dd28e5900c0c99b28b428666275cb707f974ba15dbe2315d5419526ed27ba242cf51e6cc563a1586fe6a235750266b943f4266b1d667b3d17ff97c247c547e58b0364810914aede57c16251908a00214a46139dde38cdac539da5f7e9ccda6333b5debbde9b0df09e96557608e3de72a66813ddd9f52db961b174f9e66b9ee0a05f5069ad37bab07effd26e58723602b4f22c6e48f15741fb959eae8b0176d6eb03247489d4a3429a5e494235bafcbc4054850a268a3da702c5c0cf5f7a69bb4afc6b90cabfdf857023788417c2ffec9dd28e036aa29fcc1a2240f7a786eb75a25b4852c357b74402c8a269deba784d5cc5ad352524ecbffa3806cd0529693a3d73a0953ae6c897abb20e6b2962aef2dbeb14810914aede57c16251908a00214a4615e779e6b2c2efe3d688ef5b2950d4b8c87455cdb7e8746d1c56c870b2ecb9f6a3ddd9f52db961b174f9e66b9ee0a05f5cadbf16ce04e7d8dac9c4eb2b006696ec6e48f15741fb959eae8b0176d6eb0326e761fdcc2e4b562307feb87715ff698819f921bd68a89e53a6d29f1fc738e80b90cabfdf857023788417c2ffec9dd283de960cbb7d3673b29f6d6e3632dd60484b0fa8a5a18e8b62d662b9afe31ed68d352524ecbffa3806cd0529693a3d73a62f4abbabc19194f1ddd7dc2958b32794810914aede57c16251908a00214a4618f0d32a16635da2afd8a267560b7a2efac447285a0a6844059e2e0373ff98b433ddd9f52db961b174f9e66b9ee0a05f59d620810118adb0d821eb62e446d0c94c6e48f15741fb959eae8b0176d6eb0324d46863d6c3a9bb1533b02595d0e19c49ca23dfe91202ed51574677b43e218deb90cabfdf857023788417c2ffec9dd286f932d27eda3e4b5be1a1c3155483155e043c90b52dcda3b83263c17acfecb9b75e4f4939d3fb8f55730e125a1e90cd486c6cdd29e2268a30064e936890196c24810914aede57c16251908a00214a46170033a0e8f2344fc2d5843a315f71e20ea98df90e54b1dded1d9f9d263c180cf3ddd9f52db961b174f9e66b9ee0a05f5edd7106bfa3b5544864e119f795eb2afc6e48f15741fb959eae8b0176d6eb0327f1ceefee64bb3dbc6d644eea6c6d4885ca29c7865ec4806db9207cbc018d08fb90cabfdf857023788417c2ffec9dd284c0d8e4d554f6bcba8ef8deec9615cb29624d2238ecde90119dc9ac1bb903db63d41e8502dd618576a1a700ff6908dc1a8f7cbb092c801dbb5794b3e3cb48175cc025cce48ff51567d35569330e8de1675c0f05c102d77b0cec40326068ddb4df3996c21aaa2134debb83c899410272a4810914aede57c16251908a00214a461d01da81c37b510297bba30170c4d46ba35499817ac1d9155487103318a7deb78b90cabfdf857023788417c2ffec9dd28b6b4224248e045c5f4fe5f16347b93cae23a89c6c22cd5cd75dafd84b51d9d49e6cc563a1586fe6a235750266b943f424703591c3e8b1be84e73eb74629e15844810914aede57c16251908a00214a46167019a64c48122689e94e112508d44e747a570d5f89359fadde95ddb6f834b6b3ddd9f52db961b174f9e66b9ee0a05f5aeaa833d704a88eeec1974f3e6310993c6e48f15741fb959eae8b0176d6eb03286dec1f902795a57cde449a1171fbd98deb466ec467121c34b2b9d3417646773b90cabfdf857023788417c2ffec9dd28ff1a738eefe31492552080550c29158c6b3b76af7b542eee9f042e7bede4c7e8a54adb35cb518233641f62f1318c18e86d0b25ea7e460e077e4f49e3c8f248fb4810914aede57c16251908a00214a461648901f43ef344bc0cc18e4a6349cbaefec9ccaa257b4480401b54e3a30bd86e3ddd9f52db961b174f9e66b9ee0a05f54b590ee346bf8edf58579715fb105987cc025cce48ff51567d35569330e8de1680a530dcc7bf46db04debe6f5d231b2113282372b7f3ab8e838cedde70b2fb9bb90cabfdf857023788417c2ffec9dd28f19b0f9e0252b19a2591bb274e2ba94c5efb2c97a87c28e0f720cac2aec83dd6bf4c121082d808b7a85cf11296d8abb140027c97ebf219e04c4e9961a962b6d64810914aede57c16251908a00214a461c0f5c3fc2adf60b70aa4f0153b35c88d53a51e92194a0414cb080a43aa2e708b3ddd9f52db961b174f9e66b9ee0a05f5c63e73fb16abf768e90bc29afdc815a3c6e48f15741fb959eae8b0176d6eb03268c1ce3560d0efb79b0b93f09567ba591de0f889b680a2d9feec0df6c595d3eeb90cabfdf857023788417c2ffec9dd28fca7d41eacf1554463622f28d9b06cb803b841ee5d0e99c92607d276789b2aca3768113a097c87db8c96d33d026a60ba9642a74e05dad4887d2db0d4218e3f2a4810914aede57c16251908a00214a46103056e22e36ee40eb472e0e266a62db7acb1833a07cfd63b25616b47a3b86ac73ddd9f52db961b174f9e66b9ee0a05f514556590ebe0250c6f4b30065665785ccc025cce48ff51567d35569330e8de16c34eabe860429056bbb275734717f61fb79b22dd921f85743871c5d3e78f6fedb90cabfdf857023788417c2ffec9dd2816c2376729b25804888f0921cee6c932cbc2078185d136f64244db8ffb937e6275e4f4939d3fb8f55730e125a1e90cd43a2a1d0a7b5d11ccde7b382aa638e2bc4810914aede57c16251908a00214a4619a88c2452149379a09985c233e587ce3616741d13a93d40d20e3adde27c969303ddd9f52db961b174f9e66b9ee0a05f54b590ee346bf8edf58579715fb105987c6e48f15741fb959eae8b0176d6eb0322077e7a8408480d17e68e47ebe4c0b09b6a9d303675ee84df9bdc61e5d2b2ea0b90cabfdf857023788417c2ffec9dd28d9c65d7413ffeb5db4b83abfbfcdd11ad39b57bc9897b6b3adc59b61d0976628a54adb35cb518233641f62f1318c18e8789172b832539279c3eae6b532d8aa0b4810914aede57c16251908a00214a4614436f6ddd811165216b344b185359a22888d7884c302dc5eed31d7cf622447553ddd9f52db961b174f9e66b9ee0a05f58565c314695f47a75861582e85d93cf3c6e48f15741fb959eae8b0176d6eb03275111c75c886d4de4b1bf99bd37a3dee46d69d504e5b06cb873996f8312756f7b90cabfdf857023788417c2ffec9dd284fa9aedbbb37eb48a3a26a6cecc27b02e408a98298ea46c54f05dbedfc05271914a50352478fdb5764c1904df56a39c0ff5e74045c8bcee1f63f618555b6b7f44810914aede57c16251908a00214a4616fd2722a9f0e59d622cbd8603d5c71ef038ac2582cffa2554c954d3ce107ed723ddd9f52db961b174f9e66b9ee0a05f5e80593bccd4ec0081a451f69b7d3b86ccc025cce48ff51567d35569330e8de16e7928bf66e90e2b983d9d77f514d03bf0f14ac021dec3a1e7b769e4ca8991f66b90cabfdf857023788417c2ffec9dd2824d9f884f35805fb355fe4abd90147c51c9b6fc6dbc751a0b2e4a2bc4bc9e8d5ac2a5f07ba388bd6b1fdcf0885e25d564e4513a703b7b746f9fb086db77963454810914aede57c16251908a00214a4617fb72cabc5d9838432a3baae8db24daa742da1de1031907fe1f0279f6bcddfcb3ddd9f52db961b174f9e66b9ee0a05f5c31ae7f11e3bdb6c981916ebca81979fc6e48f15741fb959eae8b0176d6eb0320cf2b7aa802bd621027f4cf72fc943af2b92d994f04b5e383bba354694d67e5eb90cabfdf857023788417c2ffec9dd286ca08404a4f294bd627180861909ba06f7d38b16bf0a2c2103331689a34003b3b1657a7c896edd51d2401a2a43301b225ea1b50a2302e4eb01a53dbd515a5b514810914aede57c16251908a00214a46110f9f63ef25a04ff7d3883c8a5ded542bc6bdc043a3e3b84b3fa36dce904edf33ddd9f52db961b174f9e66b9ee0a05f58f20424eadfd1d3f7fdcb5e4e1b6b531cc025cce48ff51567d35569330e8de16b4aa7c634012aa4630f0dd55711ecf98ccd346b7428c6a314b600a1abe40958db90cabfdf857023788417c2ffec9dd28b4e168dee4cad6f6624f75a06ecff0a1ff53270d1d30d19dc05c8ce05b31162a1d9736ca72e85b813fbc59c059e4054ba28e10efccc3bfb64d2e12f3c78f08864810914aede57c16251908a00214a46182b0dc3005b2f413b5541717e783e8f0d650cf8dc9b7724eeb07383a13ecffa33ddd9f52db961b174f9e66b9ee0a05f5a4ea9c7e5d0d70fb9d0b33ecc33610d0c6e48f15741fb959eae8b0176d6eb03257f320372a8acc166486eba52bc63457a089dd5ebfba276382c3027939482284b90cabfdf857023788417c2ffec9dd28605b0d95dfad7c1c5fe528317f509fb71c03b4b9dcac618e0c138e63b7971c4e14a50352478fdb5764c1904df56a39c098875a8687c322e5daf579a7af09d01c4810914aede57c16251908a00214a4610f1f83e917df68801c6b51a7c4a50e48ce2923b9ac20f18595e033fa9dfd020e3ddd9f52db961b174f9e66b9ee0a05f5e377f65057426da5bc67aa5f704787c1c6e48f15741fb959eae8b0176d6eb0325f83080c6f571f6f0798061372d9429e0258250c8a9787cc0627f7dfe34e6a3eb90cabfdf857023788417c2ffec9dd2829d8aae236d6eae78bbe848b2dcf0d9b43885020c8ca29889e45f936ce1c1ae43768113a097c87db8c96d33d026a60baf8b31f3de4c201b4c3b900c41308ede34810914aede57c16251908a00214a461807d0a75f3496778aac4c9c94a696905fc36c445031453e88978a1ee72ebeead3ddd9f52db961b174f9e66b9ee0a05f50708ae52c2aa172e2e5995d5e3052fc2c6e48f15741fb959eae8b0176d6eb032016059b76299f52fc785dedd759e79ec519a15d4a43247efb3aa063b02c678bcb90cabfdf857023788417c2ffec9dd28ef8502d3c84f5a3bbbbe62261524293cd11bd9551d7c091e544fdbac1b8b4afeb1657a7c896edd51d2401a2a43301b226262f38fcec93141e959a1adb9c0f9854810914aede57c16251908a00214a4615b0e60807e4b752dd34cadd4c82f8b7204c03eb6cb5ca265320a743e25ce82383ddd9f52db961b174f9e66b9ee0a05f55abfe835d797deeb4ac39de41d508c6b47acb1b226bc44fda00411bf5760fdab";

$de = $aes->decrypt($hex);
$de = $aes->decrypt(hex2bin($hex));
echo $de;

?>