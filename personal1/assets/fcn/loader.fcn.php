<?php
  function loaderScreen(){
    if (!isset($_SESSION['state'])) {
      rdrLoaderScreen();
      $_SESSION['state'] = TRUE;
    }
  }
  function rdrLoaderScreen(){
?>
<div id="loader-wrapper">
<div id="loader"></div>
<div class="loader-section section-left"></div>
<div class="loader-section section-right"></div>
</div>
<?php
  }
?>
