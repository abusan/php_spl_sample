<?php
/**
 * SplFileObjectの速度比較(CSV読み込み)
 *
 * PHP: SplFileObject - Manual
 * http://php.net/manual/ja/class.splfileobject.php
 */

include(__DIR__.'/../class/benchmark.php');

// 速度比較(読み込み)
$bench = new Benchmark();

// fopen + fgetcsv
$bench->start();
$fp = fopen('test_csv_file.csv', 'r');
$csv = [];
while (($row = fgetcsv($fp)) !== false) {
    $csv[] = $row;
}
$bench->stop();
echo 'fopen + fgetcsv         time: '.$bench->get_time_result().PHP_EOL;
echo 'fopen + fgetcsv         memory: '.$bench->get_memory_result().PHP_EOL;
fclose($fp);
unset($csv, $fp, $row);
$bench->__construct();

// SplFileObject::fgetcsv
$bench->start();
$file_obj = new SplFileObject('test_csv_file.csv');
$csv = [];
while ($file_obj->eof() === false) {
    $csv[] = $file_obj->fgetcsv();
}
$bench->stop();
echo 'SplFileObject::fgetcsv  time: '.$bench->get_time_result().PHP_EOL;
echo 'SplFileObject::fgetcsv  memory: '.$bench->get_memory_result().PHP_EOL;
unset($csv, $file_obj);
$bench->__construct();

// SplFileObject::READ_CSV
$bench->start();
$file_obj = new SplFileObject('test_csv_file.csv');
$file_obj->setFlags(SplFileObject::READ_CSV);
$csv = [];
foreach ($file_obj as $row) {
    $csv[] = $row;
}
$bench->stop();
echo 'SplFileObject::READ_CSV time: '.$bench->get_time_result().PHP_EOL;
echo 'SplFileObject::READ_CSV memory: '.$bench->get_memory_result().PHP_EOL;
unset($csv, $file_obj, $row);
$bench->__construct();

// fopen + fgetcsv         time: 0.15174984931946
// fopen + fgetcsv         memory: 7715640
// SplFileObject::fgetcsv  time: 0.14946508407593
// SplFileObject::fgetcsv  memory: 7720368
// SplFileObject::READ_CSV time: 0.1490490436554
// SplFileObject::READ_CSV memory: 7720312
