<?php

namespace Ibc\Tz;

use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

use Bitrix\Main\Diag\Debug;
use Ibc\Tz\CitiesTable;


Loc::loadMessages(__FILE__);

class IbcTzHelper
{


    public static function likeArticle($params)
    {
        /*$infoparams = [];
        $infoparams['articleid'] = $params['articleid'];
        $infoparams['userid'] = $params['userid'];

        $arResult = self::getInfolikeArticle($infoparams);

        if (empty($arResult)){

            $income = LikeTable::createObject();
            $income->set('articleid', $params['articleid']);
            $income->set('userid', $params['userid']);
            $income->set('like', $params['like']);

            $income->save();

        }else{

            LikeTable::update($arResult['id'], $params);

        }

        return $params;*/

    }

    public static function getCitiesByParams($params)
    {

        $arResult = [];
        //AddMessage2Log( print_r($params,1));
        $dbEnums = CitiesTable::getList([
            'select' => ['*'],
            'filter' => $params
        ]);

        while($arEnum = $dbEnums->fetch()) {
            $arResult[] = $arEnum;
        }

        return $arResult;

    }

    public static function getSortedCitiesByParams($params,$sorted)
    {

        $arResult = [];
        //AddMessage2Log( print_r($params,1));
        $dbEnums = CitiesTable::getList([
                                            'order' => $sorted,
                                            'select' => ['*'],
                                            'filter' => $params
                                        ]);
        $rating = 1;
        while($arEnum = $dbEnums->fetch()) {
            $arEnumX = $arEnum;
            $arEnumX['rating'] = $rating;
            $arResult[$arEnum['id']] = $arEnumX;
            $rating++;
        }

        return $arResult;

    }
}
