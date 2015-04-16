<?php
$current = isset($current) ? $current : 'index';
$activate = function($case) use($current) {
    return $case === $current ? ' class="active"': '';
}
?>
<p class="nav-header">Documentation</p>
<ul class="nav nav-pills nav-stacked">
    <li role="presentation" <?= $activate('index')?>><a href="/docs/index.php" >document</a></li>
</ul>

<p class="nav-header">Quick Start</p>
<ul class="nav nav-pills nav-stacked">
    <li<?= $activate('install')?>><a href="#" >Install</a></li>
    <li<?= $activate('quick-route')?>><a href="#" >Routing</a></li>
    <li<?= $activate('quick-controller')?>><a href="#" >View and Controller</a></li>
</ul>

<p class="nav-header">Manual</p>
<ul class="nav nav-pills nav-stacked">
    <li<?= $activate('quick-controller')?>><a href="#" >Middleware</a></li>
    <li<?= $activate('quick-controller')?>><a href="#" >View</a></li>
    <li<?= $activate('quick-controller')?>><a href="#" >Form Helper</a></li>
    <li<?= $activate('quick-controller')?>><a href="#" >Router</a></li>
    <li<?= $activate('quick-controller')?>><a href="#" >Controller</a></li>
</ul>