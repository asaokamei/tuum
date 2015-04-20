<?php /** @var \Tuum\View\Renderer $this */ ?>
<?php /** @var \Tuum\Web\View\Value $view */ ?>

<?php $this->setLayout('layout/docs-layout'); ?>

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
