<?php
$large_file = new SplFileObject(__DIR__.'/test_large_file.txt', 'a');
$large_file->ftruncate(0);
$arr = range(1, 100000);
foreach ($arr as $value) {
    $hash = md5($value);
    $large_file->fwrite($hash.PHP_EOL);
}