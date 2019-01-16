<?php

namespace wdmg\helpers;
use Yii;
use yii\helpers\BaseFormatConverter;

class DateTime extends BaseFormatConverter
{

    public static function diff($datetime1 = null, $datetime2 = null, $options = [])
    {
        $default = [
            'layout' => '<span class="{class}">{datetime}</span>',
            'inpastClass' => 'inpast-datetime',
            'futureClass' => 'future-datetime',
            'i18n_category' => 'app/*',
            'i18n_language' => Yii::$app->language
        ];
        $options = array_merge($default, $options);


        if(!$datetime1 || !$datetime2)
            return;

        if($datetime2)
            $datenow = new \DateTime($datetime2);
        else
            $datenow = new \DateTime("now");

        $dateend = new \DateTime($datetime1);
        $interval = $datenow->diff($dateend);

        $content = Yii::t(
            $options['i18n_category'],
            '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
            $interval,
            $options['i18n_language']
        );

        $layout = $options['layout'];
        if($interval->invert == 1)
            $layout = str_replace('{class}', $options['inpastClass'], $layout);
        else
            $layout = str_replace('{class}', $options['futureClass'], $layout);

        return str_replace('{datetime}', $content, $layout);

    }
}
?>