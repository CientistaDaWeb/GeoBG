<?php
class ServicosController extends Webscientist_Action {

    function indexAction() {
        $cslug = $this->_getParam('cslug');

        $this->view->title = 'Servicos';
        $this->view->description = '';
        $this->view->keywords = '';

        $obj = new Servicos();

        if(!empty($cslug)) {
            $categoria = $obj->getCategoria($cslug);
            $this->view->title = 'Servicos - '.$categoria['categoria'];
        }
        $this->view->categoria = $categoria;

        $this->view->servicos = $obj->lista($cslug);
    }

    function internaAction() {
        $cslug = $this->_getParam('cslug');
        $slug = $this->_getParam('slug');

        $this->view->description = '';
        $this->view->keywords = '';

        $obj = new Servicos();
        $servico = $obj->busca($cslug, $slug);
        $this->view->title = $servico['servico'];
        $this->view->servico = $servico;
    }
}