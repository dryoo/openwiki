<?php
if($_isMobile) { ;?>
     <div id="vaslorchatbutton" style='z-index:9999;position:fixed; left:2px;bottom:2px;border:3px dotted red;border-radius:11px;background-color:#333;'><a href='http://chat.vaslor.net/'><img src="/am/images/users.png" alt="채팅" height="32"/></a></div>
<?php } else {?>
     <a id="vaslorchatbutton" href='#' style="padding:2px;width:187px;z-index:9999;position:fixed; left:1em;bottom:0;display:<?php echo ($_vaslorchat)?"none":"block" ?>;-webkit-box-shadow: inset 0 1px rgba(255, 255, 255, .5);border-radius:5px;background-color:#411;" onclick='javascript:document.getElementById("vaslorchat").style.display="block"; document.cookie="vaslorchat=block"; return false;'><img src="/am/images/users.png" height="24px" alt="채팅" style="height:24px"/> 뷔엘넷 통신소 </a>
     <div id="vaslorchat" style="border:2px solid black;display:<?php echo ($_vaslorchat)?"block":"none" ?>; z-index:1000000;width:400px;height:300px;padding:5px;position:fixed;left:1px;bottom:1px;border-radius:7px;background-color:#fff;">
     <iframe style="width:100%;" src="http://chat.vaslor.net/" name="chat" height="299"  title="뷔엘넷 통신소" seamless scrolling="no" >ㄹ</iframe>
     <div style='position: absolute; right:-10px;top:-10px'><a href='#' onclick='javascript: document.getElementById("vaslorchat").style.display="none";document.getElementById("vaslorchatbutton").style.display="block"; document.cookie="vaslorchat=none";return false;'><img src="/am/images/cancel.png" alt="닫기" height="32"/></a></div></div>
<?php } ?>
<!--배슬로쳇 끝-->