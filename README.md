[![Yii2](https://img.shields.io/badge/required-Yii2_v2.0.35-blue.svg)](https://packagist.org/packages/yiisoft/yii2)
[![Downloads](https://img.shields.io/packagist/dt/wdmg/yii2-helpers.svg)](https://packagist.org/packages/wdmg/yii2-helpers)
[![Packagist Version](https://img.shields.io/packagist/v/wdmg/yii2-helpers.svg)](https://packagist.org/packages/wdmg/yii2-helpers)
![Progress](https://img.shields.io/badge/progress-ready_to_use-green.svg)
[![GitHub license](https://img.shields.io/github/license/wdmg/yii2-helpers.svg)](https://github.com/wdmg/yii2-helpers/blob/master/LICENSE)

<img src="./docs/images/yii2-helpers.png" width="100%" alt="Yii2 Composite Forms" />

# Yii2 Helpers
Custom helpers for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.35 and newest

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

# Status and version [ready to use]
* v.1.3.4 - Added IpAdressHelper
* v.1.3.3 - Added buildTree() method to ArrayHelper
* v.1.3.2 - Up to date dependencies
* v.1.3.1 - Added crossMerging() method to ArrayHelper
* v.1.3.0 - Added TextAnalyzer helper
* v.1.2.2 - Added exportCSV, importCSV methods to ArrayHelper
* v.1.2.1 - Added stripTags() method for StringHelper