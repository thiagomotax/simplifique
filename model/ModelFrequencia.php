<?php

class ModelFrequencia{

    private $idFrequencia;
    private $disciplinaFrequencia;
    private $cursoFrequencia;
    private $dataFrequencia;
    private $situacaoFrequencia;
    private $matriculaFrequencia;





    public function getIdFrequencia() {
        return $this->idFrequencia;
    }
    public function getDisciplinaFrequencia() {
        return $this->disciplinaFrequencia;
    }
    public function getCursoFrequencia() {
        return $this->cursoFrequencia;
    }
    public function getDataFrequencia() {
        return $this->dataFrequencia;
    }
    public function getSituacaoFrequencia() {
        return $this->situacaoFrequencia;
    }
    public function getMatriculaFrequencia() {
        return $this->matriculaFrequencia;
    }






    public function setIdFrequencia($idFrequencia) {
        $this->idFrequencia = $idFrequencia;
    }
    public function setDisciplinaFrequencia($disciplinaFrequencia) {
        $this->disciplinaFrequencia = $disciplinaFrequencia;
    }
    public function setCursoFrequencia($cursoFrequencia) {
        $this->cursoFrequencia = $cursoFrequencia;
    }
    public function setDataFrequencia($dataFrequencia) {
        $this->dataFrequencia = $dataFrequencia;
    }
    public function setSituacaoFrequencia($situacaoFrequencia) {
        $this->situacaoFrequencia = $situacaoFrequencia;
    }
    public function setMatriculaFrequencia($matriculaFrequencia) {
        $this->matriculaFrequencia = $matriculaFrequencia;
    }


}
?>
