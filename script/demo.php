<?php

//给定一个数组 arr，从小到大排列，数组长度为 n。
//请你写一个二分查找函数，从数组中找到大于等于输入 val 的最小的下标（数组下标从 0 开始）。
//如果没有符合条件则返回 -1
//[2,4,5,6,8]
//循环的时候先不返回，到最后状态的时候看下low和high指针 todo

function find($arr, $val)
{
    if (empty($arr)) {
        return -1;
    }
    return divide($arr, 0, count($arr) - 1, $val);
}

function divide($arr, $low, $high, $target)
{
    $mid = floor(($low + $high) / 2);
    if ($low <= $high) {
        if ($arr[$mid] == $target) {
            return $mid;
        }
        if ($arr[$mid] > $target) {
//            if ($mid - 1 <= $low) {
//                return $mid;
//            }
            return divide($arr, $low, $mid - 1, $target);
        }
        return divide($arr, $mid + 1, $high, $target);
    }
    $count = count($arr);
    return $high <= 0 ? 0 : ($low >= $count - 1 ? -1 : $high);
}

$arr = [2,4,6,8];
var_dump(find($arr, 1));
