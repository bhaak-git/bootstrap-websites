<?php
  session_start(); // set serverside cookie

	require_once("../config.php"); // System configuration also contains other require-statements

  unset($_SESSION['document']); // Unset document data
  $_SESSION['document'] = array("id" => "project-ar_flight", "title" => "Project AR_FLIGHT", "author" => "Matthias Rozema"); // Set document data

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

  <p class="lead">This page is dedicated to "PROJECT AR_FLIGHT". Where Matthias tries to program a drone.</p>

  <div class="list-group">
    <div id="Carousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#Carousel" data-slide-to="0" class="active"></li>
        <li data-target="#Carousel" data-slide-to="1"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="ardrone0-min.jpg">
        </div>

        <div class="item">
          <img src="ardrone1-min.jpg">
        </div>
      </div>
    <?php rdrCarouselControls();?>
    </div>
    <a class="list-group-item">
      <div class="progress unconstrained">
        <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 75%;">
          75%
        </div>
      </div>
    </a>

  </div>

  <p class="article">
    Libraries used:
    <ul>
      <li>CopterFace</li>
    </ul>
  </p>
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
