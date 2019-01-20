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
v.1.0.2 - Added internationalization and translations, refactoring.
v.1.0.1 - Added datetime helper class with `diff()` method.
v.1.0.0 - Helpers in progress development.