<?php
  function rdrNavbar(){
    $brand = "&lt;R&amp;D /&gt";
?>
<nav class="navbar navbar-inverse navbar-static-top unconstrained">
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
<li class="<?php echo validateActive("index"); ?>"><a href="/">Home</a></li>
<li class="<?php echo validateActive("books"); ?>"><a href="/books">Books</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
<ul class="dropdown-menu">
<li class="<?php echo validateActive("project-ar_flight"); ?>"><a href="/projects/ar_flight">Project AR_FLIGHT</a></li>
<li class="<?php echo validateActive("project-surw"); ?>"><a href="/projects/surw">Project SURW</a></li>
</ul>
<li class="<?php echo validateActive("services"); ?>"><a href="/services">Services</a></li>
</li>
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
