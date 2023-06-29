<?

?>

<div class="ibc-container">
    <div class="table-header-row ibc-col-1">Название</div>
    <div class="table-header-row ibc-col-2">Доходы общие</div>
    <div class="table-header-row ibc-col-3">Расходы общие</div>
    <div class="table-header-row ibc-col-4">Количество жителей</div>
    <div class="table-header-row ibc-col-5">Место в рейтинге по количеству жителей</div>
    <div class="table-header-row ibc-col-6">Место в рейтинге по средним доходам населения</div>
    <div class="table-header-row ibc-col-7">Место в рейтинге по средним расходам населения</div>
    <?foreach($arResult['items'] as $arItem):?>
        <div class="table-row ibc-col-1"><?=$arItem['name']?></div>
        <div class="table-row ibc-col-2"><?=$arItem['income']?></div>
        <div class="table-row ibc-col-3"><?=$arItem['costs']?></div>
        <div class="table-row ibc-col-4"><?=$arItem['amountcitises']?></div>
        <div class="table-row ibc-col-5"><?=$arResult['amountcitises'][$arItem['id']]['rating']?></div>
        <div class="table-row ibc-col-6"><?=$arResult['income'][$arItem['id']]['rating']?></div>
        <div class="table-row ibc-col-7"><?=$arResult['costs'][$arItem['id']]['rating']?></div>
    <?endforeach;?>
</div>


