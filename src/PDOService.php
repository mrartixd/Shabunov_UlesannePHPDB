<?php
/* Здесь происходит подключение базы данной и функции с SQL запросами на основе PDO  */
class PDOService implements IServiceDB
{	
	private $connectDB;
	
	public function connect() {	//функция подключение к хосту (базе данной)
        try {
            $this->connectDB = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";charset=".DB_CHARSET, 
                                DB_USERNAME, DB_PASSWORD);//подключение сайта к базе данных
        }		
		catch (PDOException $ex) {//фиксация ошибки
			printf("Connection failed: %s", $ex->getMessage());//выводит информацию что нет подключение и код ошибки
			exit();//выход
		}
		return true;
	}
	
	public function getAllFilms()//функция на запрос всех фильмов из базы данной
	{	
		$films=array();//переменная films массив
		if ($this->connect()) {//проверка на подключение к хосту
			if ($result = $this->connectDB->query('SELECT * FROM film')) {//проверка на вывод result через запрос
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);//переменная row рана result, которая разделяется на строки
                foreach($rows as $row){//цикл прорабатывает строки переменной rows и дает имя row
					$films[]=new Film($row['film_id'], $row['title'], $row['description'], 
										$row['release_year'], $row['language_id'], $row=['length']);//в массив films класс Film заносяться row 
                 } 
			}
		}
        $this->connectDB=null;//отключение от базы данной
		return $films;//возращает переменную films
	}

	
	public function getFilmByID($id)//функция на поиск фильмов по переменной id
	{	
		$film=null;//переменная film равна null
		if ($this->connect()) {//проверка нп подключение к базе денной
			if ($result = $this->connectDB->prepare('SELECT * FROM film WHERE film_id=:id')) {//проверка на result который равен запросу на поиск фильму по id
				$result->execute(array('id'=>$id));//присваивание id с функции к id из запроса
				//$result->execute(['id'=>$id]);
                // $result->bindValue(':id', $id, PDO::PARAM_INT);
                // $result->execute();
				
				$numRows = $result->rowCount();//переменная numRows равна result с отсылающеся на количество строк
				if ($numRows==1) {//проверка если переменная numRows равна 1цы
					$row=$result->fetch();//переменная row равна result поделленная
					$film=new Film($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);//в переменную film заносят с классом Film строки
				}
			}
		}
        $this->connectDB=null;//отключение от базы данной
	    return $film;//возращает переменную film
	}

    public function getAllFilmsInfo()//функция которая получает информацию о фильме
	{
		$films=array();//переменная films равна массиву
		if ($this->connect()) {//проверка на подключение к базе данной
			if ($result = $this->connectDB->query('SELECT * FROM film_info')) {//проверка result равна запросу на получение всей информации с таблицы film_info
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);//переменная rows равна result которая вызывает метод деление на строки
                foreach($rows as $row){//цикл прорабатывает все строки и помечает как row
					$actors=array();//переменная actors равна массив
					foreach (explode(";",$row['actors']) as $item) {//цикл делит actors на строки и помечает как item 
					   $actor=explode(",",$item);//переменная actor делится на item, делитель ","
					   $actors[]=new Actor($actor[0], $actor[1],$actor[2]);//в массив actors заносится данные актера в класс Actor
					}
					$categories=array();//переменная categories равна массиву
					foreach (explode(";",$row['categories']) as $item) {//цикл строки categories делит на item, делител ";"
					   $category=explode(",",$item);//переменная category делиться на item, делитель ","
					   $categories[]=new Category($category[0], $category[1]);//массив categories заполняется данными с переменной category в класс Category
					}
					$item=explode(',',$row['language']);//переменная item делаться на строки language
					$language=new Language($item[0], $item[1]);//переменная language заполняется item в класс Language
					$films[]=new FilmInfo($row['id'], $row['title'], $row['description'], 
										$row['year'],  $row=['length'], $actors, $categories, $language);//массив films заполняется данными в класс FilmInfo		
                 } 				
			}
		    $this->connectDB=null;//закрывает подключение к базе данной
		}
		return $films;//возращает переменную films
	}
	

	public function getAllCategories()
	{	
		$categories=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->query('SELECT * FROM category')) {
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
					$categories[]=new Category($row['category_id'], $row['name']);
                 } 
			}
		}
        $this->connectDB=null;
		return $categories;
	}

	public function getAllActors()
	{	
		$actors=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->query('SELECT * FROM actor')) {
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
					$actors[]=new Actor($row['actor_id'], $row['firstname'], $row['lastname']);
                 } 
			}
		}
        $this->connectDB=null;
		return $actors;
	}

}

