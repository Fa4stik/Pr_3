<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Keywords Cloud</title>
</head>
<body>
<a href="index.php">Главная</a>
</br>

<?php
$outputFile = 'documents_keywords.txt';
$baseFontSize = 12;  // базовый размер шрифта

if (file_exists($outputFile)) {
    $lines = file($outputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        list($page, $keywords) = explode(';', $line);
        $page = trim($page);
        $keywords = array_map('trim', explode(',', $keywords));

        $counter_file = "./counters/counter_" . $page . ".txt";
        $count = 1;
        if (file_exists($counter_file)) {
            $count = intval(file_get_contents($counter_file));
        }

        $fontSize = $baseFontSize + $count;

        foreach ($keywords as $keyword) {
            echo "<span style='font-size: {$fontSize}px;'>$keyword </span>";
        }

        echo "/ [$fontSize]px </br>";
    }
} else {
    echo "File with keywords not found.";
}
?>

</body>
</html>
