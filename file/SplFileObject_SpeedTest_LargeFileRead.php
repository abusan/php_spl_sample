<?php
/**
 * SplFileObjectの速度比較
 *
 * PHP: SplFileObject - Manual
 * http://php.net/manual/ja/class.splfileobject.php
 */

include(__DIR__.'/../class/benchmark.php');

// 速度比較(読み込み)
$bench = new Benchmark();

// file_get_contents
$bench->start();
$file = file_get_contents(__DIR__.'/test_large_file.txt');
$bench->stop();
echo 'file_get_contents()   time: '.$bench->get_time_result().PHP_EOL;
echo 'file_get_contents() memory: '.$bench->get_memory_result().PHP_EOL;
unset($file);
$bench->__construct();

// SplFileObject
$bench->start();
$file_obj = new SplFileObject(__DIR__.'/test_large_file.txt');
$file = $file_obj->fread($file_obj->getSize());
$bench->stop();
echo 'SplFileObject()       time: '.$bench->get_time_result().PHP_EOL;
echo 'SplFileObject()     memory: '.$bench->get_memory_result().PHP_EOL;
unset($file_obj);
$bench->__construct();
// file_get_contents()   time: 0.16685199737549
// file_get_contents() memory: 3300384
// SplFileObject()       time: 0.02136492729187
// SplFileObject()     memory: 3313760
