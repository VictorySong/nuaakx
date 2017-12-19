<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Just a test</title>
</head>

<body>
    <p>
        <?php
            $languages = array("C/CPP", "Python", "Asm", "PHP(the best programing language in th world!)", "Java", "JavaScript");
            $length = count($languages);
            $string = "";
            for($i = 0; $i < $length; $i++)
            {
                echo $languages[$i]."<br>";
                $string .= $languages[$i];
            }
            echo $string;
        ?>
    </p>
</body>

</html>