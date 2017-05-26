<?php
class Servicos extends Zend_Db_Table_Abstract {
    protected $_name = 'servicos';
    protected $_primary = 'id_servico';

    public function lista($cslug = '') {
        $consulta = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('s'=>'servicos'))
                ->joinInner(array('sc'=>'servicos_categorias'), 's.id_servicos_categoria = sc.id_servicos_categoria', array('cslug'=>'slug','categoria'))
                ->order('sc.id_servicos_categoria')
                ->order('servico');
        if(!empty($cslug)){
            $consulta->where('sc.slug = ?', $cslug);
        }
        return $consulta->query()->fetchAll();
    }
    public function getCategoria($cslug){
        $consulta = $this->select()
                ->setIntegrityCheck(false)
                ->from('servicos_categorias')
                ->where('slug = ?',$cslug);
        return $consulta->query()->fetch();
    }
    public function destaques() {
        $consulta = $this->select()
                ->setIntegrityCheck(false)
                ->from('servicos_categorias')
                ->order('id_servicos_categoria');
        return $consulta->query()->fetchAll();
    }

    public function busca($cslug, $slug) {
        $consulta = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('s'=>'servicos'))
                ->joinInner(array('sc'=>'servicos_categorias'), 's.id_servicos_categoria = sc.id_servicos_categoria', array('cslug'=>'slug'))
                ->where('s.slug = ?', $slug)
                ->where('sc.slug = ? ', $cslug);
        return $consulta->query()->fetch();
    }
}