<?php
/**
* @FileName: script/DesignPattern.php
* @Author: houzhongbo
* @Mail:houzhongbo@zuoyebang.com
* @Created Time: 2021-08-16 14:52:36
*/


//单例模式
//1.一个类只有一个实例
//2.必须自行创建这个实例
//3.必须自行向系统提供这个实例
class Singleton
{
    //静态成员变量，保存全局实例
    private static $instance = null;

    //私有化构造方法，保证外界无法实例化
    private function __construct()
    {
    }

    //静态工厂方法，返回此类的唯一实例
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    //防止用户克隆实例
    public function __clone()
    {
        die("Clone Is Not Allowed!");
    }

    public function test()
    {
        echo "Singleton Test";
    }
}

//策略模式
//

$instance = Singleton::getInstance();
$instance->test();
