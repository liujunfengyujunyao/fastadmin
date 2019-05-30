<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\WWW\fastadmin\public/../application/admin\view\check\cost\detail.html";i:1558939526;s:59:"D:\WWW\fastadmin\application\admin\view\layout\default.html";i:1557482263;s:56:"D:\WWW\fastadmin\application\admin\view\common\meta.html";i:1557482263;s:58:"D:\WWW\fastadmin\application\admin\view\common\script.html";i:1559031184;}*/ ?>
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
                                <form id="detail-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
    <?php if($type == 1): ?>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('legalName'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-legalName" data-rule="required" class="form-control" name="row[legalName]" type="text" value="<?php echo htmlentities($row['legalName']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('legalIdCard'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-legalIdCard" class="form-control" name="row[legalIdCard]" type="text" value="<?php echo htmlentities($row['legalIdCard']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merLegalPhone'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merLegalPhone" class="form-control" name="row[merLegalPhone]" type="text" value="<?php echo htmlentities($row['merLegalPhone']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merLegalEmail'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merLegalEmail" class="form-control" name="row[merLegalEmail]" type="text" value="<?php echo htmlentities($row['merLegalEmail']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merProvince'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merProvince" class="form-control" name="row[merProvince]" type="text" value="<?php echo htmlentities($row['merProvince']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merCity'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merCity" class="form-control" name="row[merCity]" type="text" value="<?php echo htmlentities($row['merCity']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merDistrict'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merDistrict" class="form-control" name="row[merDistrict]" type="text" value="<?php echo htmlentities($row['merDistrict']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merAddress'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merAddress" class="form-control" name="row[merAddress]" type="text" value="<?php echo htmlentities($row['merAddress']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('IDCARD_FRONT'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <!--<input id="c-IDCARD_FRONT" class="form-control" name="row[IDCARD_FRONT]" type="text" value="<?php echo htmlentities($row['IDCARD_FRONT']); ?>">-->
            <img src="http://192.168.1.133:8080<?php echo $row['IDCARD_FRONT']; ?>" alt="<?php echo __('IDCARD_FRONT'); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('IDCARD_BACK'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <!--<input id="c-IDCARD_BACK" class="form-control" name="row[IDCARD_BACK]" type="text" value="<?php echo htmlentities($row['IDCARD_BACK']); ?>">-->
            <img src="http://192.168.1.133:8080<?php echo $row['IDCARD_BACK']; ?>" alt="<?php echo __('IDCARD_BACK'); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('HAND_IDCARD'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <!--<input id="c-HAND_IDCARD" class="form-control" name="row[HAND_IDCARD]" type="text" value="<?php echo htmlentities($row['HAND_IDCARD']); ?>">-->
            <img src="http://192.168.1.133:8080<?php echo $row['HAND_IDCARD']; ?>" alt="<?php echo __('HAND_IDCARD'); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('headBankCode'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-headBankCode" class="form-control" name="row[headBankCode]" type="text" value="<?php echo htmlentities($row['headBankCode']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('bankProvince'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bankProvince" class="form-control" name="row[bankProvince]" type="text" value="<?php echo htmlentities($row['bankProvince']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('bankCity'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bankCity" class="form-control" name="row[bankCity]" type="text" value="<?php echo htmlentities($row['bankCity']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('bankCode'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bankCode" class="form-control" name="row[bankCode]" type="text" value="<?php echo htmlentities($row['bankCode']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('cardNo'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-cardNo" class="form-control" name="row[cardNo]" type="text" value="<?php echo htmlentities($row['cardNo']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('SETTLE_BANKCARD'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <!--<input id="c-SETTLE_BANKCARD" class="form-control" name="row[SETTLE_BANKCARD]" type="text" value="<?php echo htmlentities($row['SETTLE_BANKCARD']); ?>">-->
            <img src="http://192.168.1.133:8080<?php echo $row['SETTLE_BANKCARD']; ?>" alt="<?php echo __('SETTLE_BANKCARD'); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('HAND_BANKCARD'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <!--<input id="c-HAND_BANKCARD" class="form-control" name="row[HAND_BANKCARD]" type="text" value="<?php echo htmlentities($row['HAND_BANKCARD']); ?>">-->
            <img src="http://192.168.1.133:8080<?php echo $row['HAND_BANKCARD']; ?>" alt="<?php echo __('HAND_BANKCARD'); ?>" />
        </div>

    </div>
    <?php endif; if($type == 2): ?>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merFullName'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merFullName" data-rule="required" class="form-control" name="row[merFullName]" type="text" value="<?php echo htmlentities($row['merFullName']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merShortName'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merShortName" data-rule="required" class="form-control" name="row[merShortName]" type="text" value="<?php echo htmlentities($row['merShortName']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merCertType'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merCertType" data-rule="required" class="form-control" name="row[merCertType]" type="text" value="<?php echo htmlentities($row['merCertType']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merCertNo'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merCertNo" data-rule="required" class="form-control" name="row[merCertNo]" type="text" value="<?php echo htmlentities($row['merCertNo']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merContactName'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merContactName" data-rule="required" class="form-control" name="row[merContactName]" type="text" value="<?php echo htmlentities($row['merContactName']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merLevel1No'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merLevel1No" data-rule="required" class="form-control" name="row[merLevel1No]" type="text" value="<?php echo htmlentities($row['merLevel1No']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('merLevel2No'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-merLevel2No" data-rule="required" class="form-control" name="row[merLevel2No]" type="text" value="<?php echo htmlentities($row['merLevel2No']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('accountLicense'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-accountLicense" data-rule="required" class="form-control" name="row[accountLicense]" type="text" value="<?php echo htmlentities($row['accountLicense']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('cardNo'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-cardNo" data-rule="required" class="form-control" name="row[cardNo]" type="text" value="<?php echo htmlentities($row['cardNo']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('CORP_CODE'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CORP_CODE" data-rule="required" class="form-control" name="row[CORP_CODE]" type="text" value="<?php echo htmlentities($row['CORP_CODE']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('UNI_CREDIT_CODE'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-UNI_CREDIT_CODE" data-rule="required" class="form-control" name="row[UNI_CREDIT_CODE]" type="text" value="<?php echo htmlentities($row['UNI_CREDIT_CODE']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('OP_BANK_CODE'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-OP_BANK_CODE" data-rule="required" class="form-control" name="row[OP_BANK_CODE]" type="text" value="<?php echo htmlentities($row['OP_BANK_CODE']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('BUSINESS_PLACE'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-BUSINESS_PLACE" data-rule="required" class="form-control" name="row[BUSINESS_PLACE]" type="text" value="<?php echo htmlentities($row['BUSINESS_PLACE']); ?>"  disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('CASHIER_SCENE'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-CASHIER_SCENE" data-rule="required" class="form-control" name="row[CASHIER_SCENE]" type="text" value="<?php echo htmlentities($row['CASHIER_SCENE']); ?>"  disabled="disabled">
        </div>
    </div>

    <?php endif; ?>



    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2">设置费率:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="cost" class="form-control" name="row[cost]" type="text" value="0.06">-->

        <!--</div>-->

    <!--</div>-->


    <!--<div class="form-group layer-footer">-->
        <!--<label class="control-label col-xs-12 col-sm-2"></label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<button type="button" class="btn btn-success btn-ajax" id="test1">同意</button>-->
            <!--<button type="button" class="btn btn-default btn-ajax" id="test2">修正</button>-->
            <!--<button type="button" class="btn btn-ajax" id="test3" style="color:red">驳回</button>-->

        <!--</div>-->
    <!--</div>-->
</form>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<!--<script>-->
<!--$(".btn btn-success btn-ajax").on("click",function(){-->
<!--console.log("点击事件执行了");-->
<!--});-->
<!--</script>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>

    </body>
</html>