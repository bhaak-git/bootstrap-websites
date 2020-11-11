<?php
  session_start(); // set serverside cookie

	require_once("config.php"); // System configuration also contains other require-statements

  unset($_SESSION['document']); // Unset document data
  $_SESSION['document'] = array("id" => "index", "title" => "R&D by Bastiaan Haaksema", "author" => "Bastiaan Haaksema"); // Set document data

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

  <h1>Research &amp; Development</h1>
  <p class="text-muted"><span class="glyphicon glyphicon-user"></span> By <?php echo $_SESSION['document']['author']; ?></p>
  <hr>

  <!-- First Blog Post -->
  <h3><a href="/books">Books Year 1 (HBO-ICT)</a></h3>
  <p class="text-muted">
    <span class="glyphicon glyphicon-time"></span> Posted on 23 September 2015
  </p>
  <img class="img-responsive" src="/index/book.min.jpg" alt="">
  <hr>
  <p>A collection of books relevant for the courses I take as part of the HBO-ICT study program.</p>
  <a class="btn btn-primary" href="/books">Take a look <span class="glyphicon glyphicon-chevron-right"></span></a>
  <hr class="buffer">

  <!-- Second Blog Post -->
  <h3><a href="/projects/ar_flight">Project AR_FLIGHT</a></h3>
  <p class="text-muted">
    <span class="glyphicon glyphicon-time"></span> Posted on 18 September 2015
  </p>
  <img class="img-responsive" src="/index/arflight.min.jpg" alt="">
  <hr>
  <p>This page is dedicated to "PROJECT AR_FLIGHT". Where Matthias tries to program a drone.</p>
  <a class="btn btn-primary" href="/projects/ar_flight">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
  <hr class="buffer">

  <!-- Third Blog Post -->
  <h3><a href="/projects/surw">Project SURW</a></h3>
  <p class="text-muted">
    <span class="glyphicon glyphicon-time"></span> Posted on 22 August 2015
  </p>
  <img class="img-responsive" src="/index/surw.min.jpg" alt="">
  <hr>
  <p>Led by <a href="http://westercoenraads.nl" target="_blank">Wester Coenraads</a> the dev team began developing a board game codenamed SURW.</p>
  <a class="btn btn-primary" href="/projects/surw">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
  <hr class="buffer">

<?php
  echo "</div>"; // close: col-md-8

  rdrSidebar(); // Renders HTML <div class="col-md-4">

  echo "</div>"; // close: row
  echo "</div>"; // close: container

  rdrFooter(); // Renders HTML <footer>
  rdrJavascript(); // Activate javascripts

  echo "</body>"; // close: body
  echo "</html>"; // close: html
?>
