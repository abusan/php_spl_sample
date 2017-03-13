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

class EventRankingHeap extends SplHeap
{
    public function compare($array1, $array2)
    {
        return $array1['event_points'] - $array2['event_points'];
    }
}

$event_ranking_heap = new EventRankingHeap();

// DBからユーザーのイベントデータを取得したと仮定
$person_event_data_arr = array(
    array('person_id' => 1, 'person_name' => 'tarou', 'event_points' => 100),
    array('person_id' => 2, 'person_name' => 'jirou', 'event_points' => 200),
    array('person_id' => 3, 'person_name' => 'saburou', 'event_points' => 50),
    array('person_id' => 4, 'person_name' => 'shirou', 'event_points' => 70),
    array('person_id' => 5, 'person_name' => 'gorou', 'event_points' => 150),
    array('person_id' => 6, 'person_name' => 'rokurou', 'event_points' => 120),
    array('person_id' => 7, 'person_name' => 'sitirou', 'event_points' => 20),
    array('person_id' => 8, 'person_name' => 'hatirou', 'event_points' => 95),
    array('person_id' => 9, 'person_name' => 'kurou', 'event_points' => 133),
    array('person_id' => 10, 'person_name' => 'juurou', 'event_points' => 170),
);

foreach ($person_event_data_arr as $person_event_data) {
    $event_ranking_heap->insert($person_event_data);
}

foreach ($event_ranking_heap as $event_ranking_data) {
    echo implode(',', $event_ranking_data)."\n";
}









