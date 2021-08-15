<?php

class MyQueue {
    private $arr = array();
    /**
     * Initialize your data structure here.
     */
    function __construct() {

    }

    /**
     * Push element x to the back of queue.
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        $this->arr[] = $x;
        return null;
    }

    /**
     * Removes the element from in front of queue and returns that element.
     * @return Integer
     */
    function pop() {
        $val = current($this->arr);
        foreach ($this->arr as $i => $value) {
            if ($val == $value) {
                unset($this->arr[$i]);
                break;
            }
        }
        return $val;
    }

    /**
     * Get the front element.
     * @return Integer
     */
    function peek() {
        return current($this->arr);
    }

    /**
     * Returns whether the queue is empty.
     * @return Boolean
     */
    function empty() {
        return empty($this->arr);
    }
}
