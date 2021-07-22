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
    /**
     * @param ListNode $head
     * @return ListNode
     */
    public function reverse($head) {
        if ($head->next == null) {
            return $head;
        }
        $last = $this->reverse($head->next);
        $head->next->next = $head;
        $head->next = null;
        return $last;
    }
}

$head = new ListNode(1);
$head->next = new ListNode(2);
$head->next->next = new ListNode(3);
$head->next->next->next = new ListNode(4);
$head->next->next->next->next = new ListNode(5);
print_r($head);
$obj = new Solution();
print_r($obj->reverse($head));
