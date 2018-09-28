<?php
require_once('phpaes-master/src/Aes.php');
use PhpAes\Aes;

$key = "abcdefgh01234567";
$aes = new Aes($key, 'ECB');

$json = "[{\"num\":\"1823\",\"vue\":\"10\"},{\"num\":\"1873\",\"vue\":\"10\"},{\"num\":\"1952\",\"vue\":\"10\"},{\"num\":\"2053\",\"vue\":\"10\"},{\"num\":\"2155\",\"vue\":\"10\"},{\"num\":\"2283\",\"vue\":\"10\"},{\"num\":\"2394\",\"vue\":\"10\"},{\"num\":\"2483\",\"vue\":\"10\"},{\"num\":\"2544\",\"vue\":\"10\"},{\"num\":\"2525\",\"vue\":\"10\"},{\"num\":\"2470\",\"vue\":\"10\"},{\"num\":\"2399\",\"vue\":\"10\"},{\"num\":\"2286\",\"vue\":\"10\"},{\"num\":\"2175\",\"vue\":\"10\"},{\"num\":\"2070\",\"vue\":\"10\"},{\"num\":\"1941\",\"vue\":\"10\"},{\"num\":\"1843\",\"vue\":\"10\"},{\"num\":\"1746\",\"vue\":\"10\"},{\"num\":\"1671\",\"vue\":\"10\"},{\"num\":\"1625\",\"vue\":\"10\"},{\"num\":\"1611\",\"vue\":\"10\"},{\"num\":\"1648\",\"vue\":\"10\"},{\"num\":\"1721\",\"vue\":\"10\"},{\"num\":\"1789\",\"vue\":\"10\"},{\"num\":\"1830\",\"vue\":\"10\"},{\"num\":\"1867\",\"vue\":\"10\"},{\"num\":\"1931\",\"vue\":\"10\"},{\"num\":\"2019\",\"vue\":\"10\"},{\"num\":\"2196\",\"vue\":\"10\"},{\"num\":\"2433\",\"vue\":\"10\"},{\"num\":\"2572\",\"vue\":\"10\"},{\"num\":\"2605\",\"vue\":\"10\"},{\"num\":\"2525\",\"vue\":\"10\"},{\"num\":\"2397\",\"vue\":\"10\"},{\"num\":\"2203\",\"vue\":\"10\"},{\"num\":\"2034\",\"vue\":\"10\"},{\"num\":\"1927\",\"vue\":\"10\"},{\"num\":\"1855\",\"vue\":\"10\"},{\"num\":\"1847\",\"vue\":\"10\"},{\"num\":\"1981\",\"vue\":\"10\"},{\"num\":\"2540\",\"vue\":\"10\"},{\"num\":\"3447\",\"vue\":\"10\"},{\"num\":\"3553\",\"vue\":\"10\"},{\"num\":\"3552\",\"vue\":\"10\"},{\"num\":\"3548\",\"vue\":\"10\"},{\"num\":\"3555\",\"vue\":\"163\"},{\"num\":\"3539\",\"vue\":\"163\"},{\"num\":\"3552\",\"vue\":\"163\"},{\"num\":\"3577\",\"vue\":\"163\"},{\"num\":\"3210\",\"vue\":\"163\"},{\"num\":\"1782\",\"vue\":\"163\"},{\"num\":\"765\",\"vue\":\"163\"},{\"num\":\"280\",\"vue\":\"163\"},{\"num\":\"245\",\"vue\":\"163\"},{\"num\":\"501\",\"vue\":\"163\"},{\"num\":\"840\",\"vue\":\"163\"},{\"num\":\"1182\",\"vue\":\"163\"},{\"num\":\"1465\",\"vue\":\"163\"},{\"num\":\"1696\",\"vue\":\"163\"},{\"num\":\"1864\",\"vue\":\"163\"},{\"num\":\"2035\",\"vue\":\"163\"},{\"num\":\"2216\",\"vue\":\"163\"},{\"num\":\"2358\",\"vue\":\"163\"},{\"num\":\"2495\",\"vue\":\"163\"},{\"num\":\"2657\",\"vue\":\"163\"},{\"num\":\"2861\",\"vue\":\"153\"},{\"num\":\"3081\",\"vue\":\"153\"},{\"num\":\"3280\",\"vue\":\"153\"},{\"num\":\"3512\",\"vue\":\"153\"},{\"num\":\"3543\",\"vue\":\"153\"},{\"num\":\"3547\",\"vue\":\"153\"},{\"num\":\"3551\",\"vue\":\"153\"},{\"num\":\"2571\",\"vue\":\"153\"},{\"num\":\"1648\",\"vue\":\"153\"},{\"num\":\"1095\",\"vue\":\"153\"},{\"num\":\"951\",\"vue\":\"153\"},{\"num\":\"1086\",\"vue\":\"153\"},{\"num\":\"1398\",\"vue\":\"153\"},{\"num\":\"1781\",\"vue\":\"153\"},{\"num\":\"2129\",\"vue\":\"143\"},{\"num\":\"2365\",\"vue\":\"143\"},{\"num\":\"2504\",\"vue\":\"143\"},{\"num\":\"2601\",\"vue\":\"143\"},{\"num\":\"2560\",\"vue\":\"143\"},{\"num\":\"2429\",\"vue\":\"143\"},{\"num\":\"2240\",\"vue\":\"143\"},{\"num\":\"2025\",\"vue\":\"143\"},{\"num\":\"1844\",\"vue\":\"143\"},{\"num\":\"1719\",\"vue\":\"143\"},{\"num\":\"1717\",\"vue\":\"143\"},{\"num\":\"1792\",\"vue\":\"143\"},{\"num\":\"1861\",\"vue\":\"143\"},{\"num\":\"1945\",\"vue\":\"143\"},{\"num\":\"2040\",\"vue\":\"143\"},{\"num\":\"2168\",\"vue\":\"135\"},{\"num\":\"2193\",\"vue\":\"135\"},{\"num\":\"2219\",\"vue\":\"135\"},{\"num\":\"2248\",\"vue\":\"135\"},{\"num\":\"2297\",\"vue\":\"135\"},{\"num\":\"2298\",\"vue\":\"135\"},{\"num\":\"2230\",\"vue\":\"135\"},{\"num\":\"2100\",\"vue\":\"135\"},{\"num\":\"1973\",\"vue\":\"135\"},{\"num\":\"1921\",\"vue\":\"135\"},{\"num\":\"2011\",\"vue\":\"135\"},{\"num\":\"2110\",\"vue\":\"135\"},{\"num\":\"2185\",\"vue\":\"135\"},{\"num\":\"2200\",\"vue\":\"127\"},{\"num\":\"2170\",\"vue\":\"127\"},{\"num\":\"2072\",\"vue\":\"127\"},{\"num\":\"1889\",\"vue\":\"127\"},{\"num\":\"1690\",\"vue\":\"127\"},{\"num\":\"1565\",\"vue\":\"127\"},{\"num\":\"1503\",\"vue\":\"127\"},{\"num\":\"1509\",\"vue\":\"127\"},{\"num\":\"1543\",\"vue\":\"127\"},{\"num\":\"1612\",\"vue\":\"127\"},{\"num\":\"1737\",\"vue\":\"127\"},{\"num\":\"1875\",\"vue\":\"127\"},{\"num\":\"2026\",\"vue\":\"127\"},{\"num\":\"2148\",\"vue\":\"120\"},{\"num\":\"2225\",\"vue\":\"120\"},{\"num\":\"2220\",\"vue\":\"120\"},{\"num\":\"2185\",\"vue\":\"120\"},{\"num\":\"2169\",\"vue\":\"120\"},{\"num\":\"2204\",\"vue\":\"120\"},{\"num\":\"2173\",\"vue\":\"120\"},{\"num\":\"2136\",\"vue\":\"120\"},{\"num\":\"2107\",\"vue\":\"120\"},{\"num\":\"2096\",\"vue\":\"120\"},{\"num\":\"2039\",\"vue\":\"120\"},{\"num\":\"1981\",\"vue\":\"120\"},{\"num\":\"1928\",\"vue\":\"114\"},{\"num\":\"1886\",\"vue\":\"114\"},{\"num\":\"1885\",\"vue\":\"114\"},{\"num\":\"1918\",\"vue\":\"114\"},{\"num\":\"2027\",\"vue\":\"114\"},{\"num\":\"2155\",\"vue\":\"114\"},{\"num\":\"2295\",\"vue\":\"114\"},{\"num\":\"2376\",\"vue\":\"114\"},{\"num\":\"2377\",\"vue\":\"114\"},{\"num\":\"2285\",\"vue\":\"114\"},{\"num\":\"2211\",\"vue\":\"114\"},{\"num\":\"2111\",\"vue\":\"114\"},{\"num\":\"2022\",\"vue\":\"114\"},{\"num\":\"1931\",\"vue\":\"114\"},{\"num\":\"1846\",\"vue\":\"114\"},{\"num\":\"1763\",\"vue\":\"114\"},{\"num\":\"1717\",\"vue\":\"114\"},{\"num\":\"1753\",\"vue\":\"114\"}]";
$en = $aes->encrypt($json);
echo bin2hex($en);

//echo base64_encode($y);
echo '</br></br>';

$hex = "444e380b0f67f9e52b4d78d6e900885bb90cabfdf857023788417c2ffec9dd2880da101cb788207add5fe886801486fe56e9e3a67fe906e7f36c8816db06cb12e6cc563a1586fe6a235750266b943f4243b400fd59673bd9a4b1166d74ed86a54810914aede57c16251908a00214a4611467ec585cc03dbf8ad974a86c4f8cd310ca9bf69a032a68100c5c00c8c737ce3ddd9f52db961b174f9e66b9ee0a05f5220912bd6b6511e4a7b2e32e0c686424c6e48f15741fb959eae8b0176d6eb0326312fce2b3df71bdba1c135a9409a3480f13a043fab121a7f3b41244c5c0026ab90cabfdf857023788417c2ffec9dd287ac1363ea86b68b505c28157ef7cccef670e3cb83e3a8ea8f0e529691a6cc8b2b1657a7c896edd51d2401a2a43301b22a3467e101c89a8a7a3723e74b52d80b94810914aede57c16251908a00214a46151556f046b3ebd43325b57bcca4a0a5de8377e8613ad585be5d48ae1c0536b7b3ddd9f52db961b174f9e66b9ee0a05f5302da6a996e3befd04d5c96170007bf2cc025cce48ff51567d35569330e8de163562a2fe17c50f0825059bbf4bb58e11f8bc7bf8dafe80d0d3beececab83a668b90cabfdf857023788417c2ffec9dd2828897a25e57f6bb2a67fc4910f8dc50b261f6d7c0c4eb646010b0d766d26d6233768113a097c87db8c96d33d026a60badd8347a5e90cdfcedaa535481baef9964810914aede57c16251908a00214a4613f50cd046aa1947cfe45b48b9310d3593050a1e67ced240cc3e658aa571306473ddd9f52db961b174f9e66b9ee0a05f5bb1b2ecd1776c196241a0eccdbc93b54cc025cce48ff51567d35569330e8de16258b3b57b44cea884c195f5d1749ef7272fa2fd1cf29a0d68cbd63ff11529d98b90cabfdf857023788417c2ffec9dd282e8a88b91bba166146fe437b96e52ec2ad81408887920b8e6e5ad8d7a72e11123768113a097c87db8c96d33d026a60ba9ab383e27adbbdda215c5f370b3d235f4810914aede57c16251908a00214a4612af81c2f2d0b5a5c2e207f900104b8128b241e006d6a8434b1c5d78357fa50963ddd9f52db961b174f9e66b9ee0a05f5a9c1a856fe3159385b03c49d0787d79ac6e48f15741fb959eae8b0176d6eb032bd744f32f2d9c5f5cd2fe0eb7efc48b9ff9435871c1e34598e1e44f93ca0c836b90cabfdf857023788417c2ffec9dd283de7a25bfd05af5efed4939f08c304f3d122e2e4383d2f92459ad1f30f3b680a1d9736ca72e85b813fbc59c059e4054b496f0585e151b13b1e3c33d422d26ad34810914aede57c16251908a00214a461d586f33a50b79e3a6eeaed4fe814bc5d41ea63e4f51394cea25f5f607b2a9c8f3ddd9f52db961b174f9e66b9ee0a05f55baaf9942aa4a0189e674227d945f5c1cc025cce48ff51567d35569330e8de1680c97bff687d3acf2e4a6e1f140826acb8a6854954a915793b902bf20b1dc163b90cabfdf857023788417c2ffec9dd2844c921f240a236a525dc08f98b7f6b25289aa0b9c55cd857d0e16543830d030f1d9736ca72e85b813fbc59c059e4054b2731d2c8bc3b201d8c058ebaf97bade14810914aede57c16251908a00214a4613a3ea4333c996ae11e3f57f65deb22aaaf2f1d7860c5b4d15e375bef215706d13ddd9f52db961b174f9e66b9ee0a05f5331aefb3e2fa62a9e60dfc4999469fa6edcef8cba1488c12a2102264d8d85d87cc727a116ac4843701039f11498fcd81aac75bd1e27e2359c6a4e5aaca0640fbb90cabfdf857023788417c2ffec9dd28c73a5530c2cc0a1696f0e6fd88653ae7c91de4a3230947a81a3e731ddbb031e5e6cc563a1586fe6a235750266b943f42eeeb7749ef1ceec2053fd0b91267df31bd9938fd5d9c67e0813d56959876a8df802893a0ce4048201370f016d7ed1445c694972838380911a96d67835706603fd23efdb20236770e647475fbee59f6109aa21e95e2c2145060bdf94390c40e197f7dc87a5ca4d0528ce70c7cca03fc56906a224b446b9cf9553c029dfbcf1613d71a104759297cb841f44ec0ecb991b853307d6526573ac0dcbdea975610821a5fdf378783eb947beeeb1a5947ff9b02b5d71336ffbfe6269f9031bcc25509edd23efdb20236770e647475fbee59f610082ed41737bc72be93b69cc1d948a8d8c133ed5089d07f4ce2b63e10c66372d83d41e8502dd618576a1a700ff6908dc14adac03d5067da22e78bff6a9fb473edbd9938fd5d9c67e0813d56959876a8dffcd9f367d486b5910de4aeac120a270f0fadf09782e4980816de634bbf5fdcc0906a224b446b9cf9553c029dfbcf1613587b010517b910c832444e56ed6f2d6e8fa5c0b0f8bb2281c14cbd9e5cc321ccd3a800396118b8699493d4562a97001da990475dc887671cfffb3fdd240765a5d23efdb20236770e647475fbee59f610c721953dbca4eda9bdb10ff4cd0ef7e673a5c248ffb60f1cdec1e52e05d3d57b3d41e8502dd618576a1a700ff6908dc16e4d46182ea0b2ad4f066a92189ce491bd9938fd5d9c67e0813d56959876a8dff72a94375407ea30a8651dc8f61a256265b2c4b0646bbd40ccbc915f719a4d69906a224b446b9cf9553c029dfbcf1613cf05fb1f492f5070d697b4c73b7846b4fe77d076fd40670698f23da7c5c6af58aaca4b22e734e2746a2cd1e282d73ba04f7fb25c403f7926de9ea43b360515d7d23efdb20236770e647475fbee59f610e929870c76af4fa487ce3d4d90ba63b0062bca18882dbe7bbdb5cada6fc6e8d43ddd9f52db961b174f9e66b9ee0a05f50822d36ea82fcbd579194379be005578cc025cce48ff51567d35569330e8de16a306cbce97e4f5f3f7ba0474fc0e52e1c1d6ed51a42d5e8a02f530540374bf83b90cabfdf857023788417c2ffec9dd28fa9180186a55e192352058790e490149ace25c575acefca0d377332988ee2884a54adb35cb518233641f62f1318c18e8183d0d481d1189b47981fb9e0baca04f4810914aede57c16251908a00214a461f6742564c9a88fafbafedc83ad5cb5f9c5cd1a335fc16620765f5afc16af31573ddd9f52db961b174f9e66b9ee0a05f5c5b908f6cddbc36a32406377b2669589c6e48f15741fb959eae8b0176d6eb0322e72939573b3c2b3d94775bcd7a0db6dfee7c374f2a11dd446c7e7d1468fd59bb90cabfdf857023788417c2ffec9dd2868279c15f647924b7bd81606bed4f1998930c5cdfc698c264bb1fd8549fc0ae3d352524ecbffa3806cd0529693a3d73aa368dd6c4b3376d820acb4df3e79bb014810914aede57c16251908a00214a461d5f89aed90ccb449707488c72537e890b996c836ec2415fd9a544f6a06bba9063ddd9f52db961b174f9e66b9ee0a05f52317413111100476501e72cdb16acc5fc6e48f15741fb959eae8b0176d6eb03203e2105c21da1d0fdf9a7ddb978bf2f4e65423f435e3d1da38992e6fc7c17ff4b90cabfdf857023788417c2ffec9dd28daaf48929da4071921c2910bda4eb46139b39ce3e0679298121b6ea4cfa6a450bf4c121082d808b7a85cf11296d8abb1e1e1ac56a9c758cc5e7defd9c79abf2c4810914aede57c16251908a00214a46185d03e4c7abbac0d0c4be2fe49e87738ef05e5b56b0387b1fb955187fcf10f293ddd9f52db961b174f9e66b9ee0a05f54aaf69e937d49854f61d4ce924ee8ac1cc025cce48ff51567d35569330e8de16044e4c3259332d05b3b4288fe8665b195b97fe0e3ea62069cf327a651b120468b90cabfdf857023788417c2ffec9dd28e7870a66f4b2a3faec28f54d6a0cb1e782545e7f5cad8a0e49cbe4bb7ee13c92b1657a7c896edd51d2401a2a43301b2293efd57717d46f108bc5667289f0f8cf4810914aede57c16251908a00214a4616d1818f5539ae51f30f827cab684abac5a96da993382b18917863949e42dd5903ddd9f52db961b174f9e66b9ee0a05f53300b9574ed458ad0efee55d55889b66cc025cce48ff51567d35569330e8de16bf272195af9025ecf3a984ae9fef035768730f74a311e285ce802c992b66bff1b90cabfdf857023788417c2ffec9dd286292bee158cae5d26c846a732f6b3cada31bc517a401fdd64d1f7ca605d469921d9736ca72e85b813fbc59c059e4054b13198b67544f01e2b2eccc63a950d69c4810914aede57c16251908a00214a461c9ef14f412f2fc749e0b33fa44ff1e9880219446152f86dd4ace800e6e1eba933ddd9f52db961b174f9e66b9ee0a05f51197c036fa69b5b47294878bc279e35acc025cce48ff51567d35569330e8de16a024cc379ebc3546d3c7c15ef0deb0592c5f2e413eb86ca1595409dc6c3b3d4ab90cabfdf857023788417c2ffec9dd28d119576363b064caafebf2fdb95950211131f3921bd950a3fadf90e127bd8012ac2a5f07ba388bd6b1fdcf0885e25d5686d25971fd4eaad9bdd9cc5da8d8a6634810914aede57c16251908a00214a46148e6ed3e30627eab24a85246ad5ddb537d1d35561c7e16d917f57e65802e32d03ddd9f52db961b174f9e66b9ee0a05f5edd9730955c5b1c96d0cb08d2e3605f2c6e48f15741fb959eae8b0176d6eb0321c68631726b7a86cb2fe3445f1b23198e763484a6c00db3deb4cbb294b0e7d32b90cabfdf857023788417c2ffec9dd28d82a5e0a00a4f3e1ca7a10c47b61e3799de0788e6b31bef3010800730d206a7f75e4f4939d3fb8f55730e125a1e90cd49642a74e05dad4887d2db0d4218e3f2a4810914aede57c16251908a00214a461d8c0793816f4d419f664821b2c5eed1da621d804224db3a52cee704b0675af6b3ddd9f52db961b174f9e66b9ee0a05f50612aae4109f19f14c14439ec2561d26cc025cce48ff51567d35569330e8de1614a081efb2ff8ae744dbca632201f4e7ce6621d77cc1bc557931ed07e1981fcdb90cabfdf857023788417c2ffec9dd28ea31019e9254cd30929e2dc5c97680ad1ab145184149fd12ed2ecabe14e918aaac2a5f07ba388bd6b1fdcf0885e25d56250a780588010e9f70158c34ceb6fb064810914aede57c16251908a00214a4611d35531f85afd9e83004b58124c096cbe02a7b7e7ce809b58867b98ef74b1bf13ddd9f52db961b174f9e66b9ee0a05f544d370bfc76d682ebff810d1843392d6c6e48f15741fb959eae8b0176d6eb0320b0a4b46a68c84bf7706531ce964340cd7d69198e4e830bf6c5dc48bcdaac60eb90cabfdf857023788417c2ffec9dd284e88e464de3d856035e0aa41f8e05d4ead81408887920b8e6e5ad8d7a72e11123768113a097c87db8c96d33d026a60baa60fee0885e0834c3f71d6ba8d08cddd4810914aede57c16251908a00214a461627583f6dec9ffc760e30a59fcf313bba4365b75cfdd63d3e030d510a84584853ddd9f52db961b174f9e66b9ee0a05f5c5e2a2c70128cc3bd68cc8edc104b26f47acb1b226bc44fda00411bf5760fdab";
$de = $aes->decrypt($hex);
echo $de;

?>