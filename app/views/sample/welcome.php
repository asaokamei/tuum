<?php
use Tuum\Web\Viewer\View;

/** @var \Tuum\Web\Viewer\View $view */

$name = $view->data['name'];

?>
<?= $this->render('layout/header', [
    'title' => 'Welcome to ' . $name,
]); ?>
<h1>Welcome to <?= $name; ?></h1>
<p>This is from SampleController::onWelcome(),</p>
<p>and a sample/welcome view file.</p>

<form name="jump" method="get" action="/sample/">
    <input type="text" name="name" value="<?= $name; ?>" />
    <input type="submit" value="say hello" />
</form>

<?= $this->render('layout/footer'); ?>