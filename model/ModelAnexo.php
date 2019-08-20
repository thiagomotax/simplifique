<?php




class ModelAnexo{
    private $idAnexo;
    private $disciplinaAnexo;
    private $tituloAnexo;
    private $dataAnexo;
    private $fileAnexo;
    private $cursoAnexo;
    private $urlAnexo;


    public function getIdAnexo() {
        return $this->idAnexo;
    }
    public function getDisciplinaAnexo() {
        return $this->disciplinaAnexo;
    }
    public function getTituloAnexo() {
        return $this->tituloAnexo;
    }
    public function getDataAnexo() {
        return $this->dataAnexo;
    }
    public function getFileAnexo() {
        return $this->fileAnexo;
    }
    public function getCursoAnexo() {
        return $this->cursoAnexo;
    }
    public function getUrlAnexo() {
        return $this->urlAnexo;
    }

    public function setIdAnexo($idAnexo) {
        $this->idAnexo = $idAnexo;
    }
    public function setDisciplinaAnexo($disciplinaAnexo) {
        $this->disciplinaAnexo = $disciplinaAnexo;
    }
    public function setTituloAnexo($tituloAnexo) {
        $this->tituloAnexo = $tituloAnexo;
    }
    public function setDataAnexo($dataAnexo) {
        $this->dataAnexo = $dataAnexo;
    }
    public function setFileAnexo($fileAnexo) {
        $this->fileAnexo = $fileAnexo;
    }
    public function setCursoAnexo($cursoAnexo) {
        $this->cursoAnexo = $cursoAnexo;
    }
    public function setUrlAnexo($urlAnexo) {
        $this->urlAnexo = $urlAnexo;
    }
}
?>
