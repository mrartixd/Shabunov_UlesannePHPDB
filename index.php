<?php
/*Artur Shabunov RDIR 51
1. Комментарии по‎‎ программе в ‎‎пример кода. MoviesDB ‎‎(15 p.).‎
‎2. Создайте menu-(Category) (5 стр.)-пожалуйста, добавьте функцию getAllCategories к классу. ‎
‎3. список фильмов, отобранных в представлении по категориям (5 стр.)‎
‎4. в окне Создание страницы из актеров (данные сортируются в порядке возрастания по фамилии). Отобразить список фильмов, отобранных актер (5 стр.)‎
‎Используйте внешний CSS рамок (например, загрузки,...)‎
*/

require_once "autoloader.php";//подкгружаем php файл в котором происходит
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
			///$db=new MySQLiService();
			$db=new PDOService();
			foreach ($db->getAllFilms() as $film) {
				echo $film->id." ".$film->title."<br />";
			}
			$film=$db->getFilmByID(3);
			if (!is_null($film)) {
				echo "Film found: ".$film->title."<br />";
			}
			else {
				echo "Not found"."<br />";
			}
			echo "<pre>";
			$films=$db->getAllFilmsInfo();
			// foreach ($films as $film) {
			// 	var_dump($film);
			// }
			echo "</pre>";
        ?>
    </body>
</html>
