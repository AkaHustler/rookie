<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SortArithmetic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sort:Arithmetic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '排序算法';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arr = [2, 5, 1, 4, 3];
        $this->quick_sort($arr, 0, count($arr) - 1);
        print_r($arr);
    }

    /**
     * 选择排序
     * @param array $arr
     */
    private function selectionSort(array &$arr)
    {
        $this->info("start selection sort");
        $len = count($arr);
        for ($i = 0; $i < $len; $i++) {
            $min = $i;
            for ($j = $i + 1; $j < $len; $j++) {
                if ($arr[$j] < $arr[$min]) {
                    $min = $j;
                }
            }
            $this->swap($arr, $i, $min);
        }
        $this->info("end selection sort");
    }

    /**
     * 冒泡排序
     * @param array $array
     */
    private function bubbleSort(array &$array)
    {
        $this->info("start bubble sort");
        $len = count($array);
        for ($i = 0; $i < $len; $i++) {
            for ($j = 0; $j < $len - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $this->swap($array, $j, $j + 1);
                }
            }
        }
        $this->info("end bubble sort");
    }

    /**
     * 插入排序
     * @param array $array
     */
    private function insertSort(array &$array)
    {
        $this->info("start insert sort");
        $len = count($array);
        for ($i = 1; $i < $len; $i++) {
            for ($j = $i; $j > 0; $j--) {
                if ($array[$j] < $array[$j - 1]) {
                    $this->swap($array, $j, $j - 1);
                }
            }
        }
        $this->info("end insert sort");
    }

    private function quick_sort(&$arr, $l, $r)
    {
    }

    /**
     * 交换
     * @param array $arr
     * @param $i
     * @param $j
     */
    private function swap(array &$arr, $i, $j)
    {
        $temp = $arr[$j];
        $arr[$j] = $arr[$i];
        $arr[$i] = $temp;
    }
}
