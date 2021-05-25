<?php

namespace App\Models\BinaryTree;

use phpDocumentor\Reflection\Utils;

class BinaryTree {

    public function create()
    {
        $nodeA = new Node('A');
        $nodeB = new Node('B');
        $nodeC = new Node('C');
        $nodeD = new Node('D');
        $nodeE = new Node('E');
        $nodeF = new Node('F');
        $nodeG = new Node('G');
        $nodeH = new Node('H');
        $nodeI = new Node('I');
        $nodeA->left = $nodeB;
        $nodeA->right = $nodeC;
        $nodeB->left = $nodeD;
        $nodeB->right = $nodeF;
        $nodeC->left = $nodeG;
        $nodeC->right = $nodeI;
        $nodeF->left = $nodeE;
        $nodeG->right = $nodeH;
//        $node1 = new Node('A');
//
//        $node1->left = $nodeB;
//        $node1->right = $nodeC;
//        $nodeB->left = $nodeD;
//        $nodeB->right = $nodeF;
//        $nodeC->left = $nodeG;
//        $nodeC->right = $nodeI;
//        $nodeF->left = $nodeE;
//        $nodeG->right = $nodeH;

//        $nodeA = new Node('1');
//        $node1 = new Node('1');
//        $nodeB = new Node('2');
//        $nodeA->left = $nodeB;
//        $nodeA->right = null;
//        $node1->right = $nodeB;
//        echo 'create a tree <br>';
        return $nodeA;
    }

    public function preOrder($root)
    {
        echo "前序非递归遍历树结果为:";
        $this->preOrderNoRecur($root);
        echo "<br>前序递归遍历树结果为:";
        $this->preOrderRecur($root);
        echo "<br>中序非递归遍历树结果为:";
        $this->inOrderNonRecur($root);
        echo "<br>中序递归遍历树结果为:";
        $this->inOrderRecur($root);
        echo "<br>后序非递归遍历树结果为:";
        $this->postOrderNonRecur($root);
        echo "<br>后序递归遍历树结果为:";
        $this->postOrderRecur($root);
        echo "<br>层次遍历树结果为:";
        $this->levelOrder($root);
    }


    /**
     * 检查两棵树是否相同
     * https://leetcode-cn.com/problems/same-tree/
     * @param $p
     * @param $q
     * @return bool
     */
    public function isSameTree($p, $q)
    {
        if ($p === null && $q === null) {
            return true;
        }
        if ($p === null || $q === null) {
            return false;
        }
        if ($p->value !== $q->value) {
            return false;
        }
        return $this->isSameTree($p->left, $q->left) && $this->isSameTree($p->right, $q->right);
    }

    /**
     * 检查树是否对称
     * https://leetcode-cn.com/problems/symmetric-tree/
     * @param Node $root
     * @return bool
     */
    public function isSymmetric(Node $root) {
        return $this->symmetricSolution($root->left, $root->right);
    }

    /**
     * @param Node $p
     * @param Node $q
     * @return bool
     */
    private function symmetricSolution($p, $q)
    {
        if ($p === null && $q === null) {
            return true;
        }
        if ($p === null || $q === null) {
            return false;
        }
        if ($p->value !== $q->value) {
            return false;
        }
        return $this->symmetricSolution($p->left, $q->right) && $this->symmetricSolution($p->right, $q->left);
    }

    /**
     * @param Node $root
     * @return int|mixed
     */
    public function getMaxDepth(Node $root)
    {
        if ($root === null) {
            return 0;
        }
        return max($this->getMaxDepth($root->left), $this->getMaxDepth($root->right)) + 1;
    }


    /**
     * 前序遍历递归
     * @param Node $root
     */
    private function preOrderRecur($root)
    {
        //遍历顺序为1,2,4,5,3,6,7
        if ($root !== null) {
            echo $root->value . " ";
            if ($root->left !== null) {
                $this->preOrderRecur($root->left);
            }
            if ($root->left !== null) {
                $this->preOrderRecur($root->right);
            }
        }
    }

    /**
     * 前序遍历非递归
     * @param Node $root
     */
    private function preOrderNoRecur($root)
    {
        //遍历顺序为1,2,4,5,3,6,7
        $stack = array();
        $stack[] = $root;
        while (!empty($stack)) {
            /** @var Node $dealNode */
            $dealNode = array_pop($stack);
            if ($dealNode === null) {
                break;
            }
            echo $dealNode->value . " ";
            if ($dealNode->right !== null) {
                $stack[] = $dealNode->right;  //压入右子树
            }
            if ($dealNode->left !== null) {
                $stack[] = $dealNode->left;  //压入左子树
            }
        }
    }

    /**
     * 中序遍历递归
     * @param Node $root
     */
    private function inOrderRecur($root)
    {
        //遍历顺序为4,2,5,1,6,3,7
        if ($root !== null) {
            $this->inOrderRecur($root->left);
            echo $root->value . " ";
            $this->inOrderRecur($root->right);
        }
    }

    /**
     * 中序遍历非递归
     * @param Node $root
     */
    private function inOrderNonRecur($root)
    {
        //遍历顺序为4,2,5,1,6,3,7
        $stack = array();
        /** @var Node $currentNode */
        $currentNode = $root;
        while (!empty($stack) || $currentNode !== null) {
            while ($currentNode !== null) {
                $stack[] = $currentNode;
                $currentNode = $currentNode->left;
            }
            $currentNode = array_pop($stack);
            echo $currentNode->value . " ";
            $currentNode = $currentNode->right;
        }
    }

    /**
     * 后序遍历递归
     * @param Node $root
     */
    private function postOrderRecur($root)
    {
        //遍历结果为4,5,2,6,7,3,1
        if ($root !== null) {
            $this->postOrderRecur($root->left);
            $this->postOrderRecur($root->right);
            echo $root->value . " ";
        }
    }

    /**
     * 后序遍历非递归
     * @param Node $root
     */
    private function postOrderNonRecur($root)
    {
        //遍历结果为4,5,2,6,7,3,1
        $stack = $outPutStack = array();
        $stack[] = $root;
        while (!empty($stack)) {
            /** @var Node $currentNode */
            $currentNode = array_pop($stack);
            $outPutStack[] = $currentNode;  //先压入根节点，最后输出
            if ($currentNode !== null && $currentNode->left !== null) {
                $stack[] = $currentNode->left;
            }
            if ($currentNode !== null && $currentNode->left !== null) {
                $stack[] = $currentNode->right;
            }
        }
        //输出
        while (!empty($outPutStack)) {
            /** @var Node $node */
            $node = array_pop($outPutStack);
            if ($node !== null) {
                echo $node->value . " ";
            }
        }
    }

    /**
     * 层次遍历
     * @param Node $root
     */
    private function levelOrder($root)
    {
        $stack = array();
        $stack[] = $root;
        if ($root === null) {
            return;
        }
        while (!empty($stack)) {
            /** @var Node $currentNode */
            $currentNode = array_shift($stack);
            if ($currentNode !== null) {
                echo $currentNode->value . " ";
            }
            if ($currentNode->left !== null) {
                $stack[] = $currentNode->left;
            }
            if ($currentNode->right !== null) {
                $stack[] = $currentNode->right;
            }
        }
    }

    /**
     * 按从叶子节点所在层到根节点所在的层，逐层从左向右遍历
     * @param $root
     * @return array
     */
    private function levelOrderBottom($root)
    {
        if ($root === null) {
            return [];
        }
        $result = $deal = [];
        $deal[] = $root;
        while (!empty($deal)) {
            $iMax = count($deal);
            $value = [];
            for ($i = 0; $i < $iMax; $i++) {
                /** @var Node $node */
                $node = array_shift($deal);
                $value[] = $node->value;
                if ($node->left !== null) {
                    $deal[] = $node->left;
                }
                if ($node->right !== null) {
                    $deal[] = $node->right;
                }
            }
            $result[] = $value;
        }
        return array_reverse($result);
    }
}
