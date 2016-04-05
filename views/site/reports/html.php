<?php
use app\components\LanguageHelper;

$arrayParams = ['MainSearch' => ['region' => $region]];
$indexLink = LanguageHelper::getLinks('index', $arrayParams);

$arrayParams['excel'] = true;
$excelLink = LanguageHelper::getLinks('excel', $arrayParams);
?>
<h3><a href="<?= $indexLink['url']; ?>"><?= $indexLink['label']; ?></a></h3>
<button class="btn btn-default"><a href="<?= $excelLink['url']; ?>"><?= $excelLink['label']; ?></a></button>
<hr>
<ul class="nav nav-tabs">
    <?
    $first = true;
    foreach ($tabs as $tab) { ?>
        <li role="presentation" class="<?= ($first) ? 'active' : ''; ?>"><a href="#<?= $tab['id']; ?>" role="tab"
                                                                            data-toggle="tab"><?= $tab['value']; ?></a>
        </li>
        <? $first = false;
    } ?>
</ul>
<? $first = true; ?>
<div class="tab-content">
    <?php foreach ($tabs as $tab) { ?>
        <div class="tab-pane <?= ($first) ? 'active' : ''; ?>" id="<?= $tab['id']; ?>">
            <?= $tables[$tab['view']]; ?>
        </div>
        <?php $first = false;
    } ?>
</div>