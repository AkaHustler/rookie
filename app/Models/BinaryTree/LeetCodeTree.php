<?php

namespace App\Models\BinaryTree;

/**
 * LeetCode
 * Class LeetCodeTree
 * @package App\Models\BinaryTree
 */
class LeetCodeTree {

    /**
     * 剑指 Offer 55 - I. 二叉树的深度
     * https://leetcode-cn.com/problems/er-cha-shu-de-shen-du-lcof/
     * @param Node $node
     * @return int|mixed
     */
    public function maxDepth($node) {
        if ($node == null) {
            return 0;
        }
        $leftDepth = $this->maxDepth($node->left);
        $rightDepth = $this->maxDepth($node->right);
        return 1 + max($leftDepth, $rightDepth);
    }

    public function minDepth($node) {}
}
