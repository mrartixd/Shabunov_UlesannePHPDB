<?php
/* Здесь происходит подключение базы данной и функции с SQL запросами на основе MySQL  */

class MySQLiService implements IServiceDB
{	
	private $connectDB;//переменная connectDB
	
	public function connect() {	//функция подключение сайта к базе данной
		$this->connectDB = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);// доабвление в переменную значение mysqli
		$this->connectDB->set_charset(DB_CHARSET);// установка кодировки для чтение базы данной
		if (mysqli_connect_errno()) {//проверка есть ли подключение к хосту
			printf("Connection failed: %s", mysqli_connect_error());//печатет что нет подключенния и код ошибки
			exit();
		}
		return true;
	}
	
	public function getAllFilms()//функция на запрос SQL для получения список всех фильмов
	{	
		$films=array();//переменная films массив
		if ($this->connect()) {//проверка на подключение к хосту
			if ($result = mysqli_query($this->connectDB, 'SELECT * FROM film')) {//проверка переменной result на SQL запрос
				while ($row = mysqli_fetch_assoc($result)) {//цикл в котором resultat делят на строки (row)
					$films[]=new Film($row['film_id'], $row['title'], $row['description'],// массив films заполняется строкми (row)
										$row['release_year'],  $row=['length']);
                 } 
				 mysqli_free_result($result);//очищает память, занятой результатоми запроса
			}
		    mysqli_close($this->connectDB);	//закрывает подключение к хосту
		}
		return $films;//возращает переменную films
	}
	
	public function getFilmByID($id)// функция получает фильм по его ID
	{	
		$film=null;//переменная фильм со значением null
		if ($this->connect()) {//проверка на подключение к хосту
			if ($query = mysqli_prepare($this->connectDB, 'SELECT * FROM film WHERE film_id=?')) {//проверка переменной query к подготовки SQL выражение к выполнению
				$query->bind_param("i", $id); //"i" - $id is integer привязка параметра i как переменная id
				$query->execute();//запускает query на выполнение
				$result = $query->get_result();//переменная result равна переменной query с полученным результатом
				$numRows = $result->num_rows;//переменная numRows равна переменной result с полученной переменной num_rows
				if ($numRows==1) {//проверка равен ли numRows 1цы
					$row=$result->fetch_array(MYSQLI_NUM);//переменная row равна result (MYSQLI_NUM поделена на строки) 
					$film=new Film($row[0], $row[1], $row[2], $row[3], $row[5]);//переменная film заполняется строками (row)
				}
				$query->close();//переменная query закрывается
			}
		    mysqli_close($this->connectDB);//закрывает подключение к хосту (Базе Данным)
		}
	    return $film;//возращает переменную film
	}

	public function getAllFilmsInfo()//функция получить информацию о фильме
	{
		$films=array();//переменная фильмы массив
		if ($this->connect()) {//если есть подключение
			if ($result = mysqli_query($this->connectDB, 'SELECT * FROM film_info')) {//переменная result равна SQL запросу на информацию о фильмах
				while ($row = mysqli_fetch_assoc($result)) {//цикл заносит result в row пока не закончаться
					$actors=array();//переменная actors массив
					foreach (explode(";",$row['actors']) as $item) {//цикл прорабатывает строки row разбивая их с помощью ";" и помечая как переменной item
					   $actor=explode(",",$item);//переменная actor разбивает строку с помощью ","
					   $actors[]=new Actor($actor[0], $actor[1],$actor[2]);//массив actors заносит данные через класс Actor 
					}
					$categories=array();//переменная categories массив
					foreach (explode(";",$row['categories']) as $item) {//цикл прорабатывает строки row разбивая их с помощью ";" и помеает как переменной item
					   $category=explode(",",$item);//переменная category разбивает строку с помощью ","
					   $categories[]=new Category($category[0], $category[1]);//массив categories заносит данные через класс Category 
					}
					$item=explode(',',$row['language']);//переменная item разбивает строку с помощью ","
					$language=new Language($item[0], $item[1]);//в переменную language заносяться данные с класса Language
					$films[]=new FilmInfo($row['id'], $row['title'], $row['description'], //массив films заносяться данные с класса FilmInfo
										$row['year'],  $row=['length'], $actors, $categories, $language);
					
                 } 
				 mysqli_free_result($result);//очищает память, занятой результатоми запроса
			}
		    mysqli_close($this->connectDB);//закрывает подключение к хосту
		}
		return $films;//возращает переменную films
	}

}

