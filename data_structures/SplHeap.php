<?php
/**
 * SplHeapのテスト
 *
 * PHP: SplHeap - Manual
 * http://php.net/manual/ja/class.splheap.php
 */

// Q: ヒープって何？
// A: 半順序集合をツリーで表現したデータ構造です。
//    親ノードは子ノードよりも小さい(あるいは大きい)か等しいという条件を満たすツリー構造になります。
//    簡単に言うとオブジェクトに値を入れた瞬間にソートしておいてくれるということです。
//    配列でいいのではと思うかもしれませんが、特定の条件で整列されているということが保証されます。
//    普通の配列変数では中身がソートされているかどうか、どのような条件でソートされているのかは保証されません。

//    SplHeapクラスはそのまま使用せず、ユーザー定義のクラスから継承して使用します。
//    その際、比較条件を定義するcompareメソッドを実装する必要があります。

//    単純に最大値を先頭に保つ場合はSplMaxHeapクラス、最小値を先頭に保つ場合はSplMinHeapクラスを使用します。
//    これらのクラスはSplHeapクラスを継承しており、予めcompareメソッドが実装されています。

//    SplHeapはIteratorとCountableを実装しています。foreachで反復処理を行うことができます。
//    ArrayAccessは実装されていません。ヒープの性質を考えると指定したインデックスの位置に要素を追加することができないためです。

//    SplHeapに入れることができるのは単純な数値や文字列だけでなく、配列、オブジェクトも扱うことができます。

class RankingHeap extends SplHeap
{
    public function compare($array1, $array2)
    {
        return $array1['point'] - $array2['point'];
    }
}

$ranking_heap = new RankingHeap();

$point_data_arr = array(
    array('id' => 1,  'name' => 'tarou',   'point' => 100),
    array('id' => 2,  'name' => 'jirou',   'point' => 200),
    array('id' => 3,  'name' => 'saburou', 'point' => 50),
    array('id' => 4,  'name' => 'shirou',  'point' => 70),
    array('id' => 5,  'name' => 'gorou',   'point' => 150),
    array('id' => 6,  'name' => 'rokurou', 'point' => 120),
    array('id' => 7,  'name' => 'sitirou', 'point' => 20),
    array('id' => 8,  'name' => 'hatirou', 'point' => 95),
    array('id' => 9,  'name' => 'kurou',   'point' => 130),
    array('id' => 10, 'name' => 'juurou',  'point' => 170),
);

foreach ($point_data_arr as $point_data) {
    $ranking_heap->insert($point_data);
}

foreach ($ranking_heap as $ranking_data) {
    echo implode(',', $ranking_data)."\n";
}

unset($ranking_heap);

// ========== 実行速度比較 ==========

// テストデータ
unset($point_data_arr);
$point_data_arr = [];
for ($i = 0; $i < 100000; $i++) { 
    $point_data_arr[]['point'] = mt_rand(1, 10000);
}

// usort
function compare($array1, $array2)
{
    return $array1['point'] - $array2['point'];
}
$point_data_arr_for_array = $point_data_arr;

$start_memory = memory_get_usage();
$start_time   = microtime(true);
usort($point_data_arr_for_array, "compare");
echo "usort()         time:   " . (microtime(true) - $start_time) . PHP_EOL;
echo "usort()         memory: " . (memory_get_usage() - $start_memory) . PHP_EOL;
unset($point_data_arr_for_array);

// SplHeap
$start_memory = memory_get_usage();
$start_time   = microtime(true);
$ranking_heap = new RankingHeap();
foreach ($point_data_arr as $point_data) {
    $ranking_heap->insert($point_data);
}
echo "SplHeap()       time:   " . (microtime(true) - $start_time) . PHP_EOL;
echo "SplHeap()       memory: " . (memory_get_usage() - $start_memory) . PHP_EOL;

// 1回目
// usort()         time:   1.4267411231995
// usort()         memory: 9849000
// SplHeap()       time:   0.21800780296326
// SplHeap()       memory: 1047440

// 2回目
// usort()         time:   1.4669029712677
// usort()         memory: 9849000
// SplHeap()       time:   0.2252950668335
// SplHeap()       memory: 1047440

// 3回目
// usort()         time:   1.4586658477783
// usort()         memory: 9849000
// SplHeap()       time:   0.21258807182312
// SplHeap()       memory: 1047440
