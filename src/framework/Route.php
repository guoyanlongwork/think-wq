<?php
namespace thinkWQ\framework;

/**
 * Class Route 路由类
 * 解析路由确定对应控制器和方法
 * @package Framework
 */
class Route{
    public $application;
    public $controller;
    public $action;
    public function __construct(){
        //默认情况
        $this->application = 'web';
        $this->controller = 'index';
        $this->action = 'user';

        /*
         * 对目录深度有要求，尚待改进
         */
        if (isset($_SERVER['REQUEST_URI'])&&$_SERVER['REQUEST_URI']!='/'){
            $path = $_SERVER['REQUEST_URI'];
            $pathArr = explode('/',trim($path,'/'));//去除首部的‘/’，并按数组分割

            //一下尚需改进
            if(isset($pathArr[1])){         //一级：应用名
                $this->application = $pathArr[1];
            }
            if(isset($pathArr[2])){         //二级：控制器名
                $this->controller = $pathArr[2];
            }
            if(isset($pathArr[3])){         //三级：方法名
                $this->action = $pathArr[3];
            }
        }
    }
}