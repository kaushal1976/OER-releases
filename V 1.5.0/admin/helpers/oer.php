<?php

/**
 * @version		1.5.0 OER $
 * @package		oer
 * @copyright	Copyright © 2009 - All rights reserved.
 * @license		GNU/GPL
 * @author		Dr Kaushal Keraminiyage
 * @author mail	admin@confmgt.com
 * @website		www.confmgt.com
 *
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
class oerHelper
{

function urlfilesize($url) {
    if (substr($url,0,4)=='http' || substr($url,0,3)=='ftp') {
        // for php 4 users
        if (!function_exists('get_headers')) {
            function get_headers($url, $format=0) {
                $headers = array();
                $url = parse_url($url);
                $host = isset($url['host']) ? $url['host'] : '';
                $port = isset($url['port']) ? $url['port'] : 80;
                $path = (isset($url['path']) ? $url['path'] : '/') . (isset($url['query']) ? '?' . $url['query'] : '');
                $fp = fsockopen($host, $port, $errno, $errstr, 3);
                if ($fp) {
                    $hdr = "GET $path HTTP/1.1\r\n";
                    $hdr .= "Host: $host \r\n";
                    $hdr .= "Connection: Close\r\n\r\n";
                    fwrite($fp, $hdr);
                    while (!feof($fp) && $line = trim(fgets($fp, 1024))) {
                        if ($line == "\r\n") break;
                        list($key, $val) = explode(': ', $line, 2);
                        if ($format)
                            if ($val) $headers[$key] = $val;
                            else $headers[] = $key;
                        else $headers[] = $line;
                    }
                    fclose($fp);
                    return $headers;
                }
                return false;
            }
        }
        $size = array_change_key_case(get_headers($url, 1),CASE_LOWER);
        $size = $size['content-length'];
        if (is_array($size)) { $size = $size[1]; }
    } else {
        $size = @filesize($url); 
    }
    return $size;    
} 
	
function datei_mime($filetype) {
    
    switch ($filetype) {
        case "ez":  $mime="application/andrew-inset"; break;
        case "hqx": $mime="application/mac-binhex40"; break;
        case "cpt": $mime="application/mac-compactpro"; break;
        case "doc": $mime="application/msword"; break;
        case "bin": $mime="application/octet-stream"; break;
        case "dms": $mime="application/octet-stream"; break;
        case "lha": $mime="application/octet-stream"; break;
        case "lzh": $mime="application/octet-stream"; break;
        case "exe": $mime="application/octet-stream"; break;
        case "class": $mime="application/octet-stream"; break;
        case "dll": $mime="application/octet-stream"; break;
        case "oda": $mime="application/oda"; break;
        case "pdf": $mime="application/pdf"; break;
        case "ai":  $mime="application/postscript"; break;
        case "eps": $mime="application/postscript"; break;
        case "ps":  $mime="application/postscript"; break;
        case "xls": $mime="application/vnd.ms-excel"; break;
        case "ppt": $mime="application/vnd.ms-powerpoint"; break;
        case "wbxml": $mime="application/vnd.wap.wbxml"; break;
        case "wmlc": $mime="application/vnd.wap.wmlc"; break;
        case "wmlsc": $mime="application/vnd.wap.wmlscriptc"; break;
        case "vcd": $mime="application/x-cdlink"; break;
        case "pgn": $mime="application/x-chess-pgn"; break;
        case "csh": $mime="application/x-csh"; break;
        case "dvi": $mime="application/x-dvi"; break;
        case "spl": $mime="application/x-futuresplash"; break;
        case "gtar": $mime="application/x-gtar"; break;
        case "hdf": $mime="application/x-hdf"; break;
        case "js":  $mime="application/x-javascript"; break;
        case "nc":  $mime="application/x-netcdf"; break;
        case "cdf": $mime="application/x-netcdf"; break;
        case "swf": $mime="application/x-shockwave-flash"; break;
        case "tar": $mime="application/x-tar"; break;
        case "tcl": $mime="application/x-tcl"; break;
        case "tex": $mime="application/x-tex"; break;
        case "texinfo": $mime="application/x-texinfo"; break;
        case "texi": $mime="application/x-texinfo"; break;
        case "t":   $mime="application/x-troff"; break;
        case "tr":  $mime="application/x-troff"; break;
        case "roff": $mime="application/x-troff"; break;
        case "man": $mime="application/x-troff-man"; break;
        case "me":  $mime="application/x-troff-me"; break;
        case "ms":  $mime="application/x-troff-ms"; break;
        case "ustar": $mime="application/x-ustar"; break;
        case "src": $mime="application/x-wais-source"; break;
        case "zip": $mime="application/x-zip"; break;
        case "au":  $mime="audio/basic"; break;
        case "snd": $mime="audio/basic"; break;
        case "mid": $mime="audio/midi"; break;
        case "midi": $mime="audio/midi"; break;
        case "kar": $mime="audio/midi"; break;
        case "mpga": $mime="audio/mpeg"; break;
        case "mp2": $mime="audio/mpeg"; break;
        case "mp3": $mime="audio/mpeg"; break;
        case "aif": $mime="audio/x-aiff"; break;
        case "aiff": $mime="audio/x-aiff"; break;
        case "aifc": $mime="audio/x-aiff"; break;
        case "m3u": $mime="audio/x-mpegurl"; break;
        case "ram": $mime="audio/x-pn-realaudio"; break;
        case "rm":  $mime="audio/x-pn-realaudio"; break;
        case "rpm": $mime="audio/x-pn-realaudio-plugin"; break;
        case "ra":  $mime="audio/x-realaudio"; break;
        case "wav": $mime="audio/x-wav"; break;
        case "pdb": $mime="chemical/x-pdb"; break;
        case "xyz": $mime="chemical/x-xyz"; break;
        case "bmp": $mime="image/bmp"; break;
        case "gif": $mime="image/gif"; break;
        case "ief": $mime="image/ief"; break;
        case "jpeg": $mime="image/jpeg"; break;
        case "jpg": $mime="image/jpeg"; break;
        case "jpe": $mime="image/jpeg"; break;
        case "png": $mime="image/png"; break;
        case "tiff": $mime="image/tiff"; break;
        case "tif": $mime="image/tiff"; break;
        case "wbmp": $mime="image/vnd.wap.wbmp"; break;
        case "ras": $mime="image/x-cmu-raster"; break;
        case "pnm": $mime="image/x-portable-anymap"; break;
        case "pbm": $mime="image/x-portable-bitmap"; break;
        case "pgm": $mime="image/x-portable-graymap"; break;
        case "ppm": $mime="image/x-portable-pixmap"; break;
        case "rgb": $mime="image/x-rgb"; break;
        case "xbm": $mime="image/x-xbitmap"; break;
        case "xpm": $mime="image/x-xpixmap"; break;
        case "xwd": $mime="image/x-xwindowdump"; break;
        case "msh": $mime="model/mesh"; break;
        case "mesh": $mime="model/mesh"; break;
        case "silo": $mime="model/mesh"; break;
        case "wrl": $mime="model/vrml"; break;
        case "vrml": $mime="model/vrml"; break;
        case "css": $mime="text/css"; break;
        case "asc": $mime="text/plain"; break;
        case "txt": $mime="text/plain"; break;
        case "gpg": $mime="text/plain"; break;
        case "rtx": $mime="text/richtext"; break;
        case "rtf": $mime="text/rtf"; break;
        case "wml": $mime="text/vnd.wap.wml"; break;
        case "wmls": $mime="text/vnd.wap.wmlscript"; break;
        case "etx": $mime="text/x-setext"; break;
        case "xsl": $mime="text/xml"; break;
        case "flv": $mime="video/x-flv"; break;
        case "mpeg": $mime="video/mpeg"; break;
        case "mpg": $mime="video/mpeg"; break;
        case "mpe": $mime="video/mpeg"; break;
        case "qt":  $mime="video/quicktime"; break;
        case "mov": $mime="video/quicktime"; break;
        case "mxu": $mime="video/vnd.mpegurl"; break;
        case "avi": $mime="video/x-msvideo"; break;
        case "movie": $mime="video/x-sgi-movie"; break;
        case "asf": $mime="video/x-ms-asf"; break;
        case "asx": $mime="video/x-ms-asf"; break;
        case "wm":  $mime="video/x-ms-wm"; break;
        case "wmv": $mime="video/x-ms-wmv"; break;
        case "wvx": $mime="video/x-ms-wvx"; break;
        case "ice": $mime="x-conference/x-cooltalk"; break;
        case "rar": $mime="application/x-rar"; break;
        default:    $mime="application/octet-stream"; break; 
    }
    return $mime;
}	

function download($file){

		$app = &JFactory::getApplication(); 
		$path=JPATH_COMPONENT_SITE.DS.'upload'.DS;
		$filename = basename($file);
		$readfile = $path.$filename;
		
		if (!file_exists($readfile)) { 
            return 2;
		}
	
		clearstatcache(); 
		$len = oerHelper::urlfilesize($readfile); 
		
        $file_extension = strtolower(substr(strrchr($filename,"."),1));
        $ctype = oerHelper::datei_mime($file_extension);
        ob_end_clean();
        // needed for MS IE - otherwise content disposition is not used?
        if (ini_get('zlib.output_compression')){
            ini_set('zlib.output_compression', 'Off');
        }
        
        header("Cache-Control: public, must-revalidate");
        header('Cache-Control: pre-check=0, post-check=0, max-age=0');
        // header("Pragma: no-cache");  // Problems with MS IE
        header("Expires: 0"); 
        header("Content-Description: File Transfer");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header("Content-Type: " . $ctype);
        header("Content-Length: ".(string)$len);
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header("Content-Transfer-Encoding: binary\n");
        
        // set_time_limit doesn't work in safe mode
        if (!ini_get('safe_mode')){ 
            @set_time_limit(0);
        }
		
       	@readfile($readfile);
    exit;
	}
}
	
