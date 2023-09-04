<?php

require __DIR__ . '/../vendor/autoload.php';

$botToken = config('CRISP_BOT_TOKEN');
$chatId = config('CRISP_CHAT_ID');
$debugMode = config('DEBUG', false);

$data = json_decode(file_get_contents('php://input'));

if ($debugMode) {
    file_put_contents(getRandomName(), json_encode($data));
}

if (is_object($data) && isset($data->data)) {

    // send to telegram
    $message = '<b>' . $data->data->user->nickname . '</b>' . PHP_EOL;
    $message .= $data->data->content . PHP_EOL;
    sendToTelegramBot($botToken, $chatId, $message);
}

echo 'success';


function getRandomName()
{
    return __DIR__ . '/../tmp/' . 'crisp_' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 8) . '.json';
}