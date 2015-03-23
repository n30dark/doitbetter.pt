<?php

class CSSjoin {

    // Parse external files ability.
    protected $external_parser = true;

    // Parse external files from local host only.
    protected $external_parser_localhost_only = false;

    // Check external file's extension.
    // If it's not ".js" the file will not be parsed.
    protected $external_parser_check_extension = true;

    // Files delimiter when using mod_rewrite URL style.
    protected $delimiter = "..";

    // Location where to store cache files.
    // If it's set to empty string, caching system will be disabled.
    protected $cache_dir = "cache";

    // Referer protection.
    // If enabled, only embeded requests from local server's HTML documents will work.
    protected $referer_protection = true;

    public function __construct() {

        // Referer protection
        if ($this->referer_protection) {
            if (!isset($_SERVER['HTTP_REFERER'])) die;
            $ref_host = preg_replace(
                '/^[a-z0-9]+?\:\/\/([^\/]+).*$/si', "$1", $_SERVER['HTTP_REFERER']);
            if ($ref_host != $_SERVER['HTTP_HOST']) die;
        }

        $_GET = self::gpc_clear_slashes($_GET);

        // Load files from 'css' GET parameter
        if (isset($_GET['css'])) {
            if (strlen($this->cache_dir)) $cache_id = "css/";
            $files = $_GET['css'];

        // Load files from ModRewrite URL
        } elseif (isset($_GET['url']) && strlen($_GET['url'])) {
            if (strlen($this->cache_dir)) $cache_id = "url/";
            $files = explode($this->delimiter, $_GET['url']);


        // Load all CSS files in script directory
        } else {
            if (strlen($this->cache_dir)) $cache_id = "all/";
            $files = glob("*.css");
        }

        // Quit if no files
        if (!is_array($files) || !count($files)) die;

        // Initial caching values
        if (isset($cache_id)) {
            $mtime = 0;
            $cache_id .= $_SERVER['HTTP_HOST'];
        }

        $dir_files = array();
        foreach($files as $i => $file) {
            $file = trim($file);

            // External file
            if (preg_match('/^(https?)\:\/\/?([^\/]+)(\:\d+)*(\/.*)*$/i', $file, $patt)) {
                list($full, $protocol, $domain, $port, $path) = $patt;

                // Drop if external files are disabled
                if (!$this->external_parser ||
                    // or it's not localhost external file
                    ($this->external_parser_localhost_only &&
                        ($domain != $_SERVER['HTTP_HOST'])) ||
                    // or its extension are not ".css"
                    ($this->external_parser_check_extension &&
                        !preg_match('/\.css$/si', $path))
                ) {
                    unset($files[$i]);
                    continue;
                }

                if ((($protocol == "http") && ($port == ":80")) ||
                    (($protocol == "https") && ($port == ":443"))
                )
                    $port = "";

                $file = $files[$i] = "$protocol://$domain$port" .
                    self::normalize_path($path);

                $headers = get_headers($file, 1);

                // Drop external file that doesn't have Last-Modified header
                if (!isset($headers['Last-Modified'])) {
                    unset($files[$i]);
                    continue;
                }

                // Get last modification time if caching system is enabled
                if (isset($cache_id))
                    $fmtime = strtotime($headers['Last-Modified']);

            // Local file
            } else {
                $doc_root = $_SERVER['DOCUMENT_ROOT'];
                $file = $files[$i] = self::normalize_path($file);

                // Relative to Document Root file
                if (substr($file, 0, 1) == "/") {
                    $root_flag = true;
                    $file = self::normalize_path("$doc_root$file");

                // Relative to running CSS Joiner directory
                } else {
                    $root_flag = false;
                    $script_dir = dirname($_SERVER['SCRIPT_FILENAME']);
                    $file = self::normalize_path("$script_dir/$file");
                }

                // Path is directory - add its .css files
                if (is_dir($file) && is_readable($file)) {
                    $d_files = glob("$file/*.css");
                    foreach ($d_files as $d_file)
                        if (is_readable($d_file) &&
                            (substr($d_file, 0, strlen($doc_root)) == $doc_root)
                        ) {
                            $dir_files[] = $d_file;
                            if (isset($cache_id)) {
                                $fmtime = filemtime($d_file);
                                 if ($mtime < $fmtime)
                                    $mtime = $fmtime;
                                $cache_id .= $this->delimiter . $d_file;
                            }
                        }

                    // Remove directory from files list
                    unset($files[$i]);
                    continue;

                // Drop files without .css extension
                } elseif (!preg_match('/\.css$/i', $file)) {
                    unset($files[$i]);
                    continue;
                }

                // Cannot read file
                if (!is_readable($file)) {

                    // Check for Document Root relativity
                    if (!$root_flag)
                        $file = self::normalize_path("$doc_root/{$files[$i]}");

                    // Drop unexisting/unredable file
                    if ($root_flag || !is_readable($file)) {
                        unset($files[$i]);
                        continue;
                    }
                }

                // Drop file outside Document Root
                if (substr($file, 0, strlen($doc_root)) != $doc_root) {
                    unset($files[$i]);
                    continue;
                }

                // Get last modification time if caching system is enabled
                if (isset($cache_id))
                    $fmtime = filemtime($file);

                $files[$i] = $file;
            }

            // Set cache modification time & ETag ID
            if (isset($cache_id)) {
                if ($mtime < $fmtime)
                    $mtime = $fmtime;
                $cache_id .= $this->delimiter . $file;
            }
        }

        // Add directory files
        if (count($dir_files))
            $files = array_merge($files, $dir_files);

        // Quit if no suitable files
        if (!count($files)) die;

        // Caching System
        if (isset($cache_id)) {
            $cache_id = md5($cache_id); // Suitable cache ID
            $cache_file = "{$this->cache_dir}/$cache_id.css";

            // Caching
            if (!file_exists($cache_file) || (filemtime($cache_file) < $mtime)) {
                $content = self::parse_files($files);
                file_put_contents($cache_file, $content);
            }

            // Browser cache
            self::http_cache($cache_file);

        // Caching system is disabled
        } else {
            header("Content-Type: text/css");
            echo self::parse_files($files);
        }
    }

    static function gpc_clear_slashes($sbj) {
        if (ini_get('magic_quotes_gpc')) {
            if (is_array($sbj))
                foreach ($sbj as $key => $val)
                    $sbj[$key] = self::gpc_clear_slashes($val);
            elseif (is_scalar($sbj))
                $sbj = stripslashes($sbj);
        }
        return $sbj;
    }

    static function normalize_path($path) {
        $path = preg_replace('/\/+/s', "/", $path);

        $path = "/$path";
        if (substr($path, -1) != "/")
            $path .= "/";

        $expr = '/\/([^\/]{1}|[^\.\/]{2}|[^\/]{3,})\/\.\.\//s';
        while (preg_match($expr, $path))
            $path = preg_replace($expr, "/", $path);

        $path = substr($path, 0, -1);
        $path = substr($path, 1);
        return $path;
    }

    static function http_cache($file) {
        $modified = filemtime($file);
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", $modified) . " GMT");
        $headers = getallheaders();
        if (isset($headers['If-Modified-Since'])) {
            $cache_modified = explode(';', $headers['If-Modified-Since']);
            $cache_modified = strtotime($cache_modified[0]);
            if ($modified <= $cache_modified) {
                header('HTTP/1.1 304 Not Modified');
                die;
            }
        }
        $expire = 604800; // a week in seconds
        $size = filesize($file);
        $expires = gmdate("D, d M Y H:i:s", time() + $expire) . " GMT";
        header("Content-Type: text/css");
        header("Expires: $expires");
        header("Cache-Control: max-age=$expire");
        header("Pragma: !invalid");
        header("Content-Length: $size");
        readfile($file);
    }

    static function parse_files(array $files) {
        $content = "";
        foreach ($files as $file)
            $content .= self::parse_file($file);
        return $content;
    }

    static function parse_file($file) {
        $code = file_get_contents($file);

        $code = preg_replace('/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/', "", $code); // Remove comments
        $code = trim(preg_replace('/\s+/s', " ", $code)); // Whitespaces to single spaces
        $code = preg_replace('/ ?\{ ?/', "{", $code); // Spaces before and after {
        $code = preg_replace('/ ?\} ?/', "}", $code); // Spaces before and after }
        $code = preg_replace('/ ?\; ?/', ";", $code); // Spaces before and after ;
        $code = preg_replace('/ ?\> ?/', ">", $code); // Spaces before and after >
        $code = preg_replace('/ ?\, ?/', ",", $code); // Spaces before and after ,
        $code = preg_replace('/ ?\: ?/', ":", $code); // Spaces before and after :
        $code = preg_replace('/url\(\'([^\)]*)\'\)/si', "url($1)", $code); // URL quotes
        $code = preg_replace('/url\(\"([^\)]*)\"\)/si', "url($1)", $code); // URL quotes
        $code = str_replace(";}", "}", $code); // ; before }

        // 0px, 0pt, 0em and 0%  =>  0
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)(0)0*\.?0*(px|pt|em|\%)([ \;\}])/i';
        while (preg_match($expr, $code))
            $code = preg_replace($expr, "$1$3$5", $code);

        // Remove Zerofill
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)0+(\d+(\.\d+)?(px|pt|em|\%)?[ \;\}])/i';
        while (preg_match($expr, $code))
            $code = preg_replace($expr, "$1$3", $code);

        // Decimal Numbers
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)(\d+)\.0*((px|pt|em|\%)?[ \;\}])/i';
        while (preg_match($expr, $code))
            $code = preg_replace($expr, "$1$3$4", $code);
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)\.0*((px|pt|em|\%)?[ \;\}])/i';
        while (preg_match($expr, $code, $m))
            $code = str_replace($m[0], $m[1]."0".$m[3], $code);
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)(\.\d+)((px|pt|em|\%)?[ \;\}])/i';
        while (preg_match($expr, $code, $m))
            $code = str_replace($m[0], $m[1]."0".$m[3].$m[4], $code);
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)(\d+\.\d*[1-9])0+((px|pt|em|\%)?[ \;\}])/i';
        while (preg_match($expr, $code))
            $code = preg_replace($expr, "$1$3$4", $code);

        // Four size value properties
        foreach (array(
            "margin", "padding", "border-width", "outline-width", "border-radius",
            "-moz-border-radius", "-webkit-border-radius", "-moz-outline-radius",
            ) as $property
        ) {
            $property = str_replace("-", "\-", $property);
            // 2px 2px  =>  2px
            $expr = '/([\{\;]' .$property. '\:)([^ \}\;]+) ([^ \}\;]+)([\}\;])/i';
            if (preg_match_all($expr, $code, $matches, PREG_SET_ORDER))
                foreach ($matches as $m)
                    if ($m[2] == $m[3]) {
                        $replace = "{$m[1]}{$m[2]}{$m[4]}";
                        $code = str_replace($m[0], $replace, $code);
                    }

            $expr = '/([\{\;]'.$property.'\:)' .
                '([^ \}\;]+) ([^ \}\;]+) ([^ \}\;]+) ([^ \}\;]+)([\}\;])/i';
            if (preg_match_all($expr, $code, $matches, PREG_SET_ORDER))

                foreach ($matches as $m)

                    // 2px 2px 2px 2px  =>  2px
                    if (($m[2] == $m[3]) && ($m[3] == $m[4]) && ($m[4] == $m[5])) {
                        $replace = "{$m[1]}{$m[2]}{$m[6]}";
                        $code = str_replace($m[0], $replace, $code);

                    // 2px 7px 2px 7px  =>  2px 7px
                    } elseif (($m[2] == $m[4]) && ($m[3] == $m[5])) {
                        $replace = "{$m[1]}{$m[2]} {$m[3]}{$m[6]}";
                        $code = str_replace($m[0], $replace, $code);
                    }
        }

        // Parse colors: rgb(16,32,64) => #102040
        $byte = '0*(25[0-5]|2[0-4]\d|1\d{2}|[1-9]\d|\d?)';
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)' .
            'rgb\('.$byte.'\,'.$byte.'\,'.$byte.'\)' .
            '(( [^\}\;]+)?[ \;\}])/si';
        if (preg_match_all($expr, $code, $matches, PREG_SET_ORDER))
            foreach ($matches as $m) {
                $h = array($m[3], $m[4], $m[5]);
                foreach ($h as $i => $c) {
                    $c = preg_replace('/^0+/', "", $c);
                    if (!strlen($c)) $c = "0";
                    $c = dechex($c);
                    if (strlen($c) == 1)
                        $c = "0" . $c;
                    $h[$i] = $c;
                }
                list($r, $g, $b) = $h;
                $replace = "{$m[1]}#$r$g$b{$m[6]}";
                $code = str_replace($m[0], $replace, $code);
            }

        // Parse Colors: #112233 => #123
        $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)' .
            '\#(([0-9a-f])([0-9a-f])([0-9a-f])([0-9a-f])([0-9a-f])([0-9a-f]))' .
            '(( [^\}\;]+)?[ \;\}])/si';
        if (preg_match_all($expr, $code, $matches, PREG_SET_ORDER))
            foreach ($matches as $m)
                if (($m[4] == $m[5]) &&
                    ($m[6] == $m[7]) &&
                    ($m[8] == $m[9])
                ) {
                    $replace = "{$m[1]}#{$m[4]}{$m[6]}{$m[8]}{$m[10]}";
                    $code = str_replace($m[0], $replace, $code);
                }

        $colors = array ('aliceblue' => "f0f8ff", 'antiquewhite' => "faebd7", 'aqua' => "0ff", 'aquamarine' => "7fffd4", 'azure' => "f0ffff", 'beige' => "f5f5dc", 'bisque' => "ffe4c4", 'black' => "000", 'blanchedalmond' => "ffebcd", 'blue' => "00f", 'blueviolet' => "8a2be2", 'brown' => "a52a2a", 'burlywood' => "deb887", 'cadetblue' => "5f9ea0", 'chartreuse' => "7fff00", 'chocolate' => "d2691e", 'coral' => "ff7f50", 'cornflowerblue' => "6495ed", 'cornsilk' => "fff8dc", 'crimson' => "dc143c", 'cyan' => "0ff", 'darkblue' => "00008b", 'darkcyan' => "008b8b", 'darkgoldenrod' => "b8860b", 'darkgray' => "a9a9a9", 'darkgreen' => "006400", 'darkkhaki' => "bdb76b", 'darkmagenta' => "8b008b", 'darkolivegreen' => "556b2f", 'darkorange' => "ff8c00", 'darkorchid' => "9932cc", 'darkred' => "8b0000", 'darksalmon' => "e9967a", 'darkseagreen' => "8fbc8f", 'darkslateblue' => "483d8b", 'darkslategray' => "2f4f4f", 'darkturquoise' => "00ced1", 'darkviolet' => "9400d3", 'deeppink' => "ff1493", 'deepskyblue' => "00bfff", 'dimgray' => "696969", 'dodgerblue' => "1e90ff", 'firebrick' => "b22222", 'floralwhite' => "fffaf0", 'forestgreen' => "228b22", 'fuchsia' => "ff00ff", 'gainsboro' => "dcdcdc", 'ghostwhite' => "f8f8ff", 'gold' => "ffd700", 'goldenrod' => "daa520", 'gray' => "808080", 'green' => "008000", 'greenyellow' => "adff2f", 'honeydew' => "f0fff0", 'hotpink' => "ff69b4", 'indianred ' => "cd5c5c", 'indigo ' => "4b0082", 'ivory' => "fffff0", 'khaki' => "f0e68c", 'lavender' => "e6e6fa", 'lavenderblush' => "fff0f5", 'lawngreen' => "7cfc00", 'lemonchiffon' => "fffacd", 'lightblue' => "add8e6", 'lightcoral' => "f08080", 'lightcyan' => "e0ffff", 'lightgoldenrodyellow' => "fafad2", 'lightgrey' => "d3d3d3", 'lightgreen' => "90ee90", 'lightpink' => "ffb6c1", 'lightsalmon' => "ffa07a", 'lightseagreen' => "20b2aa", 'lightskyblue' => "87cefa", 'lightslategray' => "789", 'lightsteelblue' => "b0c4de", 'lightyellow' => "ffffe0", 'lime' => "0f0", 'limegreen' => "32cd32", 'linen' => "faf0e6", 'magenta' => "f0f", 'maroon' => "800000", 'mediumaquamarine' => "66cdaa", 'mediumblue' => "0000cd", 'mediumorchid' => "ba55d3", 'mediumpurple' => "9370d8", 'mediumseagreen' => "3cb371", 'mediumslateblue' => "7b68ee", 'mediumspringgreen' => "00fa9a", 'mediumturquoise' => "48d1cc", 'mediumvioletred' => "c71585", 'midnightblue' => "191970", 'mintcream' => "f5fffa", 'mistyrose' => "ffe4e1", 'moccasin' => "ffe4b5", 'navajowhite' => "ffdead", 'navy' => "000080", 'oldlace' => "fdf5e6", 'olive' => "808000", 'olivedrab' => "6b8e23", 'orange' => "ffa500", 'orangered' => "ff4500", 'orchid' => "da70d6", 'palegoldenrod' => "eee8aa", 'palegreen' => "98fb98", 'paleturquoise' => "afeeee", 'palevioletred' => "d87093", 'papayawhip' => "ffefd5", 'peachpuff' => "ffdab9", 'peru' => "cd853f", 'pink' => "ffc0cb", 'plum' => "dda0dd", 'powderblue' => "b0e0e6", 'purple' => "800080", 'red' => "f00", 'rosybrown' => "bc8f8f", 'royalblue' => "4169e1", 'saddlebrown' => "8b4513", 'salmon' => "fa8072", 'sandybrown' => "f4a460", 'seagreen' => "2e8b57", 'seashell' => "fff5ee", 'sienna' => "a0522d", 'silver' => "c0c0c0", 'skyblue' => "87ceeb", 'slateblue' => "6a5acd", 'slategray' => "708090", 'snow' => "fffafa", 'springgreen' => "00ff7f", 'steelblue' => "4682b4", 'tan' => "d2b48c", 'teal' => "008080", 'thistle' => "d8bfd8", 'tomato' => "ff6347", 'turquoise' => "40e0d0", 'violet' => "ee82ee", 'wheat' => "f5deb3", 'white' => "fff", 'whitesmoke' => "f5f5f5", 'yellow' => "ff0", 'yellowgreen' => "9acd32");

        // Name <=> HEX (select smaller value)
        foreach ($colors as $name => $hex)
            if (strlen($name) > strlen($hex)) {
                $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)'.$name.'(( [^\}\;]+)?[ \;\}])/i';
                while (preg_match($expr,$code))
                    $code = preg_replace($expr, "$1#$hex$3", $code);
            } elseif ((strlen($hex) + 1) > strlen($name)) {
                $expr = '/([\{\;][a-z\-]+\:([^\}\;]+ )?)\#'.$hex.'(( [^\}\;]+)?[ \;\}])/i';
                while (preg_match($expr,$code))
                    $code = preg_replace($expr, "$1$name$3", $code);
            }

        // Fix url() paths in external file
        if (preg_match('/^(https?)\:\/\/?([^\/]+)(\:\d+)*(\/.*)*$/i', $file, $patt)) {
            list($full, $protocol, $domain, $port, $path) = $patt;
            if ((($protocol == "http") && ($port == ":80")) ||
                (($protocol == "https") && ($port == ":443"))
            )
                $port = "";

            $url_base = "$protocol://$domain$port";
            $url_path = $url_base . dirname($path);

            $code = preg_replace('/url\(\/([^\)]*)\)/si', "url($url_base/$1)", $code);
            $code = preg_replace('/url\((https?\:[^\)]*)\)/si', "url(/$1)", $code);
            $code = preg_replace('/url\(([^\/][^\)]*)\)/si', "url($url_path/$1)", $code);
            $code = str_ireplace("url(/", "url(", $code);

        // Fix url() paths in local file
        } elseif (isset($_GET['css']) || (isset($_GET['url']) && strlen($_GET['url']))) {
            $script_dir = dirname($_SERVER['SCRIPT_FILENAME']);
            $doc_root = $_SERVER['DOCUMENT_ROOT'];

            if (($script_dir != dirname($file)) || !isset($_GET['css'])) {
                $url_path = (
                    isset($_GET['css']) &&
                    (substr($file, 0, strlen($script_dir)) == $script_dir)
                )
                    ? dirname(substr($file, strlen($script_dir) + 1))
                    : dirname(substr($file, strlen($doc_root)));

                $code = preg_replace('/url\((https?\:[^\)]*)\)/si', "url(/$1)", $code);
                $code = preg_replace('/url\(([^\/][^\)]*)\)/si', "url($url_path/$1)", $code);
                $code = preg_replace('/url\(\/(https?\:[^\)]*)\)/si', "url($1)", $code);
            }
        }

        // Normalize url() paths
        if (preg_match_all('/url\(([^\)]+)\)/si', $code, $matches, PREG_SET_ORDER))
            foreach ($matches as $patt) {
                $old_url = $patt[1];
                $new_url = self::normalize_path($old_url);
                if ($new_url != $old_url)
                    $code = str_ireplace("url($old_url)", "url($new_url)", $code);
            }

        return $code;
    }
}

new CSSjoin();

?>