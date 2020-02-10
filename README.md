[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.13-blue.svg)](https://packagist.org/packages/yiisoft/yii2) [![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-helpers/total.svg)](https://GitHub.com/wdmg/yii2-helpers/releases/) [![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-helpers.svg)](https://github.com/wdmg/yii2-helpers) ![Progress](https://img.shields.io/badge/progress-in_development-red.svg) [![GitHub license](https://img.shields.io/github/license/wdmg/yii2-helpers.svg)](https://github.com/wdmg/yii2-helpers/blob/master/LICENSE)

# Yii2 Helpers
Custom helpers for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.19 and newest

# Installation
To install the helpers, run the following command in the console:

`$ composer require "wdmg/yii2-helpers"`

# Usage
An example of a standalone time difference widget:

    <?php
    
        use wdmg\helpers\DateAndTime;
        ...
        
        echo DateAndTime::diff($data->updated_at, null, [
            'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
            'inpastClass' => 'text-danger', // Class for datediff in past time
            'futureClass' => 'text-success', // Class for datediff in future time
        ]);
    
    ?>
    
Example of integer amount to string:

    <?php
    
        use wdmg\helpers\StringHelper;
        ...
        
        echo StringHelper::integerAmount('1256', 2, true) . "<br/>";
        // 1,25K
        
        echo StringHelper::integerAmount('125763', 2, true) . "<br/>";
        // 125,76K
        
        echo StringHelper::integerAmount('2525763', 2, false) . "<br/>";
        // 2,52 mill.
        
        echo StringHelper::integerAmount('1432525763', 2, false) . "<br/>";
        // 1,43 bill.
    
    ?>
    
Example of string trim including full words:

    <?php
    
        use wdmg\helpers\StringHelper;
        ...
        
        echo StringHelper::stringShorter('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.', 55, 0) . "<br/>";
        // Lorem ipsum dolor sit amet, consectetuer adipiscing…
        
        echo StringHelper::stringShorter('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.', 55, 25) . "<br/>";
        // Lorem ipsum dolor sit amet, consectetuer adipiscing… ex ea commodo consequat.
    
    ?>

# Status and version
* v.1.3.1 - Added crossMerging() method to ArrayHelper
* v.1.3.0 - Added TextAnalyzer helper
* v.1.2.2 - Added exportCSV, importCSV methods to ArrayHelper
* v.1.2.1 - Added stripTags() method for StringHelper
* v.1.2.0 - Customize ArrayHelper (searching parents of array item)
* v.1.1.2 - Module transferred to base module interface. Update Yii2 version.