<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Interviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Interviews:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interviews:run';

    private $redis;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->redis = Redis::connection('default')->client();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
    }

    private function stepCount($n) {
        if ($n == 1) {
            return 1;
        }
        if ($n == 2) {
            return 2;
        }
        return $this->stepCount($n - 1) + $this->stepCount($n - 2);
    }

    private function stepCountDP($n) {
        if ($n == 1) {
            return 1;
        }
        if ($n == 2) {
            return 2;
        }
        /*
         f(1) = 1
         f(2) = 2
         f(3) = f(2) + f(1)
         f(4) = f(3) + f(2) = [f(2) + f(1)] + f(2)
         f(5) = f(4) + f(3) = [f(2) + f(1) + f(2)] + [f(2) + f(1)]
         */
        $first = 1; $second = 2; $third = 0;
        for ($i = 3; $i <= $n; $i++) {
            $third = $first + $second;
            $first = $second;
            $second = $third;
        }
        return $third;
    }

    /**
     * #### 最长无重复子串长度
    - 输入: “aabcabcbb”
    - 输出: 3
    - 解释: 因为无重复字符的最长子串是 “abc”，所以其长度为 3。
     * @param $str
     */
    private function test($str) {
        $len = strlen($str);
        $max = 1;
        for ($i = 0; $i < $len; $i++) {
            $target[$str[$i]] = $str[$i];
            $temp = 1;
            for ($j = $i + 1; $j < $len; $j++) {
                if (in_array($str[$j], $target)) {
                    break;
                }
                $target[$str[$j]] = $str[$j];
                $temp++;
            }
            $max = $temp > $max ? $temp : $max;
            $target = [];
        }
        return $max;
    }
}
