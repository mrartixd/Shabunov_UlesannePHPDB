<?php
//класс Film, в котором хранится: ид, название, описание, дата релиза, длина фильма. Присутствует конструктор
class Film
{
    public $id;
    public $title;
    public $description;
    public $releaseYear;
    public $length;

    public function __construct($id, $title, $description, $releaseYear, $length)
    {
        $this->id=$id;
        $this->title=$title;
        $this->description=$description;
        $this->releaseYear=$releaseYear;
        $this->length=$length;
    }

}


