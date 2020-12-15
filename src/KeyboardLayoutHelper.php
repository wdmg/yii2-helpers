<?php

namespace wdmg\helpers;

/**
 * Yii2 keyboard layout helper
 *
 * @category        Helpers
 * @version         1.4.2
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2020 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseStringHelper;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;

class KeyboardLayoutHelper extends BaseStringHelper
{
    /**
     * @var array, available keyboard layouts grouped under the primary language locale code
     */
    private static $layouts = [
        'en_US' => 'QqWwEeRrTtYyUuIiOoPp{[}]AaSsDdFfGgHhJjKkLl:;"\'|\\ZzXxCcVvBbNnMm<,>.?/~`!1@2#3$4%5^6&7*8(9)0_-+=',
        'ru_RU' => 'ЙйЦцУуКкЕеНнГгШшЩщЗзХхЪъФфЫыВвАаПпРрОоЛлДдЖжЭэ/\\ЯяЧчСсМмИиТтЬьБбЮю,.Ёё!1"2№3;4%5:6?7*8(9)0_-+=',
        'uk_UA' => 'ЙйЦцУуКкЕеНнГгШшЩщЗзХхЇїФфІіВвАаПпРрОоЛлДдЖжЄєҐґЯяЧчСсМмИиТтЬьБбЮю,.~`!1"2№3;4%5:6?7*8(9)0_-+=',
        'be_BY' => 'ЙйЦцУуКкЕеНнГгШшЎўЗзХх\'ФфЫыВвАаПпРрОоЛлДдЖжЭэЁёЯяЧчСсМмІіТтЬьБбЮю?/„“!1"2№3%4:5,6.7;8(9)0_-+=',
        'kk_KZ' => 'ЙйЦцУуКкЕеНнГгШшЩщЗзХхЪъФфЫыВвАаПпРрОоЛлДдЖжЭэЁёЯяЧчСсМмИиТтЬьБбЮю?/[]!"ӘәІіҢңҒғ;,:.ҮүҰұҚқӨөҺһ',
        'pl_PL' => 'QqWwEeRrTtZzUuIiOoPpźó)(AaSsDdFfGgHhJjKkLlŁłęą$;YyXxCcVvBbNnMmś.ń,ć-><§1%2!3?4+5=6:7_8/9"0Żż][',
        'es_ES' => 'QqWwEeRrTtYyUuIiOoPp^``+AaSsDdFfGgHhJjKkLlÑñ¨´´çZzXxCcVvBbNnMm;,:._-><!1"2·3$4%5&6/7(8)9=0?\'¿¡',
        'de_DE' => 'QqWwEeRrTtZzUuIiOoPpÜü*+AaSsDdFfGgHhJjKkLlÖöÄä\'#YyXxCcVvBbNnMm;,:._-><!1"2§3$4%5&6/7(8)9=0?ß`',
        'it_IT' => 'QqWwEeRrTtYyUuIiOoPpéè*+AaSsDdFfGgHhJjKkLlçò°à§ùZzXxCcVvBbNnMm;,:._-><!1"2£3$4%5&6/7(8)9=0?\'^ì',
        'fr_FR' => 'AaZzEeRrTtYyUuIiOoPp¨^^$QqSsDdFfGgHhJjKkLlMm%ù£``wXxCcVvBbNn?,.;/:+=><1&2é3"4\'5(6§7è8!9ç0à°)_-',
        'zn_CH' => 'ＱㄆＷㄊＥㄍＲㄐＴㄔＹㄗＵㄧＩㄛＯㄟＰㄣ『「』」ＡㄇＳㄋＤㄎＦㄑＧㄕＨㄘＪㄨＫㄜＬㄠ：ㄤ“‘｜、ＺㄈＸㄌＣㄏＶㄒＢㄖＮㄙＭㄩ，ㄝ。ㄡ？ㄥ～｀！ㄅ＠ㄉ＃ˇ＄ˋ＄ˋ％ㄓ＾ˊ＆˙＊ㄚ（ㄞ）ㄢ＿ㄦ＋＝',
    ];


    /**
     * Configures keyboard layouts (adds a new one).
     *
     * @param string|null $locale, primary language locale
     * @param null $chars, keyboard layout chars string
     * @return array|null
     */
    public static function setKeyboardLayout($locale = null, $chars = null) {

        if (!isset($chars) || empty($chars) || !is_string($chars)){
            throw new InvalidArgumentException('The `$locale` and `$chars` arguments must be set.');
            return null;
        }

        return (self::$layouts = array_merge(self::$layouts, [
            $locale => $chars
        ]));
    }

    /**
     * Returns the keyboard layout that was requested.
     *
     * @param string|null $locale, primary language locale
     * @param integer|bool $format $format, where 1 - as array, 2 - keycode array, false - as pattern string
     * @return array|array[]|false|mixed|string[]|null, keyboard layout
     */
    public static function getKeyboardLayout($locale = null, $format = false) {

        if (!$locale) {
            throw new InvalidArgumentException('The `$locale` argument must be set.');
            return null;
        }

        if (!isset(self::$layouts[$locale]))
            return null;

        if ($format == 1 || $format == 2) {
            $chars = preg_split('!!u', self::$layouts[$locale], null, PREG_SPLIT_NO_EMPTY);
            if ($format == 1) {
                return $chars;
            } elseif ($format == 2 && is_countable($chars)) {
                $keycodes = [];
                foreach ($chars as $char) {
                    $keycodes[] = \ord($char);
                }
                return $keycodes;
            } else {
                return null;
            }
        } else {
            return self::$layouts[$locale];
        }
    }

    /**
     * Returns all previously configured language keyboard layouts locales.
     *
     * @return array|null, of keyboards locales
     * @throws InvalidConfigException
     */
    public static function getKeyboardLocales() {

        if (!is_array(self::$layouts)) {
            throw new InvalidConfigException('The `KeboardLayoutHelper::$layouts` must be configured.');
            return null;
        }

        return array_keys(self::$layouts);
    }

    /**
     * Returns all previously configured keyboard layouts.
     *
     * @param integer|bool $format, where 1 - as array, 2 - keycode array, false - as pattern string
     * @return array of keyboards layouts
     * @throws InvalidConfigException
     */
    public static function getKeyboardLayouts($format = false) {

        if ($format) {
            $layouts = [];
            $locales = self::getKeyboardLocales();
            foreach ($locales as $locale) {
                $layouts[$locale] = self::getKeyboardLayout($locale, $format);
            }
            return $layouts;
        }

        return self::$layouts;
    }

    /**
     * Fixes an incorrect keyboard layout for incorrect entries.
     *
     * Например,
     * ```php
     *  var_export(\wdmg\helpers\KeyboardLayoutHelper::convertKeyboardLayout('Get ыефкеув with щгк сщтеуте ьфтфпук ыныеуь', 'ru_RU', 'en_US'));
     * ```
     * will be return:
     * ```php
     *  string(43) "Get started with our content manager system"
     * ```
     *
     * @param string|null $string, a string that contains invalid entries
     * @param string|null $from, incorrect language locale
     * @param string|null $to, primary language locale
     * @return string|null, fixed string in correct language locale
     * @throws InvalidConfigException
     */
    public static function convertKeyboardLayout($string = null, $from = null, $to = null) {

        if (!$from || !$to) {
            throw new InvalidArgumentException('The `$from` and `$to` locales argument must be set.');
            return null;
        }


        $chunks = explode(' ', $string);
        $layouts = self::getKeyboardLayouts(1);
        foreach ($chunks as $index => $chunk) {
            if ($from !== $to && $from)
                $chunks[$index] = str_replace($layouts[$from], $layouts[$to], $chunks[$index]);
        }

        return implode(' ', $chunks);
    }

}