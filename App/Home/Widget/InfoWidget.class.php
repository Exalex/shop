<?php
namespace Home\Widget;
use Think\Controller;
use Think\Model;

class InfoWidget extends Controller {
    public function load($id){

        $get_wig_conf=M('info_widget')->where("wig_id=".$id)->limit(1)->select();

        if($get_wig_conf && count($get_wig_conf)==1)
        {
            $get_wig_conf=$get_wig_conf[0];

            $m=new Model();
            $get_wig_data=array();
            //动态执行数据库中的sql语句,获得数据
            eval('$get_wig_data=$m->'.$get_wig_conf["wig_model"].';');
            
            $this->assign("w_title",$get_wig_conf["wig_title"]);
            $this->assign("w_data",$get_wig_data);//赋值
            $this->theme("5000")->display($get_wig_conf["wig_tpl"]);
        }
    }
}