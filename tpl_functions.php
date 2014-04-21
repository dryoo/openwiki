<?php /**
 * 다음뷰위젯 출력.. 1은 큰것 2는 중간것 3은 버튼

@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
function showDaum($ttty) {
     $nid =getNid();
     $box = array(
	1=>'<embed src="http://api.v.daum.net/static/recombox1.swf?nid='.$nid.
           '" quality="high" bgcolor="#ffffff" width="400" height="80" type="application/x-shockwave-flash" wmode="transparent"></embed>',
	2=>'<embed src="http://api.v.daum.net/static/recombox2.swf?nid='.$nid.
           '" quality="high" bgcolor="#ffffff" width="400" height="58" type="application/x-shockwave-flash"></embed>',
	3=>'<embed src="http://api.v.daum.net/static/recombox3.swf?nid='.$nid.
           '" quality="high" bgcolor="#ffffff" width="67" height="80" type="application/x-shockwave-flash"></embed>'
	);
	 if($nid != -1) echo $box[$ttty]; else echo "Nop";
     
  }
 
/**
 * 다음뷰에 포스트가 송고 되어 있는지 체크
 */
function getNid() {
	global $ID;
	$ret = -1;
	$xml = getXML("api.v.daum.net","/open/news_info.xml?permalink=".DOKU_URL.str_ireplace(':','/',$ID));
	if(is_object($xml)) {
		if($xml->head->code == "200") $ret = $xml->entity->news->id;
	}
    //print_r ($xml);
    //echo DOKU_URL.str_ireplace(':','/',$ID).$xml->head->code;
	return $ret;
}
 
/**
 * xml 가져오기...
 */
function getXML($url, $uri) {
	if(!($fp=fsockopen($url, 80, $errno, $errstr, 5 )))
		fprintf( stderr, $errstr );
	$out  = "GET $uri HTTP/1.1\r\n";
	$out .= "Host: api.v.daum.net\r\n";
	$out .= "Connection:Close\r\n\r\n";
	fputs( $fp, $out );
	while( $data = fgets($fp) ){
		if( !trim($data) )
			break; 	}
	$data = stream_get_contents($fp);
	return simplexml_load_string($data);
}