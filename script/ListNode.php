<?php
/**
* @FileName: ListNode.php
* @Author: houzhongbo
* @Mail:houzhongbo@zuoyebang.com
* @Created Time: 2021-07-21 11:55:09
*/

class ListNode
{
    public $val;
    public $next;

    public function __construct($val) {
        $this->val = $val;
    }
}

class Solution
{
    public $precursorNode;

    /**
     * 反转全部链表
     * @param ListNode $head
     * @return ListNode
     */
    public function reverse($head) {
        if ($head->next == null) {
            return $head;
        }
        $last = $this->reverse($head->next);
        //反转操作
        $head->next->next = $head;
        $head->next = null;
        return $last;
    }

    /**
     * 反转链表前N个节点
     * @param ListNode $head
     * @param $n
     * @return ListNode
     */
    public function reverseN($head, $n) {
        //base case
        if ($n == 1) {
            //记录第n+1个节点作为前驱节点
            $this->precursorNode = $head->next;
            return $head;
        }
        $last = $this->reverseN($head->next, $n - 1);
        //反转操作
        $head->next->next = $head;
        //将n+1节点作为next节点
        $head->next = $this->precursorNode;
        return $last;
    }

    /**
     * 反转[m, n]区间链表
     * @param ListNode $head
     * @param $m
     * @param $n
     * @return ListNode
     */
    public function reverseBetween(ListNode $head, $m ,$n) {
        //base case
        if ($m == 1) {
            return $this->reverseN($head, $n);
        }
        $head->next = $this->reverseBetween($head->next, $m - 1, $n - 1);
        return $head;
    }
}

$head = new ListNode(1);
$head->next = new ListNode(2);
$head->next->next = new ListNode(3);
$head->next->next->next = new ListNode(4);
$head->next->next->next->next = new ListNode(5);
print_r($head);
$obj = new Solution();
print_r($obj->reverseBetween($head, 2, 3));
