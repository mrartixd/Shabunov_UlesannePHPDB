<?php
/*класс FilmInfo в котором включен класс Film, чтобы не повторять переменные в классах, есть массив актеров, массив категории и язык фильма.
Есть конструктор*/
class FilmInfo extends Film
{
    public $actors=array();
    public $categories=array();
    public $language;

    public function __construct($id, $title, $description, $releaseYear, $length, $actors, $categories, $language)
    {
        parent::__construct($id, $title, $description, $releaseYear, $length);
        $this->actors=$actors;
        $this->categories=$categories;
        $this->language=$language;
    }
}

