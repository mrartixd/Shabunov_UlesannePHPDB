<?php
//класс актер, в октором хранится ид, имя, фамилия и есть конструктор
class Actor
{
    public $id;
    public $lastname;
    public $firstname;

     public function __construct($id, $firstname, $lastname)
     {
         $this->id=$id;
         $this->firstname=$firstname;
         $this->lastname=$lastname;
     }
}