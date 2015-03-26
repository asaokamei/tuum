<?= $this->blockAsSection('sample/sub-menu', 'sub-menu', ['current' => 'welcome']); ?>

<?php

$name = $view->data['name'];

?>

<h1>Welcome to <?= $name; ?></h1>
<p>This is from SampleController::onWelcome(),</p>
<p>and a sample/welcome view file.</p>

<form name="jump" method="get" action="/sample/">
    <input type="text" name="name" value="<?= $name; ?>" />
    <input type="submit" value="say hello" />
</form>

