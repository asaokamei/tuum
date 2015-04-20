<?php /** @var \Tuum\View\Renderer $this */ ?>
<?php /** @var \Tuum\Web\View\Value $view */ ?>

<?php $this->setLayout('layout/layout'); ?>

<?php $view->data['current'] = 'maps'; ?>

<?php $this->blockAsSection('layout/docs-sub-menu', 'sub-menu', ['current'=>'index']); ?>

<?php $this->startSection() ?>
<li><a href="/docs/index" >Documents</a></li>
<li class="active">top</li>
<?php $this->endSectionAs('breadcrumb'); ?>

<?= $this->getContent();?>

