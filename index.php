<?php
setlocale (LC_ALL, 'pt_BR');
$siteStatus = 'online';

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));
defined('LIBRARY_PATH') || define('LIBRARY_PATH', realpath('../library'));

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : $siteStatus));

set_include_path(implode(PATH_SEPARATOR, array(realpath(LIBRARY_PATH), get_include_path(),)));

require_once 'Zend/Application.php';
$application = new Zend_Application(APPLICATION_ENV,APPLICATION_PATH . '/configs/application.ini');
$application->bootstrap()->run();