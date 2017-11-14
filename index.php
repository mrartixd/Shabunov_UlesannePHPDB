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
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
        <title>Shabunov Ulesanne PHP DB</title>
    </head>
    <body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Shabunov Ulesanne PHP DB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Дом <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="films.php">Фильмы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="actors.php">Актеры</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Категории
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php  
      $db=new PDOService();
		  foreach ($db->getAllCategories() as $category){
				echo '<a class="dropdown-item" href="'.$category->id.'">'.$category->name.'</a>';
		  }?>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container" style="padding-top:20px; padding-bottom:20px;">
  <div class="row">
    <div class="col-4">
	<div class="card" style="width: 20rem;">
  <div class="card-header">
    Задание
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Комментарий к  программному коду Пример. MoviesDB</li>
    <li class="list-group-item">Создайте меню - (Категория) (5 стр.) - добавьте функцию getAllCategories в класс. </li>
    <li class="list-group-item">Отобразите список фильмов в выбранной категории</li>
	<li class="list-group-item">Создайте страницу Актеры (данные в порядке возрастания по отсортированной фамилии). Отобразить список фильмов выбранного актера</li>
	<li class="list-group-item">Использовать css-frameworks: Bootstrap</li>
  </ul>
</div>
    </div>
    <div class="col-8">
	<div class="jumbotron">
  <h1 class="display-3">Добро пожаловать!</h1>
  <p class="lead">Сайт посвещен фильмам и его актерам</p>
  <hr class="my-4">
  <p>Здесь вы можете найти актеров, фильмы, категории любимых фильмов</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="films.php" role="button">Фильмы</a>
	<a class="btn btn-primary btn-lg" href="actors.php" role="button">Актеры</a>
  </p>
</div>
    </div>
  </div>
    </body>
	<footer><div class="fixed-bottom p-3 bg-info text-white">Artur Shabunov 2017</div></footer>
</html>
