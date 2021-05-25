<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SplMaxHeap;
use SplStack;

class Rookie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Rookie:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rookie:test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public $inArr = [];
    public $outArr = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $input = [4,5,1,6,2,7,3,8];
        $k = 4;
        print_r($this->GetLeastNumbers_Solution($input, $k));
        return 1;
    }

    private function duplicate (array $numbers, &$duplication) {
        if ($numbers == null || count($numbers) == 0) {
            return false;
        }
        for ($i = 0; $i < count($numbers) - 1; $i++) {
            if ($i == $numbers[$i]) {
                continue;
            }
            $check = $numbers[$i];
            $checked = $numbers[$numbers[$i]];
            if ($check != $checked) {
                $j = $checked;
                $numbers[$numbers[$i]] = $check;
                $numbers[$i] = $j;
            } else {
                $duplication[0] = $check;
                return true;
            }
        }
        return false;
    }

    private function find($target, array $array) {
        if ($target == null || $array == null || count($array) == 0 || count($array[0]) == 0) {
            return false;
        }
        $rows = 0;
        $cols = count($array[0]) - 1;
        $check = $array[$rows][$cols];
        while (true) {
            if ($check > $target) {
                $cols--;
                if ($cols < 0) {
                    break;
                }
                $check = $array[$rows][$cols];
            } else if ($check < $target) {
                $rows++;
                if ($rows > count($array) - 1) {
                    break;
                }
                $check = $array[$rows][$cols];
            } else {
                return true;
            }
        }
        return false;
    }

    private function replaceSpace($str) {
        /*
        $len = strlen($str);
        $str1 = '';
        for ($i = 0; $i < $len; $i++) {
            if ($str[$i] == ' ') {
                $str1 .= '%20';
            } else {
                $str1 .= $str[$i];
            }
        }
        return $str1;
        */
        //return str_replace(' ', '%20', $str);
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            if ($str[$i] == ' ') {
                $str .= '  ';
            }
        }
        $p1 = $len - 1;
        $p2 = strlen($str) - 1;
        while ($p1 >= 0 || $p1 != $p2) {
            if ($str[$p1] != ' ') {
                $str[$p2] = $str[$p1];
                $p2--;
            } else {
                $str[$p2--] = '0';
                $str[$p2--] = '2';
                $str[$p2--] = '%';
            }
            $p1--;
        }
        return $str;
    }

    private function printMatrix($matrix) {
        $result = [];
        $r1 = 0;
        $r2 = count($matrix) - 1;
        $c1 = 0;
        $c2 = count($matrix[0]) - 1;
        while ($r1 <= $r2 && $c1 <= $c2) {
            for ($i = $c1; $i <= $c2; $i++) {
                $result[] = $matrix[$r1][$i];
            }
            for ($j = $r1 + 1; $j <= $r2; $j++) {
                $result[] = $matrix[$j][$c2];
            }

            if ($r1 != $r2) {
                for ($i = $c2 - 1; $i >= $c1; $i--) {
                    $result[] = $matrix[$r2][$i];
                }
            }

            if ($c1 != $c2) {
                for ($j = $r2 - 1; $j > $r1; $j--) {
                    $result[] = $matrix[$j][$c1];
                }
            }

            $r1++;$r2--;$c1++;$c2--;

        }
        return $result;
    }

    private function firstNotRepeatingChar($str) {
        $len = strlen($str);
        $result = [];
        for ($i = 0; $i < $len; $i++) {
            if (isset($result[$str[$i]])) {
                $result[$str[$i]]++;
                continue;
            }
            $result[$str[$i]] = 1;
        }
        foreach ($result as $key => $value) {
            if ($value > 1) {
                continue;
            }
            return strpos($str, $key);
        }
        return -1;
    }

    private function mypush($node)
    {
        array_push($this->inArr, $node);
    }

    private function mypop()
    {
        if (empty($this->outArr)) {
            while (!empty($this->inArr)) {
                array_push($this->outArr, array_pop($this->inArr));
            }
        }
        return array_pop($this->outArr);
    }

    private function IsPopOrder( $pushV ,  $popV )
    {
        $stack = [];
        $index = 0;
        foreach ($pushV as $value) {
            array_push($stack, $value);
            $peek = $value;
            while (!empty($stack) && $peek == $popV[$index]) {
                array_pop($stack);
                $index++;
                $peek = $stack[count($stack)-1] ?? '';
            }
        }
        return empty($stack);

        // write code here
    }

    private function GetLeastNumbers_Solution( $input ,  $k )
    {
        if ($k > count($input)) {
            return [];
        }
        $maxHeap = new SplMaxHeap();
        foreach ($input as $value) {
            $maxHeap->insert($value);
            if ($maxHeap->count() > $k) {
                $maxHeap->extract();
            }
        }
        $result = [];
        foreach ($maxHeap as $value) {
            $result[] = $value;
        }
        sort($result);
        return $result;
        // write code here
    }
}
