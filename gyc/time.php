<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Just a test</title>
</head>

<body>
    <p>
        <?php
            $hour = date("H");
            
            if ($hour < "20")
            {
                echo "睡什么，起来嗨！";
            }
            else
            {
                echo "晚安";
            }
        ?>
    </p>
</body>

</html>