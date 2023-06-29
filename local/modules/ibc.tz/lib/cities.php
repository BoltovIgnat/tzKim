<?php

namespace Ibc\Tz;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CitiesTable extends DataManager
{
    public static function getTableName()
    {
        return 'ibc_cities';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('id', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => 'id',
            )),
            new StringField('name', array(
                'required' => false,
                'title' => 'Название',
            )),
            new IntegerField('income', array(
                'required' => false,
                'title' => 'Доходы',
            )),
            new IntegerField('costs', array(
                'required' => false,
                'title' => 'Расходы',
            )),
            new IntegerField('amountcitises', array(
                'required' => false,
                'title' => 'Количество жителей',
            )),
        );
    }
}
