<?php
  function rdrHead(){
    $pathCSSCore = "/assets/css/main.min.css";
    $pathCSSCustom = "/assets/css/subalpine.css";
    $pathCSSFont = "http://fonts.googleapis.com/css?family=Lato:400,700";
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href=<?php echo $pathCSSCore; ?>>
<link rel="stylesheet" type="text/css" href=<?php echo $pathCSSCustom; ?>>
<link rel="stylesheet" type="text/css" href=<?php echo $pathCSSFont; ?>>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<meta name="description" content="<?php echo $_SESSION['document']['title']; ?>">
<meta name="author" content="<?php echo $_SESSION['document']['author']; ?>">
<title><?php echo $_SESSION['document']['title']; ?></title>
</head>
<?php
  }
?>
