<?php
/** @var \Tuum\View\Renderer $this */
/** @var \Tuum\Web\View\Value $view */

$current = basename($view->uri->getPath());
$current = isset($current) ? $current : 'index';
$current = $current === 'license' ? 'index' : $current;

$titleList = [
    'index' => 'Documents Top',
    'quick-install' => 'Installation',
    'quick-routing' => 'Routes File',
    'quick-controller' => 'Controller and View',
    '' => '',
];
$title = isset($titleList[$current]) ? $titleList[$current] : 'Documents';

?>

<?php $this->setLayout('layout/layout'); ?>

<?php $view->data['current'] = 'maps'; ?>

<?php $this->blockAsSection('layout/docs-sub-menu', 'sub-menu', ['current'=>$current]); ?>

<?php $this->startSection() ?>
<li><a href="/docs/index" >Documents</a></li>
<li class="active"><?= $title ?></li>
<?php $this->endSectionAs('breadcrumb'); ?>

<?= $this->getContent();?>

