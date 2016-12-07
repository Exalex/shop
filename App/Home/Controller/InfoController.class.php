<?php
namespace Home\Controller;
use Home\API\InfoAPI;
use Think\Controller;
use Think\Model;

class InfoController extends Controller {
    public function index(){

        $get_info_type=I("get.type",1,"/^\d+$/");//如果没值就是1
        
        $i=new InfoAPI($get_info_type);
        $i->loadMainData();
        $this->assign("info_data_main",$i->_main_data);//赋值主表数据
        $this->assign("info_data_detail",$i->_detail_data);//赋值子表数据
        $this->assign("pagebar",$i->_page_bar);//分页

        //1代表新闻，2代表商品
        if ($get_info_type==1)
        {
            $this->theme("5000")->display();
        }
        else if ($get_info_type==2)
        {
            $this->theme("5000")->display("product");
        }
        else if ($get_info_type==3)
        {
            $this->theme("5000")->display("invest");
        }

    }
}
?>
