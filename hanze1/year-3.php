<?php
  session_start(); // set serverside cookie

	require_once("config.php"); // System configuration also contains other require-statements

  unset($_SESSION['document']); // Unset document data
  $_SESSION['document'] = array("id" => "books-year-3", "title" => "HBO-ICT Books", "author" => "Haaksema"); // Set document data

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

  <h2>3e jaar SE: toets 03</h2>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">The Good Research Guide: For Small Scale Research Projects</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Research Proposals A Practical Guide</td>
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
