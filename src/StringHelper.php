<?php

namespace wdmg\helpers;

/**
 * Yii2 short integer helper
 *
 * @category        Helpers
 * @version         1.2.2
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseStringHelper;
use yii\base\InvalidArgumentException;

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
                return substr($number, 0, -8) . ($uppercase ? 'M' : ' mill.');
            } else if($decimals_count == '3') {
                return substr($number, 0, -12) . ($uppercase ? 'B' : ' bill.');
            } else if($decimals_count == '4') {
                return substr($number, 0, -16) . ($uppercase ? 'T' : ' trill.');
            } else {
                return $number;
            }
        } else {
            return $input;
        }
    }


    public static function stripTags($input, $tags = "a|strong|b|p", $replacement = '') {

        static::initI18N('app/helpers');

        if (empty($input)) {
            throw new InvalidArgumentException('The `$input` argument must not be empty.');
            return null;
        }

        if (!is_string($tags)) {
            throw new InvalidArgumentException('The `$tags` argument must be a string.');
            return null;
        }

        if (!is_string($replacement)) {
            throw new InvalidArgumentException('The `$replacement` argument must be a string.');
            return null;
        }

        if (empty($tags))
            $input = preg_replace("#<\s*\/?\s*[^>]*?>#im", $replacement, $input);
        else
            $input = preg_replace("#<\s*\/?(".$strip_tags.")\s*[^>]*?>#im", $replacement, $input);

        $input = str_replace("\n", ' ', $input);
        $input = preg_replace('|[\s]+|s', ' ', $input);
        return $input;
    }

    public static function stringShorter($input, $start = 55, $end = 0, $cut = true, $ending = '…') {

        static::initI18N('app/helpers');

        if (empty($input)) {
            throw new InvalidArgumentException('The `$input` argument must not be empty.');
            return null;
        }

        if ($start < 0 || $end < 0) {
            throw new InvalidArgumentException('The `$start` or `$end` argument must not be less than zero.');
            return null;
        }

        if (strlen($input) > $start && $end == 0) {
            $string = explode("\n", self::mb_wordwrap($input, $start, "\n", $cut));
            $input = $string[0] . $ending;
        } else if (strlen($input) > $start && $end > 0) {
            $start_string = explode("\n", self::mb_wordwrap($input, $start, "\n", $cut));
            $end_string = explode("\n", self::mb_wordwrap(strrev($input), $end, "\n", $cut));
            $input = $start_string[0] . $ending . " " . strrev($end_string[0]);
        }

        return $input;
    }

    private static function mb_wordwrap($str, $length = 75, $break = "\n", $cut = false) {
        $lines = explode($break, $str);
        foreach ($lines as &$line) {
            $line = rtrim($line);
            if (mb_strlen($line) <= $length) {
                continue;
            }

            $words = explode(' ', $line);
            $line = '';
            $actual = '';
            foreach ($words as $word) {
                if (mb_strlen($actual . $word) <= $length) {
                    $actual .= $word . ' ';
                } else {
                    if ($actual != '') {
                        $line .= rtrim($actual).$break;
                    }
                    $actual = $word;
                    if ($cut) {
                        while (mb_strlen($actual) > $length) {
                            $line .= mb_substr($actual, 0, $length).$break;
                            $actual = mb_substr($actual, $length);
                        }
                    }
                    $actual .= ' ';
                }
            }
            $line .= trim($actual);
        }
        return implode($break, $lines);
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