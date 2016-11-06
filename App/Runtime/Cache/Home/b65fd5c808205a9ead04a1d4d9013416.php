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
                <li><a href="/shop/home/login">登陆</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

头部
<br>

<p>这是主页
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            编号
                        </th>
                        <th>
                            产品
                        </th>
                        <th>
                            交付时间
                        </th>
                        <th>
                            状态
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Default
                        </td>
                    </tr>
                    <tr class="success">
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Approved
                        </td>
                    </tr>
                    <tr class="error">
                        <td>
                            2
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            02/04/2012
                        </td>
                        <td>
                            Declined
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>
                            3
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            03/04/2012
                        </td>
                        <td>
                            Pending
                        </td>
                    </tr>
                    <tr class="info">
                        <td>
                            4
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            04/04/2012
                        </td>
                        <td>
                            Call in to confirm
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</p>



尾部
</body>
</html>