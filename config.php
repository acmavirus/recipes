<?php
/*---------------------------------------------------------------
 *                    TIMEZONE
  --------------------------------------------------------------- */
date_default_timezone_set("asia/ho_chi_minh");
/*---------------------------------------------------------------
 *                    DOMAIN
  --------------------------------------------------------------- */
$root = realpath(dirname(__FILE__));
$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
if (in_array($domain, ["vuivui.tk", "acmatvirus.tk"])) {
  $url = "https://";
} else {
  $url = "http://";
}
$root = str_replace("\\", '/', $root);
$url .= $domain;
/*---------------------------------------------------------------=----
 *                    CONFIG
  --------------------------------------------------------------- */
$helper = array('url', 'file', 'security', 'language', 'debug', 'images', 'menus', 'urls', 'datetime', 'data', 'admin/admin');
$library = array('database', 'session', 'form_validation', 'email', 'pagination', 'breadcrumbs');
/*---------------------------------------------------------------
 *                    DEFINE
  --------------------------------------------------------------- */
define('BASE_URL', $url . '/');
define('HELPER', $helper);
define('LIBRARY', $library);
define('MEDIA_NAME', "media/"); //Tên đường dẫn lưu media
define('MEDIA_PATH', $root . DIRECTORY_SEPARATOR . MEDIA_NAME); //Đường dẫn lưu media
define('VENDOR_PATH', "theme/"); //Đường dẫn lưu vendor
/*---------------------------------------------------------------
 *                    DATABASE
  --------------------------------------------------------------- */
if (in_array($domain, ["vuivui.tk", "acmatvirus.tk"])) {
  define('DB_DEFAULT_HOST', 'localhost'); //DB HOST
  define('DB_DEFAULT_USER', 'vuivui_db'); //DB USER
  define('DB_DEFAULT_PASSWORD', 'vuivui_db'); //DB PASSWORD
  define('DB_DEFAULT_NAME', 'vuivui_db'); //DB NAME
} else {
  define('DB_DEFAULT_HOST', 'localhost'); //DB HOST
  define('DB_DEFAULT_USER', 'root'); //DB USER
  define('DB_DEFAULT_PASSWORD', ''); //DB PASSWORD
  define('DB_DEFAULT_NAME', 'vuivui_dulieu'); //DB NAME
}
/*---------------------------------------------------------------
 *                    DEBUG
  --------------------------------------------------------------- */
define('login_max_attempts', '10'); //Bảo trì
define('MAINTAIN_MODE', FALSE); //Bảo trì
define('DEBUG_MODE', false);
/*---------------------------------------------------------------
 *                    CACHE
  --------------------------------------------------------------- */
define('CACHE_MODE', TRUE);
define('CACHE_ADAPTER', 'file');
define('CACHE_PREFIX_NAME', 'MY_');
