<?php
  function rdrDisqus(){
?>
<div id="disqus_thread"></div>
<script>/*<![CDATA[*/var disqus_config=function(){this.page.identifier="<?php echo $_SESSION['document']['id']; ?>"};(function(){var b=document,a=b.createElement("script");a.src="//bastiaanhaaksema.disqus.com/embed.js";a.setAttribute("data-timestamp",+new Date());(b.head||b.body).appendChild(a)})();/*]]>*/</script>
<noscript><i>Please enable JavaScript to view the comments.</i></noscript>
<?php
  }
?>
