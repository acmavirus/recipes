<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getImageThumb')) {
    function getImageThumb($url)
    {
        if (strpos($url, 'ttp') > 0 && !empty(getimagesize($url)) == true) {
            return $url;
        } else {
            $url = base_url(MEDIA_NAME."$url");
            if (strpos($url, 'ttp') > 0 && !empty(getimagesize($url)) == true) {
                return $url;
            } else {
                $url = base_url(MEDIA_NAME.'no-image.png');
                return $url;
            };
        };
    }
}