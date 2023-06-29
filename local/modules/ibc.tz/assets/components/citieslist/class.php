<?
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use Ibc\Tz\IbcTzHelper;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class ExampleCompSimple extends CBitrixComponent {

    private function _checkModules() {
        if (!Loader::includeModule('ibc.tz'))
            return true;
    }

    public function executeComponent() {
        $this->_checkModules();
        $this->arResult['items'] = IbcTzHelper::getCitiesByParams([]);
        $this->arResult['income'] = IbcTzHelper::getSortedCitiesByParams([],array('income' => 'DESC'));
        $this->arResult['costs'] = IbcTzHelper::getSortedCitiesByParams([],array('costs' => 'DESC'));
        $this->arResult['amountcitises'] = IbcTzHelper::getSortedCitiesByParams([],array('amountcitises' => 'DESC'));
        $this->includeComponentTemplate('list');
    }
}
?>