<?php
namespace Home\Behaviors;
use Home\API\UserAPI;
use Think\Controller;

class UserBehavior extends BaseBehavior{
    //行为执行入口
    public function run(&$param){

        $user = new UserAPI();
        //判断当前控制器和action是否在配置列表里
        $get_login_config = C("need_login");
        //是否存在temp的键&&数组里是否有当前ACTION_NAME的值(判断页面是否需要登录，要登录则跳转)

        if (array_key_exists(CONTROLLER_NAME,$get_login_config) &&
        in_array(ACTION_NAME,$get_login_config[CONTROLLER_NAME]) && !$user->isLogin())
        {
//            echo '这个页面需要登录';
            //跳转到登录页面，并加上当前页的URL作为参数
            redirect("/shop/Home/login?from=".urlencode(__SELF__),1,"页面跳转中");

            exit();
        }

        //显示用户名
        if($user->isLogin())
        {
            //用户对象赋值
            $this->assign("global_user",$user->getUser());
        }




//        echo "行为扩展开始";
    }
}