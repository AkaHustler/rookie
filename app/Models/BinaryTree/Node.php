<?php

namespace App\Models\BinaryTree;

class Node {
    public $value;

    public $left;

    public $right;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
