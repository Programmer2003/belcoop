<!DOCTYPE html>
<html lang="ru">

<head>
	<title>try</title>

	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/theme.css">
</head>

<body>
	<?php
	include "db.php";
	?>

	<nav class="con navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Белкоопсоюз</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
				aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">Главная
							<span class="visually-hidden">(current)</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!--div class="wrapper main">
		<div class="storages">
			<div class="storage">
				<div class="storage__img">
					<img src="img/1.png" alt="">
				</div>
				<div class="storage__text">
					Продовольстенные <br> товары
				</div>
			</div>
			<div class="storage">
				<div class="storage__img">
					<img src="img/2.png" alt="">
				</div>
				<div class="storage__text">
					Промышленные <br> товары
				</div>
			</div>
		</div>
	</div-->

	<div class="wrapper container-fluid">
		<div class="table__info">
			<div class="table__storage">
				Склад №1 “Первый”
			</div>
			<div class="table__name">
				Промышленные товары
			</div>
		</div>
		<div class="table-all">
			<table class="table table-bordered table-striped" style="width:100%">
				<thead>
					<tr>
						<th>
							Название
						</th>
						<th>
							Цена
						</th>
						<th>
							Группа
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = 'SELECT `product`.`id`,`product`.`name`,`product`.`price`, `category`.`name` as `cateogry` FROM `product` LEFT JOIN `category` ON `product`.`category` = `category`.`id`';
					if ($result = mysqli_query($link, $query)) {
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo 	"<td style='display: none'>" . $row["id"] . "</td>";
							echo	"<td scope='row'>" . $row["name"] . "</th>";
							echo	"<td>" . $row["price"] . "</td>";
							echo	"<td>" . $row["cateogry"] . "</td>";
							echo "<td>
							<div class='w-75 btn-group' role='group'>
								<a href='edit.php?id="  . $row["id"] . "' class='btn btn-primary mx-2'><i class='bi bi-pencil-square'></i> Edit</a>
								<a href='delete.php?id="  . $row["id"] . "' class='btn btn-danger mx-2'><i class='bi bi-trash-fill'></i> Delete</a>
							</div>
							</td>";
							echo "</tr>";
						}
					}
					mysqli_free_result($result);
					?>
					<tr>
						<td width="40%">
							Йогурт 3%
						</td>
						<td width="20%">
							12.45
						</td>
						<td width="25%">
							Молочные
						</td>
						<td>
							<div class="w-75 btn-group" role="group">
								<a class="btn btn-primary mx-2"> <i class="bi bi-pencil-square"></i> Edit</a>
								<a class="btn btn-danger mx-2"> <i class="bi bi-trash-fill"></i> Delete</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.js"
		integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
		integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
</body>

</html>