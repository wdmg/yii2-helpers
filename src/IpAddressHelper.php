<?php

namespace wdmg\helpers;

/**
 * Yii2 IP address helper
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

class IpAddressHelper extends BaseArrayHelper
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

    const WHOIS_SERVERS = [
        "tw" => ["whois.twnic.net.tw", "whois.nic.tw", "whois.tw", "tw.whois-servers.net"],
        "tl" => ["whois.nic.tl", "whois.tl", "tl.whois-servers.net"],
        "pro" => ["whois.dotproregistry.net", "whois.nic.pro", "whois.pro", "pro.whois-servers.net"],
        "et" => ["whois.nic.et", "whois.et", "et.whois-servers.net"],
        "za" => ["whois.nic.za", "whois.za", "za.whois-servers.net"],
        "gs" => ["whois.nic.gs", "whois.gs", "gs.whois-servers.net"],
        "kr" => ["whois.kr", "whois.nic.kr", "kr.whois-servers.net"],
        "jm" => ["whois.nic.jm", "whois.jm", "jm.whois-servers.net"],
        "jp" => ["whois.jprs.jp", "whois.nic.jp", "whois.jp", "jp.whois-servers.net"],
        "vt" => ["whois.nic.vt", "whois.vt", "vt.whois-servers.net"],
        "ab" => ["whois.nic.ab", "whois.ab", "ab.whois-servers.net"],
        "bq" => ["whois.nic.bq", "whois.bq", "bq.whois-servers.net"],
        "cw" => ["whois.nic.cw", "whois.cw", "cw.whois-servers.net"],
        "sx" => ["whois.sx", "whois.nic.sx", "sx.whois-servers.net"],
        "os" => ["whois.nic.os", "whois.os", "os.whois-servers.net"],
        "ss" => ["whois.nic.ss", "whois.ss", "ss.whois-servers.net"],
        "td" => ["whois.nic.td", "whois.td", "td.whois-servers.net"],
        "cz" => ["whois.nic.cz", "whois.cz", "cz.whois-servers.net"],
        "cl" => ["whois.nic.cl", "whois.cl", "cl.whois-servers.net"],
        "ch" => ["whois.nic.ch", "whois.ch", "ch.whois-servers.net"],
        "se" => ["whois.iis.se", "whois.nic.se", "whois.se", "se.whois-servers.net"],
        "sj" => ["whois.nic.sj", "whois.sj", "sj.whois-servers.net"],
        "lk" => ["whois.nic.lk", "whois.lk", "lk.whois-servers.net"],
        "ec" => ["whois.nic.ec", "whois.ec", "ec.whois-servers.net"],
        "gq" => ["whois.nic.gq", "whois.gq", "gq.whois-servers.net"],
        "ax" => ["whois.ax", "whois.nic.ax", "ax.whois-servers.net"],
        "sv" => ["whois.nic.sv", "whois.sv", "sv.whois-servers.net"],
        "er" => ["whois.nic.er", "whois.er", "er.whois-servers.net"],
        "ee" => ["whois.tld.ee", "whois.nic.ee", "whois.ee", "ee.whois-servers.net"],
        "ua" => ["whois.ua", "whois.nic.ua", "ua.whois-servers.net"],
        "wf" => ["whois.nic.wf", "whois.wf", "wf.whois-servers.net"],
        "uy" => ["whois.nic.org.uy", "whois.nic.uy", "whois.uy", "uy.whois-servers.net"],
        "fo" => ["whois.nic.fo", "whois.fo", "fo.whois-servers.net"],
        "fj" => ["whois.nic.fj", "whois.fj", "fj.whois-servers.net"],
        "ph" => ["whois.nic.ph", "whois.ph", "ph.whois-servers.net"],
        "fi" => ["whois.fi", "whois.nic.fi", "fi.whois-servers.net"],
        "fk" => ["whois.nic.fk", "whois.fk", "fk.whois-servers.net"],
        "fr" => ["whois.nic.fr", "whois.fr", "fr.whois-servers.net"],
        "gf" => ["whois.nic.gf", "whois.gf", "gf.whois-servers.net"],
        "pf" => ["whois.registry.pf", "whois.nic.pf", "whois.pf", "pf.whois-servers.net"],
        "tf" => ["whois.nic.tf", "whois.tf", "tf.whois-servers.net"],
        "hr" => ["whois.dns.hr", "whois.nic.hr", "whois.hr", "hr.whois-servers.net"],
        "cf" => ["whois.dot.cf", "whois.nic.cf", "whois.cf", "cf.whois-servers.net"],
        "to" => ["whois.tonic.to", "whois.nic.to", "whois.to", "to.whois-servers.net"],
        "tt" => ["whois.nic.tt", "whois.tt", "tt.whois-servers.net"],
        "tv" => ["tvwhois.verisign-grs.com", "whois.nic.tv", "whois.tv", "tv.whois-servers.net"],
        "tn" => ["whois.ati.tn", "whois.nic.tn", "whois.tn", "tn.whois-servers.net"],
        "tm" => ["whois.nic.tm", "whois.tm", "tm.whois-servers.net"],
        "tr" => ["whois.nic.tr", "whois.tr", "tr.whois-servers.net"],
        "ug" => ["whois.co.ug", "whois.nic.ug", "whois.ug", "ug.whois-servers.net"],
        "uz" => ["whois.cctld.uz", "whois.nic.uz", "whois.uz", "uz.whois-servers.net"],
        "tg" => ["whois.nic.tg", "whois.tg", "tg.whois-servers.net"],
        "tk" => ["whois.dot.tk", "whois.nic.tk", "whois.tk", "tk.whois-servers.net"],
        "sg" => ["whois.sgnic.sg", "whois.nic.sg", "whois.sg", "sg.whois-servers.net"],
        "sy" => ["whois.tld.sy", "whois.nic.sy", "whois.sy", "sy.whois-servers.net"],
        "sk" => ["whois.sk-nic.sk", "whois.nic.sk", "whois.sk", "sk.whois-servers.net"],
        "si" => ["whois.arnes.si", "whois.nic.si", "whois.si", "si.whois-servers.net"],
        "gb" => ["whois.nic.gb", "whois.gb", "gb.whois-servers.net"],
        "us" => ["whois.nic.us", "whois.us", "us.whois-servers.net"],
        "sb" => ["whois.nic.net.sb", "whois.nic.sb", "whois.sb", "sb.whois-servers.net"],
        "so" => ["whois.nic.so", "whois.so", "so.whois-servers.net"],
        "sd" => ["whois.nic.sd", "whois.sd", "sd.whois-servers.net"],
        "sr" => ["whois.nic.sr", "whois.sr", "sr.whois-servers.net"],
        "sl" => ["whois.nic.sl", "whois.sl", "sl.whois-servers.net"],
        "tj" => ["whois.nic.tj", "whois.tj", "tj.whois-servers.net"],
        "th" => ["whois.thnic.co.th", "whois.nic.th", "whois.th", "th.whois-servers.net"],
        "tz" => ["whois.tznic.or.tz", "whois.nic.tz", "whois.tz", "tz.whois-servers.net"],
        "sn" => ["whois.nic.sn", "whois.sn", "sn.whois-servers.net"],
        "vc" => ["whois2.afilias-grs.net", "whois.nic.vc", "whois.vc", "vc.whois-servers.net"],
        "lc" => ["whois.nic.lc", "whois.lc", "lc.whois-servers.net"],
        "kn" => ["whois.nic.kn", "whois.kn", "kn.whois-servers.net"],
        "rs" => ["whois.rnids.rs", "whois.nic.rs", "whois.rs", "rs.whois-servers.net"],
        "sc" => ["whois2.afilias-grs.net", "whois.nic.sc", "whois.sc", "sc.whois-servers.net"],
        "mp" => ["whois.nic.mp", "whois.mp", "mp.whois-servers.net"],
        "bl" => ["whois.nic.bl", "whois.bl", "bl.whois-servers.net"],
        "pm" => ["whois.nic.pm", "whois.pm", "pm.whois-servers.net"],
        "pl" => ["whois.dns.pl", "whois.nic.pl", "whois.pl", "pl.whois-servers.net"],
        "pt" => ["whois.dns.pt", "whois.nic.pt", "whois.pt", "pt.whois-servers.net"],
        "pr" => ["whois.nic.pr", "whois.pr", "pr.whois-servers.net"],
        "mk" => ["whois.nic.mk", "whois.mk", "mk.whois-servers.net"],
        "re" => ["whois.nic.re", "whois.re", "re.whois-servers.net"],
        "rw" => ["whois.nic.rw", "whois.rw", "rw.whois-servers.net"],
        "ro" => ["whois.rotld.ro", "whois.nic.ro", "whois.ro", "ro.whois-servers.net"],
        "ws" => ["whois.website.ws", "whois.nic.ws", "whois.ws", "ws.whois-servers.net"],
        "sm" => ["whois.nic.sm", "whois.sm", "sm.whois-servers.net"],
        "st" => ["whois.nic.st", "whois.st", "st.whois-servers.net"],
        "sa" => ["whois.nic.net.sa", "whois.nic.sa", "whois.sa", "sa.whois-servers.net"],
        "sz" => ["whois.nic.sz", "whois.sz", "sz.whois-servers.net"],
        "sh" => ["whois.nic.sh", "whois.sh", "sh.whois-servers.net"],
        "kp" => ["whois.nic.kp", "whois.kp", "kp.whois-servers.net"],
        "cx" => ["whois.nic.cx", "whois.cx", "cx.whois-servers.net"],
        "mf" => ["whois.nic.mf", "whois.mf", "mf.whois-servers.net"],
        "hm" => ["whois.nic.hm", "whois.hm", "hm.whois-servers.net"],
        "ky" => ["whois.nic.ky", "whois.ky", "ky.whois-servers.net"],
        "ck" => ["whois.nic.ck", "whois.ck", "ck.whois-servers.net"],
        "tc" => ["whois.meridiantld.net", "whois.nic.tc", "whois.tc", "tc.whois-servers.net"],
        "pk" => ["whois.nic.pk", "whois.pk", "pk.whois-servers.net"],
        "pw" => ["whois.nic.pw", "whois.pw", "pw.whois-servers.net"],
        "ps" => ["whois.nic.ps", "whois.ps", "ps.whois-servers.net"],
        "pa" => ["whois.nic.pa", "whois.pa", "pa.whois-servers.net"],
        "va" => ["whois.nic.va", "whois.va", "va.whois-servers.net"],
        "pg" => ["whois.nic.pg", "whois.pg", "pg.whois-servers.net"],
        "py" => ["whois.nic.py", "whois.py", "py.whois-servers.net"],
        "pe" => ["kero.yachay.pe", "whois.nic.pe", "whois.pe", "pe.whois-servers.net"],
        "pn" => ["whois.nic.pn", "whois.pn", "pn.whois-servers.net"],
        "im" => ["whois.nic.im", "whois.im", "im.whois-servers.net"],
        "xxx" => ["whois.nic.xxx", "whois.xxx", "xxx.whois-servers.net"],
        "nf" => ["whois.nic.nf", "whois.nf", "nf.whois-servers.net"],
        "om" => ["whois.registry.om", "whois.nic.om", "whois.om", "om.whois-servers.net"],
        "bv" => ["whois.nic.bv", "whois.bv", "bv.whois-servers.net"],
        "cp" => ["whois.nic.cp", "whois.cp", "cp.whois-servers.net"],
        "gov" => ["whois.dotgov.gov", "whois.nic.gov", "whois.gov", "gov.whois-servers.net"],
        "nu" => ["whois.iis.nu", "whois.nic.nu", "whois.nu", "nu.whois-servers.net"],
        "nz" => ["whois.srs.net.nz", "whois.nic.nz", "whois.nz", "nz.whois-servers.net"],
        "nc" => ["whois.nc", "whois.nic.nc", "nc.whois-servers.net"],
        "no" => ["whois.norid.no", "whois.nic.no", "whois.no", "no.whois-servers.net"],
        "edu" => ["whois.educause.edu", "whois.nic.edu", "whois.edu", "edu.whois-servers.net"],
        "name" => ["whois.nic.name", "whois.name", "name.whois-servers.net"],
        "me" => ["whois.nic.me", "whois.me", "me.whois-servers.net"],
        "ae" => ["whois.aeda.net.ae", "whois.nic.ae", "whois.ae", "ae.whois-servers.net"],
        "net" => ["whois.verisign-grs.com", "whois.nic.net", "whois.net", "net.whois-servers.net"],
        "su" => ["whois.tcinet.ru", "su.whois-servers.net"],
        "mn" => ["whois.nic.mn", "whois.mn", "mn.whois-servers.net"],
        "ms" => ["whois.nic.ms", "whois.ms", "ms.whois-servers.net"],
        "mm" => ["whois.nic.mm", "whois.mm", "mm.whois-servers.net"],
        "na" => ["whois.na-nic.com.na", "whois.nic.na", "whois.na", "na.whois-servers.net"],
        "nr" => ["whois.nic.nr", "whois.nr", "nr.whois-servers.net"],
        "np" => ["whois.nic.np", "whois.np", "np.whois-servers.net"],
        "ne" => ["whois.nic.ne", "whois.ne", "ne.whois-servers.net"],
        "ng" => ["whois.nic.net.ng", "whois.nic.ng", "whois.ng", "ng.whois-servers.net"],
        "an" => ["whois.nic.an", "whois.an", "an.whois-servers.net"],
        "nl" => ["whois.domain-registry.nl", "whois.nic.nl", "whois.nl", "nl.whois-servers.net"],
        "ni" => ["whois.nic.ni", "whois.ni", "ni.whois-servers.net"],
        "info" => ["whois.afilias.net", "whois.nic.info", "whois.info", "info.whois-servers.net"],
        "mz" => ["whois.nic.mz", "whois.mz", "mz.whois-servers.net"],
        "md" => ["whois.nic.md", "whois.md", "md.whois-servers.net"],
        "mc" => ["whois.nic.mc", "whois.mc", "mc.whois-servers.net"],
        "mh" => ["whois.nic.mh", "whois.mh", "mh.whois-servers.net"],
        "mx" => ["whois.mx", "whois.nic.mx", "mx.whois-servers.net"],
        "fm" => ["whois.nic.fm", "whois.fm", "fm.whois-servers.net"],
        "com" => ["whois.verisign-grs.com", "com.whois-servers.net"],
        "lt" => ["whois.domreg.lt", "whois.nic.lt", "whois.lt", "lt.whois-servers.net"],
        "lu" => ["whois.dns.lu", "whois.nic.lu", "whois.lu", "lu.whois-servers.net"],
        "mu" => ["whois.nic.mu", "whois.mu", "mu.whois-servers.net"],
        "mr" => ["whois.nic.mr", "whois.mr", "mr.whois-servers.net"],
        "mg" => ["whois.nic.mg", "whois.mg", "mg.whois-servers.net"],
        "yt" => ["whois.nic.yt", "whois.yt", "yt.whois-servers.net"],
        "mo" => ["whois.monic.mo", "whois.nic.mo", "whois.mo", "mo.whois-servers.net"],
        "mw" => ["whois.nic.mw", "whois.mw", "mw.whois-servers.net"],
        "my" => ["whois.domainregistry.my", "whois.nic.my", "whois.my", "my.whois-servers.net"],
        "ml" => ["whois.dot.ml", "whois.nic.ml", "whois.ml", "ml.whois-servers.net"],
        "um" => ["whois.nic.um", "whois.um", "um.whois-servers.net"],
        "mv" => ["whois.nic.mv", "whois.mv", "mv.whois-servers.net"],
        "mt" => ["whois.nic.mt", "whois.mt", "mt.whois-servers.net"],
        "ma" => ["whois.iam.net.ma", "whois.nic.ma", "whois.ma", "ma.whois-servers.net"],
        "mq" => ["whois.nic.mq", "whois.mq", "mq.whois-servers.net"],
        "cg" => ["whois.nic.cg", "whois.cg", "cg.whois-servers.net"],
        "cd" => ["whois.nic.cd", "whois.cd", "cd.whois-servers.net"],
        "cr" => ["whois.nic.cr", "whois.cr", "cr.whois-servers.net"],
        "ci" => ["whois.nic.ci", "whois.ci", "ci.whois-servers.net"],
        "cu" => ["whois.nic.cu", "whois.cu", "cu.whois-servers.net"],
        "kw" => ["whois.nic.kw", "whois.kw", "kw.whois-servers.net"],
        "la" => ["whois.nic.la", "whois.la", "la.whois-servers.net"],
        "lv" => ["whois.nic.lv", "whois.lv", "lv.whois-servers.net"],
        "ls" => ["whois.nic.ls", "whois.ls", "ls.whois-servers.net"],
        "lb" => ["whois.nic.lb", "whois.lb", "lb.whois-servers.net"],
        "ru" => ["whois.tcinet.ru", "whois.nic.ru", "whois.ru", "ru.whois-servers.net", "whois.naunet.ru", "whois.reg.ru", "whois.r01.ru", "whois.ripn.ru"],
        "ly" => ["whois.nic.ly", "whois.ly", "ly.whois-servers.net"],
        "lr" => ["whois.nic.lr", "whois.lr", "lr.whois-servers.net"],
        "li" => ["whois.nic.li", "whois.li", "li.whois-servers.net"],
        "cv" => ["whois.nic.cv", "whois.cv", "cv.whois-servers.net"],
        "kz" => ["whois.nic.kz", "whois.kz", "kz.whois-servers.net"],
        "kh" => ["whois.nic.kh", "whois.kh", "kh.whois-servers.net"],
        "cm" => ["whois.nic.cm", "whois.cm", "cm.whois-servers.net"],
        "ca" => ["whois.cira.ca", "whois.nic.ca", "whois.ca", "ca.whois-servers.net"],
        "qa" => ["whois.registry.qa", "whois.nic.qa", "whois.qa", "qa.whois-servers.net"],
        "ke" => ["whois.kenic.or.ke", "whois.nic.ke", "whois.ke", "ke.whois-servers.net"],
        "cy" => ["whois.nic.cy", "whois.cy", "cy.whois-servers.net"],
        "kg" => ["whois.domain.kg", "whois.nic.kg", "whois.kg", "kg.whois-servers.net"],
        "ki" => ["whois.nic.ki", "whois.ki", "ki.whois-servers.net"],
        "cn" => ["whois.cnnic.cn", "whois.nic.cn", "whois.cn", "cn.whois-servers.net"],
        "cc" => ["ccwhois.verisign-grs.com", "whois.nic.cc", "whois.cc", "cc.whois-servers.net"],
        "co" => ["whois.nic.co", "whois.co", "co.whois-servers.net"],
        "km" => ["whois.nic.km", "whois.km", "km.whois-servers.net"],
        "do" => ["whois.nic.do", "whois.do", "do.whois-servers.net"],
        "eg" => ["whois.nic.eg", "whois.eg", "eg.whois-servers.net"],
        "zm" => ["whois.nic.zm", "whois.zm", "zm.whois-servers.net"],
        "eh" => ["whois.nic.eh", "whois.eh", "eh.whois-servers.net"],
        "zw" => ["whois.nic.zw", "whois.zw", "zw.whois-servers.net"],
        "il" => ["whois.isoc.org.il", "whois.nic.il", "whois.il", "il.whois-servers.net"],
        "in" => ["whois.inregistry.net", "whois.nic.in", "whois.in", "in.whois-servers.net"],
        "id" => ["whois.pandi.or.id", "whois.nic.id", "whois.id", "id.whois-servers.net"],
        "jo" => ["whois.nic.jo", "whois.jo", "jo.whois-servers.net"],
        "iq" => ["whois.cmc.iq", "whois.nic.iq", "whois.iq", "iq.whois-servers.net"],
        "ir" => ["whois.nic.ir", "whois.ir", "ir.whois-servers.net"],
        "ie" => ["whois.domainregistry.ie", "whois.nic.ie", "whois.ie", "ie.whois-servers.net"],
        "is" => ["whois.isnic.is", "whois.nic.is", "whois.is", "is.whois-servers.net"],
        "es" => ["whois.nic.es", "whois.es", "es.whois-servers.net"],
        "it" => ["whois.nic.it", "whois.it", "it.whois-servers.net"],
        "ye" => ["whois.nic.ye", "whois.ye", "ye.whois-servers.net"],
        "gi" => ["whois2.afilias-grs.net", "whois.nic.gi", "whois.gi", "gi.whois-servers.net"],
        "hn" => ["whois.nic.hn", "whois.hn", "hn.whois-servers.net"],
        "hk" => ["whois.hkirc.hk", "whois.nic.hk", "whois.hk", "hk.whois-servers.net"],
        "gd" => ["whois.nic.gd", "whois.gd", "gd.whois-servers.net"],
        "gl" => ["whois.nic.gl", "whois.gl", "gl.whois-servers.net"],
        "gr" => ["whois.nic.gr", "whois.gr", "gr.whois-servers.net"],
        "ge" => ["whois.nic.ge", "whois.ge", "ge.whois-servers.net"],
        "gu" => ["whois.nic.gu", "whois.gu", "gu.whois-servers.net"],
        "dk" => ["whois.dk-hostmaster.dk", "whois.nic.dk", "whois.dk", "dk.whois-servers.net"],
        "je" => ["whois.je", "whois.nic.je", "je.whois-servers.net"],
        "dj" => ["whois.nic.dj", "whois.dj", "dj.whois-servers.net"],
        "dm" => ["whois.nic.dm", "whois.dm", "dm.whois-servers.net"],
        "vu" => ["whois.nic.vu", "whois.vu", "vu.whois-servers.net"],
        "hu" => ["whois.nic.hu", "whois.hu", "hu.whois-servers.net"],
        "ve" => ["whois.nic.ve", "whois.ve", "ve.whois-servers.net"],
        "vg" => ["whois.adamsnames.tc", "whois.nic.vg", "whois.vg", "vg.whois-servers.net"],
        "vi" => ["whois.nic.vi", "whois.vi", "vi.whois-servers.net"],
        "vn" => ["whois.nic.vn", "whois.vn", "vn.whois-servers.net"],
        "ga" => ["whois.nic.ga", "whois.ga", "ga.whois-servers.net"],
        "ht" => ["whois.nic.ht", "whois.ht", "ht.whois-servers.net"],
        "gy" => ["whois.registry.gy", "whois.nic.gy", "whois.gy", "gy.whois-servers.net"],
        "gm" => ["whois.nic.gm", "whois.gm", "gm.whois-servers.net"],
        "gh" => ["whois.nic.gh", "whois.gh", "gh.whois-servers.net"],
        "gp" => ["whois.nic.gp", "whois.gp", "gp.whois-servers.net"],
        "gt" => ["whois.nic.gt", "whois.gt", "gt.whois-servers.net"],
        "gn" => ["whois.nic.gn", "whois.gn", "gn.whois-servers.net"],
        "gw" => ["whois.nic.gw", "whois.gw", "gw.whois-servers.net"],
        "de" => ["whois.denic.de", "whois.nic.de", "whois.de", "de.whois-servers.net"],
        "gg" => ["whois.gg", "whois.nic.gg", "gg.whois-servers.net"],
        "bi" => ["whois1.nic.bi", "whois.nic.bi", "whois.bi", "bi.whois-servers.net"],
        "bt" => ["whois.nic.bt", "whois.bt", "bt.whois-servers.net"],
        "bs" => ["whois.nic.bs", "whois.bs", "bs.whois-servers.net"],
        "bd" => ["whois.nic.bd", "whois.bd", "bd.whois-servers.net"],
        "bb" => ["whois.nic.bb", "whois.bb", "bb.whois-servers.net"],
        "bh" => ["whois.nic.bh", "whois.bh", "bh.whois-servers.net"],
        "by" => ["whois.cctld.by", "whois.nic.by", "whois.by", "by.whois-servers.net"],
        "bz" => ["whois.nic.bz", "whois.bz", "bz.whois-servers.net"],
        "be" => ["whois.dns.be", "whois.nic.be", "whois.be", "be.whois-servers.net"],
        "bj" => ["whois.nic.bj", "whois.bj", "bj.whois-servers.net"],
        "bm" => ["whois.nic.bm", "whois.bm", "bm.whois-servers.net"],
        "bg" => ["whois.register.bg", "whois.nic.bg", "whois.bg", "bg.whois-servers.net"],
        "bo" => ["whois.nic.bo", "whois.bo", "bo.whois-servers.net"],
        "ba" => ["whois.nic.ba", "whois.ba", "ba.whois-servers.net"],
        "bw" => ["whois.nic.net.bw", "whois.nic.bw", "whois.bw", "bw.whois-servers.net"],
        "br" => ["whois.registro.br", "whois.nic.br", "whois.br", "br.whois-servers.net"],
        "io" => ["whois.nic.io", "whois.io", "io.whois-servers.net"],
        "bn" => ["whois.bn", "whois.nic.bn", "bn.whois-servers.net"],
        "bf" => ["whois.nic.bf", "whois.bf", "bf.whois-servers.net"],
        "at" => ["whois.nic.at", "whois.at", "at.whois-servers.net"],
        "az" => ["whois.nic.az", "whois.az", "az.whois-servers.net"],
        "al" => ["whois.nic.al", "whois.al", "al.whois-servers.net"],
        "dz" => ["whois.nic.dz", "whois.dz", "dz.whois-servers.net"],
        "as" => ["whois.nic.as", "whois.as", "as.whois-servers.net"],
        "ai" => ["whois.ai", "whois.nic.ai", "ai.whois-servers.net"],
        "ao" => ["whois.nic.ao", "whois.ao", "ao.whois-servers.net"],
        "ad" => ["whois.nic.ad", "whois.ad", "ad.whois-servers.net"],
        "aq" => ["whois.nic.aq", "whois.aq", "aq.whois-servers.net"],
        "ag" => ["whois.nic.ag", "whois.ag", "ag.whois-servers.net"],
        "ar" => ["whois.nic.ar", "whois.ar", "ar.whois-servers.net"],
        "am" => ["whois.amnic.net", "whois.nic.am", "whois.am", "am.whois-servers.net"],
        "aw" => ["whois.nic.aw", "whois.aw", "aw.whois-servers.net"],
        "af" => ["whois.nic.af", "whois.af", "af.whois-servers.net"],
        "au" => ["whois.audns.net.au", "whois.nic.au", "whois.au", "au.whois-servers.net"],
        "eu" => ["whois.eu", "eu.whois-servers.net"],
        "xn--p1ai" => ["whois.naunet.ru", "whois.reg.ru", "whois.r01.ru"], // рф
        "mobi" => ["whois.dotmobiregistry.net", "mobi.whois-servers.net"],
        "org" => ["whois.pir.org", "org.whois-servers.net"],
        "biz" => ["whois.biz", "whois.nic.biz", "biz.whois-servers.net"],
        "uk" => ["whois.nic.uk", "uk.whois-servers.net"],
        "xn--j1amh" => ["whois.dotukr.com"], // укр
        "pru" => ["whois.nic.pru", "pru.whois-servers.net"],
        "asia" => ["whois.nic.asia", "asia.whois-servers.net"],
        "photo" => ["whois.uniregistry.net", "whois.nic.photo", "photo.whois-servers.net"],
        "tel" => ["whois.nic.tel", "tel.whois-servers.net"],
        "institute" => ["whois.donuts.co", "whois.nic.institute", "institute.whois-servers.net"],
        "city" => ["whois.donuts.co", "whois.nic.city"],
        "aero" => ["whois.aero", "aero.whois-servers.net"],
        "gop" => ["whois-cl01.mm-registry.com", "whois.nic.gop", "gop.whois-servers.net"],
        "life" => ["whois.donuts.co", "whois.nic.life"],
        "land" => ["whois.donuts.co", "whois.nic.land", "land.whois-servers.net"],
        "pub" => ["whois.unitedtld.com", "whois.nic.pub", "pub.whois-servers.net"],
        "club" => ["whois.nic.club", "club.whois-servers.net"],
        "today" => ["whois.donuts.co", "whois.nic.today", "today.whois-servers.net"],
        "xn--80adxhks" => ["whois.nic.xn--80adxhks"], // москва
        "photography" => ["whois.donuts.co", "whois.nic.photography", "photography.whois-servers.net"],
        "xn--80asehdb" => ["whois.online.rs.corenic.net", "whois.nic.xn--80asehdb"], // онлайн
        "ooo" => ["whois.nic.ooo"],
        "arpa" => ["whois.iana.org", "arpa.whois-servers.net"],
        "moscow" => ["whois.nic.moscow", "moscow.whois-servers.net"],
        "events" => ["whois.donuts.co", "whois.nic.events", "events.whois-servers.net"],
        "travel" => ["whois.nic.travel", "travel.whois-servers.net"],
        "guru" => ["whois.donuts.co", "whois.nic.guru", "guru.whois-servers.net"],
        "menu" => ["whois.nic.menu", "menu.whois-servers.net"],
        "xn--80aswg" => ["whois.site.rs.corenic.net", "whois.nic.xn--80aswg"], // сайт
        "center" => ["whois.donuts.co", "whois.nic.center", "center.whois-servers.net"],
        "yandex" => ["whois.nic.yandex"],
        "farm" => ["whois.donuts.co", "whois.nic.farm", "farm.whois-servers.net"],
        "click" => ["whois.uniregistry.net", "whois.nic.click"],
        "support" => ["whois.donuts.co", "whois.nic.support", "support.whois-servers.net"],
        "website" => ["whois.nic.website"],
        "xyz" => ["whois.nic.xyz", "xyz.whois-servers.net"],
        "link" => ["whois.uniregistry.net", "whois.nic.link", "link.whois-servers.net"],
        "red" => ["whois.afilias.net", "whois.nic.red", "red.whois-servers.net"],
        "money" => ["whois.donuts.co", "whois.nic.money"],
        "top" => ["whois.nic.top"],
        "onl" => ["whois.afilias-srs.net", "whois.nic.onl", "onl.whois-servers.net"],
        "tatar" => ["whois.nic.tatar"],
        "place" => ["whois.donuts.co", "whois.nic.place"],
        "agency" => ["whois.donuts.co", "whois.nic.agency", "agency.whois-servers.net"],
        "google" => ["domain-registry-whois.l.google.com", "whois.nic.google"],
        "company" => ["whois.donuts.co", "whois.nic.company", "company.whois-servers.net"],
        "expert" => ["whois.donuts.co", "whois.nic.expert", "expert.whois-servers.net"],
        "sexy" => ["whois.uniregistry.net", "whois.nic.sexy", "sexy.whois-servers.net"],
        "work" => ["whois-dub.mm-registry.com", "whois.nic.work"],
        "boutique" => ["whois.donuts.co", "whois.nic.boutique", "boutique.whois-servers.net"],
        "help" => ["whois.uniregistry.net", "whois.nic.help"],
        "buzz" => ["whois.nic.buzz", "buzz.whois-servers.net"],
        "space" => ["whois.nic.space"],
        "int" => ["whois.iana.org", "int.whois-servers.net"],
        "trade" => ["whois.nic.trade", "trade.whois-servers.net"],
        "zone" => ["whois.donuts.co", "whois.nic.zone", "zone.whois-servers.net"],
        "careers" => ["whois.donuts.co", "whois.nic.careers", "careers.whois-servers.net"],
        "sky" => ["whois.nic.sky"],
        "juegos" => ["whois.uniregistry.net", "whois.nic.juegos"],
        "video" => ["whois.rightside.co", "whois.nic.video"],
        "ink" => ["whois.centralnic.com", "whois.nic.ink", "ink.whois-servers.net"],
        "media" => ["whois.donuts.co", "whois.nic.media", "media.whois-servers.net"],
        "cash" => ["whois.donuts.co", "whois.nic.cash", "cash.whois-servers.net"],
        "haus" => ["whois.unitedtld.com", "whois.nic.haus", "haus.whois-servers.net"],
        "one" => ["whois.nic.one"],
        "party" => ["whois.nic.party"],
        "dev" => ["domain-registry-whois.l.google.com", "whois.nic.dev"],
        "cat" => ["whois.cat", "cat.whois-servers.net"],
        "supply" => ["whois.donuts.co", "whois.nic.supply", "supply.whois-servers.net"],
        "house" => ["whois.donuts.co", "whois.nic.house", "house.whois-servers.net"],
        "coop" => ["whois.nic.coop", "coop.whois-servers.net"],
        "science" => ["whois.nic.science"],
        "eus" => ["whois.eus.coreregistry.net", "whois.nic.eus", "eus.whois-servers.net"],
        "paris" => ["whois-paris.nic.fr", "whois.nic.paris", "paris.whois-servers.net"],
        "business" => ["whois.donuts.co", "whois.nic.business"],
        "estate" => ["whois.donuts.co", "whois.nic.estate", "estate.whois-servers.net"],
        "xn--90ais" => ["whois.cctld.by"], // бел
        "consulting" => ["whois.unitedtld.com", "whois.nic.consulting", "consulting.whois-servers.net"],
        "webcam" => ["whois.nic.webcam", "webcam.whois-servers.net"],
        "direct" => ["whois.donuts.co", "whois.nic.direct"],
        "rentals" => ["whois.donuts.co", "whois.nic.rentals", "rentals.whois-servers.net"],
        "tips" => ["whois.donuts.co", "whois.nic.tips", "tips.whois-servers.net"],
        "online" => ["whois.centralnic.com", "whois.nic.online"],
        "black" => ["whois.afilias.net", "whois.nic.black", "black.whois-servers.net"],
        "vodka" => ["whois-dub.mm-registry.com", "whois.nic.vodka", "vodka.whois-servers.net"],
        "tools" => ["whois.donuts.co", "whois.nic.tools", "tools.whois-servers.net"],
        "report" => ["whois.donuts.co", "whois.nic.report", "report.whois-servers.net"],
        "watch" => ["whois.donuts.co", "whois.nic.watch", "watch.whois-servers.net"],
        "site" => ["whois.centralnic.com", "whois.nic.site"],
        "ovh" => ["whois-ovh.nic.fr", "whois.nic.ovh"],
        "win" => ["whois.nic.win"],
        "beer" => ["whois-dub.mm-registry.com", "whois.nic.beer"],
        "wiki" => ["whois.nic.wiki", "wiki.whois-servers.net"],
        "finance" => ["whois.donuts.co", "whois.nic.finance", "finance.whois-servers.net"],
        "school" => ["whois.donuts.co", "whois.nic.school"],
        "diet" => ["whois.uniregistry.net", "whois.nic.diet"],
        "energy" => ["whois.donuts.co", "whois.nic.energy"],
        "london" => ["whois-lon.mm-registry.com", "whois.nic.london", "london.whois-servers.net"],
        "bank" => ["whois.nic.bank"],
        "press" => ["whois.nic.press"],
        "download" => ["whois.nic.download"],
        "coupons" => ["whois.donuts.co", "whois.nic.coupons"],
        "ninja" => ["whois.unitedtld.com", "whois.nic.ninja", "ninja.whois-servers.net"],
        "cab" => ["whois.donuts.co", "whois.nic.cab", "cab.whois-servers.net"],
        "lol" => ["whois.uniregistry.net", "whois.nic.lol"],
        "sale" => ["whois.rightside.co", "whois.nic.sale"],
        "loan" => ["whois.nic.loan"],
        "studio" => ["whois.rightside.co", "whois.nic.studio"],
        "clinic" => ["whois.donuts.co", "whois.nic.clinic", "clinic.whois-servers.net"],
        "taxi" => ["whois.donuts.co", "whois.nic.taxi"],
        "СЂС„" => ["whois.tcinet.ru"],
        "directory" => ["whois.donuts.co", "whois.nic.directory", "directory.whois-servers.net"],
        "style" => ["whois.donuts.co", "whois.nic.style"],
        "global" => ["whois.nic.global", "whois.global", "global.whois-servers.net"],
        "vet" => ["whois.rightside.co", "whois.nic.vet"],
        "news" => ["whois.rightside.co", "whois.nic.news"],
        "xn--p1acf" => ["whois.nic.xn--p1acf"], // рус
        "show" => ["whois.donuts.co", "whois.nic.show"],
        "services" => ["whois.donuts.co", "whois.nic.services", "services.whois-servers.net"],
        "diamonds" => ["whois.donuts.co", "whois.nic.diamonds", "diamonds.whois-servers.net"],
        "systems" => ["whois.donuts.co", "whois.nic.systems", "systems.whois-servers.net"],
        "guide" => ["whois.donuts.co", "whois.nic.guide"],
        "plus" => ["whois.donuts.co", "whois.nic.plus"],
        "reviews" => ["whois.unitedtld.com", "whois.nic.reviews", "reviews.whois-servers.net"],
        "catering" => ["whois.donuts.co", "whois.nic.catering", "catering.whois-servers.net"],
        "education" => ["whois.donuts.co", "whois.nic.education", "education.whois-servers.net"],
        "xn--c1avg" => ["whois.publicinterestregistry.net", "whois.nic.xn--c1avg"], // орг
        "blue" => ["whois.afilias.net", "whois.nic.blue", "blue.whois-servers.net"],
        "live" => ["whois.rightside.co", "whois.nic.live"],
        "fashion" => ["whois-dub.mm-registry.com", "whois.nic.fashion"],
        "group" => ["whois.donuts.co", "whois.nic.group"],
        "run" => ["whois.donuts.co", "whois.nic.run"],
        "capital" => ["whois.donuts.co", "whois.nic.capital", "capital.whois-servers.net"],
        "legal" => ["whois.donuts.co", "whois.nic.legal"],
        "casa" => ["whois-dub.mm-registry.com", "whois.nic.casa"],
        "gold" => ["whois.donuts.co", "whois.nic.gold"],
        "rent" => ["whois.nic.rent"],
        "bid" => ["whois.nic.bid", "bid.whois-servers.net"],
        "gratis" => ["whois.donuts.co", "whois.nic.gratis", "gratis.whois-servers.net"],
        "vin" => ["whois.donuts.co", "whois.nic.vin"],
        "design" => ["whois.nic.design"],
        "team" => ["whois.donuts.co", "whois.nic.team"],
        "casino" => ["whois.donuts.co", "whois.nic.casino"],
        "market" => ["whois.rightside.co", "whois.nic.market"],
        "toys" => ["whois.donuts.co", "whois.nic.toys", "toys.whois-servers.net"],
        "ruru" => ["host", "index", "mr", "ip", "hin", "din", "hout", "dout"],
        "world" => ["whois.donuts.co", "whois.nic.world"],
        "uno" => ["whois.nic.uno", "whois.uno", "uno.whois-servers.net"],
        "rocks" => ["whois.unitedtld.com", "whois.nic.rocks", "rocks.whois-servers.net"],
        "community" => ["whois.donuts.co", "whois.nic.community", "community.whois-servers.net"],
        "digital" => ["whois.donuts.co", "whois.nic.digital"],
        "solutions" => ["whois.donuts.co", "whois.nic.solutions", "solutions.whois-servers.net"],
        "gdn" => ["whois.nic.gdn"],
        "date" => ["whois.nic.date"],
        "tech" => ["whois.nic.tech"],
        "best" => ["whois.nic.best", "best.whois-servers.net"],
        "photos" => ["whois.donuts.co", "whois.nic.photos", "photos.whois-servers.net"],
        "lgbt" => ["whois.afilias.net", "whois.nic.lgbt", "lgbt.whois-servers.net"],
        "marketing" => ["whois.donuts.co", "whois.nic.marketing", "marketing.whois-servers.net"],
        "cool" => ["whois.donuts.co", "whois.nic.cool", "cool.whois-servers.net"],
        "shoes" => ["whois.donuts.co", "whois.nic.shoes", "shoes.whois-servers.net"],
        "leclerc" => ["whois-leclerc.nic.fr", "whois.nic.leclerc"],
        "berlin" => ["whois.nic.berlin", "berlin.whois-servers.net"],
        "moda" => ["whois.unitedtld.com", "whois.nic.moda", "moda.whois-servers.net"],
        "accountant" => ["whois.nic.accountant"],
        "racing" => ["whois.nic.racing"],
        "vip" => ["whois-dub.mm-registry.com", "whois.nic.vip"],
        "insure" => ["whois.donuts.co", "whois.nic.insure", "insure.whois-servers.net"],
        "review" => ["whois.nic.review"],
        "cricket" => ["whois.nic.cricket"],
        "codes" => ["whois.donuts.co", "whois.nic.codes", "codes.whois-servers.net"],
        "tours" => ["whois.donuts.co", "whois.nic.tours"],
        "bar" => ["whois.nic.bar", "bar.whois-servers.net"],
        "lawyer" => ["whois.rightside.co", "whois.nic.lawyer"],
        "tokyo" => ["whois.nic.tokyo", "tokyo.whois-servers.net"],
        "fishing" => ["whois-dub.mm-registry.com", "whois.nic.fishing", "fishing.whois-servers.net"],
        "dog" => ["whois.donuts.co", "whois.nic.dog"],
        "camp" => ["whois.donuts.co", "whois.nic.camp", "camp.whois-servers.net"],
        "limo" => ["whois.donuts.co", "whois.nic.limo", "limo.whois-servers.net"],
        "social" => ["whois.unitedtld.com", "whois.nic.social", "social.whois-servers.net"],
        "nyc" => ["whois.nic.nyc", "whois.nyc", "nyc.whois-servers.net"],
        "love" => ["whois.nic.love"],
        "coffee" => ["whois.donuts.co", "whois.nic.coffee", "coffee.whois-servers.net"],
        "rest" => ["whois.nic.rest", "rest.whois-servers.net"],
        "blackfriday" => ["whois.uniregistry.net", "whois.nic.blackfriday", "blackfriday.whois-servers.net"],
        "fund" => ["whois.donuts.co", "whois.nic.fund", "fund.whois-servers.net"],
        "properties" => ["whois.donuts.co", "whois.nic.properties", "properties.whois-servers.net"],
        "management" => ["whois.donuts.co", "whois.nic.management", "management.whois-servers.net"],
        "xn--d1acj3b" => ["whois.nic.xn--d1acj3b"], // дети
        "faith" => ["whois.nic.faith"],
        "kim" => ["whois.afilias.net", "whois.nic.kim", "kim.whois-servers.net"],
        "network" => ["whois.donuts.co", "whois.nic.network"],
        "email" => ["whois.donuts.co", "whois.nic.email", "email.whois-servers.net"],
        "rio" => ["whois.gtlds.nic.br", "whois.nic.rio"],
        "parts" => ["whois.donuts.co", "whois.nic.parts", "parts.whois-servers.net"],
        "xn--tckwe" => ["whois.nic.xn--tckwe"], // コム
        "pink" => ["whois.afilias.net", "whois.nic.pink", "pink.whois-servers.net"],
        "pin" => ["whois.nic.pin"],
        "wales" => ["whois.nic.wales", "wales.whois-servers.net"],
        "limited" => ["whois.donuts.co", "whois.nic.limited", "limited.whois-servers.net"],
        "college" => ["whois.nic.college", "college.whois-servers.net"],
        "wang" => ["whois.gtld.knet.cn", "whois.nic.wang", "wang.whois-servers.net"],
        "cloud" => ["whois.nic.cloud", "cloud.whois-servers.net"],
        "stream" => ["whois.nic.stream"],
        "bike" => ["whois.donuts.co", "whois.nic.bike", "bike.whois-servers.net"],
        "vegas" => ["whois.afilias-srs.net", "whois.nic.vegas", "vegas.whois-servers.net"],
        "town" => ["whois.donuts.co", "whois.nic.town", "town.whois-servers.net"],
        "cheap" => ["whois.donuts.co", "whois.nic.cheap", "cheap.whois-servers.net"],
        "poker" => ["whois.afilias.net", "whois.nic.poker"],
        "wtf" => ["whois.donuts.co", "whois.nic.wtf", "wtf.whois-servers.net"],
        "care" => ["whois.donuts.co", "whois.nic.care", "care.whois-servers.net"],
        "furniture" => ["whois.donuts.co", "whois.nic.furniture", "furniture.whois-servers.net"],
        "store" => ["whois.nic.store"],
        "ren" => ["whois.nic.ren", "ren.whois-servers.net"],
        "host" => ["whois.nic.host"],
        "barcelona" => ["whois.nic.barcelona"],
        "xn--fiqs8s" => ["cwhois.cnnic.cn", "xn--fiqs8s.whois-servers.net"], // 中国
        "tax" => ["whois.donuts.co", "whois.nic.tax", "tax.whois-servers.net"],
        "ac" => ["whois.nic.ac", "ac.whois-servers.net"],
        "tube" => ["whois.nic.tube"],
        "works" => ["whois.donuts.co", "whois.nic.works", "works.whois-servers.net"],
        "training" => ["whois.donuts.co", "whois.nic.training", "training.whois-servers.net"],
        "sydney" => ["whois.nic.sydney", "sydney.whois-servers.net"],
        "church" => ["whois.donuts.co", "whois.nic.church"],
        "men" => ["whois.nic.men", "men.whois-servers.net"],
        "jobs" => ["whois.nic.jobs"],
        "pictures" => ["whois.donuts.co", "whois.nic.pictures", "pictures.whois-servers.net"],
        "golf" => ["whois.donuts.co", "whois.nic.golf"],
        "qpon" => ["whois.nic.qpon", "qpon.whois-servers.net"],
        "dance" => ["whois.unitedtld.com", "whois.nic.dance", "dance.whois-servers.net"],
        "ngo" => ["whois.publicinterestregistry.net", "whois.nic.ngo"],
        "build" => ["whois.nic.build", "build.whois-servers.net"],
        "moe" => ["whois.nic.moe", "moe.whois-servers.net"],
        "repair" => ["whois.donuts.co", "whois.nic.repair", "repair.whois-servers.net"],
        "sex" => ["whois.afilias-srs.net", "whois.nic.sex"],
        "blog" => ["whois.nic.blog"],
        "financial" => ["whois.donuts.co", "whois.nic.financial", "financial.whois-servers.net"],
        "chat" => ["whois.donuts.co", "whois.nic.chat"],
        "nagoya" => ["whois.nic.nagoya", "nagoya.whois-servers.net"],
        "games" => ["whois.rightside.co", "whois.nic.games"],
        "productions" => ["whois.donuts.co", "whois.nic.productions", "productions.whois-servers.net"],
        "shop" => ["whois.nic.shop", "shop.whois-servers.net"],
        "voyage" => ["whois.donuts.co", "whois.nic.voyage", "voyage.whois-servers.net"],
        "hosting" => ["whois.uniregistry.net", "whois.nic.hosting"],
        "porn" => ["whois.afilias-srs.net", "whois.nic.porn"],
        "academy" => ["whois.donuts.co", "whois.nic.academy", "academy.whois-servers.net"],
        "trading" => ["whois.nic.trading"],
        "study" => ["whois.nic.study", "study.whois-servers.net"],
        "cruises" => ["whois.donuts.co", "whois.nic.cruises", "cruises.whois-servers.net"],
        "movie" => ["whois.donuts.co", "whois.nic.movie"],
        "partners" => ["whois.donuts.co", "whois.nic.partners", "partners.whois-servers.net"],
        "clothing" => ["whois.donuts.co", "whois.nic.clothing", "clothing.whois-servers.net"],
        "gal" => ["whois.gal.coreregistry.net", "whois.nic.gal", "whois.gal", "gal.whois-servers.net"],
        "crs" => ["whois.nic.crs"],
        "pet" => ["whois.afilias.net", "whois.nic.pet"],
        "pics" => ["whois.uniregistry.net", "whois.nic.pics", "pics.whois-servers.net"],
        "koeln" => ["whois-fe1.pdt.koeln.tango.knipp.de", "whois.nic.koeln", "koeln.whois-servers.net"],
        "srl" => ["whois.afilias-srs.net", "whois.nic.srl"],
        "band" => ["whois.rightside.co", "whois.nic.band"],
        "forsale" => ["whois.unitedtld.com", "whois.nic.forsale"],
        "green" => ["whois.afilias.net", "whois.nic.green", "green.whois-servers.net"],
        "sas" => ["whois.nic.sas", "sas.whois-servers.net"],
        "xn--j1aef" => ["whois.nic.xn--j1aef"], // ком
        "fitness" => ["whois.donuts.co", "whois.nic.fitness", "fitness.whois-servers.net"],
        "kitchen" => ["whois.donuts.co", "whois.nic.kitchen", "kitchen.whois-servers.net"],
        "university" => ["whois.donuts.co", "whois.nic.university", "university.whois-servers.net"],
        "camera" => ["whois.donuts.co", "whois.nic.camera", "camera.whois-servers.net"],
        "auto" => ["whois.uniregistry.net", "whois.nic.auto"],
        "domains" => ["whois.donuts.co", "whois.nic.domains", "domains.whois-servers.net"],
        "yoga" => ["whois.nic.yoga"],
        "cam" => ["whois.ksregistry.net", "whois.nic.cam", "cam.whois-servers.net"],
        "vacations" => ["whois.donuts.co", "whois.nic.vacations", "vacations.whois-servers.net"],
        "discount" => ["whois.donuts.co", "whois.nic.discount", "discount.whois-servers.net"],
        "ist" => ["whois.afilias-srs.net", "whois.nic.ist"],
        "soy" => ["whois.nic.google", "whois.nic.soy", "soy.whois-servers.net"],
        "free" => ["whois.nic.free", "free.whois-servers.net"],
        "play" => ["whois.nic.google", "whois.nic.play"],
        "ltd" => ["whois.donuts.co", "whois.nic.ltd"],
        "xn--3ds443g" => ["whois.teleinfo.cn", "whois.nic.xn--3ds443g"], // 在线
        "bet" => ["whois.afilias.net", "whois.nic.bet"],
        "yokohama" => ["whois.nic.yokohama", "yokohama.whois-servers.net"],
        "yu" => ["yu.whois-servers.net"],
        "broker" => ["whois.nic.broker"],
        "lat" => ["whois.nic.lat"],
        "recipes" => ["whois.donuts.co", "whois.nic.recipes", "recipes.whois-servers.net"],
        "software" => ["whois.rightside.co", "whois.nic.software"],
        "bio" => ["whois.afilias.net", "whois.nic.bio"],
        "coach" => ["whois.donuts.co", "whois.nic.coach"],
        "jewelry" => ["whois.donuts.co", "whois.nic.jewelry"],
        "fun" => ["whois.nic.fun", "fun.whois-servers.net"],
        "film" => ["whois.nic.film", "film.whois-servers.net"],
        "eco" => ["whois.afilias-srs.net", "whois.nic.eco"],
        "istanbul" => ["whois.afilias-srs.net", "whois.nic.istanbul"],
        "promo" => ["whois.afilias.net", "whois.nic.promo"],
        "dhl" => ["whois.nic.dhl"],
        "doctor" => ["whois.donuts.co", "whois.nic.doctor"],
        "rehab" => ["whois.rightside.co", "whois.nic.rehab"],
        "navy" => ["whois.rightside.co", "whois.nic.navy"],
        "engineering" => ["whois.donuts.co", "whois.nic.engineering", "engineering.whois-servers.net"],
        "tienda" => ["whois.donuts.co", "whois.nic.tienda", "tienda.whois-servers.net"],
        "frl" => ["whois.nic.frl", "frl.whois-servers.net"],
        "technology" => ["whois.donuts.co", "whois.nic.technology", "technology.whois-servers.net"],
        "mortgage" => ["whois.rightside.co", "whois.nic.mortgage"],
        "deals" => ["whois.donuts.co", "whois.nic.deals"],
        "gallery" => ["whois.donuts.co", "whois.nic.gallery", "gallery.whois-servers.net"],
        "amsterdam" => ["whois.nic.amsterdam", "amsterdam.whois-servers.net"],
        "flowers" => ["whois.uniregistry.net", "whois.nic.flowers"],
        "mba" => ["whois.donuts.co", "whois.nic.mba"],
        "xin" => ["whois.nic.xin"],
        "shopping" => ["whois.donuts.co", "whois.nic.shopping"],
        "football" => ["whois.donuts.co", "whois.nic.football"],
        "earth" => ["whois.nic.earth", "earth.whois-servers.net"],
        "abbott" => ["whois.afilias-srs.net", "whois.nic.abbott"],
        "jetzt" => ["whois.nic.jetzt", "jetzt.whois-servers.net"],
        "ing" => ["whois.nic.google", "whois.nic.ing"],
        "family" => ["whois.rightside.co", "whois.nic.family"],
        "cards" => ["whois.donuts.co", "whois.nic.cards", "cards.whois-servers.net"],
        "express" => ["whois.donuts.co", "whois.nic.express"],
        "okinawa" => ["whois.nic.okinawa", "okinawa.whois-servers.net"],
        "audio" => ["whois.uniregistry.net", "whois.nic.audio"],
        "florist" => ["whois.donuts.co", "whois.nic.florist", "florist.whois-servers.net"],
        "enterprises" => ["whois.nic.enterprises", "enterprises.whois-servers.net"],
        "gmbh" => ["whois.nic.gmbh"],
        "credit" => ["whois.nic.credit"],
        "solar" => ["whois.nic.solar", "solar.whois-servers.net"],
        "hamburg" => ["whois.nic.hamburg"],
        "ltda" => ["whois.afilias-srs.net", "whois.nic.ltda"],
        "ski" => ["whois.afilias.net", "whois.nic.ski"],
        "kaufen" => ["whois.nic.kaufen", "kaufen.whois-servers.net"],
        "rip" => ["whois.nic.rip"],
        "bingo" => ["whois.nic.bingo"],
        "exchange" => ["whois.nic.exchange", "exchange.whois-servers.net"],
        "hiphop" => ["whois.uniregistry.net", "whois.nic.hiphop"],
        "art" => ["whois.nic.art", "art.whois-servers.net"],
        "icu" => ["whois.nic.icu", "icu.whois-servers.net"],
        "app" => ["whois.nic.google", "whois.nic.app"],
        "cafe" => ["whois.nic.cafe"],
        "surf" => ["whois.nic.surf"],
        "holdings" => ["whois.nic.holdings", "holdings.whois-servers.net"],
        "how" => ["whois.nic.google", "whois.nic.how"],
        "wien" => ["whois.nic.wien", "wien.whois-servers.net"],
        "museum" => ["whois.nic.museum", "whois.museum", "museum.whois-servers.net"],
        "fyi" => ["whois.nic.fyi"],
        "schule" => ["whois.nic.schule", "schule.whois-servers.net"],
        "investments" => ["whois.nic.investments", "investments.whois-servers.net"],
        "new" => ["whois.nic.google", "whois.nic.new"],
        "joburg" => ["joburg-whois.registry.net.za", "whois.nic.joburg", "joburg.whois-servers.net"],
        "futbol" => ["whois.nic.futbol", "futbol.whois-servers.net"],
        "wine" => ["whois.nic.wine"],
        "villas" => ["whois.nic.villas", "villas.whois-servers.net"],
        "fit" => ["whois.nic.fit"],
        "industries" => ["whois.nic.industries", "industries.whois-servers.net"],
        "construction" => ["whois.nic.construction", "construction.whois-servers.net"],
        "law" => ["whois.nic.law", "law.whois-servers.net"],
        "vision" => ["whois.nic.vision", "vision.whois-servers.net"],
        "saarland" => ["whois.ksregistry.net", "whois.nic.saarland", "saarland.whois-servers.net"],
        "security" => ["whois.nic.security"],
        "soccer" => ["whois.nic.soccer"],
        "iselect" => ["whois.nic.iselect", "iselect.whois-servers.net"],
        "surgery" => ["whois.nic.surgery", "surgery.whois-servers.net"],
        "page" => ["whois.nic.google", "whois.nic.page"],
        "immo" => ["whois.nic.immo"],
        "tennis" => ["whois.nic.tennis"],
        "realtor" => ["whois.nic.realtor"],
        "рф" => ["whois.tcinet.ru"],
        "healthcare" => ["whois.nic.healthcare"],
        "gift" => ["whois.uniregistry.net", "whois.nic.gift", "gift.whois-servers.net"],
        "forex" => ["whois.nic.forex"],
        "fail" => ["whois.nic.fail", "fail.whois-servers.net"],
        "spot" => ["whois.nic.spot", "spot.whois-servers.net"],
        "loans" => ["whois.nic.loans"],
        "gifts" => ["whois.nic.gifts"],
        "actor" => ["whois.nic.actor", "actor.whois-servers.net"],
        "army" => ["whois.nic.army"],
        "kpmg" => ["whois.nic.kpmg", "kpmg.whois-servers.net"],
        "llc" => ["whois.afilias.net", "whois.nic.llc", "llc.whois-servers.net"],
        "fish" => ["whois.nic.fish", "fish.whois-servers.net"],
        "radio" => ["whois.nic.radio"],
        "open" => ["whois.nic.open", "open.whois-servers.net"],
        "dating" => ["whois.nic.dating", "dating.whois-servers.net"],
        "goog" => ["whois.nic.google", "whois.nic.goog"],
        "salon" => ["whois.nic.salon"],
        "adult" => ["whois.registrar.adult", "whois.nic.adult"],
        "рус" => ["whois.nic.xn--p1acf"],
        "tirol" => ["whois.nic.tirol"],
        "garden" => ["whois.nic.garden"],
        "swiss" => ["whois.nic.swiss"],
        "xn--9dbq2a" => ["whois.nic.xn--9dbq2a"], // קום
        "versicherung" => ["whois.nic.versicherung"],
        "gle" => ["whois.nic.google", "whois.nic.gle"],
        "courses" => ["whois.nic.courses", "courses.whois-servers.net"],
        "mom" => ["whois.uniregistry.net", "whois.nic.mom"],
        "meme" => ["whois.nic.google", "whois.nic.meme"],
        "scot" => ["whois.nic.scot"],
        "honda" => ["whois.nic.honda"],
        "beauty" => ["whois.nic.beauty"],
        "monster" => ["whois.nic.monster"],
        "exposed" => ["whois.nic.exposed", "exposed.whois-servers.net"],
        "brussels" => ["whois.nic.brussels", "brussels.whois-servers.net"],
        "game" => ["whois.uniregistry.net", "whois.nic.game", "game.whois-servers.net"],
        "cyou" => ["whois.nic.cyou"],
        "osaka" => ["whois.nic.osaka", "osaka.whois-servers.net"],
        "cleaning" => ["whois.nic.cleaning", "cleaning.whois-servers.net"],
        "pizza" => ["whois.nic.pizza"]
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
     * Returns whois information about a host
     *
     * @param string $host
     * @return string|null
     */
    public static function whois($host) {
        $zone = array_slice(explode(".", trim($host)), -1)[0];
        $servers = self::WHOIS_SERVERS[$zone];
        foreach ($servers as $server) {
            if ($info = self::whoisQuery($server, trim($host)))
                return $info;
        }
        return null;
    }

    /**
     * Makes a request to the whois server
     *
     * @param $server
     * @param $domain
     * @return string
     */
    private static function whoisQuery($server, $domain) {
        $port = 43;
        $timeout = 10;
        $fp = @fsockopen($server, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
        fputs($fp, $domain . "\r\n");

        $output = "";
        while(!feof($fp)) {
            $output .= fgets($fp);
        }
        fclose($fp);

        $result = "";
        if ((strpos(strtolower($output), "error") === FALSE) && (strpos(strtolower($output), "not allocated") === FALSE)) {
            $rows = explode("\n", $output);
            foreach ($rows as $row) {
                $row = trim($row);
                if (($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
                    $result .= $row."\n";
                }
            }
        }
        return $result;
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