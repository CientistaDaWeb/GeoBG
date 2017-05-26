<?php
class IndexController extends Webscientist_Action {
    public function indexAction() {
        $this->view->title = 'Bem Vindo';
        $this->view->description = '';
        $this->view->keywords = '';

        $Servico = new Servicos();
        
        $destaques = $Servico->destaques();

        $this->view->destaques = $destaques;
    }
}