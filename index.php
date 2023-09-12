<?php
namespace App;


use App\Providers\Loader;
use App\Providers\Router;

if (version_compare(PHP_VERSION, '8.0.0', '<'))
exit('Your PHP version is ' . PHP_VERSION . '. The script requires PHP 8.0 or higher.');


// Set constants (root server path + root URL)
define('PROT', (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://');
define('ROOT_URL', PROT . $_SERVER['HTTP_HOST'] . str_replace('\\', '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))) . '/'); // Remove backslashes for Windows compatibility
define('ROOT_PATH', __DIR__ . '/');

try
{
require ROOT_PATH . 'app/Providers/Loader.php';
Loader::getInstance()->init(); // Load necessary classes
$aParams = ['ctrl' => (!empty($_GET['p']) ? $_GET['p'] : 'HomeController'), 'act' => (!empty($_GET['a']) ? $_GET['a'] : 'index')];
Router::run($aParams);
}
catch (\Exception $oE)
{
echo $oE->getMessage();
}
