<?php

namespace wdmg\helpers;

/**
 * Yii2 short integer helper
 *
 * @category        Helpers
 * @version         1.0.0
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseStringHelper;

class StringHelper extends BaseStringHelper
{
    public static function integerAmount($input, $decimals = 2, $uppercase = false) {

        static::initI18N('app/helpers');

        $number = number_format(intval($input), $decimals);
        $decimals_count = substr_count($number, ',');
        if($decimals_count != '0') {
            if($decimals_count == '1') {
                return substr($number, 0, -4) . ($uppercase ? 'K' : 'k');
            } else if ($decimals_count == '2') {
                return substr($number, 0, -8) . ($uppercase ? 'M' : 'mil');
            } else if($decimals_count == '3') {
                return substr($number, 0, -12) . ($uppercase ? 'B' : 'bil');
            } else if($decimals_count == '4') {
                return substr($number, 0, -16) . ($uppercase ? 'T' : 'tril');
            } else {
                return $number;
            }
        } else {
            return $input;
        }
    }

    /**
     * Initialize translations
     */
    public static function initI18N($category)
    {
        if (!empty(Yii::$app->i18n->translations['app/helpers']))
            return;

        Yii::$app->i18n->translations['app/helpers'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/wdmg/yii2-helpers/messages',
        ];
    }
}

?>