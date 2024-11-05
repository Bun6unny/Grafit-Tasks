<?php

// Код для того, чтобы отправить сразу несколько запросов одновременно я взял отсюда:
// https://phpstack.ru/php/curl-v-php-primery-post-get-zaprosov-s-headers-cookie-json-i-mnogopotocnostu.html
// Я этот код капельку модифицировал, ниже есть комментарий, который описывает, что и где я поменял
// Для api использовал сайт https://reqres.in/

$urls = [
    'https://reqres.in/api/users/1?delay=1',
    'https://reqres.in/api/users/2?delay=2',
    'https://reqres.in/api/users/3?delay=3',
];

$multiCurl = [];
$results = [];
$mh = curl_multi_init();

foreach ($urls as $url) {
    $multiCurl[$url] = curl_init();
    curl_setopt($multiCurl[$url], CURLOPT_URL, $url);
    curl_setopt($multiCurl[$url], CURLOPT_HEADER, 0);
    curl_setopt($multiCurl[$url], CURLOPT_RETURNTRANSFER, 1);
    curl_multi_add_handle($mh, $multiCurl[$url]);
}

$index = null;

do {
    curl_multi_exec($mh, $index);
} while ($index > 0);

// Именно для этого foreach я поменял самую малость код. Добавил переменную, в которой декодируется инфа из json, так итоговый результат выглядит лучше :]
foreach ($multiCurl as $k => $ch) {
    $response = curl_multi_getcontent($ch);
    $decode = json_decode($response, true);
    $results[] = $decode['data'];
    curl_multi_remove_handle($mh, $ch);
}

curl_multi_close($mh);

// По итогу время ответа 3 секунды, так как самый большой delay задан именно в 3 секунды
echo "<pre>";
print_r($results);
echo "</pre>";

?>