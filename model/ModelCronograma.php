<?php

class ModelCronograma{

    private $idCronograma;
    private $disciplinaCronograma;
    private $cursoCronograma;
    private $dataCronograma;
    private $descricaoCronograma;
    private $tituloCronograma;





    public function getIdCronograma() {
        return $this->idCronograma;
    }
    public function getDisciplinaCronograma() {
        return $this->disciplinaCronograma;
    }
    public function getCursoCronograma() {
        return $this->cursoCronograma;
    }
    public function getDataCronograma() {
        return $this->dataCronograma;
    }
    public function getDescricaoCronograma() {
        return $this->descricaoCronograma;
    }
    public function getTituloCronograma() {
        return $this->tituloCronograma;
    }






    public function setIdCronograma($idCronograma) {
        $this->idCronograma = $idCronograma;
    }
    public function setDisciplinaCronograma($disciplinaCronograma) {
        $this->disciplinaCronograma = $disciplinaCronograma;
    }
    public function setCursoCronograma($cursoCronograma) {
        $this->cursoCronograma = $cursoCronograma;
    }
    public function setDataCronograma($dataCronograma) {
        $this->dataCronograma = $dataCronograma;
    }
    public function setDescricaoCronograma($descricaoCronograma) {
        $this->descricaoCronograma = $descricaoCronograma;
    }
    public function setTituloCronograma($tituloCronograma) {
        $this->tituloCronograma = $tituloCronograma;
    }


}
?>
