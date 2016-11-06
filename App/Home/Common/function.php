<?php
function get_navbar()
{
    $navbar=M("navbar");
    $ret=$navbar->order("nav_index")->select();
    return $ret;//数组模版赋值
}