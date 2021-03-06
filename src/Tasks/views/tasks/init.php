<?php
use Tuum\Web\View\Value;

/** @var Value $view */

$inputs   = $view->inputs;
$data     = $view->data;
$basePath = $data['basePath'];

?>

<style type="text/css">
    .init-box {
        text-align: center;
        border: 1px solid #EECCCC;
        background-color: #f8f0f0;
        border-radius: 1em;
        padding: 2em;
        margin: 1em;
    }
</style>

<h1>Task Demo / initialize tasks</h1>

    <form name="add" method="post" action="">
        <?= $data->hiddenTag('_token'); ?>
        <p>initialize task data with default task.</p>
        <div class="init-box">
            <p class="text-warning">Warning: current tasks will be replaced. </p>
            <input type="submit" value="initialize tasks" class="btn btn-lg btn-danger"/>
        </div>
    </form>



