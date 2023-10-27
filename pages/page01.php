<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Текст 1</title>
</head>
<body>
    <a href="../index.php" class="button">Вернуться на главную</a>
    </br>

    <?php
        $content = file_get_contents("../textes/Текст01.txt", );
        $content_utf8 = iconv("Windows-1251", "UTF-8", $content);
        echo nl2br($content_utf8);
    ?>

    <?php
        $counter_file = "../counters/counter_page01.txt";
        if (!file_exists($counter_file)) {
            file_put_contents($counter_file, "0");
        }
        $count = file_get_contents($counter_file);
        $count++;
        file_put_contents($counter_file, $count);
    ?>
</body>
</html>