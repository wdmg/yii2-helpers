<?php

namespace wdmg\helpers;

/**
 * Yii2 Exchange Rates
 *
 * @category        Helpers
 * @version         1.4.7
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2021 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseArrayHelper;
use yii\base\InvalidArgumentException;
use yii\httpclient\Client;
use yii\httpclient\JsonParser;
use yii\httpclient\XmlParser;

class ExchangeRates extends BaseArrayHelper
{

    /**
     * Getting currency rates from the National Bank of Ukraine
     *
     * @param bool $formatted
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    private static function _getNBURates($formatted = false) {

        $output = [];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange')
            ->send();

        if ($response->isOk) {
            $xml = new XmlParser;
            $data = $xml->parse($response);

            if (isset($data['currency'])) {
                foreach ($data['currency'] as $row) {
                    $output[] = [
                        'from' => 'UAH',
                        'to' => $row['cc'],
                        'rate' => ($formatted) ? Yii::$app->formatter->asDecimal($row['rate'], 2) : floatval($row['rate']),
                        'scale' => 1,
                        'datetime' => date('Y-m-d H:i:s', strtotime($row['exchangedate'])),
                        'source' => 'nbu'
                    ];
                }
            }
        }

        return $output;
    }

    /**
     * Getting currency rates from PrivatBank, Ukraine
     *
     * @param bool $formatted
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    private static function _getPrivatBankRates($formatted = false) {
        $output = [];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5')
            ->send();

        if ($response->isOk) {
            $xml = new XmlParser;
            $data = $xml->parse($response);

            if (isset($data['row'])) {
                foreach ($data['row'] as $row) {
                    $attributes = $row['exchangerate']['@attributes'];

                    $output[] = [
                        'from' => $attributes['ccy'],
                        'to' => $attributes['base_ccy'],
                        'rate' => ($formatted) ? Yii::$app->formatter->asDecimal($attributes['buy'], 2) : floatval($attributes['buy']),
                        'scale' => 1,
                        'datetime' => date('Y-m-d H:i:s'),
                        'source' => 'privatbank'
                    ];

                    $output[] = [
                        'from' => $attributes['base_ccy'],
                        'to' => $attributes['ccy'],
                        'rate' => ($formatted) ? Yii::$app->formatter->asDecimal($attributes['sale'], 2) : floatval($attributes['sale']),
                        'scale' => 1,
                        'datetime' => date('Y-m-d H:i:s'),
                        'source' => 'privatbank'
                    ];
                }
            }
        }

        return $output;
    }

    /**
     * Getting currency rates from the Central Bank of the Russian Federation
     *
     * @param bool $formatted
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    private static function _getCBRRates($formatted = false) {

        $output = [];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://www.cbr.ru/scripts/XML_daily.asp')
            ->send();

        if ($response->isOk) {
            $xml = new XmlParser;
            $data = $xml->parse($response);

            if (isset($data['Valute']) && $data['@attributes']['Date']) {

                $datetime = $data['@attributes']['Date'];
                foreach ($data['Valute'] as $row) {

                    $rate = floatval(str_replace(',', '.', $row['Value']));
                    $output[] = [
                        'from' => 'RUB',
                        'to' => $row['CharCode'],
                        'rate' => ($formatted) ? Yii::$app->formatter->asDecimal($rate, 2) : $rate,
                        'scale' => intval($row['Nominal']),
                        'datetime' => date('Y-m-d H:i:s', strtotime($datetime)),
                        'source' => 'cbr'
                    ];
                }
            }
        }

        return $output;
    }

    /**
     * Getting exchange rates from the Central European Bank, European Union
     *
     * @param bool $formatted
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    private static function _getECBRates($formatted = false) {

        $output = [];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml')
            ->send();

        if ($response->isOk) {
            $xml = new XmlParser;
            $data = $xml->parse($response);

            if (isset($data['Cube']['Cube']['Cube'])) {

                $rows = $data['Cube']['Cube']['Cube'];
                foreach ($rows as $row) {
                    $currency = $row['@attributes']['currency'];
                    $rate = $row['@attributes']['rate'];
                    $output[] = [
                        'from' => 'EUR',
                        'to' => $currency,
                        'rate' => ($formatted) ? Yii::$app->formatter->asDecimal($rate, 2) : floatval($rate),
                        'scale' => 1,
                        'datetime' => date('Y-m-d H:i:s'),
                        'source' => 'ecb'
                    ];
                }
            }
        }

        return $output;
    }

    /**
     * Getting currency rates from the National Bank of the Republic of Belarus
     *
     * @param bool $formatted
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    private static function _getNBRBRates($formatted = false) {

        $output = [];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://www.nbrb.by/api/exrates/rates?periodicity=0')
            ->send();

        if ($response->isOk) {
            $json = new JsonParser();

            if ($data = $json->parse($response)) {
                foreach ($data as $row) {
                    $output[] = [
                        'from' => 'BYN',
                        'to' => $row['Cur_Abbreviation'],
                        'rate' => ($formatted) ? Yii::$app->formatter->asDecimal($row['Cur_OfficialRate'], 2) : floatval($row['Cur_OfficialRate']),
                        'scale' => $row['Cur_Scale'],
                        'datetime' => date('Y-m-d H:i:s', strtotime($row['Date'])),
                        'source' => 'nbrb'
                    ];
                }
            }
        }

        return $output;
    }

    /**
     * Getting currency rates from a specific source
     *
     * @param null $source
     * @return array|bool|null
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public static function getExchangeRates($source = null) {

        if (is_null($source))
            throw new InvalidArgumentException('The source of receiving currency rates is not specified.');

        switch (\mb_strtolower($source)) {
            case "nbu" :
                return (!empty($rates = self::_getNBURates())) ? $rates : null;

            case "privatbank" :
                return (!empty($rates = self::_getPrivatBankRates())) ? $rates : null;

            case "cbr" :
                return (!empty($rates = self::_getCBRRates())) ? $rates : null;

            case "nbrb" :
                return (!empty($rates = self::_getNBRBRates())) ? $rates : null;

            case "ecb" :
                return (!empty($rates = self::_getECBRates())) ? $rates : null;
        }

        return false;
    }

    /**
     * Getting currency rates from all available sources
     *
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public static function getAllExchangeRates() {
        $all = [];
        if (!empty($ecb = self::_getECBRates()))
            $all['ecb'] = $ecb;

        if (!empty($nbu = self::_getNBURates()))
            $all['nbu'] = $nbu;

        if (!empty($privatbank = self::_getPrivatBankRates()))
            $all['privatbank'] = $privatbank;

        if (!empty($rcbr = self::_getCBRRates()))
            $all['cbr'] = $rcbr;

        if (!empty($nbrb = self::_getNBRBRates()))
            $all['nbrb'] = $nbrb;

        return $all;
    }
}