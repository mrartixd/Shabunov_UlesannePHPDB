<?php
/* Данный файл создает интерфейс, в котором вклчают множество повторяющихся функции для MySQL и PRO сервисов(подключение к хосту с базой данных, 
SQL запрос на список фильмов, SQL запрос фильмов по ID, SQL запрос на информацию о фильмах) */
interface IServiceDB 
{
    public function connect();
    public function getAllFilms();
    public function getFilmByID($id);
    public function getAllFilmsInfo();
    public function getAllCategories();
}