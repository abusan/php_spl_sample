<?php
/**
 * DirectoryIteratorのテスト
 *
 * PHP: DirectoryIterator - Manual
 * http://php.net/manual/ja/class.directoryiterator.php
 */

$directory = new DirectoryIterator('/home/user');
foreach ($directory as $file_info) {
    if ($file_info->isDot()) {
        // .と..を弾く
        continue;
    }

    if ($file_info->isDir()) {
        // isDirメソッドでディレクトリを弾くことができる
        continue;
    }

    echo $file_info->getFilename().PHP_EOL;
}
// コンストラクタに渡したディレクトリパスに含まれるディレクトリ、ファイル、シンボリックリンクを取り出すことができます
