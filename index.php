<?php
include_once('includes/visits.php');
require_once('includes/airports.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Flights reservations</title>
        <link href='bootstrap/css/bootstrap.css' rel='stylesheet'>
        <link href='css/style.css' rel='stylesheet'>
    </head>
    <body>
    <div class="well text-center">
            <?php showVisits() ?>
    </div>

    <div class="container well col-md-4 col-md-offset-4">
       <?php require_once('includes/form.php'); ?>
    </div>
       <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
       <script src='bootstrap/js/bootstrap.js'></script>
    </body>
</html>