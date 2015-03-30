<?php
use Tuum\Web\Viewer\View;

/** @var View $view */

$inputs   = $view->inputs;
$data     = $view->data;
$basePath = $data['basePath'];
$tasks    = $data->withKey('tasks');

?>

<?php $this->blockAsSection('tasks/sub-menu', 'sub-menu', ['current' => 'new', 'base' => $view->data->basePath]); ?>

<h1>Task Demo</h1>

<h2>create a new task</h2>

    <form name="add" method="post" action="">
        <?= $data->hiddenTag('_token'); ?>
        <dl>
            
            <dt>task</dt>
            <dd>
                <input type="text" name="task" value="<?= $inputs->get('task', $data['task']);?>" placeholder="add a new task..." style="width: 40em;"/>
                <?= $view->errors->text('task'); ?>
            </dd>
            
            <dt>done by</dt>
            <dd>
                <label><input type="date" name="done_by" value="<?= $inputs->get('done_by', $data['done_by']); ?>" /></label>
                <?= $view->errors->text('done_by'); ?>
            </dd>
            
            <dt></dt>
            <dd><input type="submit" value="add task" class="btn btn-primary"/></dd>

        </dl>
    </form>

<h3>adding a new task without CsRf Token</h3>

    <p>This form does not have CsRf token. should return forbidden error.</p>
    <form name="add" method="post" action="">
        <dl>

            <dt>task</dt>
            <dd>
                <input type="text" name="task" value="<?= $inputs->get('task', $data['task']);?>" placeholder="add a new task..." style="width: 40em;"/>
                <?= $view->errors->text('task'); ?>
            </dd>

            <dt>done by</dt>
            <dd>
                <label><input type="date" name="done_by" value="<?= $inputs->get('done_by', $data['done_by']); ?>" /></label>
                <?= $view->errors->text('done_by'); ?>
            </dd>

            <dt></dt>
            <dd><input type="submit" value="add task" class="btn btn-primary"/></dd>

        </dl>
    </form>


