<?php

class ModelProfessor{
    private $idUsuario;
    private $idProfessor;
    private $nomeProfessor;
    private $cpfProfessor;
    private $dataProfessor;
    private $emailProfessor;
    private $senhaProfessor;


    public function getIdProfessor() {
        return $this->idProfessor;
    }
    public function getNomeProfessor() {
        return $this->nomeProfessor;
    }
    public function getCpfProfessor() {
        return $this->cpfProfessor;
    }
    public function getDataProfessor() {
        return $this->dataProfessor;
    }
    public function getEmailProfessor() {
        return $this->emailProfessor;
    }
    public function getSenhaProfessor() {
        return $this->senhaProfessor;
    }

    public function setIdProfessor($idProfessor) {
        $this->idProfessor = $idProfessor;
    }
    public function setNomeProfessor($nomeProfessor) {
        $this->nomeProfessor = $nomeProfessor;
    }
    public function setCpfProfessor($cpfProfessor) {
        $this->cpfProfessor = $cpfProfessor;
    }
    public function setDataProfessor($dataProfessor) {
        $this->dataProfessor = $dataProfessor;
    }
    public function setEmailProfessor($emailProfessor) {
        $this->emailProfessor = $emailProfessor;
    }
    public function setSenhaProfessor($senhaProfessor) {
        $this->senhaProfessor = $senhaProfessor;
    }
}
?>