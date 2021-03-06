<?php
use Tuum\Form\Lists\Lists;
use Tuum\Form\Lists\MonthList;
use Tuum\Form\Lists\YearList;
use Tuum\Web\View\Value;

/** @var \Tuum\View\Renderer $this */
/** @var Value $view */

$forms = $view->forms;
$dates = $view->dates->withClass('form-control')->resetWidth();
$data  = $view->data;

?>

<?php $this->blockAsSection('sample/sub-menu', 'sub-menu', ['current' => 'forms']); ?>

<?php $this->section->start() ?>
<li><a href="<?= $data->basePath; ?>?name=Controller Sample" >Controller Sample</a></li>
<li class="active">Forms Sample</li>
<?php $this->section->saveAs('breadcrumb'); ?>

<h1>Form Samples</h1>

<h2>Simple Forms</h2>

<ul>
    <li><?= $forms->text('a-text', 'pre value')->width('20em')->label('a simple text box'); ?></li>
    <li>
        <?= $forms->label('label for text-area', 'b-text'); ?>
        <?= $forms->textArea('b-text')->width('20em')->placeholder('a required text area')->required()->id(); ?>
    </li>
    <li><?= $forms->checkbox('checks', 1)->checked()->label('a check box'); ?></li>
    <li><?= $forms->radio('radio', 1)->checked()->label('a radio button'); ?></li>
    <li>
        <?= $forms->open()->method('post')->uploader(); ?>
        <?= $forms->submit('a post form'); ?>
        <?= $forms->reset('a reset/cancel button'); ?>
        <?= $forms->close(); ?>
    </li>
    <li>
        <?= $forms->open()->method('put')->uploader(); ?>
        <?= $forms->submit('a put form has a hidden tag sending "put" method'); ?>
        <?= $forms->close(); ?>
    </li>
</ul>


<h2>Select, Radio Buttons, and Checkboxes</h2>

<dl class="dl-horizontal">
    
    <dt>Select Box</dt>
    <dd><?= $forms->select('select-box',
            Lists::forge(1, 10, 3)->setFormat(function($s) {return 'selecting #'.$s;})
        )->class('form-control'); ?>
    </dd>
    
    <dt>Radio List</dt>
    <dd><?= $forms->radioList('list2', [ 'a' => 'a is the first', 'b' => 'b is the second'], 'a'); ?></dd>

    <dt>Check List</dt>
    <dd><?= $forms->checkList('list1', [ 'a' => '#Aaa', 'b' => '#Bbb', 'c' => '#Ccc', 'd' => '#Ddd' ], ['a', 'c']); ?></dd>

    <dt>Another List</dt>
    <dd><?php
        $list = [ 'a' => '#Aaa', 'b' => '#Bbb', 'c' => '#Ccc', 'd' => '#Ddd' ];
        $checks = $forms->checkList('list1', $list, ['b', 'd']);
        foreach($list as $val => $label) {
            $box = $checks->getInput($val);
            echo '◀<label>',$box,'Val:',$val,', Label:',$label,'</<label>▶ ';
        }
        ?></dd>

</dl>

<h2>Composite Date</h2>

<dl class="dl-horizontal">

    <dt>Year/Month</dt>
    <dd><?= $dates->dateYM('ym', null, 'Year%1$s / Month%2$s')->head('---'); ?></dd>

    <dt>Japanese GenGou</dt>
    <dd><?= $dates
            ->useYear(YearList::forge(2015, 2017)
                ->setFormat(YearList::formatJpnGenGou()))
            ->selYear('year'); ?></dd>

    <dt>Month Day, Year</dt>
    <dd><?= $dates
            ->useYear(YearList::forge(2012, 2010))
            ->useMonth(MonthList::forge()->setFormat(MonthList::formatFullText()))
            ->dateYMD('mdY', '2012-03-04')
            ->format('%2$s %3$s, %1$s'); ?></dd>

    <dt></dt>
    <dd></dd>

    <dt></dt>
    <dd></dd>

</dl>
