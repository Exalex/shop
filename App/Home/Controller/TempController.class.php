<?php
namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;
use Think\Model;

class TempController extends Controller {   //localhost:?c=user&a=login
    public function test()
    {
        $verify = new \Think\Verify;
        ob_clean(); //ob_clean这个函数的作用就是用来丢弃输出缓冲区中的内容，如果你的网站有许多生成的图片类文件，那么想要访问正确，就要经常清除缓冲区。
        $verify->entry();
//        $this->theme("5000")->display();
    }

    public function verify()
    {
        $config =    array(
            'fontSize'    =>    30,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    yes, // 关闭验证码杂点
        );
        ob_clean(); //ob_clean这个函数的作用就是用来丢弃输出缓冲区中的内容，如果你的网站有许多生成的图片类文件，那么想要访问正确，就要经常清除缓冲区。
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
}