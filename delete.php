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
    <link rel="stylesheet" href="lib/toastr/dist/css/toastr.min.css" >
</head>


<body>
    <?php
    session_start();
    include "db.php";

    if (!isset($_GET['id']) || is_null($_GET['id'])) {
        http_response_code(404);
        include('404.php'); 
        die();
    }

    $id = $_GET['id'];
    $count = "SELECT `product`.`id`  FROM `product` 
              WHERE `product`.`id` = '{$id}'";
    if (mysqli_query($link, $count)->num_rows == 0) {
        http_response_code(404);
        include('404.php');
        die();
    }

    $q = "SELECT `product`.*,`category`.`id` AS `category` 
          FROM `product` LEFT JOIN `category` 
          ON `product`.`category` = `category`.`id`  
          WHERE `product`.`id` = '{$id}'";
    
    $obj = mysqli_query($link, $q)->fetch_assoc();
    ?>
    <div class="container">
        <form class="needs-validation" id="deleteForm" method="post" action="deletePost.php">
            <input name="id" id="recordId" type="hidden" value="<?php echo $_GET["id"]; ?>">
            <div class="border p-3 mt-4">
                <div class="row pb-2">
                    <h2 class="text-primary">Удаление товара</h2>
                    <hr />
                </div>
                <div class="mb-3">
                    <label for="name">Название</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $obj["name"]; ?>" disabled />
                </div>
                <div class="mb-3">
                    <label for="price">Цена</label>
                    <input type="number" min="0.1" step="any" id="price" class="form-control" value="<?php echo $obj["price"]; ?>" disabled />
                </div>
                <div class="mb-3">
                    <label for="exampleSelect1" class="form-label">Группа</label>
                    <select class="form-select" disabled>
                        <?php
                        $query = "SELECT `category`.`id`,`category`.`name` FROM `category`";
                        if ($result = mysqli_query($link, $query)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option " . ($row['id'] == $obj['category'] ? 'selected' : '')  . " value=" . $row["id"] . ">" . $row["name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button id="button" data-deleted="0" type="submit" class="btn btn-danger" style="width:150px">
                    Удалить 
                </button>
                <a href="index.php" class="btn btn-secondary" style="width:150px">
                    Вернуться назад
                </a>
            </div>
        </form>
    </div>

    <script src="lib/jquery/dist/jquery.js"></script>
	<script src="lib/jquery/dist/jquery-ui.js"></script>
	<script src="lib/bootstap/dist/js/bootstap.bundle.min.js"></script>

    <script src="lib/toastr/dist/js/toastr.min.js"></script>

    <script>
        $(function() {
            //form validation and product delete/recover
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                //check if we want to delete element or restore
                if($('#button').data("deleted")===0){
                    $.ajax({
                        type: 'POST',
                        url: 'deletePost.php',
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(res) {
                            console.log(res['code']);
                            toastr.success('Запись удалена');
                            $('#button').data("deleted",1);
                            $('#button').text("Восстановить");
                        },
                        error: function(data){
                            console.log('error during execution');
                            toastr.error('Ошибка во время выполнения');
                        }
                    });
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: 'recoverPost.php',
                        data: {},
                        dataType: "json",
                        success: function(res) {
                            console.log(res['code']);
                            toastr.info('Запись восстановлена');
                            history.pushState("delete","delete",`delete.php?id=${res['id']}`)
                            $('#recordId').val(res['id']);
                            $('#button').data("deleted",0);
                            $('#button').text("Удалить");
                        },
                        error: function(data){
                            console.log(data);
                            console.log('error during execution');
                            toastr.error('Ошибка во время выполнения');
                        }
                    });
                }
                
            })
        })
    </script>

    <script src="js/form-validation.js"></script>
</body>

</html>