<?php require_once "autoloader.php";//подкгружаем php файл в котором происходит
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Дом </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="films.php">Фильмы</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Актеры<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Категории
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php  
      $db=new PDOService();
		  foreach ($db->getAllCategories() as $category){
				echo '<a class="dropdown-item" href="category.php?catid='.$category->id.'">'.$category->name.'</a>';
		  }?>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container" style="padding-top:20px; padding-bottom:20px;">
  <div class="row">
    <div class="col-8 col-md-4">
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
    <div class="col-12 col-md-8"  style="padding-top:30px;">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Фильмы</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $numbers=1;
     foreach($db->getAllActors() as $actors) {?>
    <tr>
      <th scope="row"><?php echo $numbers++;  ?></th>
      <td><?php echo $actors->firstname;?></td>
      <td><?php echo $actors->lastname;?></td>

      <td><div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Подробнее
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <?php foreach((object) $db->getFilmByActor($actors->id) as $filmact){?>
          <a class="dropdown-item" href="films.php"><?php   echo $filmact->title; ?></a>
        <?php } ?>
    </div></td>
  </div>
    </tr>
    <?php }?>
  </tbody>
</table>
    </div>
  </div>
    </body>
	<footer><div class="fixed-bottom p-3 bg-info text-white">Artur Shabunov 2017</div></footer>
</html>