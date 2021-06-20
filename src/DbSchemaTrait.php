<?php

namespace wdmg\helpers;

/**
 * Yii2 Extend DB schema
 *
 * @category        Helpers
 * @version         1.4.8
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

trait DbSchemaTrait
{
    /**
     * @return \yii\db\Connection the database connection to be used for schema building.
     */
    protected abstract function getDb();

    /**
     * Creates a medium text column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     */
    public function mediumText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('mediumtext');
    }

    /**
     * Creates a long text column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     */
    public function longText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext');
    }

    /**
     * Creates a tiny text column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     */
    public function tinyText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('tinytext');
    }
}