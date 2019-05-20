<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\WWW\fastadmin\addons\cms\view\hook\user_sidenav_after.html";i:1558078066;}*/ ?>
<ul class="list-group">
    <li class="list-group-heading"><?php echo __('内容管理'); ?></li>
    <!--如果需要直接跳转对应的模型(比如我的新闻,我的产品,发布新闻,发布产品)，可以在链接后加上 ?model_id=模型ID -->
    <li class="list-group-item <?php echo $actionname=='my'?'active':''; ?>"><a href="<?php echo url('index/cms.archives/my'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo __('我发布的文章'); ?></a></li>
    <li class="list-group-item <?php echo $actionname=='post'?'active':''; ?>"><a href="<?php echo url('index/cms.archives/post'); ?>"><i class="fa fa-pencil fa-fw"></i> <?php echo __('发布文章'); ?></a></li>
</ul>