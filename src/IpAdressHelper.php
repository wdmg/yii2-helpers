<?php

namespace wdmg\helpers;

/**
 * Yii2 IP adress helper
 *
 * @category        Helpers
 * @version         1.3.4
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2020 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;
use yii\helpers\BaseArrayHelper;
use yii\base\InvalidArgumentException;

class IpAdressHelper extends BaseArrayHelper
{

    const NETMASK_INFO = [
        [
            "bitcount" => 1,
            "mask" => "128.0.0.0",
            "subnets" => null,
            "count" => "2048M",
            "class_range" => 128,
            "class" => "А"
        ],
        [
            "bitcount" => 2,
            "mask" => "192.0.0.0",
            "subnets" => null,
            "count" => "1024M",
            "class_range" => 64,
            "class" => "А"
        ],
        [
            "bitcount" => 3,
            "mask" => "224.0.0.0",
            "subnets" => null,
            "count" => "512M",
            "class_range" => 32,
            "class" => "А"
        ],
        [
            "bitcount" => 4,
            "mask" => "240.0.0.0",
            "subnets" => null,
            "count" => "256M",
            "class_range" => 16,
            "class" => "А"
        ],
        [
            "bitcount" => 5,
            "mask" => "248.0.0.0",
            "subnets" => null,
            "count" => "128M",
            "class_range" => 8,
            "class" => "А"
        ],
        [
            "bitcount" => 6,
            "mask" => "252.0.0.0",
            "subnets" => null,
            "count" => "64M",
            "class_range" => 4,
            "class" => "А"
        ],
        [
            "bitcount" => 7,
            "mask" => "254.0.0.0",
            "subnets" => null,
            "count" => "32M",
            "class_range" => 2,
            "class" => "А"
        ],
        [
            "bitcount" => 8,
            "mask" => "255.0.0.0",
            "subnets" => null,
            "count" => "16M",
            "class_range" => 1,
            "class" => "А"
        ],
        [
            "bitcount" => 9,
            "mask" => "255.128.0.0",
            "subnets" => null,
            "count" => "8M",
            "class_range" => 128,
            "class" => "B"
        ],
        [
            "bitcount" => 10,
            "mask" => "255.192.0.0",
            "subnets" => null,
            "count" => "4M",
            "class_range" => 64,
            "class" => "B"
        ],
        [
            "bitcount" => 11,
            "mask" => "255.224.0.0",
            "subnets" => null,
            "count" => "2M",
            "class_range" => 32,
            "class" => "B"
        ],
        [
            "bitcount" => 12,
            "mask" => "255.240.0.0",
            "subnets" => null,
            "count" => "1024K",
            "class_range" => 16,
            "class" => "B"
        ],
        [
            "bitcount" => 13,
            "mask" => "255.248.0.0",
            "subnets" => null,
            "count" => "512K",
            "class_range" => 8,
            "class" => "B"
        ],
        [
            "bitcount" => 14,
            "mask" => "255.252.0.0",
            "subnets" => null,
            "count" => "256K",
            "class_range" => 4,
            "class" => "B"
        ],
        [
            "bitcount" => 15,
            "mask" => "255.254.0.0",
            "subnets" => null,
            "count" => "128K",
            "class_range" => 2,
            "class" => "B"
        ],
        [
            "bitcount" => 16,
            "mask" => "255.255.0.0",
            "subnets" => null,
            "count" => "64K",
            "class_range" => 1,
            "class" => "B"
        ],
        [
            "bitcount" => 17,
            "mask" => "255.255.128.0",
            "subnets" => 2,
            "count" => "32K",
            "class_range" => 128,
            "class" => "C"
        ],
        [
            "bitcount" => 18,
            "mask" => "255.255.192.0",
            "subnets" => 4,
            "count" => "16K",
            "class_range" => 64,
            "class" => "C"
        ],
        [
            "bitcount" => 19,
            "mask" => "255.255.224.0",
            "subnets" => 8,
            "count" => "8K",
            "class_range" => 32,
            "class" => "C"
        ],
        [
            "bitcount" => 20,
            "mask" => "255.255.240.0",
            "subnets" => 16,
            "count" => "4K",
            "class_range" => 16,
            "class" => "C"
        ],
        [
            "bitcount" => 21,
            "mask" => "255.255.248.0",
            "subnets" => 32,
            "count" => "2K",
            "class_range" => 8,
            "class" => "C"
        ],
        [
            "bitcount" => 22,
            "mask" => "255.255.252.0",
            "subnets" => 64,
            "count" => "1K",
            "class_range" => 4,
            "class" => "C"
        ],
        [
            "bitcount" => 23,
            "mask" => "255.255.254.0",
            "subnets" => 128,
            "count" => 512,
            "class_range" => 2,
            "class" => "C"
        ],
        [
            "bitcount" => 24,
            "mask" => "255.255.255.0",
            "subnets" => 256,
            "count" => 256,
            "class_range" => 1,
            "class" => "C"
        ],
        [
            "bitcount" => 25,
            "mask" => "255.255.255.128",
            "subnets" => 2,
            "count" => 128,
            "class_range" => "1/2",
            "class" => "C"
        ],
        [
            "bitcount" => 26,
            "mask" => "255.255.255.192",
            "subnets" => 4,
            "count" => 64,
            "class_range" => "1/4",
            "class" => "C"
        ],
        [
            "bitcount" => 27,
            "mask" => "255.255.255.224",
            "subnets" => 8,
            "count" => 32,
            "class_range" => "1/8",
            "class" => "C"
        ],
        [
            "bitcount" => 28,
            "mask" => "255.255.255.240",
            "subnets" => 16,
            "count" => 16,
            "class_range" => "1/16",
            "class" => "C"
        ],
        [
            "bitcount" => 29,
            "mask" => "255.255.255.248",
            "subnets" => 32,
            "count" => 8,
            "class_range" => "1/32",
            "class" => "C"
        ],
        [
            "bitcount" => 30,
            "mask" => "255.255.255.252",
            "subnets" => 64,
            "count" => 4,
            "class_range" => "1/64",
            "class" => "C"
        ],
        [
            "bitcount" => 31,
            "mask" => "255.255.255.254",
            "subnets" => null,
            "count" => 2,
            "class_range" => "1/128",
            "class" => "C"
        ],
        [
            "bitcount" => 32,
            "mask" => "255.255.255.255",
            "subnets" => null,
            "count" => null,
            "class_range" => null,
            "class" => null
        ]
    ];

    const RESERVED_SUBNETS = [
        [
            "subnet" => "0.0.0.0/8",
            "description" => "Source address `this` (`my`) network, designed for local use on the host when you create IP socket."
        ],
        [
            "subnet" => "0.0.0.0/32",
            "description" => "Used to specify the source address of the host."
        ],
        [
            "subnet" => "10.0.0.0/8",
            "description" => "For use in private networks."
        ],
        [
            "subnet" => "127.0.0.0/8",
            "description" => "They network for communications within the host."
        ],
        [
            "subnet" => "169.254.0.0/16",
            "description" => "Channel address; subnet is used to automatically configure the IP address in the absence of a DHCP server."
        ],
        [
            "subnet" => "172.16.0.0/12",
            "description" => "For use in private networks."
        ],
        [
            "subnet" => "100.64.0.0/10",
            "description" => "For use in the network service provider."
        ],
        [
            "subnet" => "192.0.0.0/24",
            "description" => "Register addresses for special purposes."
        ],
        [
            "subnet" => "192.0.2.0/24",
            "description" => "For the examples in the documentation."
        ],
        [
            "subnet" => "192.168.0.0/16",
            "description" => "For use in private networks."
        ],
        [
            "subnet" => "198.51.100.0/24",
            "description" => "For the examples in the documentation."
        ],
        [
            "subnet" => "198.18.0.0/15",
            "description" => "Stands for performance testing."
        ],
        [
            "subnet" => "203.0.113.0/24",
            "description" => "For the examples in the documentation."
        ],
        [
            "subnet" => "240.0.0.0/4",
            "description" => "Reserved for future use."
        ],
        [
            "subnet" => "255.255.255.255",
            "description" => "Limited broadcast address."
        ],
        [
            "subnet" => "192.88.99.0/24",
            "description" => "Used to send the nearest node."
        ],
        [
            "subnet" => "192.88.99.0/32",
            "description" => "Used as a repeater when encapsulating IPv6 in IPv4 (6to4)"
        ],
        [
            "subnet" => "224.0.0.0/4",
            "description" => "Used for multicasting."
        ]
    ];

    function __construct() {
        self::initI18N('app/helpers');
    }

    /**
     * Returns the netmask according to the cidr bitmask
     *
     * @param $bitcount integer
     * @return string
     */
    public static function subnet2netmask($bitcount) {
        $netmask = str_split(str_pad(str_pad('', $bitcount, '1'), 32, '0'), 8);
        foreach ($netmask as &$element) {
            $element = bindec($element);
        }

        return join('.', $netmask);
    }

    /**
     * Calculates the network bitmask
     *
     * @param string | integer $netmask
     * @return int
     */
    public static function netmask2bitcount($netmask) {

        if (is_string($mask))
            $mask = ip2long($mask);

        $base = ip2long('255.255.255.255');
        $bitcount = 32 - log(
                ($mask ^ $base) + 1, 2
            );

        return (int)$bitcount;
    }

    /**
     * Returns cidr by netmask
     *
     * @param $mask string, in format: XXX.XXX.XXX.0
     * @return integer
     */
    public static function netmask2cidr($mask) {
        return self::netmask2bitcount($mask . "/" . $bitcount);
    }

    /**
     * Returns netmask by cidr
     *
     * @param $cidr string, in format: XXX.XXX.XXX.XXX/YY
     * @return string
     */
    public static function cidr2netmask($cidr) {
        $ta = substr($cidr, strpos($cidr, '/') + 1) * 1;
        $netmask = str_split(str_pad(str_pad('', $ta, '1'), 32, '0'), 8);

        foreach ($netmask as &$element)
            $element = bindec($element);

        return join('.', $netmask);

    }

    /**
     * Returns cidr by ip
     *
     * @param $ip
     * @param int $method, where 1 - by ripe.net ip range, 2 - by hostinfo ip range
     * @return string|null
     */
    public static function ip2cidr($ip, $method = 1) {
        switch ($method) {
            case 1:
                $info = self::ipLookup($ip); // by ripe.net lookup database
                if (isset($info['inetnum']['inetnum'])) {
                    $range = explode('-', $info['inetnum']['inetnum']);
                    if (isset($range[0]) && isset($range[1])) {
                        $start = trim($range[0]);
                        $end = trim($range[1]);
                        $netmask = self::range2mask($start, $end);
                        $cidr = self::netmask2cidr($netmask);
                        return $start . "/" . $cidr;
                    }
                }
                break;

            case 2:
                $info = self::ipInfo($ip); // by hostinfo
                if (isset($info['network']) && isset($info['broadcast'])) {
                    $start = trim($info['network']);
                    $end = trim($info['broadcast']);
                    $netmask = self::range2mask($start, $end);
                    $cidr = self::netmask2bitcount($netmask);
                    return $start . "/" . $cidr;
                }
                break;
        }

        return null;
    }

    /**
     * Returns a range of IP addresses included in rank (cidr)
     *
     * @param $cidr string, in format: XXX.XXX.XXX.XXX/YY
     * @return array of IP with mask and range of IP`s
     */
    public static function cidr2range($cidr) {
        $ip = explode("/", $cidr);
        $mask = 0xFFFFFFFF;

        for ($j = 0; $j < 32 - $ip[1]; $j++) {
            $mask = $mask << 1;
        }

        $lip = ip2long($ip[0]);

        return [
            long2ip($lip & $mask) . '/' . long2ip($mask),
            long2ip($lip & $mask) . '-' . long2ip(($lip & $mask) + (~$mask))
        ];
    }

    /**
     * Returns an array of ranks (cidr) that include a range of IP addresses
     *
     * @param $ipStart string | integer, in format: XXX.XXX.XXX.XXX
     * @param $ipEnd string | integer, in format: XXX.XXX.XXX.XXX
     * @return array of cidr
     */
    public static function range2cidr($ipStart, $ipEnd) {

        if (is_string($ipStart) || is_string($ipEnd)) {
            $start = ip2long($ipStart);
            $end = ip2long($ipEnd);
        } else {
            $start = $ipStart;
            $end = $ipEnd;
        }

        $result = [];
        while ($end >= $start) {
            $maxSize = 32;

            while ($maxSize > 0) {
                $mask = hexdec(self::ipMask($maxSize - 1));
                $maskBase = $start & $mask;

                if ($maskBase != $start)
                    break;

                $maxSize--;
            }

            $x = log($end - $start + 1) / log(2);
            $maxDiff = floor(32 - floor($x));

            if ($maxSize < $maxDiff)
                $maxSize = $maxDiff;

            $ip = long2ip($start);
            array_push($result, "$ip/$maxSize");
            $start += pow(
                2, (32 - $maxSize)
            );
        }

        return $result;
    }

    /**
     * Returns netmask by range of IP addresses
     *
     * @param $ipStart string | integer, in format: XXX.XXX.XXX.XXX
     * @param $ipEnd string | integer, in format: XXX.XXX.XXX.XXX
     * @param bool $asInteger
     * @return int|string
     */
    public static function range2mask($ipStart, $ipEnd, $asInteger = false) {

        if (is_string($ipStart))
            $ipStart = ip2long($ipStart);

        if (is_string($ipEnd))
            $ipEnd = ip2long($ipEnd);

        if ($asInteger)
            return ($ipStart - $ipEnd) - 1;
        else
            return long2ip(($ipStart - $ipEnd) - 1);
    }

    /**
     * Applies the mask to ip and returns the subnet
     *
     * @param string | integer $ip IP-adress (v4), in format: XXX.XXX.XXX.XXX
     * @param string | integer $mask subnet mask, in format: XXX.XXX.XXX.XXX
     * @return string subnet, in format: XXX.XXX.XXX.XXX
     */
    public static function applyNetmask($ip, $mask) {

        if (is_string($ip))
            $ip = ip2long($ip);

        if (is_string($mask))
            $mask = ip2long($mask);

        return long2ip(sprintf('%u', $ip & $mask));
    }

    /**
     * Determines if the IP address is local
     *
     * @param string $ip IP-adress (v4), in format: XXX.XXX.XXX.XXX
     * @return boolean
     */
    public static function isLocalIp($ip) {
        if ('10.0.0.0' === self::applyNetmask($ip, '255.0.0.0'))
            return true;

        if ('72.16.0.0' === self::applyNetmask($ip, '255.255.0.0'))
            return true;

        if ('127.0.0.0' === self::applyNetmask($ip, '255.0.0.0'))
            return true;

        if ('192.168.0.0' === self::applyNetmask($ip, '255.255.0.0'))
            return true;

        return false;
    }

    /**
     * Converts IP address to HEX
     *
     * @param $ip IP-adress (v4), in format: XXX.XXX.XXX.XXX
     * @return string
     */
    public static function ip2hex($ip) {
        $iparr = explode(".", $ip);
        foreach($iparr as $i => $group) {
            @$hex .= self::zerofill(base_convert($group,10,16),2);
        }
        return $hex;
    }

    /**
     * Converts HEX to IP address
     *
     * @param $hex string
     * @return string
     */
    public static function hex2ip($hex) {
        for($i=0; $i<4; $i++)
            @$ip .= base_convert(mb_substr($hex,$i*2,2),16,10).".";

        return mb_substr($ip,0,-1);
    }

    /**
     * Fills the string with zeros to the required length
     *
     * @param string $val
     * @param integer $len
     * @param bool $reverse
     * @return string
     */
    public static function zeroFill($val, $len, $reverse = false) {
        while (mb_strlen($val) < $len) {
            if ($reverse)
                $val .= "0";
            else
                $val = "0" . $val;
        }
        return $val;
    }

    /**
     * Converts HEX to binary data
     *
     * @param string $hex
     * @return string
     */
    public static function hex2bin($hex) {
        return self::zeroFill(base_convert($hex, 16, 2), 32);
    }

    /**
     * Converts binary data to HEX
     *
     * @param string $bin
     * @return string
     */
    public static function bin2hex($bin) {
        return self::zeroFill(base_convert($bin, 2, 16), 8);
    }

    /**
     * Displays complete information about the IP address by netmask
     *
     * @param $ip, IP-adress (v4) in format: XXX.XXX.XXX.XXX
     * @param $netmask IP-adress (v4), in format: XXX.XXX.XXX.XXX
     * @return array
     */
    public static function ipInfo($ip, $netmask = null) {

        if (!$netmask)
            $netmask = self::ipMask($ip);

        $iphex = self::ip2hex($ip);
        $netbin = self::hex2bin($iphex);
        $maskhex = self::ip2hex($netmask);
        $maskbin = self::hex2bin($maskhex);

        $hostbits = mb_substr($maskbin, mb_strpos($maskbin, "0"));
        $netbits = mb_substr($maskbin, 0, mb_strpos($maskbin, "0"));
        $nethex = self::bin2hex(self::zeroFill(mb_substr($netbin, 0, mb_strlen($netbits)), 32, true));

        $hosts = pow(2, mb_strlen($hostbits));
        $available_hosts = $hosts - 3;

        return [
            "ip" => $ip,
            "mask" => $netmask,
            "network" => self::hex2ip($nethex),
            "netstr" => self::hex2ip($nethex) . "/" . mb_strlen($netbits),
            "hosts" => $available_hosts,
            "firstip" => self::hex2ip(self::zeroFill(base_convert(base_convert($nethex, 16, 10) +1,10,16), 8)),
            "lastip" => self::hex2ip(self::zeroFill(base_convert(base_convert($nethex, 16, 10) + $available_hosts + 1, 10, 16), 8)),
            "broadcast" => self::hex2ip(self::zeroFill(base_convert(base_convert($nethex, 16, 10) + $available_hosts + 2, 10, 16), 8))
        ];
    }

    /**
     * Search and return info about ip by ripe.net database
     *
     * @param string $ip, IP-adress (v4) in format: XXX.XXX.XXX.XXX
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public static function ipLookup($ip) {
        $client = new \yii\httpclient\Client();

        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://rest.db.ripe.net/search')
            ->setData(['query-string' => $ip])
            ->send();

        $results = [];
        if ($response->isOk) {
            if (isset($response->data['objects']['object'])) {
                $objects = $response->data['objects']['object'];
                foreach ($objects as $object) {
                    if (isset($object['@attributes']['type'])) {
                        $type = $object['@attributes']['type'];
                        if (isset($object['attributes']['attribute'])) {
                            $attributes = $object['attributes']['attribute'];
                            foreach ($attributes as $attribute) {
                                if (isset($attribute['@attributes']['name']) && isset($attribute['@attributes']['value'])) {
                                    $name = $attribute['@attributes']['name'];
                                    $value = $attribute['@attributes']['value'];
                                    $results[$type][$name] = $value;
                                }
                            }
                        }
                    }
                }
            }
        }

        return($results);
    }

    /**
     * Get list of IP adress by range
     *
     * @param string | array $range
     * @param bool $asInteger
     * @return array
     */
    public static function range2list($range, $asInteger = false) {
        $list = [];

        if (!is_array($range) && is_string($range))
            $range = [$range];

        foreach($range as $address) {
            if (preg_match('/([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)(\-|\/)([0-9]+)$/', $address, $matches)) {
                $ip = $matches[1] . '.' . $matches[2] . '.' . $matches[3] . '.' . $matches[4];
                $ipLong = ip2long($ip);

                if ($ipLong !== false) {
                    switch($matches[5]) {
                        case '-':
                            $numIp = $matches[6];
                            break;
                        case '/':
                            $cidr = $matches[6];
                            if ( $cidr >= 1 && $cidr <= 32 ) {
                                $numIp = pow(2, 32 - $cidr); // Number of IP addresses in range
                                $netmask = (~ ($numIp - 1)); // Network mask
                                $ipLong = $ipLong & $netmask; // First IP address (even if given IP was not the first in the CIDR range)
                            }
                            else {
                                echo "\t" . "Specified CIDR " . $cidr . " is invalid (should be between 1 and 32)\n";
                                $numIp = -1;
                            }
                            break;
                    }

                    for ($ipRange = 0; $ipRange < $numIp; $ipRange++) {
                        if ($asInteger)
                            $list[] = ($ipLong + $ipRange);
                        else
                            $list[] = long2ip($ipLong + $ipRange);
                    }

                } else {
                    echo "\t" . $ip . " is invalid\n";
                }
            } else  {
                echo "\tUnrecognized pattern: " . $address . "\n";
            }

        }

        return $list;
    }


    /**
     * Simply mask of IP.
     * Note: This is a rough definition of the client's subnet mask, as the exact subnet mask cannot be determined by the server.
     *
     * @param string $ip, in format: XXX.XXX.XXX.XXX
     * @param bool $asInteger
     * @return int|string
     */
    public static function ipMask($ip, $asInteger = false) {
        if (is_string($ip))
            $ip = ip2long($ip);

        if (($ip & 0x80000000) == 0)
            $mask = 0xFF000000;
        elseif (($ip & 0xC0000000) == (int)0x80000000)
            $mask = 0xFFFF0000;
        elseif (($ip & 0xE0000000) == (int)0xC0000000)
            $mask = 0xFFFFFF00;
        else
            $mask = 0xFFFFFFFF;

        if ($asInteger)
            return $mask;
        else
            return long2ip($mask);
    }

    /**
     * Specifies the IPv4 or IPv6 IP version
     *
     * @param $ip
     * @return string|null
     */
    public static function ipVersion($ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
            return "IPv4";

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
            return "IPv6";

        return null;
    }

    /**
     * Returns information about the IP address mask
     *
     * @param null|string $mask
     * @return array|mixed
     */
    public static function getNetmaskInfo($mask = null) {
        if ($mask) {
            foreach (self::NETMASK_INFO as $key => $info) {
                if (($info['mask'] === $mask) || ($info['mask'].'00' === $mask)) {
                    return $info;
                }
            }
        }
        return self::NETMASK_INFO;
    }

    /**
     * Returns information about reserved (service) networks
     *
     * @return array
     */
    public static function getReservedSubnets() {
        self::initI18N('app/helpers');
        $subnets = self::RESERVED_SUBNETS;
        foreach ($subnets as $key => $subnet) {
            if ($subnet['description']) {
                $subnets[$key]['description'] = Yii::t('app/helpers', $subnet['description']);
            }
        }
        return $subnets;
    }

    /**
     * Initialize translations
     */
    private static function initI18N($category)
    {
        if (!empty(Yii::$app->i18n->translations['app/helpers']))
            return;

        Yii::$app->i18n->translations['app/helpers'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/wdmg/yii2-helpers/messages',
        ];
    }

}