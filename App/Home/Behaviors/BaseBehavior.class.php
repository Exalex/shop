<?php
namespace Home\Behaviors;
use Think\Controller;

class BaseBehavior extends Controller
{
    function __construct()
    {
        parent::__construct();//手动执行父类的构造方法，避免被覆盖
        $get_do = I('get.do');//取得get参数
        if ($get_do!="")
        {
            if (method_exists($this,$get_do)) //此类中有叫$get_do的方法
            {
                   $this->$get_do();//执行本类中叫$get_do的方法
            }
        }
    }

    function logout()
    {
        setcookie("userInfo",null,time()-600,"/");
        redirect("/shop/Home/Index",1,"注销成功");
        exit();
    }
}