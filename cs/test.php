<?php
include("SaeMysql.php");
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

$hex = "c61dee2306c64ff5df2584989a1d9c94fa30cc61cd77c79194be273982e54036974e222bd2d8e62a43a3738add6989e2d84362fa1aa7d6fb71ad633e56339cf93768113a097c87db8c96d33d026a60baa29476fb85f8c016d1b4af841d6c19163f0063de60750ee90e01fbf5fa64bca52c0bf18dcdd743ab159f35bbc3b85adb8f1b8aa3503a5b85d980272631b484053ddd9f52db961b174f9e66b9ee0a05f5f4c0fafcdac0d8351e7354dc299375f5c6e48f15741fb959eae8b0176d6eb032bf4ceabf7a28e018b6e0e863aa0035be0df9507f1cbc3529c1a7beeac7ec39d9b90cabfdf857023788417c2ffec9dd2859bcd5770b6078df6212b9990a0fb6b4d88cd1b78a806affa8b061ba4aa5590414a50352478fdb5764c1904df56a39c07b744da930c7b4545b87fe473f66a8efbd9938fd5d9c67e0813d56959876a8df3e71d8f2654145a56ce9dcce5a0a6bb996facb0319021308ac024949dab34a09d23efdb20236770e647475fbee59f61091ca08b31799d4432a607d4ef46f6ceda71179bc9612d944ede79cede710ae893ddd9f52db961b174f9e66b9ee0a05f577cfc11113e45a4be7041184f7fb5b99cc025cce48ff51567d35569330e8de16f939e8854787a07bd35a056ab3744a65efbeceed126da863aa8b5b36d723af47b90cabfdf857023788417c2ffec9dd28f62d45b045d2b1af6087b254c29419a2b980a6564d5dbec0f5bf075a657543771d9736ca72e85b813fbc59c059e4054b1e5df96652294abaa2430fa6f9e118634810914aede57c16251908a00214a461ee5e73bcc4a74a3af32502817ab86c66ca170476d3fe1522b5fd4e4a076f7bdb3ddd9f52db961b174f9e66b9ee0a05f50cc09659485e2652a3568c9d13462380cc025cce48ff51567d35569330e8de1697e7ddcf7a435420a0bacd0da13be76cd8eb673fb0974cf3e79ab8382e9b016ab90cabfdf857023788417c2ffec9dd280fc4f9f6d489c9dff32bb16a153156d79375a5ccb2f08a2d78990488ef61d98875e4f4939d3fb8f55730e125a1e90cd48aa33b59fa66c74eb47adf7666304b234810914aede57c16251908a00214a46125652e7a730a5c19f49dca0a9fe25067c127e23635bc8de3a1b35aa5c45dec3c3ddd9f52db961b174f9e66b9ee0a05f5eb768b43c38d13b80bd050219cc618a6ed67de2133f33cbd95099bb5739a06bfc8373a061b3b889df3cc5d9ef2cd7d84ab9692588a3e3c81ce76c6113289a71fb90cabfdf857023788417c2ffec9dd28d6730b7a5512342552c28558efeb0887670e3cb83e3a8ea8f0e529691a6cc8b2ac2a5f07ba388bd6b1fdcf0885e25d56adba197e716753940ca870b19a3e28274810914aede57c16251908a00214a4612b5a4dbd3a953b0a3358ac5671e97c2e33a17d6f58bbdeb3c4e5dcd7c26768ac3ddd9f52db961b174f9e66b9ee0a05f5caa0a95d03681ab193ebaed733a177e3c6e48f15741fb959eae8b0176d6eb03286d348f58eb70b79836dd69d7ba61bde67c37fa490d15b80038b92b21c407674b90cabfdf857023788417c2ffec9dd28ef8502d3c84f5a3bbbbe62261524293c46c2d0000f3b2a49c10877d318e4fb46d352524ecbffa3806cd0529693a3d73a4d69e164be87d079943ede90d90a9a244810914aede57c16251908a00214a46125d67ad43de2bc8af77bc22f8691aca3a9b818f218fdd44a80695a7b1503fe9a3ddd9f52db961b174f9e66b9ee0a05f53035db9ae3cb9d089e329ec14964457dcc025cce48ff51567d35569330e8de16ef930b1ff490f73d965d8ad745826b63d1cc9d7c96abcb6944a3482bf29ddf0fb90cabfdf857023788417c2ffec9dd280bb1fb80629271877f702055203e5456cbc2078185d136f64244db8ffb937e62e6cc563a1586fe6a235750266b943f428068f7fa71af5f8a1953b3d11f75add1df21ed13529a21adf7ff637e45fc6105fd2ea4389216140d37ce822b9d084670dfcb4ad6c0f0a9922073dee9b835e4833ddd9f52db961b174f9e66b9ee0a05f53b2ebf074184563d0a3bdab363dfb115c6e48f15741fb959eae8b0176d6eb032f931a9a9a99100061c237756f4d55858d6bd8ab4271b18c27423c6e1bcfff0f9b90cabfdf857023788417c2ffec9dd2807caf31426d35e31c135d28c2ceba52c57cfe05c6e8f12f1b5601ecf188d0629ac2a5f07ba388bd6b1fdcf0885e25d56ad25f6a89eaf58ccf860d90e8ba03dcd4810914aede57c16251908a00214a461b2cdf9a0fe9ba279290c6f8661ec812cc921e96e168729d8ed5bcdd9106bd1a03ddd9f52db961b174f9e66b9ee0a05f50ffae7fd860d2ca97ca4232a345615bdc6e48f15741fb959eae8b0176d6eb032588f6a4cdc3bee6b36d873e1a785876210613f44c501a16cb0c9c0d37f0f1435b90cabfdf857023788417c2ffec9dd28ebd454f4334eed784408abe55121f72931e40b89e5eda534e4c5516f91c64b00d352524ecbffa3806cd0529693a3d73a600ce266a00b94d103baec68118d6bdd4810914aede57c16251908a00214a461a69dc15859d00f010bb6cde3abd47e542ff313ab3cb6c0f80eb759e080c05db13ddd9f52db961b174f9e66b9ee0a05f5ffbf291f5daab54d00ec93369b92d53ec6e48f15741fb959eae8b0176d6eb032cfbda7181503641aba031fc607bdeccdc824b43bb874a43a1bfc4f3c86042be6b90cabfdf857023788417c2ffec9dd28de95bfedfb87e55d59cbcbf629b7973fc8d21d0df1146c70938348227fd32f3775e4f4939d3fb8f55730e125a1e90cd4ac85e1c4fe27eb721146cb71d3b6cae74810914aede57c16251908a00214a461921c38d802a522c6e3b9434ab33158947bc3f8e8501702f8760cfe89a74638c33ddd9f52db961b174f9e66b9ee0a05f57eb1417b0fe518bb3f829aa29a519573cc025cce48ff51567d35569330e8de1605ad5f70a4aa76b407e2e74cf17c737372818e518bd3274a6e4220f1708ca518b90cabfdf857023788417c2ffec9dd289b8d1de2cc44644dd93a11e6a30e4cd10848a6b452546f6f897873f25eb8076c14a50352478fdb5764c1904df56a39c0f33dd53a2ec73b3954eb493b138349914810914aede57c16251908a00214a461fcefb25bab54bcc3aa3153dd4c7fe2c6c851ed6e1143c3055d474ae6cf8036bf3ddd9f52db961b174f9e66b9ee0a05f57d5ee02e0a3bb2b4d5e5e06666dc0857c6e48f15741fb959eae8b0176d6eb0321dc75b9839d3635448d601cd9a3f7334051506c001284c11c18cc8d52e9052a1b90cabfdf857023788417c2ffec9dd28971ce73be2ffff00e22c4b0e8d176a7239520636b88f9e05789100c36c2a047eac2a5f07ba388bd6b1fdcf0885e25d56d17c34d779131b3d0d676b828aba8f4e4810914aede57c16251908a00214a46185d3512f73d2399baa0358d2245149357f60041fd00709ce53e83b83d63ccd193ddd9f52db961b174f9e66b9ee0a05f5c30b11dbf889ffa24358a44f3fa5090acc025cce48ff51567d35569330e8de1687e22a23b73c602f42f1e69b63363def10e931a971abd6da63a544faa076894cb90cabfdf857023788417c2ffec9dd28a7378c938141f4eed53386147a3bc77f5ef861c9dc8728399f842b381facb05ed352524ecbffa3806cd0529693a3d73ac76b1defc9a2668b331ecf532c9e49fa4810914aede57c16251908a00214a461a2c65ce7a6054bbf163c2f648cd54ac3ec1ce2c3009a0076321055d466e11b4b3ddd9f52db961b174f9e66b9ee0a05f54b7166db1770716254d72f28988df4e1b6dc38a5382b9bdcde3588814bba307ba048c3e184be1cb43eeff90b1d5ea3dd43490b9601a0e462b97525721a3490c4b90cabfdf857023788417c2ffec9dd28b15a74bf012683780b4c3e3e6948130593ba5c61ac0bfcf14fc12aaa1abc82b3ac2a5f07ba388bd6b1fdcf0885e25d5620bf60538fcf0855a4ed50fad1d701744810914aede57c16251908a00214a461a34f79cd96e565ccf095d249ae0fb4ab991aa450c2bc5926a8e2ae0446151f043ddd9f52db961b174f9e66b9ee0a05f596dff7b75793864e6fb7cb5c693265f9cc025cce48ff51567d35569330e8de16bbebd3e67fe8ca656771460c59c50345cbc81fec893e8f570d3a93409f8f10ddb90cabfdf857023788417c2ffec9dd28c570d470c99be6808b126d84ee69fa375efb2c97a87c28e0f720cac2aec83dd675e4f4939d3fb8f55730e125a1e90cd41d61453eb33d944c2d1de050e0e1e0b74810914aede57c16251908a00214a461e956e123d3ed0d5ca450705c5ad1febed43508d5dac0fa4a1156d356239bf7403ddd9f52db961b174f9e66b9ee0a05f535766ba2f653f09f2dff9773dfd15911c6e48f15741fb959eae8b0176d6eb032da601af06643ce472170671cf";
$de = $aes->decrypt(hex2bin($hex));
echo $de;
$mypost = json_decode($de,ture);
echo (string)$mypost[1]['num'];

?>