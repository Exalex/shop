<?php
namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;
use Think\Model;

class TempController extends Controller {   //localhost:?c=user&a=login
    public function test()
    {
        $this->theme("5000")->display();
    }
}