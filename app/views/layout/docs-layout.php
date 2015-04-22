<?php
/**
 * This is an interim layout for Documents rendered by DocView.
 */

/** @var \Tuum\View\Renderer $this */
/** @var \Tuum\Web\View\Value $view */

$file_name   = isset($file_name) ? $file_name: 'index';
$titleList   = [
    'index'            => 'Documents Top',
    'quick-install'    => 'Installation',
    'quick-routing'    => 'Routes File',
    'quick-controller' => 'Controller and View',
    '' => '',
];
$bread_title = isset($titleList[$file_name]) ? $titleList[$file_name] : 'Documents';
$activate    = function($case) use($file_name) {
    return $case === $file_name ? ' class="active"': '';
};

/**
 * set up the master layout. 
 */
$this->setLayout('layout/layout'); 
$view->data['current'] = 'maps'; 
?>

<?php
/**
 * start of BreadCrumb section.
 */
$this->startSection() 
?>
<li><a href="/docs/index" >Documents</a></li>
<li class="active"><?= $bread_title ?></li>
<?php $this->endSectionAs('breadcrumb'); ?>

<?php
/**
 * start of sub-menu section.
 */
$this->startSection() 
?>
<ul class="nav nav-pills nav-stacked">
    <li role="presentation" <?= $activate('index')?>><a href="/docs/index" >Document Top</a></li>
</ul>

<p class="nav-header">Quick Start</p>
<ul class="nav nav-pills nav-stacked">
    <li<?= $activate('quick-install')?>><a href="/docs/quick-install" >Installation</a></li>
    <li<?= $activate('quick-routing')?>><a href="/docs/quick-routing" >Routes File</a></li>
    <li<?= $activate('quick-controller')?>><a href="/docs/quick-controller" >Controller and View</a></li>
</ul>

<p class="nav-header">Manual</p>
<ul class="nav nav-pills nav-stacked">
    <li<?= $activate('manual-http')?>><a href="#" >Request and Response</a></li>
    <li<?= $activate('manual-middleware')?>><a href="#" >Middleware</a></li>
    <li<?= $activate('manual-view')?>><a href="#" >View</a></li>
    <li<?= $activate('manual-forms')?>><a href="#" >Form Helper</a></li>
    <li<?= $activate('manual-router')?>><a href="#" >Router</a></li>
    <li<?= $activate('manual-controller')?>><a href="#" >Controller</a></li>
    <li<?= $activate('manual-performance')?>><a href="#" >Performance</a></li>
</ul>
<?php $this->endSectionAs('sub-menu'); ?>

<?=
/**
 * output contents.
 */
$this->getContent();?>

