<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>电子商城</title>
    <link href="/shop/Public/bs/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/shop">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--原生-->
                <!--<?php foreach($navbar as $nav):?>-->
                 <!--<li><a href="#"><?php echo $nav["nav_title"]?></a></li>-->
                <!--<?php endforeach?>-->
                
                <?php $navbar=W("Nav/def");?>
                <?php if(is_array($navbar)): foreach($navbar as $key=>$nav): ?><li><a href="<?php echo ($nav["nav_href"]); ?>"><?php echo ($nav["nav_title"]); ?></a></li><?php endforeach; endif; ?>

            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if($global_user): ?>
<li><a href="#"><?php echo ($global_user->user_name); ?></a></li>
<li><a href="?do=logout">注销</a></li>
<?php else: ?>
<li><a href="/shop/home/login">登录</a></li>
<li><a href="/shop/home/reg">注册</a></li>
<?php endif; ?>

<li><a href="/shop/home/Temp/test">测试</a></li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

头部
<br>



    <style>
        .media{margin-bottom: 30px;border-bottom: solid 1px #ddd;}
    </style>

    <script>//循环拼接一个脚本数组
    var detail_data=[
            <?php if(is_array($info_data_detail)): foreach($info_data_detail as $key=>$info): ?>[<?php echo ($info["info_id"]); ?>,'<?php echo ($info["im_key"]); ?>','<?php echo ($info["im_value"]); ?>'],<?php endforeach; endif; ?>
    [-1,'','']
    ];
    //        alert(detail_data);

    function getMeta(info_id,im_key,default_value)
    {
        for(var i=0;i<detail_data.length;i++)
        {
            if (detail_data[i][0]==info_id && detail_data[i][1]==im_key)
            {
                return detail_data[i][2];
            }
        }
        if (default_value)
            return default_value;
        else
            return 0;
    }
    </script>

    <div class="container">
        <div class="col-md-8">
            <?php if(is_array($info_data_main)): foreach($info_data_main as $key=>$info): ?><!--循环出主表数据-->
                <div class="row">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="/shop/Public/images/php.jpg" alt="..." style="width: 80px;height: 80px">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo ($info["info_title"]); ?></h4>
                            <div class="well"><?php echo ($info["info_content"]); ?></div>
                            <p>
                                <span>点击量：<script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'views'));</script></span>
                                <span>评论数：<script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'review'));</script></span>
                                <!--<span><?php echo ($info["info_id"]); ?></span>-->
                            </p>
                        </div>
                    </div>
                </div><?php endforeach; endif; ?>

            <div class="pagination">
                <?php echo ($pagebar); ?>
            </div>
        </div>

        <div class="col-md-4">
            <?php echo W('Info/load',array(1));?>
        </div>
    </div>





尾部
</body>
</html>