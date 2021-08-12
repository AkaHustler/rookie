<?php
/**
 * 动态规划
* @FileName: script/DP.php
* @Author: houzhongbo
* @Mail:houzhongbo@zuoyebang.com
* @Created Time: 2021-08-10 17:58:59
*/

class DynamicPlan
{
    /**
     * 斐波那契数列
     * @param $n
     * @return mixed
     */
    public function fib($n)
    {
        $pre = 1;
        $curr = 2;
        for ($i = 3; $i <= $n; $i++) {
            $sum = $curr + $pre;
            $pre = $curr;
            $curr = $sum;
        }
        return $curr;
    }

    /**
     * 杨辉三角
     * @param $n
     * @return array|int[]
     */
    public function pascalTriangle($n)
    {
        if ($n == 1) {
            return array(1);
        }
        if ($n == 2) {
            return array(1, 1);
        }
        $dp[0] = 1;
        $lastRow = $this->pascalTriangle($n - 1);
        for ($i = 1; $i < $n - 1; $i++) {
            $dp[$i] = $lastRow[$i - 1] + $lastRow[$i];
        }
        $dp[$n - 1] = 1;
        return $dp;
    }
}

$obj = new DynamicPlan();
var_dump($obj->fib(4));

