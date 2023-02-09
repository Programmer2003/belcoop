<!DOCTYPE html>
<html lang="ru">

<head>
    <title>try</title>

    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="lib/bootstap/dist/css/bootstap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="lib/toastr/dist/css/toastr.min.css">
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
    ?>
    <nav class="con navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Белкоопсоюз</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            Выбрать таблицу
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <form class="needs-validation" id="editForm" method="post" action="insertPost.php" novalidate>
            <div class="border p-3 mt-4">
                <div class="row pb-2">
                    <h2 class="text-primary">Добавление товара</h2>
                    <hr />
                </div>
                <div class="mb-3">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" class="form-control" required />
                    <div class="invalid-feedback">
                        Введите название.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="price">Цена</label>
                    <input type="number" min="0.1" step="any" id="price" name="price" class="form-control" required />
                    <div class="invalid-feedback">
                        Цена должна быть от 10 копеек.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleSelect1" class="form-label">Группа</label>
                    <select class="form-select" name="category">
                        <?php
                            $query = "SELECT `category`.`id`,`category`.`name` FROM `category`
                                      WHERE `category`.`storage`='{$group}'";
                            if ($result = mysqli_query($link, $query)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option selected value=" . $row["id"] . ">" . $row["name"] . "</option>";
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

    <script src="lib/jquery/dist/jquery.js"></script>
    <script src="lib/jquery/dist/jquery-ui.js"></script>
    <script src="lib/bootstap/dist/js/bootstap.bundle.min.js"></script>

    <script src="lib/toastr/dist/js/toastr.min.js"></script>

    <script>
        //form validation and product insert
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
                    url: 'insertPost.php',
                    data: $(this).serialize()
                }).then(function (data) {
                    console.log(data);
                    if (data.error) {
                        console.log('error during execution');
                        toastr.error('Ошибка во время выполнения');
                    }
                    else {
                        toastr.success('Запись добавлена');
                    }
                })
            })
        })
    </script>

    <script src="js/form-validation.js"></script>
</body>

</html>