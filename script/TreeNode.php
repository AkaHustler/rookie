<?php
/**
 * @FileName: test.php
 * @Author: houzhongbo
 * @Mail:houzhongbo@zuoyebang.com
 * @Created Time: 2021-05-28 11:00:30
 */

/**
 * Definition for a binary tree node.
 * */
class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class Solution
{

    public $map = [];
    public $res = [];

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree($root)
    {
        //base case
        if ($root == null) {
            return null;
        }
        //root操作
        $temp = $root->left;
        $root->left = $root->right;
        $root->right = $temp;
        //递归
        $this->invertTree($root->left);
        $this->invertTree($root->right);
        return $root;
    }

    /**
     * @param Integer[] $nums
     * @return TreeNode
     */
    function constructMaximumBinaryTree($nums) {
        if (count($nums) == 0) {
            return null;
        }
        if (count($nums) == 1) {
            return new TreeNode($nums[0], null, null);
        }
        $i = $this->getMax($nums);

        $root = new TreeNode($nums[$i]);
        $left = $this->constructMaximumBinaryTree(array_slice($nums, 0, $i));
        $right = $this->constructMaximumBinaryTree(array_slice($nums, $i + 1, count($nums) - 1));
        $root->left = $left;
        $root->right = $right;
        return $root;
    }

    function getMax($nums)
    {
        $max = 0;
        $i = $nums[$max] ?? 0;
        foreach ($nums as $key => $value) {
            if ($value >= $max) {
                $max = $value;
                $i = $key;
            }
        }
        return $i;
    }

//    /**
//     * @param  $preorder
//     * @param  $inorder
//     * @return TreeNode
//     */
//    function buildTree(&$preorder, $inorder) {
//        //base case
//        if (count($inorder) == 0) {
//            return null;
//        }
//        if (count($inorder) == 1) {
//            array_shift($preorder);
//            return new TreeNode($inorder[0]);
//        }
//        //root 节点操作
//        $i = $this->getRootNode($preorder, $inorder);
//        if (!isset($i)) {
//            return null;
//        }
//        array_shift($preorder);
//        $root = new TreeNode($inorder[$i]);
//        //递归子节点
//        $left = $this->buildTree($preorder, array_slice($inorder, 0, $i));
//        $right = $this->buildTree($preorder, array_slice($inorder, $i + 1, count($inorder) - 1));
//        $root->left = $left;
//        $root->right = $right;
//        return $root;
//    }

    function getRootNode($inorder, $postOrder) {
        $root = end($postOrder);
        foreach ($inorder as $key => $value) {
            if ($value == $root) {
                return $key;
            }
        }
        return null;
    }

    /**
     * @param $inorder
     * @param $postorder
     * @return TreeNode
     */
    function buildTree($inorder, &$postorder) {
        //base case
        if (count($inorder) == 0) {
            return null;
        }
        if (count($inorder) == 1) {
            array_pop($postorder);
            return new TreeNode($inorder[0]);
        }
        //root节点操作
        $i = $this->getRootNode($inorder, $postorder);
        if (!isset($i)) {
            return null;
        }
        array_pop($postorder);
        $root = new TreeNode($inorder[$i]);
        //递归子节点
        $right = $this->buildTree(array_slice($inorder, $i + 1, count($inorder) - 1), $postorder);
        $left = $this->buildTree(array_slice($inorder, 0, $i), $postorder);
        $root->right = $right;
        $root->left = $left;
        return $root;
    }



    /**
     * @param TreeNode $root
     * @return TreeNode[]
     */
    function findDuplicateSubtrees($root) {
        $this->traverse($root);
        return $this->res;
    }

    /**
     * @param TreeNode $root
     * @return string
     */
    private function traverse($root) {
        //base case
        if ($root == null) {
            return '#';
        }
        //后序遍历递归子节点
        $left   = $this->traverse($root->left);
        $right  = $this->traverse($root->right);
        //root 节点操作
        $key = $left . '-' . $root->val . '-' . $right;
        if (!array_key_exists($key, $this->map)) {
            $this->map[$key] = $root;
        } else {
            echo $key . PHP_EOL;
            $this->res[$key] = $root;
        }
        return $key;
    }

    /**
     * @param TreeNode $root
     * @param Integer $k
     * @return Integer
     */
    function kthSmallest($root, $k) {
        $res = null;
        $rank = 0;
        $this->middleOrder($root, $k, $res, $rank);
        return $res;
    }

    /**
     * @param TreeNode $root
     * @param $k
     */
    function middleOrder($root, $k, &$res, &$rank) {
        if ($root == null) {
            return;
        }
        $this->middleOrder($root->left, $k, $res, $rank);
        $rank++;
        if ($rank == $k) {
            //找到最小的了
            $res = $root->val;
            return ;
        }
        $this->middleOrder($root->right, $k, $res,  $rank);
    }

    /**
     * 538：将BST转化为累加树
     * @param $root
     * @return mixed
     */
    function convertBST($root) {
        $sum = 0;
        $this->middleConvertBST($root, $sum);
        return $root;
    }

    /**
     * @param TreeNode $root
     */
    function middleConvertBST(&$root, &$sum) {
        if ($root == null) {
            return;
        }
        $this->middleConvertBST($root->right, $sum);
        $sum += $root->val;
        $root->val = $sum;
        $this->middleConvertBST($root->left, $sum);
    }
}

$obj = new Solution();
$root = new TreeNode(4);
$root->left = new TreeNode(1);
$root->right = new TreeNode(6);
$root->left->left = new TreeNode(0);
$root->left->right = new TreeNode(2);
$root->right->left = new TreeNode(5);
$root->right->right = new TreeNode(7);
$root->left->right->right = new TreeNode(3);
$root->right->right->right = new TreeNode(8);

$subject = $obj->convertBST($root);
var_dump($subject);

