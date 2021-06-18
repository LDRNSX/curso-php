<?php
require_once '../Modelo/ClasesBaseDatos/BaseDatos.php';

class CRUD extends BaseDatos{
    private $pSQL_C;
    private $pSQL_R;
    private $pSQL_U;
    private $pSQL_D;

    protected function setDatos( $BaseDatos){
        $this->pDatos=$BaseDatos;
    } 

    protected function setSQL_C( $query){
        $this->pSQL_C=$query;
    } 

    protected function setSQL_R( $query){
        $this->pSQL_R=$query;
    } 

    protected function setSQL_U( $query){
        $this->pSQL_U=$query;
    }

    protected function setSQL_D( $query){
        $this->pSQL_D=$query;
    } 

}
?>