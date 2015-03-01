<?php

use Tuum\Form\Dates;
use Tuum\Form\Forms;
use Tuum\Form\Lists\Lists;
use Tuum\Form\Lists\YearList;

/** @var Forms $forms */
/** @var Dates $dates */

$forms = $this->service('forms');
$dates = $this->service('dates');


?>
<?= $this->render('layout/header', [
    'title' => 'Form Samples!',
]); ?>
<h1>Form Samples</h1>

<h2>Simple Forms</h2>

<ul>
    <li><?= $forms->text('a-text', 'pre value')->width('20em')->label('a simple text box'); ?></li>
    <li><?= $forms->text('b-text')->width('20em')->placeholder('a required text')->required(); ?></li>
    <li><?= $forms->checkbox('checks', 1)->checked()->label('a check box'); ?></li>
    <li><?= $forms->radio('radio', 1)->checked()->label('a radio button'); ?></li>
</ul>


<h2>Select, Radio Buttons, and Checkboxes</h2>

<dl class="dl-horizontal">
    
    <dt>Select Box</dt>
    <dd><?= $forms->select('select-box',
            Lists::forge(1, 10, 3)->setFormat(function($s) {return 'sel-'.$s;})
        ); ?>
    </dd>
    
    <dt>Check List</dt>
    <dd><?= $forms->checkList('list1', [ 'a' => 'a is the first', 'b' => 'b is the second'], 'b'); ?></dd>

    <dt>Radio List</dt>
    <dd><?= $forms->radioList('list2', [ 'a' => 'a is the first', 'b' => 'b is the second'], 'a'); ?></dd>
    
</dl>

<h2>Composite Date</h2>

<dl class="dl-horizontal">
    
    <dt>Japanese GenGou</dt>
    <dd><?= $dates->selYear('year', YearList::forge(2015, 2017)->setFormat(YearList::formatJpnGenGou())); ?></dd>

    <dt>Year-Month</dt>
    <dd><?= $dates->dateYM('ym'); ?> </dd>

    <dt></dt>
    <dd></dd>

    <dt></dt>
    <dd></dd>

    <dt></dt>
    <dd></dd>

</dl>
