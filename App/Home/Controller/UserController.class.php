<?php
namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;
use Think\Model;

class UserController extends Controller {   //localhost:?c=user&a=login
    
    //用户控制器-注册
    public function reg()
    {
        $user = D("user"); //D方法：初始化user模型类
        $data = array();
        $data["user_name"] = "yangguohao";
        $data["user_pwd"] = "006134";
        $data["user_regdate"] = date('Y-m-d h-i-s');
        $ret = $user->add($data); //模型类的add方法
        echo $ret;
        $this->theme("5000")->display();
    }
    
    public function login(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
//        $users=M("Users");
//        var_export($users->select());
//        var_dump($_POST);
        $a = new UserAPI();//创建类
        $a->login();//执行类里的登录方法
        eval($a->actionInfo);//动态执行字符串，执行登录判断结果
        $this->theme("5000")->display();
    }
    
}
?>
