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
        <a class="nav-link" href="#">Фильмы<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="actors.php">Актеры</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php 
        $db=new PDOService();
        $cate=$db->getCategoryByID($_GET['catid']);
        if (!is_null($cate)) {
          echo $cate->name;
        }
        else {
          echo "Категория";
        } ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php  
   
		  foreach ($db->getAllCategories() as $category){
				echo '<a class="dropdown-item" href="category.php?catid='.$category->id.'">'.$category->name.'</a>';
		  }?>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container" style="padding-top:20px; padding-bottom:50px;">
  <div class="row">
    <div class="col-sm">
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
    <?php 
    foreach((object) $db->getFilmByCategory($_GET['catid']) as $catfilm){
      if (!is_null($catfilm)){?>
    <div class="col-sm"style="padding-bottom:15px;">
    <div class="card" style="width: 20rem;">
  <div class="card-body alert-secondary">
    <h4 class="card-title"><?php echo $catfilm->title; ?></h4>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $catfilm->releaseYear; ?></h6>
    <p class="card-text"><?php echo 'Описание: '.$catfilm->description; ?></p>
    <p class="card-text"><?php echo 'Длинна фильма: '.$catfilm->length.' ч.'; ?></p>
  </div>
</div>
    </div>
    <?php 
    }
    else {
      echo '<h1>Нету фильмов в этой категории</h1>';
    }
   } ?>
    </div>
  </div>
    </body>
	<footer><div class="fixed-bottom p-3 bg-info text-white">Artur Shabunov 2017</div></footer>
</html>