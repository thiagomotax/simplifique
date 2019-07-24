<?php

class ModelCurso{

    private $idCurso;
    private $nomeCurso;
    private $descricaoCurso;

    public function getIdCurso() {
        return $this->idCurso;
    }
    public function getNomeCurso() {
        return $this->nomeCurso;
    }
    public function getDescricaoCurso() {
        return $this->descricaoCurso;
    }
    public function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }
    public function setNomeCurso($nomeCurso) {
        $this->nomeCurso = $nomeCurso;
    }
    public function setDescricaoCurso($descricaoCurso) {
        $this->descricaoCurso = $descricaoCurso;
    }
}
?>