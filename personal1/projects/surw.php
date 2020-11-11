<?php
  session_start(); // set serverside cookie

	require_once($_SERVER['DOCUMENT_ROOT'] . "config.php"); // System configuration also contains other require-statements

  unset($_SESSION['document']); // Unset document data
  $_SESSION['document'] = array("id" => "project-surw", "title" => "Project SURW", "author" => "Bastiaan Haaksema"); // Set document data

  echo "<!DOCTYPE html><html lang=\"en\">"; // Declaration of doctype and open: <html>
  rdrHead(); // Renders HTML <head>
  echo "<body>"; // open: <body>

  loaderScreen(); // Initiate loading screen
  rdrNavbar(); // Renders HTML <nav>
  rdrBanner(); // Renders HTML <banner>

  echo "<div class=\"container\">"; // open: container
  echo "<div class=\"row\">"; // open: row
  echo "<div class=\"col-md-8\">"; // open: col-md-12
?>

  <h1><?php echo $_SESSION['document']['title']; ?></h1>
  <p class="text-muted"><span class="glyphicon glyphicon-pencil"></span> By <?php echo $_SESSION['document']['author']; ?></p>
  <hr>

  <p class="lead">Led by <a href="http://westercoenraads.nl" target="_blank">Wester Coenraads</a> the dev team began developing a board game codenamed SURW.</p>

  <div class="list-group">
    <div id="Carousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#Carousel" data-slide-to="0" class="active"></li>
        <li data-target="#Carousel" data-slide-to="1"></li>
        <li data-target="#Carousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="surw0.png" alt="SURW0">
        </div>
        <div class="item">
          <img src="surw1.png" alt="SURW1">
        </div>
        <div class="item">
          <img src="surw2.png" alt="SURW2">
        </div>
      </div>
    <?php rdrCarouselControls();?>
    </div>
    <a class="list-group-item">
      <div class="progress unconstrained">
        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 80%;">
          80%
        </div>
      </div>
    </a>

  </div>

  <p class="article">My role in this project is mainly to create textures and writing C# code.</p>
  <hr>

<?php
  rdrDisqus(); // Renders HTML <nav>

  echo "</div>"; // close: col-md-8

  rdrSidebar(); // Renders HTML <div class="col-md-4">

  echo "</div>"; // close: row
  echo "</div>"; // close: container

  rdrFooter(); // Renders HTML <footer>
  rdrJavascript(); // Activate javascripts

  echo "</body>"; // close: body
  echo "</html>"; // close: html
?>
