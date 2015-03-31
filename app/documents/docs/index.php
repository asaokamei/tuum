<?php /** @var \Tuum\View\Renderer $this */ ?>

<?php $this->startSection() ?>
<li><a href="/docs/index.php" >URL Map Sample</a></li>
<li class="active">PHP File</li>
<?php $this->endSectionAs('breadcrumb'); ?>

<!Doctype html>
<html>
<head>
    <title>TuumPHP is here</title>
</head>
<body>
<h1>PHP View File</h1>
<p>This is directly rendered from a PHP file.</p>
</body>
</html>