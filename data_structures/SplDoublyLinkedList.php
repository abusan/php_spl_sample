<?php
/**
 * SplDoubliLinkedListのテスト
 *
 * PHP: データ構造 - Manual
 * http://php.net/manual/ja/spl.datastructures.php
 */

$linked_list = new SplDoublyLinkedList();

// 双方向のリストなので先頭からだけでなく末尾からもアクセス可能
// Iterator、ArrayAccess、Countableを実装しているため配列のように操作可能(ただし、末尾からのアクセスはメソッドを使う必要がある)
$arr = range(1, 10);

foreach ($arr as $val) {
    // pushメソッドで末尾に追加(unshiftメソッドで末尾に追加)
    $linked_list->push($val);
}

// 値の取得
// メソッドを使用して取り出すと、取り出したノードはリストから消える
// つまりキューやスタックと同じ構造

// 先頭から値を取得
echo $linked_list->shift()."\n";

// 末尾から値を取得
echo $linked_list->pop()."\n";

// 先頭から順番に値を取得
foreach ($linked_list as $val) {
    echo $val."\n";
}

// 末尾から順番に値を取得
$linked_list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
foreach ($linked_list as $val) {
    echo $val."\n";
}
