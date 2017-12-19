<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Just a test</title>
</head>

<body>
    <p>
        <?php
            echo "你的名字是".$_POST["name"]."学号".$_POST["number"]."年龄".$_POST["age"]."<br>";
            if ($_POST["sex"] == "girl")
            {
                echo "你这个女孩";
            }
            elseif ($_POST["sex"] == "boy")
            {
                echo "你个小伙子";
            }
            else
            {
                echo "你竟然，，，你";
            }
            if ($_POST["love"] == "single")
            {
                echo "果然单身狗";
            }
            else
            {
                echo "竟然恋爱了~~";
            }
        ?>
    </p>
</body>

</html>