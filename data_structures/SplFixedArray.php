<?php
/**
 * SplFixedArrayテスト
 *
 * PHP: SplFixedArray - Manual
 * http://php.net/manual/ja/class.splfixedarray.php
 */

// Q1. これは何？
// A1. 固定長の配列を実現するためのクラスです。固定長なのでコンストラクタに渡したサイズの要素以上は扱えません。
//     固定長にすることで高速かつ省メモリな配列を実現できています。また、順序を保証することができます。

$fixed_array = new SplFixedArray(10);
$fixed_array[0] = 10;
$fixed_array[1] = 20;
$fixed_array[2] = 30;
$fixed_array[3] = 40;
$fixed_array[4] = 50;
$fixed_array[5] = 60;
$fixed_array[6] = 70;
$fixed_array[7] = 80;
$fixed_array[8] = 90;
$fixed_array[9] = 100;

// $fixed_array[10] = 110;   // これはエラーになる。RuntimeExceptionが投げられるためtry catchで捕捉可能
// PHP Fatal error:  Uncaught exception 'RuntimeException' with message 'Index invalid or out of range'

unset($fixed_array);

// ========== 速度 & メモリ比較 ==========
const ARRAY_LENGTH = 1000000;   // 100万

// 通常の配列
$start_memory = memory_get_usage();
$start_time = microtime(true);
$array = [];
for ($i = 0; count($array) < ARRAY_LENGTH; $i++) {
    $array[$i] = $i;
}
echo "Array()         time:   " . (microtime(true) - $start_time) . PHP_EOL;
echo "Array()         memory: " . (memory_get_usage() - $start_memory) . PHP_EOL;
unset($array);

// SplFixedArray
$start_memory = memory_get_usage();
$start_time = microtime(true);
$fixed_array = new SplFixedArray(ARRAY_LENGTH);
for ($i = 0; count($fixed_array) < ARRAY_LENGTH; $i++) {
    $fixed_array[$i] = $i;
}
echo "SplFixedArray() time:   " . (microtime(true) - $start_time) . PHP_EOL;
echo "SplFixedArray() memory: " . (memory_get_usage() - $start_memory) . PHP_EOL;
echo PHP_EOL;

// Array()         time:   0.5632700920105
// Array()         memory: 144389344
// SplFixedArray() time:   0.00093698501586914
// SplFixedArray() memory: 8000352
