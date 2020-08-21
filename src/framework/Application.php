<?php

namespace thinkWQ\framework;

/**
 * Created by PhpStorm.
 * User: seven
 * Date: 2018/12/20
 * Time: 19:58
 */
class Application
{

    /**
     *使用框架单例模式，只保存一个Application实例
     */

    //创建静态私有变量保存该类对象
    private static $instance = null;

    //私有克隆函数
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    //私有构造函数，防止直接创建对象
    protected function __construct()
    {

    }

    //获得应用单例
    public static function getInstance()
    {
        if (is_null(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * 框架入口
     */
    public function run()
    {
        $this->boostrap();
    }

    protected $router;

    protected $middleware = [];

    public function initRouter(){
       $this->router = new Route();
    }

    /**
     * 框架初始化
     */
    public function boostrap()
    {
        //初始化路由
        $this->initRouter();
        // 加载路由路径
        $this->start();
    }

    public function start(){
        $applicationName = $this->router->application;
        $controllerName = $this->router->controller;
        $action = $this->router->action;
        $controllerPath='./'.$applicationName.'/Controller/'.$controllerName.'.php';
        if(is_file($controllerPath)){
//            die($controllerPath);
            include $controllerPath;
            $fullClassName = '\\'.$applicationName.'\\Controller\\'.$controllerName;
            $Controller = new $fullClassName;
            //运行
            $Controller->$action();

        }else{
            throw new \Exception('找不到控制器'.$controllerName);
        }
    }


}

