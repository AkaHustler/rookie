<?php
/**
 * @FileName: script/DFS.php
 * @Author: houzhongbo
 * @Mail:houzhongbo@zuoyebang.com
 * @Created Time: 2021-08-11 17:04:03
 */

class DFSSolution
{
    /*
     * 我们所熟悉的 DFS（深度优先搜索）问题通常是在树或者图结构上进行的
     * 二叉树的 DFS 有两个要素：「访问相邻结点」和「判断 base case」。
     * demo:
     * void traverse(TreeNode root) {
            // 判断 base case
            if (root == null) {
                return;
            }
            // 访问两个相邻结点：左子结点、右子结点
            traverse(root.left);
            traverse(root.right);
       }
     * 而网格的 DFS 的相邻结点则是上、下、左、右四个，
     * 而base case是网格中不需要继续遍历、grid[r][c] 会出现数组下标越界异常的格子，也就是那些超出网格范围的格子
     * demo:
     * void dfs(int[][] grid, int r, int c) {
            // 判断 base case
            // 如果坐标 (r, c) 超出了网格范围，直接返回
            if (!inArea(grid, r, c)) {
                return;
            }
            // 访问上、下、左、右四个相邻结点
            dfs(grid, r - 1, c);
            dfs(grid, r + 1, c);
            dfs(grid, r, c - 1);
            dfs(grid, r, c + 1);
       }
       // 判断坐标 (r, c) 是否在网格中
        boolean inArea(int[][] grid, int r, int c) {
            return 0 <= r && r < grid.length
                    && 0 <= c && c < grid[0].length;
        }
     */
    /*
     * 另外在图的DFS遍历时要将遍历过的格子加上标记，避免重复遍历
     */

    public function numIslands($grid)
    {
        if (empty($grid)) {
            return 0;
        }
        $res = 0;
        foreach ($grid as $i => &$iValue) {
            foreach ($iValue as $j => &$jValue) {
                if ($jValue == '1') {
                    $count = $this->dfsMap($grid, $i, $j);
                    $res = $count > $res ? $count : $res;
                }
            }
        }
        unset($iValue, $jValue);
        return $res;
    }

    //遍历(i,j)相邻岛屿，并标记为已遍历
    private function dfsMap(&$grid, $i, $j)
    {
        //base case
        if (!$this->isInArea($grid, $i, $j)) {
            //不在范围内
            return 0;
        }
        //判断格子是否是岛屿
        if ($grid[$i][$j] != '1') {
            return 0;
        }
        $grid[$i][$j] = '2';
        //遍历相邻结点，上下左右
        return
            $this->dfsMap($grid, $i - 1, $j) +
            $this->dfsMap($grid, $i + 1, $j) +
            $this->dfsMap($grid, $i, $j - 1) +
            $this->dfsMap($grid, $i, $j + 1) + 1;
    }

    private function isInArea($grid, $i, $j)
    {
        return $i >= 0 && $i < count($grid) && $j >= 0 && $j < count($grid[0]);
    }
}


$obj = new DFSSolution();
$grid = [
    [0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
    [0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0],
    [0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0]
];


var_dump($obj->numIslands($grid));
