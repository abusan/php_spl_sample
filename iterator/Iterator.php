<?php
/**
 * Iteratorのテスト
 *
 * PHP: Iterator - Manual
 * http://php.net/manual/ja/class.iterator.php
 */

//  Q: Iteratorって何？
//  A: PHPで反復処理を行うためのインターフェイスです。
//      PHPのオブジェクトは特に何もしなくてもforeachによる反復処理が可能です。publicのメンバを得ることができます。
//      より詳細に反復処理された際の挙動を実装できるのがIteratorインターフェイスです。
//      Iteratorはcurrent, key, next, rewind, validの5つを実装する必要があります。
//      Iteratorインターフェイスを実装したオブジェクトは、完全なIteratorとしての振る舞いを要求されます。

class BasicIterator implements Iterator
{
    private $position = 0;
    private $data_arr = [];

    public function __construct()
    {
        $this->rewind();
    }

    public function add($value)
    {
        $this->data_arr[] = $value;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->data_arr[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function valid()
    {
        return isset($this->data_arr[$this->position]);
    }
}

$basic_iterator = new BasicIterator();
$basic_iterator->add('first');
$basic_iterator->add('second');
$basic_iterator->add('third');
$basic_iterator->add('forth');
$basic_iterator->add('fifth');

foreach ($basic_iterator as $key => $value) {
    echo $key.':'.$value.PHP_EOL;
}
// 0:first
// 1:second
// 2:third
// 3:forth
// 4:fifth
