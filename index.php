<?php

require_once "data.php";
require_once "helpers.php";

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

$list = filterByCategory($products, $categoryId);

$total = inventoryValue($products);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mini Shop 02</title>
</head>

<body>

<h2>Danh sach san pham</h2>

<a href="index.php">Tat ca</a> |
<a href="?category_id=1">Ban phim</a> |
<a href="?category_id=2">Chuot</a> |
<a href="?category_id=3">Man hinh</a>

<br><br>

<table border="1" cellpadding="8">

<tr>
    <th>SKU</th>
    <th>Ten</th>
    <th>Danh muc</th>
    <th>Gia</th>
    <th>So luong</th>
    <th>Tong</th>
    <th>Muc ton</th>
</tr>

<?php renderProductRows($list, $categories); ?>

</table>

<h3>Tong gia tri kho: <?= $total ?></h3>

<h3>Quy mo kho: <?= rankInventory($total) ?></h3>

<hr>

<h2>Bao cao theo danh muc</h2>

<table border="1" cellpadding="8">

<tr>
    <th>Danh muc</th>
    <th>So SP</th>
    <th>Tong gia tri</th>
</tr>

<?php

foreach ($categories as $category) {

    $count = 0;
    $sum = 0;

    foreach ($products as $product) {

        if ($product['category_id'] == $category['id']) {

            $count++;

            $sum += lineTotal($product);

        }

    }

    echo "<tr>";
    echo "<td>{$category['name']}</td>";
    echo "<td>$count</td>";
    echo "<td>$sum</td>";
    echo "</tr>";

}

?>

</table>

<?php

$sp = findProductBySku($products, "MN-02");

echo "<h3>Checkpoint: ".$sp['name']."</h3>";

?>

<!-- MS_EXPECT inventory_value=41380000 rank=Lon -->

</body>
</html>