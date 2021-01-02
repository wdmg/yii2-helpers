<?php

namespace wdmg\helpers;

/**
 * Yii2 Custom array helper
 *
 * @category        Helpers
 * @version         1.4.3
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseArrayHelper;
use yii\base\InvalidArgumentException;

class ArrayHelper extends BaseArrayHelper
{

    /**
     * Returns the path to the parent array and the child array key (separated by a separator) where the search was found
     *
     * @param $needle
     * @param array $array
     * @param string $delimiter
     * @param bool $searchByKeys
     * @return bool|int|string
     */
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

    /**
     * Forms an array of values from CSV data for subsequent import
     *
     * @param null $data
     * @param null $delimiter
     * @param bool $withColumns
     * @return array
     */
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

    /**
     * Forms CSV string data from an array of values for subsequent export
     *
     * @param null $array
     * @param string $columns
     * @param null $delimiter
     * @param bool $withColumns
     * @return string|null
     */
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

    /**
     * Uniqueizes a multidimensional array, including specifying a key for uniqueizing values
     *
     * @param $array
     * @param null $columns
     * @return array|mixed
     */
    public static function unique($array, $columns = null) {

        if (!is_array($array)) {
            throw new InvalidArgumentException('The `$array` argument must be array.');
            return null;
        }

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

    /**
     * Returns the differences of multidimensional arrays.
     *
     * @param $array1
     * @param $array2
     * @return array|null
     */
    public static function diff($array1, $array2) {
        $array = [];

        if (!is_array($array1)) {
            throw new InvalidArgumentException('The `$array1` argument must be array.');
            return null;
        }

        if (!is_array($array2)) {
            throw new InvalidArgumentException('The `$array2` argument must be array.');
            return null;
        }

        foreach ($array1 as $key => $value) {
            if (array_key_exists($key, $array2)) {
                if (is_array($value)) {

                    $diff = self::diff($value, $array2[$key]);

                    if (count($diff))
                        $array[$key] = $diff;

                } else {

                    if ($value != $array2[$key])
                        $array[$key] = $value;

                }
            } else {
                $array[$key] = $value;
            }
        }
        
        return $array;
    }

    /**
     * Merges multidimensional arrays.
     *
     * @param $array1
     * @param $array2
     * @param null $count1
     * @param null $count2
     * @return array|null
     */
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
            if (isset($array1[$i++]))
                $array[$k++] = $array1[$i++];

            if (isset($array2[$j++]))
                $array[$k++] = $array2[$j++];
        }

        // Store remaining elements of first array
        while ($i < $count1) {
            if (isset($array1[$i++]))
                $array[$k++] = $array1[$i++];
        }

        // Store remaining elements of second array
        while($j < $count2) {
            if (isset($array2[$j++]))
                $array[$k++] = $array2[$j++];
        }

        return $array;

    }

    /**
     * Builds an array tree from heirs by keys ʻitems` and `parent_id`
     *
     * @param array $array
     * @param int $parentId
     * @param string $parentKey
     * @param string $childsKey
     * @param int $level
     * @return array
     */
    public static function buildTree(&$array = [], $parentId = 0, $parentKey = 'parent_id', $childsKey = 'items', $level = 1) {
        $tree = [];
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


    /**
     * Flatten a multidimensional array on a child key ʻitems` and sets of parent key id
     *
     * @param array $array
     * @param string $childsKey
     * @param string $parentKey
     * @return array
     */
    public static function flattenTree($array = [], $childsKey = 'items', $parentKey = 'parent_id') {
        $flatten = [];
        foreach ($array as $key => $object) {

            // Separate its children
            $children = isset($object[$childsKey]) ? $object[$childsKey] : [];
            unset($object[$childsKey]);

            // And add it to the output array
            $flatten[] = $object;

            // Recursively flatten the array of children
            $children = self::flattenTree($children, $childsKey, $parentKey);
            foreach ($children as $child) {
                $child[$parentKey] = array_key_last($flatten);
                $flatten[] = $child;
            }
        }
        return $flatten;
    }

    /**
     * Finds and changes the name of an array key`s
     *
     * @param array $array
     * @return int|mixed|string|null
     */
    public static function changeKey($array = [], $keySetOrCallBack = [])
    {
        if (!is_array($array)) {
            throw new InvalidArgumentException('The `$array` argument must be array.');
            return null;
        }

        if (!is_array($keySetOrCallBack) && !is_callable($keySetOrCallBack)) {
            throw new InvalidArgumentException('The `$keySetOrCallBack` argument must be array or callable.');
            return null;
        }

        $output = [];
        foreach ($array as $k => $v) {
            if (is_callable($keySetOrCallBack))
                $key = call_user_func_array($keySetOrCallBack, [$k, $v]);
            else
                $key = $keySetOrCallBack[$k] ?? $k;

            $output[$key] = is_array($v) ? self::changeKey($v, $keySetOrCallBack) : $v;
        }

        return $output;
    }

    /**
     * Returns the key of the first element of the array
     *
     * @param array $array
     * @return int|mixed|string|null
     */
    public static function keyFirst($array = [])
    {
        if (!is_array($array)) {
            throw new InvalidArgumentException('The `$array` argument must be array.');
            return null;
        }

        if (!function_exists('array_key_first')) {
            foreach ($array as $key => $value) {
                return $key;
            }
        } else {
            return array_key_first($array);
        }
    }

    /**
     * Returns the key of the last element of the array
     *
     * @param array $array
     * @return int|mixed|string|null
     */
    public static function keyLast($array = [])
    {
        if (!is_array($array)) {
            throw new InvalidArgumentException('The `$array` argument must be array.');
            return null;
        }

        if (!function_exists('array_key_last')) {
            return key(array_slice($array, -1, 1, true));
        } else {
            return array_key_last($array);
        }
    }
}