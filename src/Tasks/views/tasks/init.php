<?php
use Tuum\Web\Viewer\View;

/** @var View $view */

$inputs   = $view->inputs;
$data     = $view->data;
$basePath = $data['basePath'];
$tasks    = $data->withKey('tasks');

?>

<?php $this->blockAsSection('tasks/sub-menu', 'sub-menu', ['current' => 'init', 'base' => $view->data->basePath]); ?>

<h1>Task Demo</h1>

<h2>initialize tasks</h2>

    <form name="add" method="post" action="">
        <?= $data->hiddenTag('_token'); ?>
        <p>initialize task data with default task.</p>
        <input type="submit" value="initialize tasks" class="btn btn-primary"/>
    </form>



