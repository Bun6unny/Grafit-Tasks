<?php

// Условная БД
$goods = [
    ['name' => 'Яблоко', 'price' => 59],
    ['name' => 'Арбуз', 'price' => 166],
    ['name' => 'Груша', 'price' => 43],
    ['name' => 'Ягоды', 'price' => 88],
    ['name' => 'Банан', 'price' => 41],
];

// Для наглядности добавил на страницу вывод цен до наценки
echo "<h2>Цена до наценки:</h2>";

foreach ($goods as $item) {
    echo $item['name'] . " цена: " . $item['price'] . " руб. <br>";
}

echo "<h2>Цена после наценки:</h2>";

foreach ($goods as $item) {
    $roundPrice = round($item['price'] / 10) * 10;
    $price = $roundPrice + $roundPrice/100*30;
    echo $item['name'] . " цена: " . $price . " руб. <br>";
}

?>