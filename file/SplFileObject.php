<?php
/**
 * SplFileObjectのテスト
 *
 * PHP: SplFileObject - Manual
 * http://php.net/manual/ja/class.splfileobject.php
 */

$file = new SplFileObject(__DIR__.'/test_file.txt');
foreach ($file as $line) {
    echo $line;
}

// 実体のないストリームを使用すると正常に動かない
// 例えばphp://stdinやphp://inputなど
// rewindメソッドで先頭に巻き戻せないため
// NoRiwindIteratorで包んでやると動く
$file = new SplFileObject('php://stdin');
$file_iterator = new NoRewindIterator($file);
foreach ($file_iterator as $line) {
    echo $line;
}

// SplFileObject::READ_CSVフラグをセットするとCSVを簡単に配列にできる
$csv_file = new SplFileObject(__DIR__.'/test_csv_file.csv');
$csv_file->setFlags(SplFileObject::READ_CSV);
foreach ($csv_file as $line) {
    var_dump($line);
}
