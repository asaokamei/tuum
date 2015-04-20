<?php
$current = isset($current) ? $current : 'index';
$activate = function($case) use($current) {
    return $case === $current ? ' class="active"': '';
}
?>

<ul class="nav nav-pills nav-stacked">
    <li role="presentation" <?= $activate('index')?>><a href="/docs/index" >Document Top</a></li>
</ul>

<p class="nav-header">Quick Start</p>
<ul class="nav nav-pills nav-stacked">
    <li<?= $activate('quick-install')?>><a href="#" >Install</a></li>
    <li<?= $activate('quick-route')?>><a href="#" >Routing</a></li>
    <li<?= $activate('quick-controller')?>><a href="#" >View and Controller</a></li>
</ul>

<p class="nav-header">Manual</p>
<ul class="nav nav-pills nav-stacked">
    <li<?= $activate('manual-middleware')?>><a href="#" >Middleware</a></li>
    <li<?= $activate('manual-view')?>><a href="#" >View</a></li>
    <li<?= $activate('manual-forms')?>><a href="#" >Form Helper</a></li>
    <li<?= $activate('manual-router')?>><a href="#" >Router</a></li>
    <li<?= $activate('manual-controller')?>><a href="#" >Controller</a></li>
    <li<?= $activate('manual-performance')?>><a href="#" >Performance</a></li>
</ul>