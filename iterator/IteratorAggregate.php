<?php
/**
 * IteratorAggregateのテスト
 *
 * PHP: IteratorAggregate - Manual
 * http://php.net/manual/ja/class.iteratoraggregate.php
 */

//  Q: IteratorAggregateって何？
//  A: Iteratorインターフェイスを使いやすくしたインターフェイスです
//      神様は言いました。「Iteratorってさあ、実装が面倒だよね」「いろんなクラスに同じ処理が散らばっちゃうよね」
//      そこでPHPの開発者たちはIteratorAggregateを生み出しました。
//
//      IteratorAggregateインターフェイスはIteratorインターフェイスと同じく反復処理可能なクラスを実装するためのインターフェイスです。
//      Iteratorとの最大の違いは、Iteratorがオブジェクトそのものを反復処理可能にするのに対し、反復処理可能なオブジェクトを返させるというところです。
//      IteratorAggregateインターフェイスで必要なメソッドはgetIteratorメソッドの一つだけです。getIteratorインターフェイスで行うことは、反復処理可能なオブジェクトを返すだけです。
//      PHPにはいくつかの実用的なIteratorが組み込まれていますし、個別に実装したIteratorを使っても構いません。
//      PHP5.5以降であればジェネレーター構文を使用することもできます。ちょっとした軽い処理だけど組み込みのIteratorは使えないなんて時に重宝します。

class BasicIteratorAggregate implements IteratorAggregate
{
    private $data_arr = [];

    public function __construct()
    {
        $this->data_arr = [];
    }

    public function set($key, $value)
    {
        $this->data_arr[$key] = $value;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->data_arr);
    }
}

$basic_iterator_aggregate = new BasicIteratorAggregate();
$basic_iterator_aggregate->set(0, 'first');
$basic_iterator_aggregate->set(1, 'second');
$basic_iterator_aggregate->set(2, 'third');
$basic_iterator_aggregate->set(3, 'forth');
$basic_iterator_aggregate->set(4, 'fifth');

foreach ($basic_iterator_aggregate as $key => $value) {
    echo $key.':'.$value.PHP_EOL;
}
// 0:first
// 1:second
// 2:third
// 3:forth
// 4:fifth


// ジェネレーター構文を使用した例
class BasicIteratorAggregateGenerator implements IteratorAggregate
{
    private $data_arr = [];

    public function __construct()
    {
        $this->data_arr = [];
    }

    public function set($key, $value)
    {
        $this->data_arr[$key] = $value;
    }

    public function getIterator()
    {
        foreach ($this->data_arr as $key => $value) {
            yield $key => $value;
        }
    }
}

$basic_iterator_aggregate_generator = new BasicIteratorAggregateGenerator();
$basic_iterator_aggregate_generator->set(0, 'first');
$basic_iterator_aggregate_generator->set(1, 'second');
$basic_iterator_aggregate_generator->set(2, 'third');
$basic_iterator_aggregate_generator->set(3, 'forth');
$basic_iterator_aggregate_generator->set(4, 'fifth');
foreach ($basic_iterator_aggregate_generator as $key => $value) {
    echo $key.':'.$value.PHP_EOL;
}
// 0:first
// 1:second
// 2:third
// 3:forth
// 4:fifth
