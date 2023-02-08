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

	<div class="wrapper main" id="choice">
		<div class="storages">
			<div class="storage" data-group="1">
				<div class="storage__img">
					<img src="img/1.png" alt="">
				</div>
				<div class="storage__text">
					Продовольстенные <br> товары
				</div>
			</div>
			<div class="storage" data-group="2">
				<div class="storage__img">
					<img src="img/2.png" alt="">
				</div>
				<div class="storage__text">
					Промышленные <br> товары
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper container-fluid" id="show" style="display: none;">
		<div class="table__info">
			<div class="table__storage">
				Склад №1 “Первый”
			</div>
			<div class="table__name">
				Промышленные товары
			</div>
		</div>
		<div class="table-all">
			<table class="table table-bordered table-striped" style="width:100%" id="table">
				
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
	<script>
		$(function () {
			for (let item of $('.storage')) {
				$(item).on('click', function () {
					let id = $(this).data("group");
					showTable(id);
					$('#choice').slideToggle(500, 'linear');
					$('#show').slideToggle(750);
				})
			}
		})

		function showTable(id) {
			$.ajax({
				type: 'POST',
				url: 'getTable.php',
				data: { id: id}
			}).then(function (res) {
				$('#table').html(res);
			})
		}
	</script>
</body>

</html>