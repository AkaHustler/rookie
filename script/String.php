<?php

class StringSolution
{
    /**
     * 寻找以$s[$l]和$s[$r]为中心的最长回文子串
     * @param $str
     * @param $l
     * @param $r
     * @return false|string
     */
    private function palindrome($str, $l, $r)
    {
        while ($l >= 0 && $r < strlen($str) && $str[$l] == $str[$r]) {
            //相等，向两边平铺
            $l--;
            $r++;
        }
        //寻找以$s[$l]和$s[$r]为中心的最长回文子串
        return substr($str, $l + 1, $r - $l - 1);
    }

    /**
     * 获取最长回文子串
     * @param $str
     * @return string
     */
    public function longestPalindrome($str)
    {
        //base case
        if (empty($str)) {
            return '';
        }
        $ret = '';
        for ($i = 0, $len = strlen($str); $i < $len; $i++) {
            //寻找以$s[$i]为中心最长的回文子串
            $ret1   = $this->palindrome($str, $i, $i);
            //寻找以$s[$i]和$s[$i+1]为中心的最长回文子串
            $ret2   = $this->palindrome($str, $i, $i + 1);
            $ret    = strlen($ret) > strlen($ret1) ? $ret : $ret1;
            $ret    = strlen($ret) > strlen($ret2) ? $ret : $ret2;
        }
        return $ret;
    }

    /**
     * 最长无重复子串
     * @param $s
     * @return int
     */
    public function lengthOfLongestSubstring($s)
    {
        if (empty($s)) {
            return 0;
        }
        $str = '';
        for ($i = 0, $iMax = strlen($s); $i < $iMax; $i++) {
            $tmp = $s[$i];
            for ($j = $i + 1; $j < $iMax; $j++) {
                if (strpos($tmp, $s[$j]) !== false) {
                    break;
                }
                $tmp .= $s[$j];
            }
            $str = strlen($str) > strlen($tmp) ? $str : $tmp;
        }
        return strlen($str);
    }
}

$obj = new StringSolution();
var_dump($obj->lengthOfLongestSubstring("abcabcbb"));
