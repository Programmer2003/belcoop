<!DOCTYPE html>
<html lang="ru">

<head>
    <title>try</title>

    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/theme.css">
</head>

<body>
    <?php
    include "db.php";
    session_start();
    if(isset($_SESSION['group'])){
        $group = $_SESSION['group'];
    }
    else{
        $group = 1;
    }
    $id = $_GET['id'];
    $q = "SELECT `product`.*,`category`.`id` as `category` FROM `product` LEFT JOIN `category` ON `product`.`category` = `category`.`id`  where `product`.`id` = '{$id}'";

    $obj = mysqli_query($link, $q)->fetch_assoc();
    ?>
    <div class="container">
        <form class="needs-validation" id="editForm" method="post" action="editPost.php" novalidate>
            <input name="id" type="hidden" value="<?php echo $_GET["id"]; ?>">
            <div class="border p-3 mt-4">
                <div class="row pb-2">
                    <h2 class="text-primary">Редактирование товара</h2>
                    <hr />
                </div>
                <div class="mb-3">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" class="form-control" 
                    value="<?php echo $obj["name"]; ?>" required/>
                    <div class="invalid-feedback">
                        Введите название.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="price">Цена</label>
                    <input type="number" min="0.1" step="any" id="price" name="price" class="form-control"
                        value="<?php echo $obj["price"]; ?>" required/>
                    <div class="invalid-feedback">
                        Цена должна быть от 10 копеек.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleSelect1" class="form-label">Группа</label>
                    <select class="form-select" name="category">
                        <?php
                            $query = "SELECT id,name FROM category WHERE `category`.`storage`='{$group}'";
                            if ($result = mysqli_query($link, $query)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option " . ($row['id']==$obj['category']?'selected':'')  . " value=" . $row["id"] . ">" . $row["name"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:150px">
                    Обновить
                </button>
                <a href="index.php" class="btn btn-secondary" style="width:150px">
                    Вернуться назад
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"
        integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        $(function () {
            $('#editForm').on('submit', function (e) {
                e.preventDefault();

                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                this.classList.add('was-validated');

                $.ajax({
                    type: 'POST',
                    url: 'editPost.php',
                    data: $(this).serialize()
                }).then(function (res) {
                    let data = JSON.parse(res);
                    console.log(data);
                    if (data.error) {
                        console.log('error during execution');
                        toastr.error('Ошибка во время выполнения');
                    }
                    else {
                        toastr.success('Запись успешно обновлена');
                    }
                })
            })
        })
    </script>

    <script>
            (function () {
                'use strict'

                var forms = document.querySelectorAll('.needs-validation')

                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
    </script>
</body>

</html>