<?php
/**
 * Classe que controla todas as Views
 *
 * @author Fernando Henrique
 */
class Webscientist_Action extends Zend_Controller_Action {
    public function init() {
        $Servico = new Servicos();

        $lista = $Servico->lista();
        $this->view->lista = $lista;

        parent::init();
    }
}