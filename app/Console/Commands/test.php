<?php

$stack = [];
$minStack = [];

echo date("Y-m-d H:i:s");die;

function mypush($node)
{
    global $stack, $minStack;
    array_push($stack, $node);
    array_push($minStack, empty($minStack) ? $node : min($minStack[count($minStack)-1], $node));
    print_r($stack);
    print_r($minStack);
    // write code here
}
function mypop()
{
    global $stack, $minStack;
    array_pop($stack);
    array_pop($minStack);
    // write code here
}
function mytop()
{
    global $stack;
    return $stack[count($stack)-1] ?? '';
    // write code here
}
function mymin()
{
    global $minStack;
    return $minStack[count($minStack)-1] ?? '';
    // write code here
}
