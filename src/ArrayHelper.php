<?php

namespace wdmg\helpers;

/**
 * Yii2 custom array helper
 *
 * @category        Helpers
 * @version         1.2.0
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseArrayHelper;
use yii\base\InvalidArgumentException;

class ArrayHelper extends BaseArrayHelper
{
    public static function getParents($needle, $array = [], $delimiter = '.', $searchByKeys = true) {
        foreach ($array as $key => $value) {

            if (($searchByKeys && $key === $needle) || (!$searchByKeys && $value === $needle))
                return $key;

            if (!is_array($value))
                continue;

            if ($child = self::getParents($needle, $value, $delimiter, $searchByKeys))
                return $key . $delimiter . $child;

        }
        return false;
    }
}