<?php


interface IMethodeCRUD {
    public function Add();
    public function Update();
    public function Delete();
    public function DeleteAll();
    public function GetAll();
    public function Find($val);
}


?>