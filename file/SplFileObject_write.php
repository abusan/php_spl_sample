<?php
/**
 * SplFileObjectのテスト(書き込み)
 *
 * PHP: SplFileObject - Manual
 * http://php.net/manual/ja/class.splfileobject.php
 */

/**
 * ランダム文字列生成 (英数字)
 * $length: 生成する文字数
 * 
 * ランダムな英数字の文字列を作成 - Qiita
 * https://qiita.com/TetsuTaka/items/bb020642e75458217b8a
 */
function makeRandStr($length = 8) {
    static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for ($i = 0; $i < $length; ++$i) {
        $str .= $chars[mt_rand(0, 61)];
    }
    return $str;
}

$data = '';
for ($i = 0; $i < 10000; $i++) {
    $str = makeRandStr(32);
    $data .= $str.PHP_EOL;
}


$start_memory = memory_get_usage();
$start_time = microtime(true);
file_put_contents('./test_file_1', $data);
echo "file_put_contents       time:   " . (microtime(true) - $start_time) . PHP_EOL;
echo "file_put_contents       memory: " . (memory_get_usage() - $start_memory) . PHP_EOL;


$start_memory = memory_get_usage();
$start_time = microtime(true);
$file = new SplFileObject('./test_file_2');
$file->fwrite($data);
echo "SplFileObject()         time:   " . (microtime(true) - $start_time) . PHP_EOL;
echo "SplFileObject()         memory: " . (memory_get_usage() - $start_memory) . PHP_EOL;



