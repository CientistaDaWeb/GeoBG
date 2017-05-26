<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    private $controller, $router;

    protected function _initAutoLoader() {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Noumenal_');
        $autoloader->registerNamespace('Phpmailer_');
        $autoloader->setFallbackAutoloader(true);
    }
    public function _initTranslate() {
        $translate = new Zend_Translate('Gettext',APPLICATION_PATH .'/translates/validate/pt_BR.mo');
        Zend_Validate_Abstract::setDefaultTranslator($translate);
    }
    public function _initConfigs() {
        $configs = new Zend_Config_Ini(APPLICATION_PATH.'/configs/config.ini', 'ween');
        Zend_Registry::set('configs', $configs);
    }
    public function _initRotes() {
        $this->controller = Zend_Controller_Front::getInstance();
        $this->router = $this->controller->getRouter();
        $this->router->addRoute('servicos', new Zend_Controller_Router_Route('servicos/:cslug/:slug', array(
                        'controller' => 'servicos',
                        'action'=> 'interna')));
        $this->router->addRoute('servicos2', new Zend_Controller_Router_Route('servicos/:cslug', array(
                        'controller' => 'servicos',
                        'action'=> 'index')));
    }

    public function HelperMessenger() {
        $this->view->addHelperPath(LIBRARY_PATH.'/Noumenal/View/Helper','Noumenal_View_Helper');
    }

    public function _initRedirect() {
        $configs = Zend_Registry::get('configs');

        //Configura os PATH
        defined('PUBLIC_PATH') || define('PUBLIC_PATH', '/public/');
        defined('CSS_PATH') || define('CSS_PATH', PUBLIC_PATH.'css/');
        defined('DOC_PATH') || define('DOC_PATH', PUBLIC_PATH.'docs/');
        //defined('IMAGE_PATH') || define('IMAGE_PATH', PUBLIC_PATH.'images/');
        defined('IMAGE_PATH') || define('IMAGE_PATH', 'http://images.weentigra.com.br/'.$configs->cliente->dominio.'/');
        defined('JS_PATH') || define('JS_PATH', PUBLIC_PATH.'js/');
        defined('SWF_PATH') || define('SWF_PATH', PUBLIC_PATH.'swf/');

        if($_SERVER['SERVER_ADDR'] == $configs->cliente->ip) {
            if($_SERVER['HTTP_HOST'] == $configs->cliente->dominio) {
                $url = $_SERVER['REQUEST_URI'];
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: http://www.'.$configs->cliente->dominio.$url);
            }
        }
    }

    function run() {
        $this->HelperMessenger();
        parent::run();
    }
}