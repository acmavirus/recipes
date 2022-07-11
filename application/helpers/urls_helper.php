<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('toSlug')) {
    function toSlug($doc, $fm = '_')
    {
        $doc = trim($doc);
        $str = addslashes(html_entity_decode($doc));
        $str = toNormal($str);
        $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $str = preg_replace("/( )/", $fm, $str);
        $str = str_replace('/', '', $str);
        $str = str_replace("\/", '', $str);
        $str = str_replace("+", "", $str);
        $str = strtolower($str);
        $str = stripslashes($str);
        return trim($str);
    }
}

if (!function_exists('toNormal')) {
    function toNormal($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
}

if (!function_exists('getCatUrl')) {
    function getCatUrl($slug, $base_url = true)
    {
        if (!empty($slug)) {
            if ($base_url == true) return base_url('recipes/' . $slug . '-cat.html');
            if ($base_url == false) return $slug . '-cat.html';
        } else {
            return '#noSlug';
        }
    }
}

if (!function_exists('getUrlContent')) {
    function getUrlContent($slug, $base_url = true)
    {
        if (!empty($slug)) {
            if ($base_url == true) return base_url('recipes/' . $slug . '-det.html');
            if ($base_url == false) return $slug . '-det.html';
        } else {
            return '#noDetail';
        }
    }
}

if (!function_exists('getPostUrl')) {
    function getPostUrl($slug, $base_url = true)
    {
        if (!empty($slug)) {
            if ($base_url == true) return base_url('' . $slug . '-post.html');
            if ($base_url == false) return $slug . '-post.html';
        } else {
            return '#noDetail';
        }
    }
}

if (!function_exists('returnLink')) {
    function returnLink($class= 'text-decoration-none text-white', $url, $title)
    {
        return "<a class='$class' href='$url' title='$title'>";
    }
}

if (!function_exists('returnRelLink')) {
    function returnRelLink($rel = '', $class= 'text-decoration-none text-white', $url, $title)
    {
        return "<a rel='$rel' class='$class' href='$url' title='$title'>";
    }
}

if (!function_exists('returnImg')) {
    function returnImg($class= '', $width='100%', $height = '100%', $url, $title)
    {
        return "<img class='$class' width='$width' height='$height' src='$url' alt='$title'>";
    }
}
