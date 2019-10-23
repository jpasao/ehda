<?php

class EtiquetasController extends Controller
{
    public function Save()
    {
        if (isset($_POST['save'])){
            $name = $_POST['name'];
            $this->modelTags->SaveTag(0, $name);
        }

        header('location: ' . URL . 'admin/etiquetas');
    }
}