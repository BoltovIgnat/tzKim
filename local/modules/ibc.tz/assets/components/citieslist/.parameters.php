<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if( !Loader::includeModule("iblock") ) {
    throw new \Exception('Не загружены модули необходимые для работы компонента');
}

$arInfoBlocks = array();
$arFilter = array('ACTIVE' => 'Y');
// если уже выбран тип инфоблока, выбираем инфоблоки только этого типа
if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}
$rsIBlock = CIBlock::GetList(
    array('SORT' => 'ASC'),
    $arFilter
);
while($iblock = $rsIBlock->Fetch()) {
    $arInfoBlocks[$iblock['ID']] = '['.$iblock['ID'].'] '.$iblock['NAME'];
}

$arInfoBlockSections = array(
    '-' => '[=Выберите=]',
);
$arFilter = array(
    'SECTION_ID' => false, // только корневые разделы
    'ACTIVE' => 'Y' // только активные разделы
);
// если уже выбран тип инфоблока, выбираем разделы, принадлежащие инфоблокам выбранного типа
if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilter['IBLOCK_TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}
// если уже выбран инфоблок, выбираем разделы только этого инфоблока
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arFilter['IBLOCK_ID'] = $arCurrentValues['IBLOCK_ID'];
}
$result = CIBlockSection::GetList(
    array('SORT' => 'ASC'),
    $arFilter
);
while ($section = $result->Fetch()) {
    $arInfoBlockSections[$section['ID']] = '['.$section['ID'].'] '.$section['NAME'];
}

$arComponentParameters = [
    'PARAMETERS' => array(
        'SEF_MODE' => array( 
            'list' => array(
                'NAME' => 'Список задач',
                'DEFAULT' => '',
            ),
            'detail' => array(
                'NAME' => 'Задача',
                'DEFAULT' => 'detail/',
                "VARIABLES" => array("ELEMENT_CODE")
            ),
        ),
        'IBLOCK_TYPE' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Тип инфоблока',
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlockTypes,
            'REFRESH' => 'Y',
        ),
        'IBLOCK_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Инфоблок',
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
            'REFRESH' => 'Y',
        ),
        'CACHE_TIME'  =>  array('DEFAULT' => 3600),
        'CACHE_GROUPS' => array( 
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => 'Учитывать права доступа',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ),
        'USE_CODE_INSTEAD_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Использовать символьный код вместо ID',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
        ),
)];
?>