<?php
  session_start(); // set serverside cookie

	require_once("config.php"); // System configuration also contains other require-statements

  unset($_SESSION['document']); // Unset document data
  $_SESSION['document'] = array("id" => "books-year-1", "title" => "HBO-ICT Books", "author" => "Haaksema"); // Set document data

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

  <h3>Theme 1.1: Website development</h3>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">Engels in de beroepspraktijk</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Fundamentals of Business Process Management </td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_gRm45bmVuVjd6OFU" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Communication in Organizations</td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_gMzAtSWkwSUVScW8" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
  </table>
  <hr>

  <h3>Theme 1.2: IT Service Management & Security</h3>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">Essential information security</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Introduction to Design Science</td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_geWpxblRCUWpSbUU" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Engels in de beroepspraktijk</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Samenvatting ITIL  Service Management</td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_gNW4wV3hRVWtCVHM" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
  </table>
  <hr>

  <h3>Theme 1.3: Design & Build</h3>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">Fundamentals of Business Process Management</td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_gRm45bmVuVjd6OFU" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">The inmates are running the asylum - why high-tech products drive us crazy and how to restore the sanity</td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_gZklfNURxUG82OWs" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
  </table>
  <hr>

  <h3>Theme 1.4: Data analysis & visualisation</h3>
  <table class="table table-bordered">
    <tr>
      <th class="col-xs-10">Title</th>
      <th class="col-xs-2">Link</th>
    </tr>
    <tr>
      <td class="col-xs-10">NoSQL Distilled: A Brief Guide to the Emerging World of Polyglot Persistence</td>
      <td class="col-xs-2"><a href="https://drive.google.com/open?id=0B2KAkSFl0Y_gRUhiMmFPZ0pBTTg" target="_blank" class="btn btn-warning btn-xs">Expired</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Now you see it.</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Statistics in 20 steps</td>
      <td class="col-xs-2"><a href="#" class="btn btn-danger btn-xs">Unavailable</a></td>
    </tr>
    <tr>
      <td class="col-xs-10">Rapportagetechniek</td>
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
