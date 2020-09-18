<?php

namespace wdmg\helpers;

/**
 * Yii2 Custom array helper
 *
 * @category        Helpers
 * @version         1.3.6
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2020 W.D.M.Group, Ukraine
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

    public static function importCSV($data = null, $delimiter = null, $withColumns = false) {

        if (is_null($delimiter))
            $delimiter = ";";

        $array = [];
        if (is_resource($data)) {

            $num = 0;
            while (($row = fgetcsv($data, 4096, $delimiter)) !== false) {

                if ($withColumns) {
                    if (empty($columns)) {
                        $columns = $row;
                        continue;
                    }

                    foreach ($row as $key => $value) {
                        $array[$num][$columns[$key]] = $value;
                    }

                } else {
                    $array[] = $row;
                }

                $num++;
                unset($row);
            }

        } else if (is_string($data)) {

            $num = 0;
            foreach (explode("\r\n", $data) as $row) {

                $row = explode($delimiter, $row);

                if ($withColumns) {

                    if (empty($columns)) {
                        $columns = $row;
                        continue;
                    }

                    foreach ($row as $key => $value) {
                        $array[$num][$columns[$key]] = $value;
                    }

                } else {
                    $array[] = explode($delimiter, $row);
                }

                $num++;
                unset($row);
            }

        }

        return $array;
    }

    public static function exportCSV($array = null, $columns = "*", $delimiter = null, $withColumns = false) {
        if (is_array($array)) {

            if (is_null($delimiter))
                $delimiter = ";";

            if (!is_null($columns)) {

                if (is_string($columns) && $columns !== "*")
                    $columns = explode(",", $columns);

            }

            $i = 0;
            $output = [];
            foreach ($array as &$row) {

                if (is_array($columns) && $columns !== "*") {
                    foreach (array_keys($row) as $key) {

                        if (array_search($key, $columns) === false)
                            unset($row[$key]);
                        else
                            continue;

                    }
                }

                if ($i == 0 && $withColumns === true)
                    $output[] = implode($delimiter, array_keys($row));

                $output[] = implode($delimiter, $row);
                $i++;
            }

            return implode("\r\n", $output);
        } else {
            return null;
        }
    }

    public static function unique($array, $columns = null) {
        list($temp, $data) = [[],[]];
        foreach ($array as $key => $row) {

            if (is_array($columns)) {
                foreach ($columns as $column) {
                    if (isset($row[$column])) {
                        if (!in_array($row[$column], $data)) {
                            $data[] = $row[$column];
                            $temp[$key] = $row;
                        }
                    }
                }
            } else if (is_string($columns) && isset($row[$columns])) {
                if (!in_array($row[$columns], $data)) {
                    $data[] = $row[$columns];
                    $temp[$key] = $row;
                }
            }
        }

        if (empty($temp) && !$columns) {
            return array_unique($array, SORT_REGULAR);
        } else {
            $array = $temp;
            unset($temp, $data);
            return $array;
        }
    }

    public static function crossMerging($array1, $array2, $count1 = null, $count2 = null) {
        $i = 0;
        $j = 0;
        $k = 0;
        $array = [];

        if (!is_array($array1)) {
            throw new InvalidArgumentException('The `$array1` argument must be array.');
            return null;
        }

        if (!is_array($array2)) {
            throw new InvalidArgumentException('The `$array2` argument must be array.');
            return null;
        }

        if (is_null($count1))
            $count1 = count($array1);

        if (is_null($count2))
            $count2 = count($array2);

        // Traverse both array
        while ($i < $count1 && $j < $count2) {
            $array[$k++] = $array1[$i++];
            $array[$k++] = $array2[$j++];
        }

        // Store remaining elements of first array
        while ($i < $count1) {
            $array[$k++] = $array1[$i++];
        }

        // Store remaining elements of second array
        while($j < $count2) {
            $array[$k++] = $array2[$j++];
        }

        return $array;

    }

    public static function buildTree(&$array = [], $parentId = 0, $parentKey = 'parent_id', $childsKey = 'items', $level = 1) {
        $tree = array();
        foreach ($array as &$item) {
            if ($item[$parentKey] == $parentId) {
                $child = self::buildTree($array, $item['id'], $parentKey, $childsKey, $level+1);
                if ($child) {
                    if ($childsKey) {
                        $child = array_values($child);
                        $item[$childsKey] = $child;
                    } else {
                        $item = self::merge($item, $child);
                    }
                }
                $tree[$item['id']] = $item;
                $tree[$item['id']]['_level'] = $level;
                unset($item);
            }
        }
        return $tree;
    }
}