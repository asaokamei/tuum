<?php /** @var \Tuum\View\Renderer $this */ ?>
<?php /** @var \Tuum\Web\View\Value $view */ ?>

<?php $view->data['current'] = 'maps'; ?>

<?php $this->blockAsSection('docs/sub-menu', 'sub-menu', ['current'=>'index']); ?>

<?php $this->startSection() ?>
<li><a href="/docs/index" >Documents</a></li>
<li class="active">top</li>
<?php $this->endSectionAs('breadcrumb'); ?>

<!Doctype html>
<html>
<head>
    <title>Tuum is here</title>
</head>
<body>
<h1>PHP View File</h1>
<p>This is directly rendered from a PHP file.</p>

<h3>URL Map Samples</h3>
<ul>
    <li><a href="tuum.html" >html file</a></li>
    <li><a href="non-such.html">not found</a></li>
    <li><a href="tuum.txt" >text file</a></li>
    <li><a href="marked.md" >markdown file</a></li>
    <li><a href="errors" >php exception thrown</a></li>
</ul>

</body>
</html>