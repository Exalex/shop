<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class UserController extends Controller {   //localhost:?c=user&a=login
    public function login(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
//        $users=M("Users");
//        var_export($users->select());

        if ($_POST){ //判断是否在提交注册表

            $getUserName= I('post.txtUsername','','/^\w{6,20}$/');// 采用正则表达式进行变量过滤
            $getUserPWD= I('post.txtPwd','','/^\w{6,20}$/');

            if ($getUserName==""||$getUserPWD=="")
            {
                $this->assign("errorInfo","密码格式不正确");
            }

            $result=M('user')->where("user_name='".$getUserName."'")->limit(1)->select();
            if ($result && count($result==1))
            {
                $user_pwd=$result[0]["user_pwd"];

                if ($user_pwd==$getUserPWD){
                    $this->assign("errorInfo","登陆成功");
                }
                else
                {
                    $this->assign("errorInfo","登陆名或密码错误");
                }
            }
            else
            {
                $this->assign("errorInfo","用户名不存在");
            }


        }

        $this->theme("5000")->display();
    }
}
?>
