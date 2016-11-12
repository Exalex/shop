<?php
namespace Home\API;
class UserAPI
{
//    function __construct() //构造函数 方法名=类名
//    {
//        echo "自动加载成功";
//    }
    public $actionInfo=''; //把需要赋值的信息保存为字符串；

    //获取当前登录用户的信息对象（cookie）
    function getUser()
    {
        //判断cookie是否有值
        $get_cookie = $_COOKIE['userInfo'];
        if (!$get_cookie) return false;
        $get_cookie_log = unserialize($get_cookie);//反序列化
        if (!$get_cookie_log) return false;
        if ($get_cookie_log && intval($get_cookie_log)>0)
        {
            return $get_cookie_log;
        }

        return false;
    }

    function isLogin() //判断用户是否登录
    {
        $u = $this->getUser();
        if ($u && intval($u)>0)
        {
            return true;
        }

    }

    function login()
    {
        if ($_POST){ //判断是否在提交注册表

            $getUserName= I('post.txtUsername','','/^\w{6,20}$/');// 采用正则表达式进行变量过滤
            $getUserPWD= I('post.txtPwd','','/^\w{6,20}$/');

            if ($getUserName==""||$getUserPWD=="")
            {
                $this->actionInfo='$this->assign("errorInfo","密码格式不正确");';
                return;
            }

            //取出user表里name=post值的记录
            $result=M('user')->where("user_name='".$getUserName."'")->limit(1)->select();
            if ($result && count($result==1))
            {
                $user_pwd=$result[0]["user_pwd"];//取出该记录的密码

                if ($user_pwd==$getUserPWD){ //登录成功
                    //记录cookie,实例化std类设置属性，把对象序列化保存进cookie；
                    $user_log = new \stdClass();
                    $user_log->user_id = $result[0]["user_id"];
                    $user_log->user_name = $getUserName;
                    setcookie("userInfo",serialize($user_log),time()+20,"/");

                    //登录成功后跳转回之前的页面
                    if (I("get.from")!="")
                        $this->actionInfo="header('location:".I("get.from")."');";
                    else
                        $this->actionInfo="header('location:/shop/Home/index');";//无参数则跳回首页

                    return;

                }
                else
                {
                    $this->actionInfo = '$this->assign("errorInfo","登陆名或密码错误");';
                    return;
                }
            }
            else
            {
                $this->actionInfo = '$this->assign("errorInfo","用户名不存在");';
                return;
            }
        }
        else //无post的情况（页面无submit操作的时候）
        {
            setcookie("name","exalex",time()+60*60,"/");
            echo $_COOKIE["name"];
        }
    }
}
