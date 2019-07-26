<?php

class ModelDisciplina{

    private $idDisciplina;
    private $idCurso;
    private $idProfessor;
    private $nomeDisciplina;
    private $anoDisciplina;

    public function getIdDisciplina() {
        return $this->idDisciplina;
    }
    public function getIdCurso() {
        return $this->idCurso;
    }
    public function getIdProfessor() {
        return $this->idProfessor;
    }
    public function getNomeDisciplina() {
        return $this->nomeDisciplina;
    }
    public function getAnoDisciplina() {
        return $this->anoDisciplina;
    }

    public function setIdDisciplina($idDisciplina) {
        $this->idDisciplina = $idDisciplina;
    }
    public function setIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }
    public function setIdProfessor($idProfessor) {
        $this->idProfessor = $idProfessor;
    }
    public function setNomeDisciplina($nomeDisciplina) {
        $this->nomeDisciplina = $nomeDisciplina;
    }
    public function setAnoDisciplina($anoDisciplina) {
        $this->anoDisciplina = $anoDisciplina;
    }
}
?>