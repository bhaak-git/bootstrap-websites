<?php
  session_start(); // set serverside cookie

	require_once("config.php"); // System configuration also contains other require-statements

  unset($_SESSION['document']); // Unset document data
  $_SESSION['document'] = array("id" => "books-year-2", "title" => "HBO-ICT Books", "author" => "Haaksema"); // Set document data

  echo "<!DOCTYPE html><html lang=\"en\">"; // Declaration of doctype and open: <html>
  rdrHead(); // Renders HTML <head>
  echo "<body>"; // open: <body>

  rdrNavbar(); // Renders HTML <nav>
  rdrBanner(); // Renders HTML <banner>

  echo "<div class=\"container\">"; // open: container
  echo "<div class=\"row\">"; // open: row
  echo "<div class=\"col-md-12\">"; // open: col-md-12
?>

  <h1><?php echo $_SESSION['document']['title']; ?></h1>
  <p class="text-muted"><span class="glyphicon glyphicon-pencil"></span> By <?php echo $_SESSION['document']['author']; ?></p>
  <hr>

  <h2>2.1 I: IT-service development</h2>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">Operating System Concepts with Java</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Secrets of Service Level Management: A Process Owner's Guide</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
  </table>
  <hr>

  <h2>2.3 I: Software engineering</h2>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">Gesprekken in organisaties</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Intro to Java Programming, Comprehensive Version, Global Edition</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Software Development. Case Studies In Java</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
  </table>
  <hr>

  <h2>2.4 I:Database development</h2>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">FDatabase Systems: A Practical Approach to Design, Implementation, and Management: Global Edition</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Pro MySQL</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
  </table>
  <hr>

  <h2>2e jaar SE: toets 01-02</h2>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">The Good Research Guide: For Small Scale Research Projects</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
  </table>
  <hr>

<?php

  echo "</div>"; // close: col-md-12
  echo "</div>"; // close: row
  echo "</div>"; // close: container

  rdrFooter(); // Renders HTML <footer>
  rdrJavascript(); // Activate javascripts

  echo "</body>"; // close: body
  echo "</html>"; // close: html
?>
