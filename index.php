<!DOCTYPE html>
<html lang="ru">

<head>
	<title>try</title>

	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="lib/bootstap/dist/css/bootstap.min.css" >
	<link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/theme.css">
</head>

<body>
	<?php
	include "db.php";
	?>

	<nav class="con navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid ">
			<a class="navbar-brand" href="#">Белкоопсоюз</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
				aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="showChoice()">Выбрать таблицу
							<span class="visually-hidden">(current)</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="wrapper main" id="choice">
		<div class="storages">
			<?php
			$query = "SELECT `storage`.`id`,`storage`.`type`,`storage`.`img` FROM `storage`";
			if ($result = mysqli_query($link, $query)) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<div class='storage' data-group='{$row['id']}'>
						<div class='storage__img'>
							<img src='img/{$row['img']}' alt='{$row['type']}'>
						</div>
						<div class='storage__text'>
							{$row['type']}
						</div>
					</div>";
				}
			}
			?>
		</div>
	</div>

	<div class="wrapper container-fluid" id="show" style="display: none;">
		<div class="table__info" id="tableInfo">
			<div class="table__storage" id="storageName">
				Склад №1
			</div>
			<div class="table__name" id="storageType">
				Товары
			</div>
			<div class="text-end">
				<a href="create.php" class="btn btn-primary">
					<i class="bi bi-plus-circle"></i> &nbsp; Добавить товар
				</a>
			</div>
		</div>
		<div class="table-all">
			<table class="table table-bordered table-striped" style="width:100%" id="table">

			</table>
		</div>
	</div>

	<script src="lib/jquery/dist/jquery.js"></script>
	<script src="lib/jquery/dist/jquery-ui.js"></script>
	<script src="lib/bootstap/dist/js/bootstap.bundle.min.js"></script>
	
	<script>
		//choose storage
		$(function () {
			for (let item of $('.storage')) {
				$(item).on('click', function () {
					let id = $(this).data("group");
					tableInfo(id);
					showTable(id);
					$('#choice').slideToggle(500, 'linear');
					$('#show').slideToggle(750);
				})
			}
		})

		//get products of chosen storage
		function showTable(id) {
			$.ajax({
				type: 'POST',
				url: 'getTable.php',
				data: {
					id: id
				}
			}).then(function (res) {
				$('#table').html(res);
			});
		}

		//get information about chosen storage
		function tableInfo(id) {
			$.ajax({
				type: 'POST',
				url: 'getTableInfo.php',
				data: {
					id: id
				}
			}).then(function (res) {
				let data = JSON.parse(res);
				$('#storageName').html(data['name']);
				$('#storageType').html(data['type']);
			});
		}

		//show storages
		function showChoice() {
			if ($('#choice').is(':hidden')) {
				$('#choice').slideToggle(500, 'linear');
				$('#show').hide(750);
			}
		}
	</script>
</body>

</html>