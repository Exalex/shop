<?php
namespace Home\API;
use Home\Lib\PasswordHash;
class UserAPI
{
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

    function reg()
    {
        $getUserName= I('post.txtUsername','','/^\w{6,20}$/');// 采用正则表达式进行变量过滤
        $getUserPWD= I('post.txtPwd','','/^\w{6,20}$/');

        if ($getUserName==""||$getUserPWD=="")
        {
            $this->actionInfo='$this->assign("errorInfo","注册失败：密码格式不正确");';
            return; //下面代码不执行
        }

        $ph = new PasswordHash(8,false);
        $user = D("User");

        //用户注册的数据库操作
        try
        {
            $user->user_name = $getUserName;
            $user->user_pwd =  $ph->HashPassword($getUserPWD);
            $user_id = $user->add();
            if ($user_id) //主表插入成功，则插入用户属性表（子表）
            {
                $muser = M("user_meta");
                $muser->user_id = $user_id;
                $muser->umeta_key = "reg_date";
                $muser->umeta_value = date();
                $ret = $muser->add();
                if ($ret) //跳转登录页面
                {
                    $this->actionInfo = "header('location:/shop/Home/login');";
                    return;
                }
                else
                {
                    $this->actionInfo = '$this->assign("errorInfo","属性表插入失败");';
                    return;
                }
            }
            else
            {
                $this->actionInfo = '$this->assign("errorInfo","用户主表插入失败");';
            }
        }
        catch (\Think\Exception $ex)
        {
            $this->actionInfo = '$this->assign("errorInfo","用户名被占用");';
            return;
        }
    }

    function login()
    {
        if ($_POST){ //判断是否在提交注册表

            $getUserName = I('post.txtUsername','','/^\w{6,20}$/');// 采用正则表达式进行变量过滤
            $getUserPWD = I('post.txtPwd','','/^\w{6,20}$/');
            $getUserVerify = I('post.txtCode');

            if ($getUserName==""||$getUserPWD=="")
            {
                $this->actionInfo='$this->assign("errorInfo","用户名、密码格式不正确");';
                return;
            }

            // 检测输入的验证码是否正确
            $verify = new \Think\Verify();
            if(!$verify->check($getUserVerify))
            {
                $this->actionInfo='$this->assign("errorInfo","验证码不正确");';
                return;
            }

            //取出user表里name=post值的记录,再取密码对比
            $result=M('user')->where("user_name='".$getUserName."'")->limit(1)->select();
            if ($result && count($result==1))
            {
                $user_pwd=$result[0]["user_pwd"];//取出该记录的密码
                $ph = new PasswordHash(8,false);//PHPPASS类

                if ($ph->CheckPassword($getUserPWD,$user_pwd)){ //登录成功
                    //记录cookie,实例化std类设置属性，把对象序列化保存进cookie；
                    $user_log = new \stdClass();
                    $user_log->user_id = $result[0]["user_id"];
                    $user_log->user_name = $getUserName;
                    setcookie("userInfo",serialize($user_log),time()+200,"/");

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
