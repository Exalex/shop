<?php
namespace Home\API;
class InfoAPI
{
    public $_info_type=1;//默认1，1代表新闻，2代表商品
    public $_page_size=5;//每页显示多少条

    public $_page_bar="";//分页组件的展示内容
    public $_main_data=array();//主表数据
    public $_detail_data=array();//子表数据

    function __construct($infoType,$pageSize=5)
    {
        $this->_info_type=$infoType;
        $this->_page_size=$pageSize;
    }

    function loadMainData($where_main="",$where_detail="")//加载主表数据
    {
        if ($where_main!="")//传了参数多拼接where条件，暂时没起作用
        {
            $where_main=$where_main."and info_type=".$this->_info_type;
        }
        else//没传参数情况
        {
            $where_main="info_type=".$this->_info_type;
        }

        $info_count=M("info")->where($where_main)->count();
        $page=new \Think\Page($info_count,$this->_page_size);
        $this->_page_bar=$page->show();//分页组件显示
        //主表数据取值
        $this->_main_data=M("info")->order("info_id asc")->where($where_main)->limit($page->firstRow.','.$page->listRows)->select();

        //取出当前分页的info_id ，取出在这范围内info_id的子表数据
        $info_id_set=""; //拼凑一个类似 4，5，6，7 的字符串
        foreach ($this->_main_data as $info) //取出当前page的info_id
        {
            if ($info_id_set!="")
            {
                $info_id_set.=",";
            }
            $info_id_set.=$info["info_id"];
        }
        if ($info_id_set!="")
        {
            //当有$where_detail参数时，拼凑字符串在取子表时用
            if ($where_detail!="") $where_detail.="and".$where_detail;
            //取出子表数据
            $this->_detail_data=M("info_meta")->where("info_id in(".$info_id_set.")".$where_detail)->select();
        }

    }

}