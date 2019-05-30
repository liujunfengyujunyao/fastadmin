<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\WWW\fastadmin\public/../application/admin\view\pay\account\edit.html";i:1558682313;s:59:"D:\WWW\fastadmin\application\admin\view\layout\default.html";i:1557482263;s:56:"D:\WWW\fastadmin\application\admin\view\common\meta.html";i:1557482263;s:58:"D:\WWW\fastadmin\application\admin\view\common\script.html";i:1559031184;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-order_id" data-rule="required" data-source="order/index" class="form-control selectpage" name="row[order_id]" type="text" value="<?php echo htmlentities($row['order_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Unique_order_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-unique_order_id" data-rule="required" data-source="unique/order/index" class="form-control selectpage" name="row[unique_order_id]" type="text" value="<?php echo htmlentities($row['unique_order_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('User_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-user_id" data-rule="required" data-source="user/user/index" data-field="nickname" class="form-control selectpage" name="row[user_id]" type="text" value="<?php echo htmlentities($row['user_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Leader_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-leader_id" data-rule="required" data-source="leader/index" class="form-control selectpage" name="row[leader_id]" type="text" value="<?php echo htmlentities($row['leader_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-type" data-rule="required" class="form-control selectpicker" name="row[type]">
                <?php if(is_array($typeList) || $typeList instanceof \think\Collection || $typeList instanceof \think\Paginator): if( count($typeList)==0 ) : echo "" ;else: foreach($typeList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['type'])?$row['type']:explode(',',$row['type']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-order_amount" data-rule="required" class="form-control" step="0.01" name="row[order_amount]" type="number" value="<?php echo htmlentities($row['order_amount']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Goods_detail'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-goods_detail" class="form-control" name="row[goods_detail]" type="text" value="<?php echo htmlentities($row['goods_detail']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Goods_title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-goods_title" data-rule="required" class="form-control" name="row[goods_title]" type="text" value="<?php echo htmlentities($row['goods_title']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('User_in'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-user_in" class="form-control" step="0.01" name="row[user_in]" type="number" value="<?php echo htmlentities($row['user_in']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Agent_in'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-agent_in" class="form-control" step="0.01" name="row[agent_in]" type="number" value="<?php echo htmlentities($row['agent_in']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Platform_in'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-platform_in" class="form-control" step="0.01" name="row[platform_in]" type="number" value="<?php echo htmlentities($row['platform_in']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Yeepay_in'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-yeepay_in" class="form-control" step="0.01" name="row[yeepay_in]" type="number" value="<?php echo htmlentities($row['yeepay_in']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-order_status" data-rule="required" class="form-control" name="row[order_status]" type="number" value="<?php echo htmlentities($row['order_status']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Residual_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-residual_amount" data-rule="required" class="form-control" step="0.01" name="row[residual_amount]" type="number" value="<?php echo htmlentities($row['residual_amount']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Divide_rate'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-divide_rate" data-rule="required" class="form-control" step="0.001" name="row[divide_rate]" type="number" value="<?php echo htmlentities($row['divide_rate']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Add_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-add_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[add_time]" type="text" value="<?php echo $row['add_time']?datetime($row['add_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Update_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-update_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[update_time]" type="text" value="<?php echo $row['update_time']?datetime($row['update_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sn'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sn" class="form-control" name="row[sn]" type="text" value="<?php echo htmlentities($row['sn']); ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>

    </body>
</html>