<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\WWW\fastadmin\public/../application/admin\view\pay\account\paymethod.html";i:1559116988;s:59:"D:\WWW\fastadmin\application\admin\view\layout\default.html";i:1557482263;s:56:"D:\WWW\fastadmin\application\admin\view\common\meta.html";i:1557482263;s:58:"D:\WWW\fastadmin\application\admin\view\common\script.html";i:1559031184;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Document</title>
  <style>
    .box {
      margin: 150px auto;
      background-color: #f1f4f6;
      text-align: center;
      border: 0 none;
      box-shadow: none
    }
    button {
      width: 120px;
      height: 40px;
      outline-style: none;
      border: 0 none;
      color: #fff;
      font-size: 16px;
      border-radius: 10px;
    }
    .weixinbtn {
      background-color: #2a9e38;
      margin-right: 70px;
      margin-top:30px;
    }
    .zhifubtn {
      background-color: #1f9fdb;
    }
    .setprice {
      font-size: 18px
    }
    input {
      height: 40px;
      width: 200px;
      font-size: 16px;
      padding-left: 10px;
      outline: none;
    }
  </style>
</head>
<body>
<div class="box">
  <div class="setprice">设置收款金额: <input id="money" type="number" oninput="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')"></div>
  <div style="color:red;padding-top:5px;padding-left: 60px;display: none" class="warntext">*设置金额的值必须大于零</div>
  <button class="weixinbtn">微信支付</button>
  <button class="zhifubtn">支付宝支付</button>
  <div style="height:200px;margin-top:20px" id="erweima">
    <div style="font-size:14px;margin-bottom:15px;display: none" id="weixinPay">请使用微信扫一扫支付</div>
    <div style="font-size:14px;margin-bottom:15px;display: none" id="zhifuPay">请使用支付宝扫一扫支付</div>
    <img src="" alt="" style="width: 200px" id="qrcode" />
  </div>
</div>
</body>
</html>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>

    </body>
</html>