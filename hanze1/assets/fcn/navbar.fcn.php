<?php
  function rdrNavbar(){
    $brand = "Haaksema";
?>
    <!--HTML-->
    <nav class="navbar navbar-default navbar-static-top unconstrained">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><?php echo $brand ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="<?php echo validateActive("books-year-1"); ?>"><a href="/">Year 1</a></li>
            <li class="<?php echo validateActive("books-year-2"); ?>"><a href="/year-2">Year 2</a></li>
            <li class="<?php echo validateActive("books-year-3"); ?>"><a href="/year-3">Year 3</a></li>
            <li class="<?php echo validateActive("books-year-4"); ?>"><a href="/year-4">Year 4</a></li>
          </ul>
        </div>
      </div>
    </nav>
<?php
  }

  function validateActive($id){
    if ($id == $_SESSION['document']['id']){
      $result = "active";
    }
    return $result;
  }
?>
