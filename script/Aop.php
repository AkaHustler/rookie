<?php
/**
* @FileName: script/Aop.php
* @Author: houzhongbo
* @Mail:houzhongbo@zuoyebang.com
* @Created Time: 2021-07-23 10:20:05
*/

class User
{
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}

class Log
{
    private $obj;

    function __call($method, $arguments)
    {
        echo "{$method} (" . implode(',', $arguments) . ")\n";
        return call_user_func_array(array(&$this->obj, $method), $arguments);
    }

    public function __construct($obj)
    {
        $this->obj = $obj;
    }
}

$cl = new Log(new User());
$cl->setName('Winner');
$name = $cl->getName();
echo $name;

