<?php

namespace wdmg\helpers;

/**
 * Yii2 date and time helper
 *
 * @category        Helpers
 * @version         1.1.1
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseFormatConverter;

class DateAndTime extends BaseFormatConverter
{

    public static function diff($datetime1 = null, $datetime2 = null, $options = [])
    {
        //@TODO: https://www.yiiframework.com/doc/api/2.0/yii-i18n-formatter#asRelativeTime()-detail

        static::initI18N('app/helpers');
        $default = [
            'layout' => '<span class="{class}">{datetime}</span>',
            'inpastClass' => 'field-inpast-datetime',
            'futureClass' => 'field-future-datetime'
        ];
        $options = array_merge($default, $options);

        if(!$datetime1)
            return;

        if($datetime2)
            $datenow = new \DateTime($datetime2);
        else
            $datenow = new \DateTime("now");

        $dateend = new \DateTime($datetime1);
        $interval = $datenow->diff($dateend);

        $content = Yii::t(
            'app/helpers',
            '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
            $interval
        );

        $layout = $options['layout'];
        if($interval->invert == 1)
            $layout = str_replace('{class}', $options['inpastClass'], $layout);
        else
            $layout = str_replace('{class}', $options['futureClass'], $layout);

        return str_replace('{datetime}', $content, $layout);

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