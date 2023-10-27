<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="cloud.jpg" alt="">
    </br>
    <?php
        for ($i = 1; $i <= 10; $i++) {
            echo '<a href="pages/page' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.php" class="button">Страничка ' . $i . '</a><br>';
        }
    ?>
    <form method="POST">
        <button id="loadKeyWords" name="loadKeyWords">Load key wods</button>
    </form>

    <a href="font_size_key_words.php">Check key words</a>
</body>
</html>

<?php
if (isset($_POST['loadKeyWords'])) {
    $dir = 'textes';
    $outputFile = 'documents_keywords.txt';

    // Если файл уже существует, очистим его
    file_put_contents($outputFile, '');

    for ($i = 1; $i <= 10; $i++) {
        $filename = $dir . '/Текст' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.txt'; // Создаем имя файла

        if (file_exists($filename)) {
            $content = file_get_contents($filename);

            // Преобразование из Windows-1251 в UTF-8 (так как было указано, что кодировка файлов Windows-1251)
            $content_utf8 = iconv("windows-1251", "UTF-8", $content);

            // Выделить все слова из текста
            preg_match_all('/\b\w{6,}\b/u', $content_utf8, $matches);

            if (count($matches[0]) >= 10) {
                // Выбрать 10 рандомных слов
                shuffle($matches[0]);
                $keywords = array_slice($matches[0], 0, 10);

                $line = "page" . str_pad($i, 2, '0', STR_PAD_LEFT) . "; " . implode(', ', $keywords) . "\n";

                // Добавить эту строку в файл documents_keywords.txt
                file_put_contents($outputFile, $line, FILE_APPEND);
            }
        }
    }

    echo "Done! Keywords added to {$outputFile}.";
}
?>