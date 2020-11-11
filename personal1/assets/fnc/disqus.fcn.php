<?php
  function rdrDisqus(){
?>
  <!--HTML-->
  <div id="disqus_thread"></div>
  <script>
      var disqus_config = function () {
          this.page.identifier = '<?php echo $_SESSION['document']['id']; ?>';
      };
      (function() {
          var d = document, s = d.createElement('script');
          s.src = '//bastiaanhaaksema.disqus.com/embed.js';
          s.setAttribute('data-timestamp', +new Date());
          (d.head || d.body).appendChild(s);
      })();
  </script>
  <noscript><i>Please enable JavaScript to view the comments.</i></noscript>
<?php
  }
?>
