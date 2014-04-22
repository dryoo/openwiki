<?php /*타이머 시작*/$_pagestart=microtime(get_as_float);
/**
 * DokuWiki Default Template 2012
 *
 * @link     http://dokuwiki.org/template
 * @author   Anika Henke <anika@selfthinker.org>
 * @author   Clarence Lee <clarencedglee@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */
if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge,chrome=1');
$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT=='show');
if (preg_match('/'.tpl_getConf('adsense_filter').'/',$ID)) // 애드센스처리
	$noadsense=true; else $noadsense=false;
if (p_get_metadata($ID,"adult") || $INFO["userinfo"]) $noadsense=true;
?>
<!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
  <meta charset="utf-8" />
  <title><?php tpl_pagetitle() ?> :<?php echo strip_tags($conf['title']) ?>:</title>    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
  <link rel="canonical" href="http://openwiki.kr/<?=str_replace(":","/",$ID)?>"/>
  <?php tpl_metaheaders() ?>
  <meta name="description" content="<?php $abstract= p_get_metadata($ID,"description");echo  htmlspecialchars($abstract['abstract']) ?>" >
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
  <?php tpl_includeFile('meta.html') ?>
<script type="text/javascript">
//<![CDATA[
  (function() {
    var shr = document.createElement('script');
    shr.setAttribute('data-cfasync', 'false');
    shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
    shr.type = 'text/javascript'; shr.async = 'true';
    shr.onload = shr.onreadystatechange = function() {
      var rs = this.readyState;
      if (rs && rs != 'complete' && rs != 'loaded') return;
      var apikey = '2d08dc987b657ac3c101d640ac6ef155';
      try { Shareaholic.init(apikey); } catch (e) {}
    };
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(shr, s);
  })();
//]]>
</script>
<script type="text/javascript">
window.onload = function(){ document.getElementById("dokuwiki__site").style.display = '';}
window.setTimeout("document.getElementById('dokuwiki__site').style.display = ''", 500);
</script>
<script>document.onkeydown=function(e){
if (window.event) var e=window.event,f=e.srcElement,nn=f.tagName;
else var f=e.target,nn=f.nodeName;/*현재 포커스를 얻음*/
if (nn!='INPUT'&&nn!='TEXTAREA') {/*현재 문자입력중이 아닌지 확인*/
/*h 홈*/     if(e.which==72){ window.open('/','_self',false);return false;} 
/*a 랜덤*/   if(e.which==65){ window.open('/<?=$ID?>?do=randompage','_self',false);return false;} 
/*v 보기 */  if(e.which==86){ window.open('/<?=$ID?>?do=show','_self',false); return false;}
/*m 파일 */  if(e.which==77){ window.open('/<?=$ID?>?do=media','_self',false); return false;}
/*t 맨위로*/ if(e.which==84){ window.open('#dokuwiki__top','_self',false); return false;}
/*d최근차이*/if(e.which==68){ window.open('/<?=$ID?>?do=diff','_self',false); return false;}
/*r최근변경/if(e.which==82){ window.open('/<?=$ID?>?do=recent','_self',false); return false;}*
/*e,w편집*/  if(e.which==69||e.which==87){ window.open('/<?=$ID?>?do=edit','_self',false);return false;} 
/*s,q찾기*/  if(e.which==83||e.which==81){ document.getElementById('qsearch__in').focus();return false;}
/*i,o변경*/  if(e.which==73||e.which==79){ window.open('/<?=$ID?>?do=revisions','_self',false);return false;}
} }</script>
  <script type="text/javascript"> 
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-16671750-1']);
    _gaq.push(['_trackPageview']);
     (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
</head>
<?php /*배경처리*/
if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { $_isMobile=true;} else $_isMobile=false;
if (!$_isMobile)  { 
$bg='http://openwiki.kr/bg_'.str_replace(':','_',$INFO['namespace']).'.jpg';
//if (!file_exists($bg)) $bg="http://openwiki.kr/bg_.jpg";
}?>
<body style="background:#000 url(<?=$bg ?>) fixed center center no-repeat">
 <!-- <div class="ribbon-wrapper-green"><div class="ribbon-green">세월호 탑승객의 무사귀가를 염원합니다.</div></div>-->
<?php if ($_isMobile) include($_SERVER["DOCUMENT_ROOT"].'/am/nav.php');  /*뷀넷 헤더*/ ?>
<!--[if lte IE 7 ]><div id="IE7"><![endif]--><!--[if IE 8 ]><div id="IE8"><![endif]-->
<div id="wrapper"  >

<div class="nav_header">
	<div class="header_inner">
		<div class="site" style="">
         	<?php include('tpl_header.php') ?>
         	<div style="position:fixed;top:9em;" >
				<div style="position:absolute; left:-32px;">
                	<?php include('cssmenu.php') ?> 
         	   	</div>
			</div>
		</div>
	</div>
</div>

<div id="dokuwiki__site" style="display:none;"><div id="dokuwiki__top" 
        class="dokuwiki site mode_<?php echo $ACT ?> <?php echo ($showSidebar) ? 'showSidebar' : '';
        ?> <?php echo ($hasSidebar) ? 'hasSidebar' : ''; ?> <?php echo ($_isMobile)? 'mobile':'' ?>">
        <div class="clearer"></div>
    <?php html_msgarea() ?>
    <!-- BREADCRUMBS -->
    <?php if($conf['breadcrumbs'] || $conf['youarehere']): ?>
        <div class="breadcrumbs pad group">
            <?php if($conf['youarehere']): ?>
                <div class="youarehere"><?php tpl_youarehere() ?></div>
            <?php endif ?>
            <?php if($conf['breadcrumbs'] ): ?>
                <div class="trace"><?php tpl_breadcrumbs() ?></div>
            <?php endif ?>
        </div>
    <?php endif ?>

    <hr class="a11y" />
<div class="clearer"></div>

        <div class="wrapper group">

            <?php if($showSidebar): ?>
                <!-- ********** ASIDE ********** -->
                                        <?php // tpl_flush() ?>
                <div id="dokuwiki__aside"><div class="pad include group">
                    <h3 class="toggle"><?php echo $lang['sidebar'] ?></h3>
                    <div class="content">
                        <?php include('sidebarheader.php') ?> 
                        <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                        <?php tpl_includeFile('sidebarfooter.html') ?>
                    </div>
                </div></div><!-- /aside -->
            <?php endif; ?>

            <!-- ********** CONTENT ********** -->
            <div id="dokuwiki__content"><div class="pad group">

                <div class="pageId"><span title="<?=$ACT?>"><?php echo hsc($ID) ?></span></div>

                <div class="page group">
                    <?php // tpl_flush() ?>
			       <div style="float:right" class="test" id="short_url"></div>
					<!--[if lte IE 10]>IE 11을 권장합니다.<![endif]-->
					
                    <?php if (($ACT=='show' || $ACT=="showtag") && (!$noadsense))  include('adsense.php'); ?>
                    <!-- wikipage start -->
                    <?php tpl_content() ?>

<div class="clearer"></div>
                    <?php /*업로드*/ if  (($ACT=='edit'or ($ACT=='preview'))& ($INFO['isadmin'])) { ?>
                    <iframe src="http://openwiki.kr/up?target=<?php echo str_replace(":","/",getNS($ID))?>" scrolling="no" style="width:100%;height:150px;border:none;margin:0;padding:0;overflow: hidden;" > </iframe>
                    <?php } ?>	
                    <?php /*참조문서 출력*/  if  ((ft_backlinks($ID)!=null) &&($INFO['namespace']!="") && (strrchr(':'.$INFO['id'],":")!=":home") &&  (($ACT=='edit') or ($ACT=='preview') or ($ACT="show") ) ) print p_render('xhtml',p_get_instructions('{{backlinks>.}}'),$info);?>

<?php /*미니문법설명*/ if  (($ACT=='edit')or ($ACT=='preview') ) print p_render('xhtml',p_get_instructions('
^  **초미니 문법 설명**  (혹은 [[:syntax]]참조하세요)  ||||
^강조| %%**굵게**%%| %%//기울임//%% | %%__밑줄__%%|
^제목| ======제목1단계|=====제목2단계|====제목3단계 (뒤는 자동)|
^목록| _*_  공백과 총알 한개 (점목록)|_-_ 공백과 빼기 (번호목록)||
^연결| %%[[두개의 대괄호로 연결]]%%| %%URL%% 혹은 %%[[URL]]%%| %%[[URL|표시될 이름]]%%|
^표| %%|셀 내용1|셀 내용2|%% | %%^제목내용1^제목내용2^%% |테이블 끝에 공백이 오면 안됩니다|
'),$info);?>

<?php  if ($ACT=='show' && $ID!='home') { ?>
    <div id="disqus_thread" style="border:1px solid #ccc; max-width:700px;margin:0.5em auto;padding:0 7px;background-color:#f0f0f0"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'vln'; // required: replace example with your forum shortname
    var disqus_url = 'http://openwiki.kr/<?=str_replace(":","/",$ID)?>';
    var disqus_identifier ='http://openwiki.kr/<?=str_replace(":","/",$ID)?>';
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    <?php } ?>
<div style="max-width:605px;margin:0 auto">
<?php if ($ACT=='show' && (!$noadsense)) { include('adsense_foot.php'); /*애드센스 아래쪽*/ }?>
<?php if ($ACT=='show') { ?> 
<div class="" style='float:left;width:298px;min-height:248px;border:1px #ccc solid'>
<img  style="float:left" src="/qr?data=http://openwiki.kr/<?=str_replace(":","/",$ID)?>" title="http://openwiki.kr/<?=str_replace(":","/",$ID)?>" alt="http://openwiki.kr/<?=str_replace(":","/",$ID)?>">
<div style="width:298px;text-weight:100"><?php echo $INFO['meta']['title']?></div>
<dl>
  <dt>마지막 수정</dt>
  <dd><?php echo @date('Y-m-d H:i:s.',$INFO['meta']['date']['modified']);?></dd>
  
    <?php  /*작성자 표시*/
	print '<dt>작성자</dt><dd>';
    $contributors =$INFO['meta']['contributor'];// p_get_metadata($ID, 'contributor' );
      if ($contributors!=null)    { 
		 //$contributors=array_unique(array_diff_assoc($contributors,array_unique($contributors)));  
         foreach(array_unique($contributors) as $userid=>$usernick){
			 if ( strtolower($userid)=="v_l" ||  strtolower($userid)=="vaslor" )
			 {
				 //echo '<a href="https://plus.google.com/102990262307362184016?rel=author"  rel="publisher">'.$usernick.'</a> ';
				  echo  '<a href="http://openwiki.kr/user/'.$userid.'">'.$usernick.'</a> ';
			 } else
			 {
				 echo  '<a href="http://openwiki.kr/user/'.$userid.'">'.$usernick.'</a> ';
			 }
    			 	
		 
		 //    $_contributors.="[[:user:".$userid."|".$usernick."]]  "; // [[:user:id|name]]으로 링크형성
         }
		 
        // print '<dt>작성자</dt><dd>'.p_render('xhtml',p_get_instructions($_contributors),$info).'</dd>';
	}
     ?>
</dl>
<div class='shareaholic-canvas' data-app='share_buttons' data-app-id='360026'></div>
</div>
</div>
<?php }?>


        <!-- wikipage stop -->    
                </div>
                   


                <?php //tpl_flush() ?>
            </div></div><!-- /content -->

            <hr class="a11y" />
            <!-- PAGE ACTIONS -->
            <div id="dokuwiki__pagetools">
                <h3 class="a11y"><?php echo $lang['page_tools']; ?></h3>
                <div class="tools">
                    <ul>
                        <?php
                            tpl_action('edit',      1, 'li', 0, '<span>', '</span>');
                            tpl_action('revert',    1, 'li', 0, '<span>', '</span>');
                            tpl_action('revisions', 1, 'li', 0, '<span>', '</span>');
                            tpl_action('backlink',  1, 'li', 0, '<span>', '</span>');
                            tpl_action('subscribe', 1, 'li', 0, '<span>', '</span>');
                            tpl_action('top',       1, 'li', 0, '<span>', '</span>');
                            tpl_action('admin',     1, 'li', 0, '<span>', '</span>');
                        ?>
                    </ul>
                </div>
            </div>
        </div><!-- /wrapper -->

        <?php include('tpl_footer.php') ?>
    </div></div><!-- /site -->
    <?php  //include($_SERVER["DOCUMENT_ROOT"].'/am/vlfoot.php'); ?>
	<?php // include('chat.php'); ?>
	                <div class="docInfo"></div>
                    
     <script>
      function appendResults(text) {
        var results = document.getElementById('short_url');
        //results.appendChild(document.createElement('P'));
        results.appendChild(document.createTextNode(text));
      }

      function makeRequest() {
        var request = gapi.client.urlshortener.url.insert({
          'resource': { 'longUrl': 'http://openwiki.kr' }
        });
        request.execute(function(response) {
          appendResults(response.shortUrl);
        });
      }

      function load() {
        gapi.client.setApiKey('AIzaSyCk3OGDenKduTy6nuxYtP-gVg0-QNxxMlg');
        gapi.client.load('urlshortener', 'v1', makeRequest);
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=load"></script>
    
	<div style="text-align:center;font-size:12px">
		<?php tpl_pageinfo() ?><br>
<?php /*챗 php processing time of the server */ printf("%.3f seconds in $ACT ing this page ($ID). ",(microtime(get_as_float)-$_pagestart));?></div>
    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
    <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
    </div>
</body>
</html>