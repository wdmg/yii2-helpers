<?php

namespace wdmg\helpers;

/**
 * Yii2 Custom file helper
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
use yii\helpers\BaseFileHelper;
use yii\base\InvalidArgumentException;

class FileHelper extends BaseFileHelper
{

    /**
     * Safety a file/directory path.
     *
     * @param string $path the file/directory path to be normalized
     * @param null|string $root the base root path. If set as NULL use path of `@app` alias by default.
     * @param string $ds the directory separator to be used in the normalized result. Defaults to `DIRECTORY_SEPARATOR`.
     * @return string the safety file/directory path
     */
    public static function safetyPath($path, $root = null, $ds = DIRECTORY_SEPARATOR) {

        $path = parent::normalizePath($path, $ds);

        if (!$root)
            $root = Yii::getAlias('@app');

        $pattern = str_replace('_SEPARATOR_', $ds, "/\_SEPARATOR_[A-Za-z0-9]{0,4}/is");
        $safe = preg_replace($pattern, "$ds****", $root);
        return str_replace($root, $safe, $path);
    }
}