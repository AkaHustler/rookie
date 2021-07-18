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

    function getMax($nums) {
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

    /**
     * @param  $preorder
     * @param  $inorder
     * @return TreeNode
     */
    function buildTree(&$preorder, $inorder) {
        //base case
        if (count($inorder) == 0) {
            return null;
        }
        if (count($inorder) == 1) {
            array_shift($preorder);
            return new TreeNode($inorder[0]);
        }
        //root 节点操作
        $i = $this->getRootNode($preorder, $inorder);
        if (!isset($i)) {
            return null;
        }
        array_shift($preorder);
        $root = new TreeNode($inorder[$i]);
        //递归子节点
        $left = $this->buildTree($preorder, array_slice($inorder, 0, $i));
        $right = $this->buildTree($preorder, array_slice($inorder, $i + 1, count($inorder) - 1));
        $root->left = $left;
        $root->right = $right;
        return $root;
    }

    function getRootNode($preorder, $inorder) {
        $root = current($preorder);
        foreach ($inorder as $key => $value) {
            if ($value == $root) {
                return $key;
            }
        }
        return null;
    }
}

$obj = new Solution();
$preorder = [3,9,20,15,7];
$inorder = [9,3,15,20,7];
$root = $obj->buildTree($preorder, $inorder);
var_dump($root);
