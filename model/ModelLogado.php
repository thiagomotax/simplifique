<?php

class ModelLogado{
    private $idLogado;
    private $nomeLogado;
    private $cpflogado;
    private $emailLogado;
    private $senhaLogado;



    public function getIdLogado() {
        return $this->idLogado;
    }
    public function getNomeLogado() {
        return $this->nomeLogado;
    }
    public function getCpflogado() {
        return $this->cpflogado;
    }
    public function getEmailLogado() {
        return $this->emailLogado;
    }
    public function getSenhaLogado() {
        return $this->senhaLogado;
    }

    public function setIdLogado($idLogado) {
        $this->idLogado = $idLogado;
    }
    public function setNomeLogado($nomeLogado) {
        $this->nomeLogado = $nomeLogado;
    }
    public function setCpflogado($cpflogado) {
        $this->cpflogado = $cpflogado;
    }
    public function setEmailLogado($emailLogado) {
        $this->emailLogado = $emailLogado;
    }
    public function setSenhaLogado($senhaLogado) {
        $this->senhaLogado = $senhaLogado;
    }
}
?>
