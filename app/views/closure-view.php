<?php /** @var \Tuum\View\Renderer $this */ ?>

<?php $this->startSection() ?>
<li><a href="/closure/view" >Closure Sample</a></li>
<li class="active">view file</li>
<?php $this->endSectionAs('breadcrumb'); ?>

<html>
<body>
<h1>This is from a view file!</h1>
<p>but it is called from a closure.</p>

<h3>Other Closure Samples</h3>
<ul>
    <li><a href="/closure">from closure</a></li>
    <li><a href="/closure/text">raw text from a closure</a></li>
    <li><a href="/closure/array">array from a closure</a></li>
    <li><a href="/closure/view">a view file from closure-view</a></li>
</ul>

</body>
</html>