<?php
namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;
use Think\Model;
use Think\Page;
use Think\Think;

class TempController extends Controller {   //localhost:?c=user&a=login
    public function test()
    {
        $m=M("info");
        $count=$m->where("info_type=1")->count();
//        echo $count; //取出符合条件的信息条数
        $page=new \Think\Page($count,5); //page方法，一页5条
        $info_data=$m->where("info_type=1")->order("info_id desc")->limit($page->firstRow.','.$page->listRows)->select();
//        var_dump($info_data);//根据分页取出主表数据
        echo $page->show();

        //取出当前分页的info_id ，取出在这范围内info_id的子表数据
        $info_id_set=""; //拼凑一个类似 4，5，6，7 的字符串
        foreach ($info_data as $info) //取出当前page的info_id
        {
            if ($info_id_set!="")
            {
                $info_id_set.=",";
            }
            $info_id_set.=$info["info_id"];
        }
//        echo $info_id_set;
        //取出子表info_id为info_id_set的数据
        $info_data_meta=M("info_meta")->where("info_id in(".$info_id_set.")")->select();
        var_dump($info_data_meta);


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