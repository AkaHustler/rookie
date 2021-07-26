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

class SingleListSolution
{
    public $precursorNode;

    /**
     * 反转全部链表 递归
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
     * 反转链表，迭代(也是需要思考每个节点需要做的事)
     * @param ListNode $head
     * @return ListNode
     */
    public function reverseIteration($head) {
        //base case
        if ($head == null || $head->next == null) {
            return $head;
        }
        $pre = null;
        while ($head != null) {
            $tmp = $head->next;
            $head->next = $pre;
            $pre = $head;
            $head = $tmp;
        }
        return $pre;
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
     * 反转链表前N个节点(迭代) 要先把左右节点拿出来
     * @param  ListNode $head
     * @param $n
     * @return ListNode
     */
    public function reverseNIteration($head, $n) {
        if ($head == null || $head->next == null) {
            return $head;
        }
        $i = 1;
        $node = null;
        $pre = $head;
        //这是找到反转列表的后继节点
        for ($j = 1; $j <= $n; $j++) {
            $pre = $pre->next;
        }
        while ($head != null && $i <= $n) {
            $tmp = $head->next;
            $head->next = $pre;
            $pre = $head;
            $head = $tmp;
            $i++;
        }
        return $pre;
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

    /**
     * @param ListNode $head
     * @param $m
     * @param $n
     * @return ListNode
     */
    public function reverseBetweenIteration(ListNode $head, $m, $n) {
        if ($head == null || $head->next == null) {
            return $head;
        }
        $pre = $head;
        //找到左节点前一个节点
        for ($i = 1; $i < $m - 1; $i++) {
            $pre = $pre->next;
        }
        //找到右节点后一个节点
        $rightNode = $pre;
        for ($i = $m; $i <= $n; $i++) {
            $rightNode = $rightNode->next;
        }

        //截取子链表
        $reverse = $pre->next;
        $curr = $rightNode->next;

        $reverse = $this->reverseIteration($reverse);
        print_r($reverse);die;

        //切断链接
        $pre->next = null;
        $rightNode->next = null;

    }
}

$head = new ListNode(1);
$head->next = new ListNode(2);
$head->next->next = new ListNode(3);
$head->next->next->next = new ListNode(4);
$head->next->next->next->next = new ListNode(5);
$head->next->next->next->next->next = new ListNode(6);
print_r($head);
$obj = new SingleListSolution();
print_r($obj->reverseBetweenIteration($head, 3, 4));
