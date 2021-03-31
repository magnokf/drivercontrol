<?php
/**
* DATABASE
*/
if (strpos($_SERVER['HTTP_HOST'], "localhost")) {
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "m15c1d8m12R9");
    define("CONF_DB_NAME", "fleet_db");
} else{
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "dmrgame1_fleetdb");
    define("CONF_DB_PASS", "bEbx2uxgrmYA");
    define("CONF_DB_NAME", "dmrgame1_fleetdb");
}

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.dmrtech.com.br/drivercontrol");
define("CONF_URL_TEST", "https://www.localhost/dmrtech.com.br/site/demo/drivercontrol");
define("URL", "https://www.localhost/dmrtech.com.br/site/demo/drivercontrol");

/**
 * SITE
 */
define("CONF_SITE_NAME", "DriverControl");
define("CONF_SITE_TITLE", "Gerencie suas contas e gestão de atividades de Motorista de App");
define("CONF_SITE_DESC",
    "O DriverControl é um gerenciador de contas simples, poderoso e gratuito. O prazer de tomar um café e ter o controle total de suas contas e atividades relacionadas ao seu carro alugado.");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "https://www.dmrtech.com.br/drivercontrol");
define("CONF_SITE_ADDR_STREET", "Rio de Janeiro-RJ");
define("CONF_SITE_ADDR_NUMBER", "7290");
define("CONF_SITE_ADDR_COMPLEMENT", "Bloco 1, 304");
define("CONF_SITE_ADDR_CITY", "Rio de Janeiro");
define("CONF_SITE_ADDR_STATE", "RJ");
define("CONF_SITE_ADDR_ZIPCODE", "22790-877");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@creator");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@creator");
define("CONF_SOCIAL_FACEBOOK_APP", "5555555555");
define("CONF_SOCIAL_FACEBOOK_PAGE", "pagename");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "author");
define("CONF_SOCIAL_GOOGLE_PAGE", "5555555555");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "5555555555");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "insta");
define("CONF_SOCIAL_YOUTUBE_PAGE", "youtube");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "cafeweb");
define("CONF_VIEW_APP", "cafeapp");
define("CONF_VIEW_ADMIN", "cafeadm");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_FILE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_FILE_DIR . "/cache");
define("CONF_MEDIA_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_MEDIA_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_FILE_SIZE", 9000);
define("CONF_MEDIA_SIZE", 9000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "mail.dmrtech.com.br");
define("CONF_MAIL_PORT", "465");
define("CONF_MAIL_USER", "drivercontrol@dmrtech.com.br");
define("CONF_MAIL_PASS", "990373mkF*");
define("CONF_MAIL_SENDER", ["name" => "DriverControl", "address" => "drivercontrol@dmrtech.com.br"]);
define("CONF_MAIL_SUPPORT", "webmaster@dmrgames.com");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "ssl");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * Cars
 */
define("CONF_PLATE_MIN_LEN", 7);
define("CONF_PLATE_MAX_LEN", 7);
/**
 * PAGAR.ME
 */
define("CONF_PAGARME_MODE", "test");
define("CONF_PAGARME_LIVE", "ak_live_*****");
define("CONF_PAGARME_TEST", "ak_test_*****");
define("CONF_PAGARME_BACK", CONF_URL_BASE . "/pay/callback");

/**
 * PAGSEGURO
 */
define("CONF_PAGSEGURO_MODE", "teste");
define("CONF_PAGSEGURO_APPID_TESTE", "app8753145994");
define("CONF_PAGSEGURO_TOKEN_TESTE", "644C1D47A704441BBA50BE1776639578");
define("CONF_PAGSEGURO_APPKEY_TESTE", "DFE6FD33E7E7C9799412BFA02559C752");
define ("EMAIL_LOJA", "v77019817595055635642@sandbox.pagseguro.com.br");


define("EMAIL_PAGSEGURO", "v77019817595055635642@sandbox.pagseguro.com.br");
define("TOKEN_PAGSEGURO", "PUB43ED580F73F1424FBF859EAEA4F20ABD");
define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");

define("MOEDA_PAGAMENTO", "BRL");
define("URL_NOTIFICACAO", "");


define("CONF_PAGSEGURO_APPID_LIVE", "****");
define("CONF_PAGSEGURO_TOKEN_LIVE", "****");
define("CONF_PAGSEGURO_APPKEY_LIVE", "****");





