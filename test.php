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

    }
}

//$obj = new Solution();
//$inorder = [1,2];
//$postorder = [2,1];
////$inorder = [9,3,15,20,7];
////$postorder = [9,15,7,20,3];
//$root = $obj->buildTree($inorder, $postorder);
//print_r($root);

function mergeArr($nums1, $nums2) {
    if (count($nums1) === 0 || count($nums2) === 0) {
        return [];
    }
}

$nums1 = [1,2,3];
$nums2 = [2,5,6];
