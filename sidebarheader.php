<?php $today=':오늘:'.date("n월_j일");  if (page_exists($today)) { 
	print p_render('xhtml',p_get_instructions('^  오늘은 [['.$today.']]  ^'),$info);
}
?>
<h2 style="text-align:center">
<?php  tpl_link(wl($INFO['namespace']),''.p_get_first_heading($INFO['namespace'].':home').'')?>
</h2>
<!--
<img src="http://vaslor.net/text.php?text=<?php echo p_get_first_heading($INFO['namespace'].':home')?>" alt="VV" />-->

