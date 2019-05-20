<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"D:\WWW\fastadmin\public/../application/admin\view\machine\index.html";i:1557904156;s:59:"D:\WWW\fastadmin\application\admin\view\layout\default.html";i:1557482263;s:56:"D:\WWW\fastadmin\application\admin\view\common\meta.html";i:1557482263;s:58:"D:\WWW\fastadmin\application\admin\view\common\script.html";i:1557482263;}*/ ?>
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
                                <div class="panel panel-default panel-intro">
    <?php echo build_heading(); ?>

    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <!--  这个对应页面刷新的按钮  -->
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <!--  这个对应页面添加的按钮  -->
                        <a href="javascript:;" class="btn btn-success btn-add <?php echo $auth->check('machine/add')?'':'hide'; ?>" title="<?php echo __('Add'); ?>" ><i class="fa fa-plus"></i> <?php echo __('Add'); ?></a>
                        <!--  这个对应页面编辑的按钮  -->
                        <a href="javascript:;" class="btn btn-success btn-edit btn-disabled disabled <?php echo $auth->check('machine/edit')?'':'hide'; ?>" title="<?php echo __('Edit'); ?>" ><i class="fa fa-pencil"></i> <?php echo __('Edit'); ?></a>
                        <!--  这个对应页面删除的按钮  -->
                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled <?php echo $auth->check('machine/del')?'':'hide'; ?>" title="<?php echo __('Delete'); ?>" ><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>
                        <!--  这个对应页面导入的按钮  -->
                        <a href="javascript:;" class="btn btn-danger btn-import <?php echo $auth->check('machine/import')?'':'hide'; ?>" title="<?php echo __('Import'); ?>" id="btn-import-file" data-url="ajax/upload" data-mimetype="csv,xls,xlsx" data-multiple="false"><i class="fa fa-upload"></i> <?php echo __('Import'); ?></a>
                        <!--  这个对应页面更多的按钮  -->
                        <div class="dropdown btn-group <?php echo $auth->check('machine/multi')?'':'hide'; ?>">
                            <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('More'); ?></a>
                            <!--  这两个个对应页面更多下面的设为正常或隐藏的子按钮  -->
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a></li>
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to hidden'); ?></a></li>
                            </ul>
                        </div>

                        
                    </div>
                    <!--  这个对应页面的表格,数据就是在这个展示的  -->
                    <!--  这里有一个id="table"的属性，这里是对应到它的js页面来对表格个封装数据的  -->
                    <!--  具体位置在public\accest\js\backend\machine\machine.js  -->
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="<?php echo $auth->check('machine/edit'); ?>"
                           data-operate-del="<?php echo $auth->check('machine/del'); ?>" 
                           width="100%">
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>