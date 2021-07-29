<?php

require 'vendor/autoload.php';

$client = new Etcd\Client('127.0.0.1:2379', 'v3');
$client->setPretty(true);

// 测试数据
$now = time();
$array = [
    'uuid' => uniqid(mt_rand(), true),
    'time' => $now,
    'date' => date('Y-m-d H:i:s', $now)
];

$project_prefix = 'FTH-TT-DEV/en_US';
$key = $project_prefix . '/ft_game/ft_game_event';

// 读取，不存在就写入数据
$get = $client->get($key);
if (!$get) {
    $client->put($key, json_encode($array));
    $get = $client->get($key);
}

// 获取指定前缀的key
//$get = $client->getKeysWithPrefix($project_prefix);

// 遍历清空
//if (count($get)) {
//    foreach ($get as $key => $value) {
//        $client->del($key);
//    }
//}

// 获取所有key
$get = $client->getAllKeys();

var_export($get);exit;
//var_export(json_decode($get[$key], 1));exit;
