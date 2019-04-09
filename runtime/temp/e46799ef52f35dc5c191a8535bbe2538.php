<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"D:\phpStudy\PHPTutorial\WWW\dsmall\public/../application/admin\view\goodsalbum\pic_list.html";i:1554714361;s:76:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\header.html";i:1545196757;s:81:"D:\phpStudy\PHPTutorial\WWW\dsmall\application\admin\view\public\admin_items.html";i:1545196757;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DsMall(php)B2B2C商城系统后台</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo ADMIN_SITE_ROOT; ?>/css/admin.css">
        <link rel="stylesheet" href="<?php echo ADMIN_SITE_ROOT; ?>/iconfont/iconfont.css">
        <link rel="stylesheet" href="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.css">
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery-2.1.4.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.validate.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.cookie.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/common.js"></script>
        <script src="<?php echo ADMIN_SITE_ROOT; ?>/js/admin.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/perfect-scrollbar.min.js"></script>
        <script src="<?php echo PLUGINS_SITE_ROOT; ?>/layer/layer.js"></script>
        <script type="text/javascript">
            var BASESITEROOT = "<?php echo BASE_SITE_ROOT; ?>";
            var ADMINSITEROOT = "<?php echo ADMIN_SITE_ROOT; ?>";
            var BASESITEURL = "<?php echo BASE_SITE_URL; ?>";
            var HOMESITEURL = "<?php echo HOME_SITE_URL; ?>";
            var ADMINSITEURL = "<?php echo ADMIN_SITE_URL; ?>";
        </script>
    </head>
    <body>
        <div id="append_parent"></div>
        <div id="ajaxwaitid"></div>








<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>图片列表</h3>
                <h5></h5>
            </div>
            <?php if($admin_item): ?>
<ul class="tab-base ds-row">
    <?php if(is_array($admin_item) || $admin_item instanceof \think\Collection || $admin_item instanceof \think\Paginator): if( count($admin_item)==0 ) : echo "" ;else: foreach($admin_item as $key=>$item): ?>
    <li><a href="<?php echo $item['url']; ?>" <?php if($item['name'] == $curitem): ?>class="current"<?php endif; ?>><span><?php echo $item['text']; ?></span></a></li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php endif; ?>
        </div>
    </div>

    <form method="get" name="formSearch">
        <div class="ds-search-form">
            <dl>
                <dt><?php echo \think\Lang::get('g_album_keyword'); ?></dt>
                <dd><input class="txt" name="keyword" id="keyword" value="<?php echo \think\Request::instance()->get('keyword'); ?>" type="text"></dd>
            </dl>
            <div class="btn_group">
                <?php if($store_name!=''  && !empty($albumpic_list)): ?>
                <a class="btn btn-mini" target="_blank" href="<?php echo url('home/Store/index',['store_id'=>$albumpic_list['0']['store_id']]); ?>"><span><?php echo $store_name; ?></span></a>
                <?php endif; ?>
                <a href="javascript:document.formSearch.submit();" class="btn " title="<?php echo \think\Lang::get('ds_query'); ?>"><?php echo \think\Lang::get('ds_query'); ?></a>
                <a href="<?php echo url('Goodsalbum/pic_list',['aclass_id'=>\think\Request::instance()->param('aclass_id')]); ?>" class="btn btn-default" title="<?php echo \think\Lang::get('ds_cancel'); ?>"><?php echo \think\Lang::get('ds_cancel'); ?></a>
            </div>
        </div>
    </form>
    
        <table class="ds-default-table">
            <tbody>
            <?php if(!(empty($albumpic_list) || (($albumpic_list instanceof \think\Collection || $albumpic_list instanceof \think\Paginator ) && $albumpic_list->isEmpty()))): ?>
            <tr>
                <td colspan="20">
                    <ul class="thumblists">
                        <?php if(is_array($albumpic_list) || $albumpic_list instanceof \think\Collection || $albumpic_list instanceof \think\Paginator): if( count($albumpic_list)==0 ) : echo "" ;else: foreach($albumpic_list as $key=>$v): ?>
                        <li class="picture" id="ds_row_<?php echo $v['apic_id']; ?>">
                            <div class="size-64x64">
                                <span class="thumb">
                                    <i></i>
                                    <?php if(!(empty($v['apic_cover']) || (($v['apic_cover'] instanceof \think\Collection || $v['apic_cover'] instanceof \think\Paginator ) && $v['apic_cover']->isEmpty()))): ?>
                                    <a data-lightbox="lightbox-image" href="<?php echo goods_cthumb($v['apic_cover'],1280,$v['store_id']); ?>" rel="gal">
                                        <img title='<?php echo date("Y-m-d",$v['upload_time']); ?><br><?php echo $v['apic_spec']; ?>px<br><?php echo number_format($v['apic_size']/1024,2); ?>k' width="64" height="64" class="tip" src="<?php echo goods_cthumb($v['apic_cover'],240,$v['store_id']); ?>">
                                    </a>
                                    <?php else: ?>
                                    <img height="64" src="" max-height='70px' max-width="70px">
                                    <?php endif; ?>
                                </span>
                            </div>
                            <p>
                                <span><input class="checkitem" type="checkbox" name="delbox[]" value="<?php echo $v['apic_id']; ?>"></span><span><a href="javascript:dsLayerConfirm('<?php echo url('Goodsalbum/del_album_pic',['apic_id'=>$v['apic_id']]); ?>','<?php echo \think\Lang::get('ds_ensure_del'); ?>',<?php echo $v['apic_id']; ?>)"><?php echo \think\Lang::get('ds_del'); ?></a></span>
                            </p>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </td>
            </tr>
            <?php else: ?>
            <tr class="no_data">
                <td colspan="15"><?php echo \think\Lang::get('ds_no_record'); ?></td>
            </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr class="tfoot">
                <td class="w48"><input id="checkallBottom" class="checkall" type="checkbox"/></td>
                <td colspan="16">
                    <label for="checkallBottom"><?php echo \think\Lang::get('ds_select_all'); ?></label>
                    <a class="btn btn-small" href="javascript:void(0);" onclick="submit_delete_batch()"><span><?php echo \think\Lang::get('ds_del'); ?></span></a>
                </td>
            </tr>
            </tfoot>
        </table>
         <?php echo $show_page; ?>

</div>
<script>
    jQuery.browser={};(function(){jQuery.browser.msie=false; jQuery.browser.version=0;if(navigator.userAgent.match(/MSIE ([0-9]+)./)){ jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;}})();
</script>
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/jquery.poshytip.min.js"></script>
<link rel="stylesheet" href="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery.lightbox/css/lightbox.min.css">
<script src="<?php echo PLUGINS_SITE_ROOT; ?>/js/jquery.lightbox/js/lightbox.min.js"></script>
<script>
    $(function () {
        $('.tip').poshytip({
            className: 'tip-yellowsimple',
            alignTo: 'target',
            alignX: 'center',
            alignY: 'bottom',
            offsetX: 0,
            offsetY: 5,
            allowTipHover: false
        });
    });
    function submit_delete(ids_str){
        _uri = ADMINSITEURL+"/Goodsalbum/del_album_pic.html?apic_id=" + ids_str;
        dsLayerConfirm(_uri,'<?php echo \think\Lang::get('ds_ensure_del'); ?>');
    }
</script>