<?php

class ModelRegistro{
    private $idRegistro;
    private $nomeRegistro;
    private $cpfRegistro;
    private $dataRegistro;
    private $emailRegistro;
    private $senhaRegistro;
    private $cursoRegistro;



    public function getIdRegistro() {
        return $this->idRegistro;
    }
    public function getNomeRegistro() {
        return $this->nomeRegistro;
    }
    public function getCpfRegistro() {
        return $this->cpfRegistro;
    }
    public function getDataRegistro() {
        return $this->dataRegistro;
    }
    public function getEmailRegistro() {
        return $this->emailRegistro;
    }
    public function getSenhaRegistro() {
        return $this->senhaRegistro;
    }
    public function getCursoRegistro() {
        return $this->cursoRegistro;
    }

    public function setIdRegistro($idRegistro) {
        $this->idRegistro = $idRegistro;
    }
    public function setNomeRegistro($nomeRegistro) {
        $this->nomeRegistro = $nomeRegistro;
    }
    public function setCpfRegistro($cpfRegistro) {
        $this->cpfRegistro = $cpfRegistro;
    }
    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }
    public function setEmailRegistro($emailRegistro) {
        $this->emailRegistro = $emailRegistro;
    }
    public function setSenhaRegistro($senhaRegistro) {
        $this->senhaRegistro = $senhaRegistro;
    }
    public function setCursoRegistro($cursoRegistro) {
        $this->cursoRegistro = $cursoRegistro;
    }
}
?>