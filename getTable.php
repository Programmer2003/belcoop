<?php
include 'db.php';
$group = $_POST['id'];
session_start();
$_SESSION['group'] = $group;
echo "<thead>
	    <tr>
		    <th width='40%'>
			    Название
			</th>
			<th width='20%'>
			    Цена
			</th>
			<th width='25%'>
			    Группа
			</th>
			<th></th>
		</tr>
	</thead>
	<tbody>";
$query = "SELECT `product`.`id`,`product`.`name`,`product`.`price`, `category`.`name` as `cateogry` FROM `product` LEFT JOIN `category` ON `product`.`category` = `category`.`id` WHERE `category`.`storage`='{$group}' ORDER BY `product`.`id`";
if ($result = mysqli_query($link, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo     "<td style='display: none'>" . $row["id"] . "</td>";
        echo    "<td >" . $row["name"] . "</th>";
        echo    "<td>" . $row["price"] . "</td>";
        echo    "<td>" . $row["cateogry"] . "</td>";
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

echo "</tbody>";

