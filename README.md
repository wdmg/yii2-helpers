[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.13-blue.svg)](https://packagist.org/packages/yiisoft/yii2) [![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-helpers/total.svg)](https://GitHub.com/wdmg/yii2-helpers/releases/) [![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-helpers.svg)](https://github.com/wdmg/yii2-helpers) ![Progress](https://img.shields.io/badge/progress-in_development-red.svg) [![GitHub license](https://img.shields.io/github/license/wdmg/yii2-helpers.svg)](https://github.com/wdmg/yii2-helpers/blob/master/LICENSE)

# Yii2 Helpers
Custom helpers for Yii2

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.13 and newest

# Installation
To install the helpers, run the following command in the console:

`$ composer require "wdmg/yii2-datepicker"`

# Usage
Example of standalone widget:

    <?php
    
    use wdmg\helpers\DateAndTime;
    ...
    
    echo DateAndTime::diff($data->updated_at, null, [
        'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
        'inpastClass' => 'text-danger', // Class for datediff in past time
        'futureClass' => 'text-success', // Class for datediff in future time
    ]);
    
    ?>

# Status and version
* v.1.0.2 - Added internationalization and translations, refactoring.
* v.1.0.1 - Added datetime helper class with `diff()` method.
* v.1.0.0 - Helpers in progress development.