<?php
/**
 * ArrayObjectテスト
 *
 * PHP: ArrayObject - Manual
 * http://php.net/manual/ja/class.arrayobject.php
 */

// ArrayObjectはクラスオブジェクトに配列としての振る舞いをさせるための抽象クラスです。
// ArrayObjectは抽象クラスなので実装を持っています。その実装をオーバーライドすることで挙動を変更できます。
// 必要な機能を実装するだけで完了しますが、オーバーライドしていないメソッドが呼ばれてしまうと意図しない動作になってしまいます。
// 完全に配列としての振る舞いを制御するなら、IteratorAggregate, ArrayAccess, Serializable, Countableインタフェースの4つを実装する必要があります。

class DataList extends ArrayObject
{
    // 自動的に親クラスのコンストラクタが呼び出され、引数に渡した配列がセットされる
    // 自前でコンストラクタを書く場合は、親クラスのコンストラクタを呼び出す必要がある

    public function offsetGet($index)
    {
        return parent::offsetGet($index);
    }
}

$data_arr = [
    'first',
    'second',
    'third',
    'forth',
    'fifth',
];
$data_list = new DataList($data_arr);
echo $data_list[0].PHP_EOL;
