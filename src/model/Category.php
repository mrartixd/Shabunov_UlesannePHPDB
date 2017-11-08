<?php
//класс Category, в котором хранится ид и имя категории. Есть конструктор
class Category
{
    public $id;
    public $name;

     public function __construct($id, $name)
     {
         $this->id=$id;
         $this->name=$name;
     }
}