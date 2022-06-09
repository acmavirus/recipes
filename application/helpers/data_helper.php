<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('forecast_weather')) {
    function forecast_weather()
    {
        $ci = &get_instance();
        $cache = "cache_forecast_weather";
        $data = $ci->getCache($cache);
        if (empty($current)) {
            $stationId = '353412';
            $apiKey = 'iF9XO7x4yIqfEpNxKkig0qBf21ZEAoDA';
            $apiListkey = ['2TZ34TvME35eADyjYSl60hsTGBk8lGr0', '%092TZ34TvME35eADyjYSl60hsTGBk8lGr0&q'];
            $current = json_decode(file_get_contents("https://dataservice.accuweather.com/forecasts/v1/daily/5day/$stationId?language=vi&apikey=$apiKey"));
            $data = [];
            $data['current'] = $current;
            $data['day'] = [];
            $data['night'] = [];
            foreach ($current->DailyForecasts as $key => $value) {
                $value->Day->Icon = substr("00" . $value->Day->Icon, -2, 2);
                $value->Night->Icon = substr("00" . $value->Night->Icon, -2, 2);
                $data['day'][] = [
                    'Date' => day_of_week_vn_byTime($value->EpochDate),
                    'Icon' => base_url(MEDIA_NAME)."weather_icons/" . $value->Day->Icon . ".png",
                    'IconPhrase' => $value->Day->IconPhrase,
                    'Temp' => ceil(($value->Temperature->Maximum->Value - 32) / 1.8),
                ];
                $data['night'][] = [
                    'Date' => day_of_week_vn_byTime($value->EpochDate),
                    'Icon' => base_url(MEDIA_NAME)."weather_icons/" . $value->Night->Icon . ".png",
                    'IconPhrase' => $value->Night->IconPhrase,
                    'Temp' => ceil(($value->Temperature->Minimum->Value - 32) / 1.8),
                ];
            };
            $ci->setCache($cache, $data, 84600);
        };

        return $data;
    }
}

if (!function_exists('rss_feed')) {
    function rss_feed()
    {
        $ci = &get_instance();
        $cache = "cache_rss_feed";
        $feed = $ci->getCache($cache);
        if (empty($feed)) {
            $domOBJ = new DOMDocument();
            $domOBJ->load('https://vnexpress.net/rss/tin-moi-nhat.rss'); //XML page URL
            $content = $domOBJ->getElementsByTagName("item");
            $rs = [];
            foreach ($content as $data) {
                $title = $data->getElementsByTagName("title")->item(0)->nodeValue;
                $rs[] = [
                    'title' => $title
                ];
            };
            shuffle($rs);
            $feed = array_slice($rs, 0, 6);
            $ci->setCache($cache, $feed, 100);
        };
        return $feed;
    }
}
