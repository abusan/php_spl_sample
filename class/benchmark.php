<?php
/**
 * 速度比較などに使うためのベンチマーククラス
 */
class Benchmark
{
    /** 実行時間 */
    private $time       = 0;
    private $start_time = 0;
    private $end_time   = 0;

    /** 消費メモリ(byte) */
    private $memory       = 0;
    private $start_memory = 0;
    private $end_memory   = 0;

    public function __construct()
    {
        $this->time       = 0;
        $this->start_time = 0;
        $this->end_time   = 0;

        $this->memory       = 0;
        $this->start_memory = 0;
        $this->end_memory   = 0;
    }

    public function clear_result()
    {
        $this->__construct();
    }

    public function start()
    {
        $this->time_start();
        $this->memory_start();
    }

    public function stop()
    {
        $this->time_stop();
        $this->memory_stop();
    }

    public function get_result()
    {
        $bench_result_arr = [
            'time'        => $this->time,
            'memory'      => $this->memory,
        ];
        return $bench_result_arr;
    }

    public function get_memory_result()
    {
        return $this->memory;
    }

    public function get_time_result()
    {
        return $this->time;
    }

    private function time_start()
    {
        $this->start_time = microtime(true);
    }

    private function time_stop()
    {
        $this->end_time = microtime(true);
        $this->time = $this->end_time - $this->start_time;
    }

    private function memory_start()
    {
        $this->start_memory = memory_get_usage();
    }

    private function memory_stop()
    {
        $this->end_memory = memory_get_usage();
        $this->memory = $this->end_memory - $this->start_memory;
    }
}