<?php

function lineTotal(array $product): int
{
    return $product['price'] * $product['qty'];
}

function inventoryValue(array $products): int
{
    $sum = 0;

    foreach ($products as $product) {
        $sum += lineTotal($product);
    }

    return $sum;
}

function findProductBySku(array $products, string $sku): ?array
{
    foreach ($products as $product) {
        if ($product['sku'] == $sku) {
            return $product;
        }
    }

    return null;
}

function countByCategory(array $products, int $categoryId): int
{
    $count = 0;

    foreach ($products as $product) {
        if ($product['category_id'] == $categoryId) {
            $count++;
        }
    }

    return $count;
}

function stockLevel(array $product): string
{
    if ($product['qty'] >= 5) {
        return "Du";
    } elseif ($product['qty'] >= 2) {
        return "Sap het";
    } else {
        return "Can nhap";
    }
}

function filterByCategory(array $products, ?int $categoryId): array
{
    if ($categoryId == null) {
        return $products;
    }

    $result = [];

    foreach ($products as $product) {
        if ($product['category_id'] == $categoryId) {
            $result[] = $product;
        }
    }

    return $result;
}

function rankInventory(int $totalValue): string
{
    if ($totalValue < 15000000) {
        return "Nho";
    } elseif ($totalValue < 35000000) {
        return "Trung binh";
    }

    return "Lon";
}

function renderProductRows(array $products, array $categories): void
{
    foreach ($products as $product) {

        $categoryName = "";

        foreach ($categories as $category) {
            if ($category['id'] == $product['category_id']) {
                $categoryName = $category['name'];
                break;
            }
        }

        echo "<tr>";
        echo "<td>{$product['sku']}</td>";
        echo "<td>{$product['name']}</td>";
        echo "<td>{$categoryName}</td>";
        echo "<td>{$product['price']}</td>";
        echo "<td>{$product['qty']}</td>";
        echo "<td>" . lineTotal($product) . "</td>";
        echo "<td>" . stockLevel($product) . "</td>";
        echo "</tr>";
    }
}