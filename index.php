<?php

require_once "data.php";
require_once "helpers.php";

// Lấy category_id từ URL (nếu có)
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

// Lọc sản phẩm
$list = filterByCategory($products, $categoryId);

// Tổng giá trị kho
$total = inventoryValue($products);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Mini Shop 02</title>
</head>

<body>

    <h1>MINI SHOP 02</h1>

    <h3>Danh sách sản phẩm</h3>

    <a href="index.php">Tất cả</a> |
    <a href="?category_id=1">Bàn phím</a> |
    <a href="?category_id=2">Chuột</a> |
    <a href="?category_id=3">Màn hình</a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>SKU</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Mức tồn</th>
        </tr>

        <?php renderProductRows($list, $categories); ?>

    </table>

    <br>

    <h3>Tổng giá trị kho: <?php echo number_format($total); ?> VNĐ</h3>

    <h3>Quy mô kho: <?php echo rankInventory($total); ?></h3>

    <hr>

    <h2>Báo cáo theo danh mục</h2>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>Danh mục</th>
            <th>Số SP</th>
            <th>Tổng giá trị</th>
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
            echo "<td>" . number_format($sum) . "</td>";
            echo "</tr>";

        }

        ?>

    </table>

    <br>

    <h3>Kiểm tra findProductBySku()</h3>

    <?php

    $p = findProductBySku($products, "MN-02");

    if ($p != null) {
        echo "Tên sản phẩm: " . $p['name'];
    }

    ?>

    <!-- MS_EXPECT inventory_value=41380000 rank=Lon -->

</body>

</html>