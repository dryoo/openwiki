<?php
/**
 * Template header, included in the main and detail files
 */
// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>
<!-- ********** HEADER ********** -->
<div id="dokuwiki__header" >


<div class="pad group">
    <?php tpl_includeFile('header.html') ?>
    <div class="headings group" style="overflow:hidden;">
    <ul class="a11y skip">
            <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content']; ?></a></li>
        </ul>       
<?php if ((!$_isMobile) && ($ACT!='edit') && ($ACT!='media')  ){
            $logoSize = array();
            $logo = tpl_getMediaFile(array(':'.$INFO['namespace'].':logo.jpg',':'.$INFO['namespace'].':logo.png',':오늘:'.date("n월_j일").'.png',':logo.png',':wiki:logo.png', 'images/logo.png'), false, $logoSize); ?>
			<div style="text-align:center;float:left;width:185px;height:86px;background-image:url(<?=$logo?>);background-size:185px 86px;" ></div>
<?php } ?><div class="title" ><?php tpl_link(  wl($INFO['namespace']),p_get_first_heading(':'.$INFO['namespace'].':home'),'accesskey="h" title="[H]"');    ?></div>
    </div>
    <div class="tools group" >
        <!-- USER TOOLS -->
        <?php if ($conf['useacl'] && $isMobile): ?>
            <div id="dokuwiki__usertools">
                <h3 class="a11y"><?php echo $lang['user_tools']; ?></h3>
                <ul>
                    <?php
                        if ($_SERVER['REMOTE_USER']) {
                            echo '<li class="user">';
                            tpl_userinfo(); /* 'Logged in as ...' */
                            echo '</li>';
                        } 
                        tpl_action('profile', 1, 'li');
                        tpl_action('register', 1, 'li');
                        tpl_action('login', 1, 'li');
                    ?>
                </ul>
            </div>
        <?php endif ?>
        <!-- SITE TOOLS -->
        <div id="dokuwiki__sitetools">
            <h3 class="a11y"><?php echo $lang['site_tools']; ?></h3>
			<?php if (!plugin_isdisabled('searchformgoto')) {
				$searchformgoto = &plugin_load('helper','searchformgoto');
				$searchformgoto->gotoform();
				} else { tpl_searchform(); }
			?>
            <div class="mobileTools">
                <?php tpl_actiondropdown($lang['tools']); ?>
            </div>
            <?php if ($ACT!='edit' && $ACT!='preview' && !$_isMobile): ?>
            <ul class="toolicons">
                     <?php tpl_bs_actionlink("admin","cog","li","");?>
                     <?php tpl_bs_actionlink("media","picture","li", "");?>
                    <?php tpl_bs_actionlink("index","th-list","li", "");?>
                    <?php tpl_bs_actionlink("recent","fire","li", "");?>
                    <li></li><li></li><li></li>
		<?PHP  if (@class_exists("Context",false)) {
			$logged_info = Context::get("logged_info");
 		   if($logged_info){ 
			   $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($logged_info->email_address)))."?d=mm&s=32";
      // echo '<li><a style="height:32px;padding:5px 0;padding-left:37px;background: url('.$logged_info->profile_image->src.') no-repeat left;" title="'.implode(',',$logged_info->group_list).'">'.'</a></li>'; 
      echo '<li><a href="http://bb.openwiki.kr/index.php?act=dispMemberLogout" title="'.$lang["btn_logout"].'"><span style="color:#a44" class="glyphicon glyphicon-off"></span></a></li>'; //$logged_info->nick_name." (".$logged_info->user_id.")".
    } else {
      echo '<li><a href="http://bb.openwiki.kr/index.php?mid=blank&act=dispMemberLoginForm" title="입장"><span style="color:
#73A0FF" class="glyphicon glyphicon-log-in"></span></a></li>'; 
    }  }?>
            <li><a  href="" onclick="myFunction()" style="margin:3px" title="새 문서 만들기"><span style="color:#3DE03D" class="glyphicon glyphicon-plus-sign"></span></a></li>             
            </ul>
             <?php endif ?>   
        </div>
    </div>
    <hr class="a11y" />
</div><!-- /header --></div>
<?php
  function tpl_bs_actionlink($type, $pre = '', $suf = '', $inner ='', $return = false) {
       global $lang;
       $data = tpl_get_action($type);
       if($data === false) {
           return false;
       } elseif(!is_array($data)) {
           $out = sprintf($data, 'link');
       } else {
           /**
            * @var string $accesskey
            * @var string $id
            * @var string $method
            * @var bool   $nofollow
            * @var array  $params
            * @var string $replacement
            */
           extract($data);
           if(strpos($id, '#') === 0) {
               $linktarget = $id;
           } else {
               $linktarget = wl($id, $params);
           }
           $caption = $lang['btn_'.$type];
           if(strpos($caption, '%s')){
               $caption = sprintf($caption, $replacement);
           }
           $akey    = $addTitle = '';
           if($accesskey) {
               $akey     = 'accesskey="'.$accesskey.'" ';
               $addTitle = ' ['.strtoupper($accesskey).']';
           }
           $rel = $nofollow ? 'rel="nofollow" ' : '';
           $out = tpl_link(
               $linktarget, $pre.(($inner) ? $inner : $caption).$suf,
               'class="btn action '.$type.'" '.
                   $akey.$rel.
                   'title="'.hsc($caption).$addTitle.'"', 1
           );
           $out='<a href="'.$linktarget.'" ';
           $out.='class="action '.$type.'" '.
                   $akey.$rel.
                   'title="'.hsc($caption).$addTitle.'"';
           $out.='>';
           if ($pre) $out.='<span class="glyphicon glyphicon-'.$pre.'"></span>';
        //   $out.=(($inner) ? $inner : $caption);
           $out.='</a>';
           if ($suf) $out='<'.$suf.'>'.$out.'</'.$suf.'>';
       }
       if($return) return $out;
       echo $out;
       return true;
   }
?>