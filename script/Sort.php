<?php

class SortSolution
{
    //冒泡排序，相邻数据比较大小，交换顺序
    public function bubbleSort($arr)
    {
        $size = count($arr);
        for ($i = 0; $i < $size; $i++) {
            //这里的子循环是相邻数据比较大小，交换顺序
            //最后几位已经是最大值，所以边界是$size - $i - 1
            for ($j = 0; $j < $size - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $this->swap($arr, $j, $j+1);
                }
            }
        }
        return $arr;
    }

    //快速排序
    public function quickSort($arr)
    {
        $this->quickSortArr($arr, 0, count($arr) - 1);
        return $arr;
    }

    private function quickSortArr(&$arr, $low, $high) {
        if ($low < $high) {
            $pos = $this->quickSortPartition($arr, $low, $high);
            $this->quickSortArr($arr, $low, $pos - 1);
            $this->quickSortArr($arr, $pos + 1, $high);
        }
    }

    //快排分区函数，寻找基准元素
    //返回p，保证区间[low,p]的数据都 <= arr[p] 区间[p,high]的数据都 >= arr[p]
    private function quickSortPartition(&$arr, $low, $high)
    {
        $j = $low;
        $target = $arr[$j];
        for ($i = $low + 1; $i <= $high; $i++) {
            if ($arr[$i] <= $target) {
                //这里的j++是保证最终的j是基准元素左边第一个元素
                //所以最后再交换一次
                $j++;
                $this->swap($arr, $j, $i);
            }
        }

        //将基准元素low与基准元素左边第一个元素交换
        $this->swap($arr, $j, $low);
        return $j;
    }

    //归并排序
    public function mergeSort($arr)
    {
        if (empty($arr)) {
            return $arr;
        }
        $this->mSort($arr, 0, count($arr) - 1);
        return $arr;
    }

    private function mSort(&$arr, $left, $right)
    {
        $mid = floor(($left + $right) / 2);
        if ($left < $right) {
            $this->mSort($arr, $left, $mid);
            $this->mSort($arr, $mid + 1, $right);
            $this->merge($arr, $left, $mid, $right);
        }
    }

    //合并函数
    private function merge(&$arr, $left, $mid, $right)
    {
        $tmp = array();
        $i = $left; //左指针
        $j = $mid + 1; //右指针
        $k = 0;
        // 把较小的数先转移到新数组中
        while ($i <= $mid && $j <= $right) {
            if ($arr[$i] < $arr[$j]) {
                $tmp[$k++] = $arr[$i++];
            } else {
                $tmp[$k++] = $arr[$j++];
            }
        }
        //把左边剩余的数移入数组
        while ($i <= $mid) {
            $tmp[$k++] = $arr[$i++];
        }
        //把右边剩余的数移入数组
        while ($j <= $right) {
            $tmp[$k++] = $arr[$j++];
        }

        //把新数组中的覆盖nums数组
        foreach ($tmp as $k2 => $k2Value) {
            $arr[$k2 + $left] = $k2Value;
        }
    }

    //希尔排序
    public function shellSort($arr)
    {}

    //搜索旋转排序数组
    //33 https://leetcode-cn.com/problems/search-in-rotated-sorted-array
    public function search($nums, $target)
    {
        $size = count($nums);

        //base case
        if ($size == 0) {
            return -1;
        }
        if ($size == 1) {
            return $nums[0] == $target ? 0 : -1;
        }
        $l = 0; $r = $size - 1;
        while ($l <= $r) {
            //二分
            $mid = round(($l + $r) / 2);
            if ($nums[$mid] == $target) {
                return $mid;
            }
            if ($nums[$l] <= $nums[$mid]) {
                //区间[l,mid]是有序的
                if ($nums[$l] <= $target && $target <= $nums[$mid]) {
                    //在这个有序区间范围内
                    $r = $mid - 1;
                    continue;
                }
                $l = $mid + 1;
                continue;
            }
            if ($nums[$mid] <= $nums[$r]) {
                //区间[mid,r]是有序的
                if ($nums[$mid] <= $target && $target <= $nums[$r]) {
                    //target在这个[mid,r]有序区间范围内
                    $l = $mid + 1;
                    continue;
                }
                $r = $mid - 1;
                continue;
            }
        }
        return -1;
    }

    //缺失的第一正整数
    //41 https://leetcode-cn.com/problems/first-missing-positive/
    public function firstMissingPositive($nums)
    {
        //[3,4,-1,1]
        //[-1,4,3,1]
        //[-1,1,3,4]
        $size = count($nums);
        //原地hash [1,N+1]
        for ($i = 0; $i < $size; $i++) {
            while ($nums[$i] > 0 && $nums[$i] <= $size && $nums[$i] != $nums[$nums[$i]-1]) {
                $this->swap($nums, $i, $nums[$i] - 1);
            }
        }
        //这个地方是因为循环里有涉及到iValue值的修改
        foreach ($nums as $key => $value) {
            if ($key + 1 != $value) {
                return $key + 1;
            }
        }
        return $size + 1;
    }

    private function swap(&$arr, $i, $j)
    {
        $tmp = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $tmp;

    }
}

$obj = new SortSolution();
$arr = array(5,6,2,4,9,1);
var_dump($obj->mergeSort($arr));
