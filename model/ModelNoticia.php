<?php

class ModelNoticia{

    private $idNoticia;
    private $tituloNoticia;
    private $descricaoNoticia;
    private $cursoNoticia;
    private $dataNoticia;
    private $cpfNoticia;





    public function getIdNoticia() {
        return $this->idNoticia;
    }
    public function getTituloNoticia() {
        return $this->tituloNoticia;
    }
    public function getDescricaoNoticia() {
        return $this->descricaoNoticia;
    }
    public function getCursoNoticia() {
        return $this->cursoNoticia;
    }
    public function getDataNoticia() {
        return $this->dataNoticia;
    }
    public function getCpfNoticia() {
        return $this->cpfNoticia;
    }






    public function setIdNoticia($idNoticia) {
        $this->idNoticia = $idNoticia;
    }
    public function setTituloNoticia($tituloNoticia) {
        $this->tituloNoticia = $tituloNoticia;
    }
    public function setDescricaoNoticia($descricaoNoticia) {
        $this->descricaoNoticia = $descricaoNoticia;
    }
    public function setCursoNoticia($cursoNoticia) {
        $this->cursoNoticia = $cursoNoticia;
    }
    public function setDataNoticia($dataNoticia) {
        $this->dataNoticia = $dataNoticia;
    }
    public function setCpfNoticia($cpfNoticia) {
        $this->cpfNoticia = $cpfNoticia;
    }


}
?>
