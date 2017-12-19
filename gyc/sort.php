<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Just a test</title>
</head>

<body>
    <p>
        <?php
            $numbers = array(rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100), rand(0, 100));
            for ($i = 0; $i < 5; $i++)
            {
                for ($j = $i + 1; $j < 5; $j++)
                {
                    if ($numbers[$i] > $numbers[$j])
                    {
                        $tmp = $numbers[$j];
                        $numbers[$j] = $numbers[$i];
                        $numbers[$i] = $tmp;
                    }
                }
            }
            for ($i = 0; $i < 5; $i++)
            {
                echo $numbers[$i]."<br>";
            }
        ?>
    </p>
</body>

</html>