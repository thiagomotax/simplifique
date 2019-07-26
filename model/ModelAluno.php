<?php

class ModelAluno{
    private $idUsuario;
    private $idAluno;
    private $nomeAluno;
    private $cpfALuno;
    private $dataAluno;
    private $emailAluno;
    private $senhaAluno;


    public function getIdAluno() {
        return $this->idAluno;
    }
    public function getNomeAluno() {
        return $this->nomeAluno;
    }
    public function getCpfALuno() {
        return $this->cpfALuno;
    }
    public function getDataAluno() {
        return $this->dataAluno;
    }
    public function getEmailAluno() {
        return $this->emailAluno;
    }
    public function getSenhaAluno() {
        return $this->senhaAluno;
    }

    public function setIdAluno($idAluno) {
        $this->idAluno = $idAluno;
    }
    public function setNomeAluno($nomeAluno) {
        $this->nomeAluno = $nomeAluno;
    }
    public function setCpfALuno($cpfALuno) {
        $this->cpfALuno = $cpfALuno;
    }
    public function setDataAluno($dataAluno) {
        $this->dataAluno = $dataAluno;
    }
    public function setEmailAluno($emailAluno) {
        $this->emailAluno = $emailAluno;
    }
    public function setSenhaAluno($senhaAluno) {
        $this->senhaAluno = $senhaAluno;
    }
}
?>