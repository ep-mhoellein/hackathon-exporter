<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// require_once("epages-rest-php/src/Shop.class.php");
// ep6\Logger::setLogLevel(ep6\LogLevel::NONE);
// ep6\Logger::setOutput(ep6\LogOutput::SCREEN);

// $shop = new ep6\Shop("royals.epages.com", "Hackathon", "I4UqHzGdLa5OMgMv4tZzMb3njoU4QQM6", true);

// include 'php/products.php';


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="source/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- jquery -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="source/js/jquery-ui/jquery-ui.min.js"></script>
    <!-- own jquery widgets -->
    <script src="source/js/filterform.widget.js"></script>
    <script src="source/js/compare-filter.widget.js"></script>
    <script src="source/js/bool-filter.widget.js"></script>
    <script src="source/js/item-filter.widget.js"></script>
    <script src="source/js/select-filter.widget.js"></script>

    <!-- JS template engine -->
    <script src="node_modules/mustache/mustache.min.js"></script>

    <script src="php/filter-object.php"></script>

    <script src="source/js/main.js"></script>
</head>
<body>
<div class="container">

    <form class="filterform">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="">Data export</h1>
            </div>
        </div><!-- //.row -->

        <div class="row headRow">
            <div class="col-xs-10">
                <strong>Filter</strong>
            </div><!-- //.col-xs-10 -->
            <div class="col-xs-2 text-right">
                <strong>remove Filter</strong>
            </div><!-- //.col-xs-2 -->
        </div><!-- //.row -->

        <div class="row borderRow">
            <div class="col-xs-12">
                <div id="formFields"></div>
            </div><!-- //.col-xs-12 -->
        </div><!-- //.row -->

        <div class="row top-margin-xs">
            <div class="col-xs-12 text-right">
                <a class="btn btn-primary" id="exportLink" href="#"><i class="material-icons">file_download</i> export</a>
            </div><!-- //.col-xs-12 -->
        </div><!-- //.row -->

        <div class="row">
            <div class="col-xs-12">
                <div id="responseContainer"></div>
            </div><!-- //.col-xs-12 -->
        </div><!-- //.row -->
    </form>

</div><!-- //.container -->
</body>
</html>