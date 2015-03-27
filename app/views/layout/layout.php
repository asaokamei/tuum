<?php
use Tuum\View\Tuum\Renderer;
use Tuum\Web\Viewer\View;

/** @var View $view */
/** @var Renderer $this */

if (!isset($title)) {
    $title = 'TuumPHP Demo';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title><?= $title; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        nav#footer {
            background-color: #f0f0f0;
            border-top: 1px solid #cccccc;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">TuumPHP</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/sample?name=TuumPHP">Controller Sample</a></li>
                <li><a href="/demoTasks">Task Demo</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <?= $this->getSection('sub-menu'); ?>
    <?= isset($view) ? $view->message : ''; ?>

    <?= $this->getContent();?>

</div>
<nav id="footer" class="nav navbar-fixed-bottom">
    <div class="container">
        <h4>TuumPHP framework.</h4>
        <p><em>Tuum</em> means 'yours' in Latin; so it happens to the same pronunciation as 'stack' in Japanese. </p>
    </div>
</nav>
</body>
</html>