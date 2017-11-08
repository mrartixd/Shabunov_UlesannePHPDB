<?php
//Класс Language в котором есть переменные ид и название, присутсвует конструктор
class Language
{
    public $id;
    public $name;

     public function __construct($id, $name)
     {
         $this->id=$id;
         $this->name=$name;
     }
}