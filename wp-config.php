<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']N<lDA?ip|U-)=6 cEblP6b?Q}D>eq)!5H>e<uPOBcD[AQNFEgA|W!3EKMOBTCeB');
define('SECURE_AUTH_KEY',  'UgOl<}5K&0ePx%(XYCo<q<oI8zD9lFrl@Dzltp]YMO(9s_K%ry}NL;bQ8:>Kd#K&');
define('LOGGED_IN_KEY',    'p/E%H]OfN?Ev#U`PCnU-m_.:@4TFe,Q->=e^5]kBUfEA-#%_uln#i7#W}$kFVkkw');
define('NONCE_KEY',        '?,SX@LhXvBW[VBz]xeqWqD05 #4Ug3IDvaFn0WukW/f(r-hBQ`Oc[UKq&^t2rd[r');
define('AUTH_SALT',        '3W.]KOx$Yb}v<:u~DTES ofj`G<GBzIr(H(kxm4Wu/kkUnV~W4iS4cK(y+2ku~So');
define('SECURE_AUTH_SALT', '7p=OtYs8]VeGPe)6B,3o <5/^h{baOF193s3&#^p1vI3}_3Jl+>=),I0)JtI%c:4');
define('LOGGED_IN_SALT',   'lNP,@]?-E&kW[D5Ld|T%+;tLCV5flXoPTS) :.h+6@c}?E>&9;d?_*N3}TF3>CI}');
define('NONCE_SALT',       'L%b[9]a /y^)B,7nlvhr]r~&.}tQJ<ig7A]tFxc@r=$x6mc`3+!*k>C|&Hm&j,0k');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
