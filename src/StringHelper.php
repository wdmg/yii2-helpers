<?php

namespace wdmg\helpers;

/**
 * Yii2 String Helper
 *
 * @category        Helpers
 * @version         1.4.8
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseStringHelper;
use yii\base\InvalidArgumentException;

class StringHelper extends BaseStringHelper
{
    /**
     * Formats the text ending of a numeric value
     *
     * @param $input
     * @param int $decimals
     * @param bool $uppercase
     * @return string
     */
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

    /**
     * Cuts (replaces) html entities from a substring
     *
     * @param $input
     * @param string $tags
     * @param string $replacement
     * @return mixed|string|string[]|null
     */
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
            $input = preg_replace("#<\s*\/?(".$tags.")\s*[^>]*?>#im", $replacement, $input);

        $input = str_replace("\n", ' ', $input);
        $input = preg_replace('|[\s]+|s', ' ', $input);
        return $input;
    }

    /**
     * Truncates a string to a given length without truncating words
     *
     * @param $input
     * @param int $start
     * @param int $end
     * @param bool $cut
     * @param string $ending
     * @return string|null
     */
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

    /**
     * Generate UUID (Universally Unique Identifier) string based on format and lenght
     *
     * @param int $lenght
     * @param string $format
     * @param bool $upperCase
     * @return bool|string|null
     * @throws \Exception
     */
    public static function genUUID($lenght = 32, $format = '%s%s-%s%s-%s%s-%s-%s', $upperCase = true) {

        if (!is_integer($lenght))
            return null;

        $data = PHP_MAJOR_VERSION < 7 ? openssl_random_pseudo_bytes(16) : random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // Set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // Set bits 6-7 to 10
        $base = bin2hex($data);
        $uuid = substr(($upperCase) ? strtoupper($base) : $base, 0, ($lenght > 32) ? 32 : $lenght);

        if ($format)
            return vsprintf($format, str_split($uuid, 4));
        else
            return $uuid;

    }

    /**
     * Checks if a string is a serialized data
     *
     * @param $string
     * @return bool, `true` if string is serialized data
     */
    public static function is_serialized($string) {

        if (!is_string($string) || empty($string))
            return false;

        $string = trim($string);
        if ('N;' == $string)
            return true;

        if (!preg_match('/^([adObis]):/', $string, $matches))
            return false;

        switch ($matches[1]) {
            case 'a' :
            case 'O' :
            case 's' :
                if (preg_match("/^{$matches[1]}:[0-9]+:.*[;}]\$/s", $string))
                    return true;

                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if (preg_match("/^{$matches[1]}:[0-9.E-]+;\$/", $string))
                    return true;

                break;
            default:
                return false;
        }

    }

    /**
     * Checks if a string is a json data
     *
     * @param $string
     * @return bool, `true` if string is json data
     */
    public static function is_json($string) {

        if (!is_string($string) || empty($string))
            return false;

        return !preg_match('/[^,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t]/', preg_replace('/"(\\.|[^"\\\\])*"/', '', $string));
    }

    /**
     * Checks if a string is a regex pattern
     *
     * @param $string
     * @return bool, `true` if string is regex pattern
     */
    public static function is_regexp($string) {

        if (!is_string($string) || empty($string))
            return false;

        if (preg_match("/^\/[\s\S]+\/[a-zA-Z]{0,6}+$/", $string))
            return true;

        return false;
    }

    /**
     * Checks if a string is a domain name
     *
     * @param $string
     * @return bool|mixed, `true` if string is domain name
     */
    public static function is_domain($string) {

        if (!is_string($string) || empty($string))
            return false;

        if (preg_match("/^[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,})$/", $string))
            return (filter_var($string, FILTER_VALIDATE_DOMAIN));

        return false;
    }

    /**
     * Checks if a string is a URL address
     *
     * @param $string
     * @return bool|mixed, `true` if string is URL address
     */
    public static function is_url($string) {

        if (!is_string($string) || empty($string))
            return false;

        if (preg_match("/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/", $string))
            return (filter_var($string, FILTER_VALIDATE_URL));

        return false;
    }

    /**
     * Checks if a string is a Email address
     *
     * @param $string
     * @return bool|mixed, `true` if string is Email address
     */
    public static function is_email($string) {

        if (!is_string($string) || empty($string))
            return false;

        return (filter_var($string, FILTER_VALIDATE_EMAIL));
    }

    /**
     * @param $string
     * @return bool|mixed, `true` if string is IP address
     */
    public static function is_ip($string) {

        if (!is_string($string) || empty($string))
            return false;

        return (filter_var($string, FILTER_VALIDATE_IP));
    }

    /**
     * Checks if a string is a MAC address
     *
     * @param $string
     * @return bool|mixed, `true` if string is MAC address
     */
    public static function is_mac($string) {

        if (!is_string($string) || empty($string))
            return false;

        return (filter_var($string, FILTER_VALIDATE_MAC));
    }

    /**
     * Checks if a string is a geo address
     *
     * @param $string
     * @return bool|mixed, `true` if string is GEO location (lat/lng) address
     */
    public static function is_geo($string) {

        if (!is_string($string) || empty($string))
            return false;

        if (preg_match('/^([-]?[1-9]?[0-9]\.\d+|[-]?90\.0+?)(.)([-]?1[0-7][0-9]\.\d+|[-]?[1-9]?[0-9]\.\d+|[-]?180\.0+?)$/', $string))
            return true;

        return false;
    }

    /**
     * Converts string of size to bytes in integer
     *
     * @param string $size with suffix, like: 10Kb, 10M, 2Gb
     * @return int
     */
    public static function sizeToBytes($size) {
        switch (\mb_strtolower(\preg_replace('/\PL/u', '', \mb_substr($size, -2)))) {

            case 'k':
            case 'kb':
                return (int)$size * 1024;

            case 'm':
            case 'mb':
                return (int)$size * 1048576;

            case 'g':
            case 'gb':
                return (int)$size * 1073741824;

            case 't':
            case 'tb':
                return (int)$size * 1099511627776;

            default:
                return (int)$size;
        }
    }

    /**
     * Converts integer of bytes to size in string
     *
     * @param integer of size in bytes
     * @return string of size with suffix, like: 10Kb, 10M, 2Gb
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = ['bytes', 'Kb', 'Mb', 'Gb', 'Tb', 'Eb', 'Zb', 'Yb'];
        $bytes = max((int)$bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        //$bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public static function sizeFormatNormalize($size, $precision = 2) {
        return self::formatBytes(self::sizeToBytes($size), $precision);
    }

    public static function genLettersRange($end, $start = '', $letters = null) {
        $range = [];
        $length = mb_strlen($end);

        if (is_null($letters)) {
            $letters = range('A', 'Z');
        } else if (!is_array($letters) && is_string($letters)) {
            $letters = preg_split('//u', $letters, -1, PREG_SPLIT_NO_EMPTY);
        }

        foreach ($letters as $letter) {
            $range[] = $start . $letter;

            if (($start . $letter) == $end)
                return $range;
        }

        foreach ($range as $letter) {
            if (!in_array($end, $range) && mb_strlen($letter) < $length) {
                $range = array_merge($range, self::genLettersRange($end, $letter, $letters));
            }
        }

        return $range;
    }

    /**
     * Splits a string into substrings with a string termination
     *
     * @param $str
     * @param int $length
     * @param string $break
     * @param bool $cut
     * @return string
     */
    public static function mb_wordwrap($str, $length = 75, $break = "\n", $cut = false) {
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