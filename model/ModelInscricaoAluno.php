<?php

class ModelInscricaoAluno{
    private $idInscricao;
    private $idCurso;
    private $idUsuario;
    private $statusInscricao;




    public function getIdInscricao() {
        return $this->idInscricao;
    }
    public function getIdUsuario() {
        return $this->idUsuario;
    }
    public function getIdCurso() {
        return $this->idCurso;
    }
    public function getStatusInscricao() {
        return $this->statusInscricao;
    }

    public function setIdInscricao($idInscricao) {
        $this->idInscricao = $idInscricao;
    }
    public function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    public function setStatusInscricao($statusInscricao) {
        $this->statusInscricao = $statusInscricao;
    }
    
}
?>