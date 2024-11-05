<?php

$num = rand(0, 100);

// функция, которая определяет, какое окончание слову дать
function CorrectWord($num) {
    $lastNum = $num % 10;

    if ($num >= 11 && $num <= 14) {
        return "Товаров";
    }

    if ($lastNum == 1) {
        return "Товар";
    }

    if ($lastNum >= 2 && $lastNum <= 4) {
        return "Товара";
    }

    return "Товаров";
}

echo "<h2>" . $num . " " . CorrectWord($num) . "</h2>";

?>