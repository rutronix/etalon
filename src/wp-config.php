<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
/** определяем директорию wp-content **/
define( 'WP_CONTENT_DIR', __DIR__ .'/wp-content');
define( 'WP_CONTENT_URL',  "//{$_SERVER['HTTP_HOST']}/wp-content" );

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');
/** Имя пользователя MySQL */
define('DB_USER', 'admin');
/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'admin');
/** Имя сервера MySQL (обычно не изменяется) */
define('DB_HOST', 'localhost');
/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');
/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@-*/
/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать разные префиксы.
 * Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 *
 * В принципе этот префикс можно не трогать, все будет работать. 
 * Указанный в переменной $table_prefix будет использоваться для всех создаваемых таблиц.
 */
$table_prefix  = 'web_';
/**
 *
 *
 * Ключи аутентификации
 *
 * Также обязательно нужно изменить ключи аутентификации. Эти ключи используются в разных местах кода WordPress для защиты от взлома.
 * Чтобы не сочинять ключи самому их можно быстро генерировать по следующей ссылке: https://api.wordpress.org/secret-key/1.1/salt/
 */
 
define('AUTH_KEY',         'Svy:bUnP(>h1CZ0HWXR4d(~!{g4R^-}2x(2@+n>+/QT=+-.6m08|+YIZeNv2-Xd.');
define('SECURE_AUTH_KEY',  'urB0Y(Mi+n@+dZOkrp+)bsuW<)rWg?fYy* rG-{dsoRkcZ=#k_O#Rb*&G+3PbbuB');
define('LOGGED_IN_KEY',    'K!P ^IaIgfh#^1z/tC4jAg5[>#K>G+Km-p$lsM+X;[>3|%*i{+Sp:+oduZC=T-}Y');
define('NONCE_KEY',        '@YKTH+5wNNY`mYGdz579flAR+-L.TUT#8E:OQJgZ<%eQ yTk[c61p=uP+J$,^S*U');
define('AUTH_SALT',        '79TKa#vN<_ytQ<(%/oJVpav@s|K[NWnxY;Wf{C.bi7IAw|RlEZVLwZ&3(v?_2u@>');
define('SECURE_AUTH_SALT', '3(s[s1$#KtIbhz4teh1[W|w8gk#!|k<9Ol60Q;Gq,,b XYyEyxhtPqF^Dv8SN0PF');
define('LOGGED_IN_SALT',   '2kRQJ[K]d8mB)@_df:h/ke+sb$s$6Cy+?a3+>YLxTGrut]YTH%cVOUI7Hj6*iXP|');
define('NONCE_SALT',       'G6LH: o!>%u4)^3>frEh h_(OwzeQ#gX:vXUvbc=EDl4vNh Gj_4a|F+ urtD{WH');

//define('WP_SITEURL', 'http://start-web/');
//define('WP_HOME', 'http://start-web/wordpress');

// Для разработчиков: Режим отладки WordPress. В обычном режиме false
define('WP_DEBUG', false);

//Задаем свой WordPress.com API-ключ как константу
define( 'WPCOM_API_KEY', 'My_API_Key' );

//Разрешаем загрузки любых файлов в WordPress для администраторов
define( 'ALLOW_UNFILTERED_UPLOADS', true );

//Определим новую тему по умолчанию
define( 'WP_DEFAULT_THEME', 'starck-theme' );

//Откажемся от автоматических обновлений тем в папке wp-content во время глобального обновления WP
define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );

/* Это всё, дальше не редактируем. */
/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');