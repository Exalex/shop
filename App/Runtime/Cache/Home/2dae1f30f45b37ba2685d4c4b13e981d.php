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
                <?php if(is_array($navbar)): foreach($navbar as $key=>$nav): ?><li><a href="#"><?php echo ($nav["nav_title"]); ?></a></li><?php endforeach; endif; ?>

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



    <div class="container">
        <h3>用户注册</h3>
        <!--如设置为get方法提交到当前页（忽略参数），post不忽略-->
        <form method="post">
            <div class="form-group">
                <label>用户名 </label>
                <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="填入用户名">
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" class="form-control" name="txtPwd" id="txtPwd" placeholder="填入密码">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="saveUser"> 保存一周
                </label>
            </div>
            <button type="submit" class="btn btn-default">注册</button>
            <span style="color: red"><?php echo ($errorInfo); ?></span>
        </form>

    </div>



尾部
</body>
</html>