<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Ibc\Tz\CitiesTable;

Loc::loadMessages(__FILE__);

class ibc_tz extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'ibc.tz';
        $this->MODULE_NAME = '!Модуль tz';
        $this->MODULE_DESCRIPTION =  'Модуль tz';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = 'ibc';
        $this->PARTNER_URI = 'ibc';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();

        copyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/ibc.tz/assets/cities', $_SERVER["DOCUMENT_ROOT"], true, true);
        copyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/ibc.tz/assets/components', $_SERVER["DOCUMENT_ROOT"].'/local/components/ibc', true, true);
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        
        DeleteDirFilesEx("/cities");
        DeleteDirFilesEx("/local/components/ibc/citieslist");
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {

            CitiesTable::getEntity()->createDbTable();

            $income = CitiesTable::createObject();
            $income->set('name', 'City1');
            $income->set('income', 100);
            $income->set('costs', 100);
            $income->set('amountcitises', 100);

            $income->save();
            
            $income = CitiesTable::createObject();
            $income->set('name', 'City2');
            $income->set('income', 200);
            $income->set('costs', 200);
            $income->set('amountcitises', 200);

            $income->save();

            $income = CitiesTable::createObject();
            $income->set('name', 'City3');
            $income->set('income', 300);
            $income->set('costs', 300);
            $income->set('amountcitises', 300);

            $income->save();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();

            $connection->dropTable(CitiesTable::getTableName());


        }
    }
    
}
