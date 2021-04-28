<?php

namespace wdmg\helpers;

/**
 * Yii2 Date and Time helper
 *
 * @category        Helpers
 * @version         1.4.6
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseFormatConverter;

class DateAndTime extends BaseFormatConverter
{

    /**
     * Stores a description of time zones.
     *
     * @var array
     */
    protected static $_timeZones = [
        ['abbr' => 'A', 'name' => 'Alpha Time Zone', 'location' => 'Military', 'offsets' => ['+01:00']],
        ['abbr' => 'ACDT', 'name' => 'Australian Central Daylight Time', 'location' => 'Australia', 'offsets' => ['+10:30']],
        ['abbr' => 'ACST', 'name' => 'Australian Central Standard Time', 'location' => 'Australia', 'offsets' => ['+09:30']],
        ['abbr' => 'ACT', 'name' => 'Acre Time', 'location' => 'South America', 'offsets' => ['-05:00']],
        ['abbr' => 'ACT', 'name' => 'Australian Central Time', 'location' => 'Australia', 'offsets' => ['+09:30', '+10:30']],
        ['abbr' => 'ACWST', 'name' => 'Australian Central Western Standard Time', 'location' => 'Australia', 'offsets' => ['+08:45']],
        ['abbr' => 'ADT', 'name' => 'Arabia Daylight Time', 'location' => 'Asia', 'offsets' => ['+04:00']],
        ['abbr' => 'ADT', 'name' => 'Atlantic Daylight Time', 'location' => 'North America, Atlantic', 'offsets' => ['-03:00']],
        ['abbr' => 'AEDT', 'name' => 'Australian Eastern Daylight Time', 'location' => 'Australia', 'offsets' => ['+11:00']],
        ['abbr' => 'AEST', 'name' => 'Australian Eastern Standard Time', 'location' => 'Australia', 'offsets' => ['+10:00']],
        ['abbr' => 'AET', 'name' => 'Australian Eastern Time', 'location' => 'Australia', 'offsets' => ['+10:00', '+11:00']],
        ['abbr' => 'AFT', 'name' => 'Afghanistan Time', 'location' => 'Asia', 'offsets' => ['+04:30']],
        ['abbr' => 'AKDT', 'name' => 'Alaska Daylight Time', 'location' => 'North America', 'offsets' => ['-08:00']],
        ['abbr' => 'AKST', 'name' => 'Alaska Standard Time', 'location' => 'North America', 'offsets' => ['-09:00']],
        ['abbr' => 'ALMT', 'name' => 'Alma-Ata Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'AMST', 'name' => 'Amazon Summer Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'AMST', 'name' => 'Armenia Summer Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'AMT', 'name' => 'Amazon Time', 'location' => 'South America', 'offsets' => ['-04:00']],
        ['abbr' => 'AMT', 'name' => 'Armenia Time', 'location' => 'Asia', 'offsets' => ['+04:00']],
        ['abbr' => 'ANAST', 'name' => 'Anadyr Summer Time', 'location' => 'Asia', 'offsets' => ['+12:00']],
        ['abbr' => 'ANAT', 'name' => 'Anadyr Time', 'location' => 'Asia', 'offsets' => ['+12:00']],
        ['abbr' => 'AQTT', 'name' => 'Aqtobe Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'ART', 'name' => 'Argentina Time', 'location' => 'Antarctica, South America', 'offsets' => ['-03:00']],
        ['abbr' => 'AST', 'name' => 'Arabia Standard Time', 'location' => 'Asia', 'offsets' => ['+03:00']],
        ['abbr' => 'AST', 'name' => 'Atlantic Standard Time', 'location' => 'North America, Atlantic, Caribbean', 'offsets' => ['-04:00']],
        ['abbr' => 'AT', 'name' => 'Atlantic Time', 'location' => 'North America, Atlantic, Caribbean', 'offsets' => ['-04:00', '-3:00']],
        ['abbr' => 'AWDT', 'name' => 'Australian Western Daylight Time', 'location' => 'Australia', 'offsets' => ['+09:00']],
        ['abbr' => 'AWST', 'name' => 'Australian Western Standard Time', 'location' => 'Australia', 'offsets' => ['+08:00']],
        ['abbr' => 'AZOST', 'name' => 'Azores Summer Time', 'location' => 'Atlantic', 'offsets' => ['+00:00']],
        ['abbr' => 'AZOT', 'name' => 'Azores Time', 'location' => 'Atlantic', 'offsets' => ['-01:00']],
        ['abbr' => 'AZST', 'name' => 'Azerbaijan Summer Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'AZT', 'name' => 'Azerbaijan Time', 'location' => 'Asia', 'offsets' => ['+04:00']],
        ['abbr' => 'AoE', 'name' => 'Anywhere on Earth', 'location' => 'Pacific', 'offsets' => ['-12:00']],
        ['abbr' => 'B', 'name' => 'Bravo Time Zone', 'location' => 'Military', 'offsets' => ['+02:00']],
        ['abbr' => 'BNT', 'name' => 'Brunei Darussalam Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'BOT', 'name' => 'Bolivia Time', 'location' => 'South America', 'offsets' => ['-04:00']],
        ['abbr' => 'BRST', 'name' => 'Brasília Summer Time', 'location' => 'South America', 'offsets' => ['-02:00']],
        ['abbr' => 'BRT', 'name' => 'Brasília Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'BST', 'name' => 'Bangladesh Standard Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'BST', 'name' => 'Bougainville Standard Time', 'location' => 'Pacific', 'offsets' => ['+11:00']],
        ['abbr' => 'BST', 'name' => 'British Summer Time', 'location' => 'Europe', 'offsets' => ['+01:00']],
        ['abbr' => 'BTT', 'name' => 'Bhutan Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'C', 'name' => 'Charlie Time Zone', 'location' => 'Military', 'offsets' => ['+03:00']],
        ['abbr' => 'CAST', 'name' => 'Casey Time', 'location' => 'Antarctica', 'offsets' => ['+08:00']],
        ['abbr' => 'CAT', 'name' => 'Central Africa Time', 'location' => 'Africa', 'offsets' => ['+02:00']],
        ['abbr' => 'CCT', 'name' => 'Cocos Islands Time', 'location' => 'Indian Ocean', 'offsets' => ['+06:30']],
        ['abbr' => 'CDT', 'name' => 'Central Daylight Time', 'location' => 'North America', 'offsets' => ['-05:00']],
        ['abbr' => 'CDT', 'name' => 'Cuba Daylight Time', 'location' => 'Caribbean', 'offsets' => ['-04:00']],
        ['abbr' => 'CEST', 'name' => 'Central European Summer Time', 'location' => 'Europe, Antarctica', 'offsets' => ['+02:00']],
        ['abbr' => 'CET', 'name' => 'Central European Time', 'location' => 'Europe, Africa', 'offsets' => ['+01:00']],
        ['abbr' => 'CHADT', 'name' => 'Chatham Island Daylight Time', 'location' => 'Pacific', 'offsets' => ['+13:45']],
        ['abbr' => 'CHAST', 'name' => 'Chatham Island Standard Time', 'location' => 'Pacific', 'offsets' => ['+12:45']],
        ['abbr' => 'CHOST', 'name' => 'Choibalsan Summer Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'CHOT', 'name' => 'Choibalsan Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'CHUT', 'name' => 'Chuuk Time', 'location' => 'Pacific', 'offsets' => ['+10:00']],
        ['abbr' => 'CIDST', 'name' => 'Cayman Islands Daylight Saving Time', 'location' => 'Caribbean', 'offsets' => ['-04:00']],
        ['abbr' => 'CIST', 'name' => 'Cayman Islands Standard Time', 'location' => 'Caribbean', 'offsets' => ['-05:00']],
        ['abbr' => 'CKT', 'name' => 'Cook Island Time', 'location' => 'Pacific', 'offsets' => ['-10:00']],
        ['abbr' => 'CLST', 'name' => 'Chile Summer Time', 'location' => 'South America, Antarctica', 'offsets' => ['-03:00']],
        ['abbr' => 'CLT', 'name' => 'Chile Standard Time', 'location' => 'South America, Antarctica', 'offsets' => ['-04:00']],
        ['abbr' => 'COT', 'name' => 'Colombia Time', 'location' => 'South America', 'offsets' => ['-05:00']],
        ['abbr' => 'CST', 'name' => 'Central Standard Time', 'location' => 'North America, Central America', 'offsets' => ['-06:00']],
        ['abbr' => 'CST', 'name' => 'China Standard Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'CST', 'name' => 'Cuba Standard Time', 'location' => 'Caribbean', 'offsets' => ['-05:00']],
        ['abbr' => 'CT', 'name' => 'Central Time', 'location' => 'North America, Central America', 'offsets' => ['-06:00', '-5:00']],
        ['abbr' => 'CVT', 'name' => 'Cape Verde Time', 'location' => 'Africa', 'offsets' => ['-01:00']],
        ['abbr' => 'CXT', 'name' => 'Christmas Island Time', 'location' => 'Australia', 'offsets' => ['+07:00']],
        ['abbr' => 'ChST', 'name' => 'Chamorro Standard Time', 'location' => 'Pacific', 'offsets' => ['+10:00']],
        ['abbr' => 'D', 'name' => 'Delta Time Zone', 'location' => 'Military', 'offsets' => ['+04:00']],
        ['abbr' => 'DAVT', 'name' => 'Davis Time', 'location' => 'Antarctica', 'offsets' => ['+07:00']],
        ['abbr' => 'DDUT', 'name' => 'Dumont-d\'Urville Time', 'location' => 'Antarctica', 'offsets' => ['+10:00']],
        ['abbr' => 'E', 'name' => 'Echo Time Zone', 'location' => 'Military', 'offsets' => ['+05:00']],
        ['abbr' => 'EASST', 'name' => 'Easter Island Summer Time', 'location' => 'Pacific', 'offsets' => ['-05:00']],
        ['abbr' => 'EAST', 'name' => 'Easter Island Standard Time', 'location' => 'Pacific', 'offsets' => ['-06:00']],
        ['abbr' => 'EAT', 'name' => 'Eastern Africa Time', 'location' => 'Africa, Indian Ocean', 'offsets' => ['+03:00']],
        ['abbr' => 'ECT', 'name' => 'Ecuador Time', 'location' => 'South America', 'offsets' => ['-05:00']],
        ['abbr' => 'EDT', 'name' => 'Eastern Daylight Time', 'location' => 'North America, Caribbean', 'offsets' => ['-04:00']],
        ['abbr' => 'EEST', 'name' => 'Eastern European Summer Time', 'location' => 'Europe, Asia', 'offsets' => ['+03:00']],
        ['abbr' => 'EET', 'name' => 'Eastern European Time', 'location' => 'Europe, Asia, Africa', 'offsets' => ['+02:00']],
        ['abbr' => 'EGST', 'name' => 'Eastern Greenland Summer Time', 'location' => 'North America', 'offsets' => ['+00:00']],
        ['abbr' => 'EGT', 'name' => 'East Greenland Time', 'location' => 'North America', 'offsets' => ['-01:00']],
        ['abbr' => 'EST', 'name' => 'Eastern Standard Time', 'location' => 'North America, Caribbean, Central America', 'offsets' => ['-05:00']],
        ['abbr' => 'ET', 'name' => 'Eastern Time', 'location' => 'North America, Caribbean, Central America', 'offsets' => ['-05:00', '-4:00']],
        ['abbr' => 'F', 'name' => 'Foxtrot Time Zone', 'location' => 'Military', 'offsets' => ['+06:00']],
        ['abbr' => 'FET', 'name' => 'Further-Eastern European Time', 'location' => 'Europe', 'offsets' => ['+03:00']],
        ['abbr' => 'FJST', 'name' => 'Fiji Summer Time', 'location' => 'Pacific', 'offsets' => ['+13:00']],
        ['abbr' => 'FJT', 'name' => 'Fiji Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'FKST', 'name' => 'Falkland Islands Summer Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'FKT', 'name' => 'Falkland Island Time', 'location' => 'South America', 'offsets' => ['-04:00']],
        ['abbr' => 'FNT', 'name' => 'Fernando de Noronha Time', 'location' => 'South America', 'offsets' => ['-02:00']],
        ['abbr' => 'G', 'name' => 'Golf Time Zone', 'location' => 'Military', 'offsets' => ['+07:00']],
        ['abbr' => 'GALT', 'name' => 'Galapagos Time', 'location' => 'Pacific', 'offsets' => ['-06:00']],
        ['abbr' => 'GAMT', 'name' => 'Gambier Time', 'location' => 'Pacific', 'offsets' => ['-09:00']],
        ['abbr' => 'GET', 'name' => 'Georgia Standard Time', 'location' => 'Asia, Europe', 'offsets' => ['+04:00']],
        ['abbr' => 'GFT', 'name' => 'French Guiana Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'GILT', 'name' => 'Gilbert Island Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'GMT', 'name' => 'Greenwich Mean Time', 'location' => 'Europe, Africa, North America, Antarctica', 'offsets' => ['+00:00']],
        ['abbr' => 'GST', 'name' => 'Gulf Standard Time', 'location' => 'Asia', 'offsets' => ['+04:00']],
        ['abbr' => 'GST', 'name' => 'South Georgia Time', 'location' => 'South America', 'offsets' => ['-02:00']],
        ['abbr' => 'GYT', 'name' => 'Guyana Time', 'location' => 'South America', 'offsets' => ['-04:00']],
        ['abbr' => 'H', 'name' => 'Hotel Time Zone', 'location' => 'Military', 'offsets' => ['+08:00']],
        ['abbr' => 'HDT', 'name' => 'Hawaii-Aleutian Daylight Time', 'location' => 'North America', 'offsets' => ['-09:00']],
        ['abbr' => 'HKT', 'name' => 'Hong Kong Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'HOVST', 'name' => 'Hovd Summer Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'HOVT', 'name' => 'Hovd Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'HST', 'name' => 'Hawaii Standard Time', 'location' => 'North America, Pacific', 'offsets' => ['-10:00']],
        ['abbr' => 'I', 'name' => 'India Time Zone', 'location' => 'Military', 'offsets' => ['+09:00']],
        ['abbr' => 'ICT', 'name' => 'Indochina Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'IDT', 'name' => 'Israel Daylight Time', 'location' => 'Asia', 'offsets' => ['+03:00']],
        ['abbr' => 'IOT', 'name' => 'Indian Chagos Time', 'location' => 'Indian Ocean', 'offsets' => ['+06:00']],
        ['abbr' => 'IRDT', 'name' => 'Iran Daylight Time', 'location' => 'Asia', 'offsets' => ['+04:30']],
        ['abbr' => 'IRKST', 'name' => 'Irkutsk Summer Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'IRKT', 'name' => 'Irkutsk Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'IRST', 'name' => 'Iran Standard Time', 'location' => 'Asia', 'offsets' => ['+03:30']],
        ['abbr' => 'IST', 'name' => 'India Standard Time', 'location' => 'Asia', 'offsets' => ['+05:30']],
        ['abbr' => 'IST', 'name' => 'Irish Standard Time', 'location' => 'Europe', 'offsets' => ['+01:00']],
        ['abbr' => 'IST', 'name' => 'Israel Standard Time', 'location' => 'Asia', 'offsets' => ['+02:00']],
        ['abbr' => 'JST', 'name' => 'Japan Standard Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'K', 'name' => 'Kilo Time Zone', 'location' => 'Military', 'offsets' => ['+10:00']],
        ['abbr' => 'KGT', 'name' => 'Kyrgyzstan Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'KOST', 'name' => 'Kosrae Time', 'location' => 'Pacific', 'offsets' => ['+11:00']],
        ['abbr' => 'KRAST', 'name' => 'Krasnoyarsk Summer Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'KRAT', 'name' => 'Krasnoyarsk Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'KST', 'name' => 'Korea Standard Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'KUYT', 'name' => 'Kuybyshev Time', 'location' => 'Europe', 'offsets' => ['+04:00']],
        ['abbr' => 'L', 'name' => 'Lima Time Zone', 'location' => 'Military', 'offsets' => ['+11:00']],
        ['abbr' => 'LHDT', 'name' => 'Lord Howe Daylight Time', 'location' => 'Australia', 'offsets' => ['+11:00']],
        ['abbr' => 'LHST', 'name' => 'Lord Howe Standard Time', 'location' => 'Australia', 'offsets' => ['+10:30']],
        ['abbr' => 'LINT', 'name' => 'Line Islands Time', 'location' => 'Pacific', 'offsets' => ['+14:00']],
        ['abbr' => 'M', 'name' => 'Mike Time Zone', 'location' => 'Military', 'offsets' => ['+12:00']],
        ['abbr' => 'MAGST', 'name' => 'Magadan Summer Time', 'location' => 'Asia', 'offsets' => ['+12:00']],
        ['abbr' => 'MAGT', 'name' => 'Magadan Time', 'location' => 'Asia', 'offsets' => ['+11:00']],
        ['abbr' => 'MART', 'name' => 'Marquesas Time', 'location' => 'Pacific', 'offsets' => ['-09:30']],
        ['abbr' => 'MAWT', 'name' => 'Mawson Time', 'location' => 'Antarctica', 'offsets' => ['+05:00']],
        ['abbr' => 'MDT', 'name' => 'Mountain Daylight Time', 'location' => 'North America', 'offsets' => ['-06:00']],
        ['abbr' => 'MHT', 'name' => 'Marshall Islands Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'MMT', 'name' => 'Myanmar Time', 'location' => 'Asia', 'offsets' => ['+06:30']],
        ['abbr' => 'MSD', 'name' => 'Moscow Daylight Time', 'location' => 'Europe', 'offsets' => ['+04:00']],
        ['abbr' => 'MSK', 'name' => 'Moscow Standard Time', 'location' => 'Europe, Asia', 'offsets' => ['+03:00']],
        ['abbr' => 'MST', 'name' => 'Mountain Standard Time', 'location' => 'North America', 'offsets' => ['-07:00']],
        ['abbr' => 'MT', 'name' => 'Mountain Time', 'location' => 'North America', 'offsets' => ['-07:00', '-6:00']],
        ['abbr' => 'MUT', 'name' => 'Mauritius Time', 'location' => 'Africa', 'offsets' => ['+04:00']],
        ['abbr' => 'MVT', 'name' => 'Maldives Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'MYT', 'name' => 'Malaysia Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'N', 'name' => 'November Time Zone', 'location' => 'Military', 'offsets' => ['-01:00']],
        ['abbr' => 'NCT', 'name' => 'New Caledonia Time', 'location' => 'Pacific', 'offsets' => ['+11:00']],
        ['abbr' => 'NDT', 'name' => 'Newfoundland Daylight Time', 'location' => 'North America', 'offsets' => ['-02:30']],
        ['abbr' => 'NFDT', 'name' => 'Norfolk Daylight Time', 'location' => 'Australia', 'offsets' => ['+12:00']],
        ['abbr' => 'NFT', 'name' => 'Norfolk Time', 'location' => 'Australia', 'offsets' => ['+11:00']],
        ['abbr' => 'NOVST', 'name' => 'Novosibirsk Summer Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'NOVT', 'name' => 'Novosibirsk Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'NPT', 'name' => 'Nepal Time', 'location' => 'Asia', 'offsets' => ['+05:45']],
        ['abbr' => 'NRT', 'name' => 'Nauru Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'NST', 'name' => 'Newfoundland Standard Time', 'location' => 'North America', 'offsets' => ['-03:30']],
        ['abbr' => 'NUT', 'name' => 'Niue Time', 'location' => 'Pacific', 'offsets' => ['-11:00']],
        ['abbr' => 'NZDT', 'name' => 'New Zealand Daylight Time', 'location' => 'Pacific, Antarctica', 'offsets' => ['+13:00']],
        ['abbr' => 'NZST', 'name' => 'New Zealand Standard Time', 'location' => 'Pacific, Antarctica', 'offsets' => ['+12:00']],
        ['abbr' => 'O', 'name' => 'Oscar Time Zone', 'location' => 'Military', 'offsets' => ['-02:00']],
        ['abbr' => 'OMSST', 'name' => 'Omsk Summer Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'OMST', 'name' => 'Omsk Standard Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'ORAT', 'name' => 'Oral Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'P', 'name' => 'Papa Time Zone', 'location' => 'Military', 'offsets' => ['-03:00']],
        ['abbr' => 'PDT', 'name' => 'Pacific Daylight Time', 'location' => 'North America', 'offsets' => ['-07:00']],
        ['abbr' => 'PET', 'name' => 'Peru Time', 'location' => 'South America', 'offsets' => ['-05:00']],
        ['abbr' => 'PETST', 'name' => 'Kamchatka Summer Time', 'location' => 'Asia', 'offsets' => ['+12:00']],
        ['abbr' => 'PETT', 'name' => 'Kamchatka Time', 'location' => 'Asia', 'offsets' => ['+12:00']],
        ['abbr' => 'PGT', 'name' => 'Papua New Guinea Time', 'location' => 'Pacific', 'offsets' => ['+10:00']],
        ['abbr' => 'PHOT', 'name' => 'Phoenix Island Time', 'location' => 'Pacific', 'offsets' => ['+13:00']],
        ['abbr' => 'PHT', 'name' => 'Philippine Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'PKT', 'name' => 'Pakistan Standard Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'PMDT', 'name' => 'Pierre & Miquelon Daylight Time', 'location' => 'North America', 'offsets' => ['-02:00']],
        ['abbr' => 'PMST', 'name' => 'Pierre & Miquelon Standard Time', 'location' => 'North America', 'offsets' => ['-03:00']],
        ['abbr' => 'PONT', 'name' => 'Pohnpei Standard Time', 'location' => 'Pacific', 'offsets' => ['+11:00']],
        ['abbr' => 'PST', 'name' => 'Pacific Standard Time', 'location' => 'North America', 'offsets' => ['-08:00']],
        ['abbr' => 'PST', 'name' => 'Pitcairn Standard Time', 'location' => 'Pacific', 'offsets' => ['-08:00']],
        ['abbr' => 'PT', 'name' => 'Pacific Time', 'location' => 'North America', 'offsets' => ['-08:00', '-7:00']],
        ['abbr' => 'PWT', 'name' => 'Palau Time', 'location' => 'Pacific', 'offsets' => ['+09:00']],
        ['abbr' => 'PYST', 'name' => 'Paraguay Summer Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'PYT', 'name' => 'Paraguay Time', 'location' => 'South America', 'offsets' => ['-04:00']],
        ['abbr' => 'PYT', 'name' => 'Pyongyang Time', 'location' => 'Asia', 'offsets' => ['+08:30']],
        ['abbr' => 'Q', 'name' => 'Quebec Time Zone', 'location' => 'Military', 'offsets' => ['-04:00']],
        ['abbr' => 'QYZT', 'name' => 'Qyzylorda Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'R', 'name' => 'Romeo Time Zone', 'location' => 'Military', 'offsets' => ['-05:00']],
        ['abbr' => 'RET', 'name' => 'Reunion Time', 'location' => 'Africa', 'offsets' => ['+04:00']],
        ['abbr' => 'ROTT', 'name' => 'Rothera Time', 'location' => 'Antarctica', 'offsets' => ['-03:00']],
        ['abbr' => 'S', 'name' => 'Sierra Time Zone', 'location' => 'Military', 'offsets' => ['-06:00']],
        ['abbr' => 'SAKT', 'name' => 'Sakhalin Time', 'location' => 'Asia', 'offsets' => ['+11:00']],
        ['abbr' => 'SAMT', 'name' => 'Samara Time', 'location' => 'Europe', 'offsets' => ['+04:00']],
        ['abbr' => 'SAST', 'name' => 'South Africa Standard Time', 'location' => 'Africa', 'offsets' => ['+02:00']],
        ['abbr' => 'SBT', 'name' => 'Solomon Islands Time', 'location' => 'Pacific', 'offsets' => ['+11:00']],
        ['abbr' => 'SCT', 'name' => 'Seychelles Time', 'location' => 'Africa', 'offsets' => ['+04:00']],
        ['abbr' => 'SGT', 'name' => 'Singapore Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'SRET', 'name' => 'Srednekolymsk Time', 'location' => 'Asia', 'offsets' => ['+11:00']],
        ['abbr' => 'SRT', 'name' => 'Suriname Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'SST', 'name' => 'Samoa Standard Time', 'location' => 'Pacific', 'offsets' => ['-11:00']],
        ['abbr' => 'SYOT', 'name' => 'Syowa Time', 'location' => 'Antarctica', 'offsets' => ['+03:00']],
        ['abbr' => 'T', 'name' => 'Tango Time Zone', 'location' => 'Military', 'offsets' => ['-07:00']],
        ['abbr' => 'TAHT', 'name' => 'Tahiti Time', 'location' => 'Pacific', 'offsets' => ['-10:00']],
        ['abbr' => 'TFT', 'name' => 'French Southern and Antarctic Time', 'location' => 'Indian Ocean', 'offsets' => ['+05:00']],
        ['abbr' => 'TJT', 'name' => 'Tajikistan Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'TKT', 'name' => 'Tokelau Time', 'location' => 'Pacific', 'offsets' => ['+13:00']],
        ['abbr' => 'TLT', 'name' => 'East Timor Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'TMT', 'name' => 'Turkmenistan Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'TOST', 'name' => 'Tonga Summer Time', 'location' => 'Pacific', 'offsets' => ['+14:00']],
        ['abbr' => 'TOT', 'name' => 'Tonga Time', 'location' => 'Pacific', 'offsets' => ['+13:00']],
        ['abbr' => 'TRT', 'name' => 'Turkey Time', 'location' => 'Asia, Europe', 'offsets' => ['+03:00']],
        ['abbr' => 'TVT', 'name' => 'Tuvalu Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'U', 'name' => 'Uniform Time Zone', 'location' => 'Military', 'offsets' => ['-08:00']],
        ['abbr' => 'ULAST', 'name' => 'Ulaanbaatar Summer Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'ULAT', 'name' => 'Ulaanbaatar Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'UTC', 'name' => 'Coordinated Universal Time', 'location' => 'Worldwide', 'offsets' => ['+00:00']],
        ['abbr' => 'UYST', 'name' => 'Uruguay Summer Time', 'location' => 'South America', 'offsets' => ['-02:00']],
        ['abbr' => 'UYT', 'name' => 'Uruguay Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'UZT', 'name' => 'Uzbekistan Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'V', 'name' => 'Victor Time Zone', 'location' => 'Military', 'offsets' => ['-09:00']],
        ['abbr' => 'VET', 'name' => 'Venezuelan Standard Time', 'location' => 'South America', 'offsets' => ['-04:00']],
        ['abbr' => 'VLAST', 'name' => 'Vladivostok Summer Time', 'location' => 'Asia', 'offsets' => ['+11:00']],
        ['abbr' => 'VLAT', 'name' => 'Vladivostok Time', 'location' => 'Asia', 'offsets' => ['+10:00']],
        ['abbr' => 'VOST', 'name' => 'Vostok Time', 'location' => 'Antarctica', 'offsets' => ['+06:00']],
        ['abbr' => 'VUT', 'name' => 'Vanuatu Time', 'location' => 'Pacific', 'offsets' => ['+11:00']],
        ['abbr' => 'W', 'name' => 'Whiskey Time Zone', 'location' => 'Military', 'offsets' => ['-10:00']],
        ['abbr' => 'WAKT', 'name' => 'Wake Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'WARST', 'name' => 'Western Argentine Summer Time', 'location' => 'South America', 'offsets' => ['-03:00']],
        ['abbr' => 'WAST', 'name' => 'West Africa Summer Time', 'location' => 'Africa', 'offsets' => ['+02:00']],
        ['abbr' => 'WAT', 'name' => 'West Africa Time', 'location' => 'Africa', 'offsets' => ['+01:00']],
        ['abbr' => 'WEST', 'name' => 'Western European Summer Time', 'location' => 'Europe, Africa', 'offsets' => ['+01:00']],
        ['abbr' => 'WET', 'name' => 'Western European Time', 'location' => 'Europe, Africa', 'offsets' => ['+00:00']],
        ['abbr' => 'WFT', 'name' => 'Wallis and Futuna Time', 'location' => 'Pacific', 'offsets' => ['+12:00']],
        ['abbr' => 'WGST', 'name' => 'Western Greenland Summer Time', 'location' => 'North America', 'offsets' => ['-02:00']],
        ['abbr' => 'WGT', 'name' => 'West Greenland Time', 'location' => 'North America', 'offsets' => ['-03:00']],
        ['abbr' => 'WIB', 'name' => 'Western Indonesian Time', 'location' => 'Asia', 'offsets' => ['+07:00']],
        ['abbr' => 'WIT', 'name' => 'Eastern Indonesian Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'WITA', 'name' => 'Central Indonesian Time', 'location' => 'Asia', 'offsets' => ['+08:00']],
        ['abbr' => 'WST', 'name' => 'West Samoa Time', 'location' => 'Pacific', 'offsets' => ['+14:00']],
        ['abbr' => 'WST', 'name' => 'Western Sahara Summer Time', 'location' => 'Africa', 'offsets' => ['+01:00']],
        ['abbr' => 'WT', 'name' => 'Western Sahara Standard Time', 'location' => 'Africa', 'offsets' => ['+00:00']],
        ['abbr' => 'X', 'name' => 'X-ray Time Zone', 'location' => 'Military', 'offsets' => ['-11:00']],
        ['abbr' => 'Y', 'name' => 'Yankee Time Zone', 'location' => 'Military', 'offsets' => ['-12:00']],
        ['abbr' => 'YAKST', 'name' => 'Yakutsk Summer Time', 'location' => 'Asia', 'offsets' => ['+10:00']],
        ['abbr' => 'YAKT', 'name' => 'Yakutsk Time', 'location' => 'Asia', 'offsets' => ['+09:00']],
        ['abbr' => 'YAPT', 'name' => 'Yap Time', 'location' => 'Pacific', 'offsets' => ['+10:00']],
        ['abbr' => 'YEKST', 'name' => 'Yekaterinburg Summer Time', 'location' => 'Asia', 'offsets' => ['+06:00']],
        ['abbr' => 'YEKT', 'name' => 'Yekaterinburg Time', 'location' => 'Asia', 'offsets' => ['+05:00']],
        ['abbr' => 'Z', 'name' => 'Zulu Time Zone', 'location' => 'Military', 'offsets' => ['+00:00']]
    ];

    /**
     * Returns the time difference between two dates.
     *
     * @param null $datetime1
     * @param null $datetime2
     * @param array $options
     * @return mixed|void
     * @throws \Exception
     */
    public static function diff($datetime1 = null, $datetime2 = null, $options = [])
    {
        //@TODO: https://www.yiiframework.com/doc/api/2.0/yii-i18n-formatter#asRelativeTime()-detail

        static::initI18N('app/helpers');
        $default = ['layout' => '<span class="{class}">{datetime}</span>', 'inpastClass' => 'field-inpast-datetime', 'futureClass' => 'field-future-datetime'
        ];
        $options = array_merge($default, $options);

        if (!$datetime1)
            return;

        if ($datetime2)
            $datenow = new \DateTime($datetime2);
        else
            $datenow = new \DateTime("now");

        $dateend = new \DateTime($datetime1);
        $interval = $datenow->diff($dateend);

        $content = Yii::t('app/helpers', '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
            $interval
        );

        $layout = $options['layout'];
        if ($interval->invert == 1)
            $layout = str_replace('{class}', $options['inpastClass'], $layout);
        else
            $layout = str_replace('{class}', $options['futureClass'], $layout);

        return str_replace('{datetime}', $content, $layout);

    }

    /**
     * Converts the difference in seconds to UTC.
     *
     * @param $offset
     * @param null $format
     * @return string
     */
    public static function convertOffsetToUTC($offset, $format = null)
    {
        $prefix = $offset < 0 ? '-' : '+';
        $formatted = gmdate((is_string($format) && !empty($format)) ? $format : 'H:i', abs($offset));
        return $prefix . $formatted;
    }

    /**
     * Returns the abbreviation of the timezone.
     *
     * @param $timezone
     * @return string
     * @throws \Exception
     */
    public static function getTimezoneAbbr($timezone)
    {
        $dateTime = new \DateTime(null, new \DateTimeZone($timezone));
        $abbr = $dateTime->format('T');
        return strtoupper($abbr);
    }

    /**
     * Returns the name/description of time zones.
     *
     * @return array
     */
    public static function getTimezoneNames()
    {
        return self::$_timeZones;
    }

    /**
     * Sets the name/description of time zones.
     *
     * @param $timezones
     */
    public static function setTimezoneNames($timezones)
    {
        if (is_array($timezones) && !empty($timezones))
            self::$_timeZones = $timezones;
    }

    public static function modify($date, $string) {

        // Change the modifier string if needed
        if ($date->format('N') == 7 ) { // It's Sunday and we're calculating a day using relative weeks
            $matches = array();
            $pattern = '/this week|next week|previous week|last week/i';
            if (preg_match($pattern, $string, $matches)) {
                $string = str_replace($matches[0], '-7 days '.$matches[0], $string);
            }
        }

        return $date->modify($string);
    }

    /**
     * Returns the name of the timezone.
     *
     * @param $abbr
     * @param $utc
     * @return mixed|null
     */
    public static function getTimezoneName($abbr, $utc)
    {
        $timezones = self::getTimezoneNames();
        foreach ($timezones as $zone) {
            if (isset($zone['abbr']) && isset($zone['offsets'][0])) {
                if ($abbr == $zone['abbr'] && $utc == $zone['offsets'][0]) {
                    return $zone['name'];
                }
            }
        }

        return null;
    }

    /**
     * Returns a list of time zones.
     *
     * @param bool $groupped
     * @param bool $expanded
     * @param null $regions
     * @param bool $addUTC
     * @param bool $addDescription
     * @param bool $addLocations
     * @param bool $addTransitions
     * @return array
     * @throws \Exception
     */
    public static function getTimezones($groupped = false, $expanded = false, $regions = null, $addUTC = true, $addDescription = false, $addLocations = false, $addTransitions = false)
    {

        $timezones = [];

        if (is_null($regions) && !is_array($regions))
            $regions = [
                'Africa' => \DateTimeZone::AFRICA,
                'America' => \DateTimeZone::AMERICA,
                'Arctic' => \DateTimeZone::ANTARCTICA,
                'Asia' => \DateTimeZone::ASIA,
                'Atlantic' => \DateTimeZone::ATLANTIC,
                'Australia' => \DateTimeZone::AUSTRALIA,
                'Europe' => \DateTimeZone::EUROPE,
                'Indian' => \DateTimeZone::INDIAN,
                'Pacific' => \DateTimeZone::PACIFIC,
                'Other' => \DateTimeZone::UTC
            ];

        foreach ($regions as $index => $region) {

            $zones = \DateTimeZone::listIdentifiers($region);
            if ($expanded || $addUTC) {

                foreach ($zones as $key => $zone) {
                    $timezone = new \DateTimeZone($zone);
                    $offset = $timezone->getOffset(new \DateTime);
                    $abbr = self::getTimezoneAbbr($zone);
                    $utc = self::convertOffsetToUTC($offset);

                    if ($expanded) {
                        $location = $timezone->getLocation();
                        $zones['full'][$key] = [
                            'timezone' => $zone,
                            'name' => ($name = self::getTimezoneName($abbr, $utc)) ? $name : $timezone->getName(),
                            'abbr' => $abbr,
                            'offset' => $offset
                        ];

                        if ($addUTC && $utc)
                            $zones['full'][$key]['utc'] = 'UTC ' . $utc;

                        if ($addLocations)
                            $zones['full'][$key]['location'] = ['country' => $location['country_code'], 'lat' => $location['latitude'], 'lng' => $location['longitude']];

                        if ($addTransitions)
                            $zones['full'][$key]['transitions'] = $timezone->getTransitions();

                    } else {
                        if (!($name = self::getTimezoneName($abbr, $utc)))
                            $name = $timezone->getName();

                        if ($addUTC && $utc)
                            $zones['short'][$zone] = str_replace('_', '', $zone) . (($addDescription) ? ' - ' . $name  : '') . " (" . 'UTC ' . $utc . ")";
                        else
                            $zones['short'][$zone] = str_replace('_', '', $zone) . ($addDescription) ? ' - ' . $name : '';

                    }
                }
            }


            if ($expanded)
                $zones = $zones['full'];
            else
                $zones = $zones['short'];

            if ($groupped)
                $timezones[$index][] = array_merge(isset($timezones[$index]) ? $timezones[$index] : [], $zones);
            else
                $timezones = array_merge($timezones, $zones);
        }

        return $timezones;
    }

    /**
     * Initialize translations
     */
    public static function initI18N($category)
    {
        if (!empty(Yii::$app->i18n->translations['app/helpers']))
            return;

        Yii::$app->i18n->translations['app/helpers'] = ['class' => 'yii\i18n\PhpMessageSource', 'sourceLanguage' => 'en-US', 'basePath' => '@vendor/wdmg/yii2-helpers/messages'];
    }

}

?>