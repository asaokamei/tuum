<?php
use Tuum\View\Renderer;
use Tuum\Web\View\Value;

/** @var Renderer $this */
/** @var Value $view */

$page_selection = [3 => 3, 5 => 5, 10 => 10, 20 => 20];
?>

<h1>Pagination</h1>

<p>This page demonstrates the outcome of the WScore/Paginate package. </p>

<h3>PaginateFull class</h3>

<?= $view->data->page1; ?>

<h3>PaginateMini class</h3>

<?= $view->data->page2; ?>

<h2>Changing Per Page</h2>

<div class="container" style="padding-left: 2em;">

    <p>Please change the number of list per page below to see how pagination changes. </p>
    <form class="form">

        <div class="form-group">
            <label for="_limit">row per page</label>
            <?= $view->forms->select('_limit', $page_selection)
                ->value($view->data->_limit)
                ->class('form-control')->style('width:5em'); ?>
            <input type="submit" value="set per page" class="btn btn-primary">
        </div>

    </form>

</div>

