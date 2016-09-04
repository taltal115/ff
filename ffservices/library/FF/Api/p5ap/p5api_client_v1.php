<?php

/**
 * (c) Marcus Engene (api@pond5.com), Pond5 inc. All rights reserved.
 *     You are free to use this code to access pond5 via its API.
 *     Pond5 inc takes no responsability for any problems that might occur.
 *
 *     Updated 2010-04-10
 *
 * We recommend using the Ioncube PHP encoder for increased speed and
 * security.
 *
 * Netbeans is our recommended development environment for PHP.
 *
 * <code>
 * $client = new p5api_client();
 * $client->api_key = "234_345";
 * $client->my_secret = "havregryn";
 *
 * $cmd = $client->get_search_command();
 * $cmd->col_mask = p5api_client_command_search::$COL_NAME + p5api_client_command_search::$COL_DURATION;
 * $cmd->query = "dog";
 * $client->add_command($cmd);
 *
 * $obj = $client->query_pond5();
 * </code>
 * 
 * @package p5api_client
 */

/**
 * @package p5api_client
 */
class p5api_client_command
{
    /*
     * These are the variables you are supposed to set. Please use the definitions
     * above when possible.
     */

    /**
     * The command.
     * $CMD_enums.
     *
     * @var string
     */
    public $command;

    /**
     * Error, if any.
     *
     * @var string
     */
    public $error_str = "";

    /*
     * Do not use the functions below directly.
     */

    public function __construct ($command)
    {
        $this->command = $command;
    }

    /**
     * @return bool
     */
    public function is_ok()
    {
        $this->error_str = "";

        if ("" === $this->command || !is_string($this->command))
        {
            $error_str = "Command is not set or not valid [" . $this->command . "]";
            return false;
        }

        return true;
    }

    /**
     * We only want to transmit values that are actually necessary (ie not default).
     *
     * @param array $obj
     * @param string $key
     * @param string $not_me
     * @param mixed $value
     */
    public function set_if_ne (&$obj, $key, $not_me, $value)
    {
        if ($not_me != $value)
        {
            $obj[$key] = $value;
        }
    }

}


/**
 * @package p5api_client
 */
class p5api_client_command_search extends p5api_client_command
{
    /*
     * BM (bitmask) - binary mask telling the search engine what types of clips you want.
     */
    public static $BM_HD = 1;
    public static $BM_PAL = 2;
    public static $BM_NTSC = 4;
    public static $BM_MULTIMEDIA = 8;
    public static $BM_ANY_VIDEO = 15;
    public static $BM_MUSIC = 16;
    public static $BM_SFX = 32;
    public static $BM_ANY_SOUND = 48;
    public static $BM_ANY_SOUND_AND_VIDEO = 63;
    public static $BM_AFTER_EFFECTS = 64;
    public static $BM_MODEL_RELEASE = 256;
    public static $BM_MATTE = 512;
    public static $BM_ILLUSTRATION = 1024;
    public static $BM_PHOTOS = 128;
    public static $BM_FILTER_EXPLICIT = 2048;

    /*
     * How many search results per page?
     */
    public static $NO_25 = 25;
    public static $NO_50 = 50;
    public static $NO_100 = 100;

    /*
     * Sort By of the search result set.
     */
    public static $SB_DEFAULT = 1;
    public static $SB_USERNAME = 2;
    public static $SB_PRICE = 4;
    public static $SB_DURATION = 5;
    public static $SB_DATE_UPLOADED = 6;
    public static $SB_NBR_SALE = 8;
    public static $SB_SALE_SUM = 9;
    public static $SB_NBR_VIEW = 10;
    public static $SB_ADD_THIS_TO_REVERSE = 100;

    /*
     * extra COLumns in search result items.
     */
    public static $COL_NAME = 1;
    public static $COL_DURATION = 2;
    public static $COL_KEYWORDS = 4;
    public static $COL_DESCRIPTION = 8;


    /**
     * BitMask for search result types.
     * $BM_ enums.
     *
     * @var int
     */
    public $bm = 15;

    /**
     * Query string (for search)
     *
     * @var string
     */
    public $query = "";

    /**
     * Max nbr of result (for search)
     * $NO_ enums.
     *
     * @var int
     */
    public $no = 25;

    /**
     * Sort By (for search)
     * $SB_ enums.
     *
     * @var int
     */
    public $sb = 1;

    /**
     * By default, the columns returned for each item is id, vs, ox, oy
     * $COL_ enums
     *
     * @var int
     */
    public $col_mask = 0;

    /**
     * Category.
     *
     * @var int
     */
    public $cat = 0;

    /**
     * At page of search results (0..).
     *
     * @var int
     */
    public $at_page = 0;
    
    public function __construct ()
    {
        parent::__construct("search");
    }

    /**
     * @return array
     */
    public function get_simplified()
    {
        $obj = array();
        $obj["command"] = $this->command;
        $obj["bm"] = $this->bm;
        $obj["p"] = $this->at_page;
        $this->set_if_ne($obj, "query", "", $this->query);
        $this->set_if_ne($obj, "sb", 1, $this->sb);
        $this->set_if_ne($obj, "no", 25, $this->no);
        $this->set_if_ne($obj, "col", 0, $this->col_mask);
        $this->set_if_ne($obj, "cat", 0, $this->cat);

        return $obj;
    }

}


/**
 * @package p5api_client
 */
class p5api_client_command_get_clip_data extends p5api_client_command
{
    /**
     * The if of the clip you want the info for
     *
     * @var int
     */
    public $itemid = 0;

    public function __construct ()
    {
        parent::__construct("get_clip_data");
    }

    /**
     * @return array
     */
    public function get_simplified()
    {
        $obj = array();
        $obj["command"] = $this->command;
        $obj["itemid"] = $this->itemid;

        return $obj;
    }

}


/**
 * @author ehsmeng
 * @package p5api_client
 *
 * Do not reuse this object for several server calls. Create a new object instead
 * Set the api_key and my_secret from where you instantiate this object, not in this source code.
 */
class p5api_client
{
    /**
     * This is the string that will receive the commands.
     * You should likely not change this.
     *
     * @var string
     */
    public $url = "http://www.pond5.com/?page=api";

    /**
     * It has the form x_y where x is user id in P5 and y is some (initially random) number.
     *
     * @var string
     */
    public $api_key = "";

    /**
     * This is your secret string used for authenticate your commands.
     *
     * @var string
     */
    public $my_secret = "";

    /**
     * If you want to fetch the icons over https.
     *
     * @var bool
     */
    public $https = false;

    /**
     * Set to xml if you want to use xml.
     *
     * @var string
     */
    public $format = 'json';

    /**
     * If there is an error, the error text goes here.
     *
     * @var string
     */
    protected $error_str = "";

    /**
     * The version of the api. Do not change!
     *
     * @var int
     */
    private $ver = 1; // the api version

    /**
     * @var array[int]p5api_client_command
     */
    protected $commands = array();

    /**
     * @return p5api_client_command_search
     */
    public function get_search_command()
    {
        return new p5api_client_command_search();
    }

    /**
     * @return p5api_client_command_get_clip_data
     */
    public function get_get_clip_data_command()
    {
        return new p5api_client_command_get_clip_data();
    }

    /**
     * Adds the command so it will be inclided in the processing. One could argue
     * that get_search_command() should do this automatically.
     *
     * @param p5api_client_command $command
     */
    public function add_command($command)
    {
        array_push($this->commands, $command);
    }

    /**
     * This function makes the json string that will be posted to Pond5. It tries
     * to simplify the request as much as possible.
     *
     * @return mixed false on error or string on success.
     */
    public function get_json()
    {
        if (0 == count($this->commands))
        {
            $this->error_str = "No commands were added.";
            return false;
        }

        $cmd_arr = array();
        foreach ($this->commands as $k => $command)
        {
            if (! $command->is_ok())
            {
                $this->error_str .= "command " . $k . " is bad [" . $command->error_str . "]";
                return false;
            }

            array_push($cmd_arr, $command->get_simplified());
        }

        $json_object = array();
        $json_object["api_key"] = $this->api_key;
        $json_object["ver"] = $this->ver;
        $json_object["commands_json"] = json_encode($cmd_arr);
        $json_object["commands_hash"] = md5($json_object["commands_json"] . $this->my_secret . 'dragspel');
        if (true == $this->https)
        {
            $json_object["https"] = true;
        }

        return json_encode($json_object);
    }

    /**
     * Write XML as per Associative Array
     * @param object $xml XMLWriter Object
     * @param array $data Associative Data Array
     */
    private function xml_recursive_write(XMLWriter $xml, $data)
    {
        foreach($data as $key => $value)
        {
            if(is_array($value))
            {
                if (is_numeric($key))
                {
                    $xml->startElement('item');
                }
                else
                {
                    $xml->startElement($key);
                }
                $this->xml_recursive_write($xml, $value);
                $xml->endElement();
                continue;
            }

            $xml->writeElement($key, $value);
        }
    }

    /**
     * Converts an associative array to XML.
     *
     * @param array $data
     * @param string $startElement
     * @param string $xml_version
     * @param string $xml_encoding
     * @return mixed
     */
    public function build_XML_data($data, $startElement = 'apa', $xml_version = '1.0', $xml_encoding = 'UTF-8')
    {
        if(!is_array($data))
        {
            $this->error_str = "Internal error building XML.";
            return false;
        }

        $xml = new XmlWriter();
        $xml->openMemory();
        $xml->startDocument($xml_version, $xml_encoding);
        $xml->startElement($startElement);

        $this->xml_recursive_write($xml, $data);

        $xml->endElement();//write end element
        //Return the XML results
        return $xml->outputMemory(true);
    }

    /**
     * This function makes the XML string that will be posted to Pond5. It tries
     * to simplify the request as much as possible.
     *
     * @return mixed false on error or string on success.
     */
    public function get_xml()
    {
        if (0 == count($this->commands))
        {
            $this->error_str = "No commands were added.";
            return false;
        }

        $cmd_arr = array();
        foreach ($this->commands as $k => $command)
        {
            if (! $command->is_ok())
            {
                $this->error_str .= "command " . $k . " is bad [" . $command->error_str . "]";
                return false;
            }

            array_push($cmd_arr, $command->get_simplified());
        }

        $cmd_arr_xml = $this->build_XML_data($cmd_arr, "commands");
        if (false === $cmd_arr_xml)
        {
            return false;
        }

        $assoc_object = array();
        $assoc_object["api_key"] = $this->api_key;
        $assoc_object["ver"] = $this->ver;
        $assoc_object["commands_xml"] = $cmd_arr_xml;
        $assoc_object["commands_hash"] = md5($assoc_object["commands_xml"] . $this->my_secret . 'dragspel');
        if (true == $this->https)
        {
            $assoc_object["https"] = true;
        }

        return $this->build_XML_data($assoc_object, 'pond5_api_request');
    }

    /**
     * Converts XML text to an associative array.
     *
     * @param string $xml
     * @return mixed
     */
    public function xml_to_assoc($xml)
    {
        if (is_string($xml))
        {
            $simplexml = new SimpleXMLElement($xml);
            return $this->xml_to_assoc($simplexml);
        }
        else
        {
            $children = array();
            $any_child = false;
            foreach($xml->children() as $child)
            {
                $any_child = true;

                $attr = array();
                foreach ($child->attributes() as $k => $v)
                {
                    $attr[$k] = (string)$v;
                }

                if (0 != count ($attr))
                {
                    $children[':' . $child->getName()] = $attr;
                }

                if ('item' == $child->getName())
                {
                    array_push($children, $this->xml_to_assoc ($child));
                }
                else
                {
                    $children[$child->getName()] = $this->xml_to_assoc($child);
                }
            }

            if (!$any_child)
            {
                return (string)$xml;
            }
            else
            {
                return $children;
            }
        }
    }

    /**
     * This function makes the actual call to Pond5 and returns the result.
     *
     * @return mixed false on error, an associative array otherwise.
     */
    public function query_pond5 ()
    {
        switch ($this->format)
        {
            case 'json':
                $data_req = $this->get_json();
                break;
            case 'xml':
                $data_req = $this->get_xml();
                break;
            default:
                $this->error_str = "Unknown format [" . $this->format . "] Valid options are xml and json.";
                return false;
        }

        if (false === $data_req)
        {
            return false;
        }
        $post_val = "api=" . urlencode($data_req);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post_val);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $mydata = curl_exec ($ch);

        if (curl_errno($ch))
        {
           $this->error_str =  "curl error [" . curl_error($ch) . "]";
           return false;
        }
        else
        {
           curl_close($ch);
        }

        switch ($this->format)
        {
            case 'json':
                return json_decode ($mydata, true);
            case 'xml':
                $ret = $this->xml_to_assoc($mydata);
                $ret["e"] = ($ret["e"] == 'true');
                return $ret;
        }
    }

    /**
     * Only call this function if get_json() returned false.
     *
     * @return string
     */
    public function get_error ()
    {
        return $this->error_str;
    }

    /**
     * This function calculates the maximum size an icon/flv can have to fit inside
     * $max_xsize and $max_ysize and still maintain the configured aspect ratio.
     *
     * @param int $video_standard
     * @param int $aspect_ratio
     * @param int $probed_x
     * @param int $probed_y
     * @param int $max_xsize
     * @param int $max_ysize
     * @return array array of $out_xsize, $out_ysize
     */
    protected function get_preview_size($video_standard, $aspect_ratio, $probed_x, $probed_y, $max_xsize, $max_ysize)
    {
        $xsx = $max_xsize;
        if (100 <= $video_standard)
        {
            $ysx = round (($xsx * 9.0) / 16.0);
        }
        else
        {
            if (4 == $aspect_ratio || 5 == $aspect_ratio)
            {
                $ysx = round (($xsx * $probed_y) / $probed_x);
            }
            else
            {
                if (2 == $aspect_ratio || 6 == $aspect_ratio)
                {
                    $ysx = round (($xsx * 9.0) / 16.0);
                }
                else
                {
                    $ysx = round (($xsx * 3.0) / 4.0);
                }
            }
        }

        $ysx = (int)($ysx) & 0x7ffffffe;

        $ysy = $max_ysize;
        if (100 <= $video_standard)
        {
            $xsy = round (($ysy * 16.0) / 9.0);
        }
        else
        {
            if (4 == $aspect_ratio || 5 == $aspect_ratio)
            {
                $xsy = round (($ysy * $probed_x) / $probed_y);
            }
            else
            {
                if (2 == $aspect_ratio || 6 == $aspect_ratio)
                {
                    $xsy = round (($ysy * 16.0) / 9.0);
                }
                else
                {
                    $xsy = round (($ysy * 4.0) / 3.0);
                }
            }
        }

        $xsy = (int)($xsy) & 0x7ffffffe;

        if ($xsx > $max_xsize || $ysx > $max_ysize)
        {
            $out_xsize = $xsy;
            $out_ysize = $ysy;
        }
        elseif ($xsy > $max_xsize || $ysy > $max_ysize)
        {
            $out_xsize = $xsx;
            $out_ysize = $ysx;
        }
        else
        {
            if ($xsx > $xsy)
            {
                $out_xsize = $xsx;
                $out_ysize = $ysx;
            }
            else
            {
                $out_xsize = $xsx;
                $out_ysize = $ysx;
            }
        }

        if (0 >= $out_xsize)
        {
            $out_xsize = 8;
        }

        if (0 >= $out_ysize)
        {
            $out_ysize = 4;
        }

        return array($out_xsize, $out_ysize);
    }

    public function get_preview_size_quotient ($max_x, $max_y, $aspect_quotient, &$out_x, &$out_y)
    {
        if (0 == $aspect_quotient)
        {
            $out_x = $max_x; // BUG
            $out_y = $max_y;
            return;
        }

        $out_x = round($max_y * $aspect_quotient);
        $out_y = $max_y;
        if ($max_x < $out_x)
        {
            $out_x = $max_x;
            $out_y = round($max_x / $aspect_quotient);
        }
    }

    /**
     * This is a convenience function to get the max size fitting inside $in_max_xsize
     * and $in_max_ysize of an icon and an url to the appropriate icon version. Presently,
     * Pond5 generates icons that fits inside 120x90, 240x180 and 480x360 as well as the
     * original size of the clip.
     *
     * You should always set the size of an icon for at least two reasons: one is that
     * the web-browser knows the size and can start rendering quicker and the second is
     * that sometimes clips are assumed to be 4x3 in the preprocessing program but really
     * are 16x9 and has this aspect in the meta data (f.ex some anamorphic SD shots).
     *
     * @param array $in_command
     * @param array $in_row
     * @param int $in_max_xsize
     * @param int $in_max_ysize
     * @return array array of $out_url, $out_xsize, $out_ysize
     */
    public function get_icon(&$in_command, &$in_row, $in_max_xsize, $in_max_ysize)
    {
        if (isset($in_row["o"]) && !isset($in_row["id"]))
        {
            $in_row["id"] = $in_row["o"];
        }

        if (!isset($in_row["ox"]) && isset($in_row["dx"]))
        {
            $in_row["ox"] = $in_row["dx"];
        }

        if (!isset($in_row["oy"]) && isset($in_row["dy"]))
        {
            $in_row["oy"] = $in_row["dy"];
        }

        if (isset($in_row["aq"]) && 0 == $in_row["ox"] && 0 == $in_row["oy"])
        {
            $item["ox"] = 1600;
            $item["oy"] = (int)round(1600.0 / (real)$in_row["aq"]);
        }

        if (isset($in_row["aq"]) && (300 == $in_row["vs"] || 301 == $in_row["vs"]))
        {
            $this->get_preview_size_quotient($in_max_xsize, $in_max_ysize, $in_row["aq"], $out_xsize, $out_ysize);
        }
        else
        {
            list ($out_xsize, $out_ysize) = $this->get_preview_size($in_row["vs"], $in_row["ar"], $in_row["ox"], $in_row["oy"], $in_max_xsize, $in_max_ysize);
        }
        
        if (120 >= $out_xsize && 90 >= $out_ysize)
        {
            $icon = sprintf("%09d_icon.jpeg", $in_row["id"]);
        }
        elseif (240 >= $out_xsize && 180 >= $out_ysize)
        {
            $icon = sprintf("%09d_iconm.jpeg", $in_row["id"]);
        }
        elseif (480 >= $out_xsize && 360 >= $out_ysize)
        {
            $icon = sprintf("%09d_iconl.jpeg", $in_row["id"]);
        }
        else
        {
            $icon = sprintf("%09d_prevstill.jpeg", $in_row["id"]);
        }

        $out_url = $in_command["icon_base"] . $icon;

        return array($out_url, $out_xsize, $out_ysize);
    }

    /**
     * This function generates URLs for the two FLV versions. The hq_url file
     * might not exist. It's generated by a special server with On2's VP6 encoder
     * and not immediately. The only object you can assume always exists is the
     * normal_url.
     *
     * @param array $in_command
     * @param array $in_row
     * @param int $in_max_xsize
     * @param int $in_max_ysize
     * @return array array of $hq_url, $normal_url, $out_xsize, $out_ysize
     */
    public function get_flv(&$in_command, &$in_row, $in_max_xsize, $in_max_ysize)
    {
        list ($out_xsize, $out_ysize) = $this->get_preview_size($in_row["vs"], $in_row["ar"], $in_row["ox"], $in_row["oy"], $in_max_xsize, $in_max_ysize);

        $hq_url = $in_command["flv_base"] . sprintf("%09d_prev_xl.flv", $in_row["id"]);
        $normal_url = $in_command["flv_base"] . sprintf("%09d_prev_l.flv", $in_row["id"]);

        return array($hq_url, $normal_url, $out_xsize, $out_ysize);
    }

    /**
     * This generates the URL for the mov preview. These previews are generated in
     * baseline H.264 and should be iPhone compatible.
     *
     * @param array $in_command
     * @param array $in_row
     * @param int $in_max_xsize
     * @param int $in_max_ysize
     * @return array array of $url, $out_xsize, $out_ysize
     */
    public function get_mov(&$in_command, &$in_row, $in_max_xsize, $in_max_ysize)
    {
        list ($out_xsize, $out_ysize) = $this->get_preview_size($in_row["vs"], $in_row["ar"], $in_row["ox"], $in_row["oy"], $in_max_xsize, $in_max_ysize);

        $url = $in_command["flv_base"] . sprintf("%09d_prev_264.mov", $in_row["id"]);

        return array($url, $out_xsize, $out_ysize);
    }
    
    /**
     * Makes sure a name can be used as url: '/stock-footage/' . $itemid . '/' .
     * pond_ok_name ($name) . '.html'
     *
     * @param string $str
     * @return string
     */
    private function get_ok_name ($str)
    {
        $trans_chars = array (
            'å' => 'a',
            'ä' => 'a',
            'ö' => 'o',
            'é' => 'e',
            'è' => 'e',
            'á' => 'a',
            'à' => 'a',
            'ô' => 'o',
            'ê' => 'e',
            'ã' => 'a',
            'ç' => 'c'
        );

        $str = mb_strtolower($str);

        if (strcasecmp (substr ($str,0, 23), "stock video footage of ") == 0)
        {
            $str = substr ($str, 23);
        }
        elseif (strcasecmp (substr ($str, 0, 15), "stock video of ") == 0)
        {
            $str = substr ($str, 15);
        }
        elseif (strcasecmp (substr($str, 0, 17), "stock footage of ") == 0)
        {
            $str = substr ($str, 17);
        }

        $outStr = '';
        $prevIsSpace = false;
        $char_arr = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($char_arr as $char)
        {
            if (('a' <= $char && 'z' >= $char) ||
                ('0' <= $char && '9' >= $char) ||
                '_' == $char
               )
            {
                $outStr .= $char;
                $prevIsSpace = false;
            }
            elseif ("'" == $char)
            {
            }
            elseif (isset ($trans_chars[$char]))
            {
                $outStr .= $trans_chars[$char];
                $prevIsSpace = false;
            }
            else
            {
                if (! $prevIsSpace)
                {
                    $outStr .= ' ';
                    $prevIsSpace = true;
                }
            }
        }

        $outStr = str_replace('  ', ' ', $outStr);
        $outStr = str_replace(' ', '-', trim ($outStr));

        return $outStr;
    }

    /**
     * This returns the url of the clip as it's constructed on Pond5. This is an
     * Apache mod_rewrite url that honours flags that you might add, such as
     * ?ref=username.
     *
     * @param array $in_command
     * @param array $in_row
     * @return string
     */
    public function get_canonical_url(&$in_command, &$in_row)
    {
        switch ($in_row["vs"])
        {
            case 100:
                $seo = "/stock-music/";
                $ok_name = "music-clip";
                break;
            case 101:
                $seo = "/sound-effect/";
                $ok_name = "sfx-clip";
                break;
            default:
                $seo = "/stock-footage/";
                $ok_name = "video-clip";
                break;
        }

        if (isset ($in_row["n"]))
        {
            $ok_name = $this->get_ok_name($in_row["n"]);
        }

        return "http://www.pond5.com" . $seo . $in_row["id"] . '/' . $ok_name . '.html';
    }

    public function get_vs_string ($video_standard)
    {
        switch ($video_standard)
        {
            case 1:
                return 'NTSC D1';
            case 2:
                return 'NTSC DV';
            case 3:
                return 'PAL';
            case 8:
                return 'HDV 1080i';
            case 4:
                return 'HD 1080';
            case 5:
                return 'HDV 720p';
            case 9:
                return 'HD 720';
            case 6:
                return 'Other Hi-Def';
            case 7:
                return 'Multimedia';
            case 0:
                return 'Multimedia';
            case 100:
                return 'Music';
            case 101:
                return 'Sound effect';
            case 200:
                return 'After effects';
            case 300:
                return 'Photos';
            case 301:
                return 'Illustrations';
            case 800:
                return 'One off fee';
            case 801:
                return 'Buy credits';
            default:
                return '? Bad value';
        }
    }

}
?>
