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

    public function __construct($val)
    {
        $this->val = $val;
    }

}

/**
 * 单链表
 * Class SingleListSolution
 */
class SingleListSolution

{
    public $precursorNode;

    /**
     * 反转全部链表 递归
     * @param ListNode $head
     * @return ListNode
     */
    public function reverse($head)
    {
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
    public function reverseIteration($head)
    {
        //base case
        if ($head == null || $head->next == null) {
            return $head;
        }
        //双指针，pre指针是每次接收反转后的节点，head指针是遍历原本链表
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
    public function reverseN($head, $n)
    {
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
     * @param ListNode $head
     * @param $n
     * @return ListNode
     */
    public function reverseNIteration($head, $n)
    {
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
    public function reverseBetween(ListNode $head, $m, $n)
    {
        //base case
        if ($m == 1) {
            return $this->reverseN($head, $n);
        }
        $head->next = $this->reverseBetween($head->next, $m - 1, $n - 1);
        return $head;
    }

    /**
     * 反转[m, n]区间链表 迭代 todo
     * @param ListNode $head
     * @param $m
     * @param $n
     * @return ListNode
     */
    public function reverseBetweenIteration(ListNode $head, $m, $n)
    {
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
        print_r($reverse);
        die;

        //切断链接
        $pre->next = null;
        $rightNode->next = null;

    }

    /**
     * k个节点一组反转链表
     * @param ListNode $head
     * @param $k
     * @return ListNode
     */
    public function reverseGroup($head, $k)
    {
        //base case
        if ($head == null || $head->next == null) {
            return $head;
        }
        $a = $b = $head;
        for ($i = 0; $i < $k; $i++) {
            if ($b == null) {
                return $head;
            }
            $b = $b->next;
        }

        $newHead = $this->reverseSectionNode($a, $b);
        $a->next = $this->reverseGroup($b, $k);
        return $newHead;
    }

    /**
     * 反转[a,b)区间内的节点
     * @param ListNode $a
     * @param ListNode $b
     * @return ListNode
     */
    public function reverseSectionNode($a, $b)
    {
        if ($a == null || $a->next == null) {
            return $a;
        }
        $pre = null;
        while ($a !== $b) {
            $tmp = $a->next;
            $a->next = $pre;
            $pre = $a;
            $a = $tmp;
        }
        return $pre;
    }

    //删除排序链表中的重复元素 递归
    //82 https://leetcode-cn.com/problems/remove-duplicates-from-sorted-list-ii/
    public function deleteDuplicates($head)
    {
        //base case
        if ($head == null || $head->next == null) {
            return $head;
        }
        //删除以head为头节点的链表里重复的值
        if ($head->val != $head->next->val) {
            //头节点的值不等于下个节点的值
            //head肯定不删除，但是要删除以head->next为头节点的链表重复的值
            $head->next = $this->deleteDuplicates($head->next);
        } else {
            //头节点的值等于下个节点的值
            //要找到下个不相等的值
            $move = $head->next;
            while ($move != null && $move->val == $head->val) {
                $move = $move->next;
            }
            return $this->deleteDuplicates($move);
        }
        return $head;
    }

    //删除排序链表中的重复元素 迭代
    public function deleteDuplicatesIteration($head)
    {
        //建立一个虚拟头节点
        $dummyHead = new ListNode(null);
        $dummyHead->next = $head;
        $curNode = $dummyHead;
        while ($curNode->next) {
            $val = $curNode->next->val;
            $end = $curNode->next;
            //判断是否有重复元素
            if ($end->next && $end->next->val == $val) {
                //有则二层遍历，直到找到不是该值的节点
                while ($end->next && $end->next->val == $val) {
                    $end = $end->next;
                }
                $curNode->next = $end->next;
            } else {
                $curNode = $curNode->next;
            }
        }
        return $dummyHead->next;

    }
}

$head = new ListNode(1);
$head->next = new ListNode(2);
$head->next->next = new ListNode(3);
$head->next->next->next = new ListNode(3);
$head->next->next->next->next = new ListNode(4);
$head->next->next->next->next->next = new ListNode(4);
$head->next->next->next->next->next->next = new ListNode(5);
print_r($head);
$obj = new SingleListSolution();
print_r($obj->deleteDuplicatesIteration($head));
