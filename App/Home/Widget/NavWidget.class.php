<?php
namespace Home\Widget;
use Think\Controller;
class NavWidget extends Controller {
    public function def(){
        //获取nav数据（Widget扩展一般用于页面组件的扩展。）
        $navbar=M("navbar");
        $ret=$navbar->order("nav_index")->select();
        return $ret;//数组模版赋值
    }
}