<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Data Penjualan</title>
</head>
<body>
    <h2>Sistem Pencatatan Data Penjualan</h2>

    <form method="POST" action="">
        <label for="name">Nama Produk:</label>
        <input type="text" name="name" required><br><br>

        <label for="price">Harga Per Produk:</label>
        <input type="number" name="price" required><br><br>

        <label for="quantity">Jumlah Terjual:</label>
        <input type="number" name="quantity" required><br><br>

        <button type="submit" name="submit">Tambah Data Penjualan</button>
    </form>

    <?php
    // Initialize the sales array in session
    session_start();
    if (!isset($_SESSION['sales'])) {
        $_SESSION['sales'] = [];
    }

    // Add new sale data to the session array
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $total = $price * $quantity;

        $_SESSION['sales'][] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $total
        ];
    }

    // Display sales report if there are sales records
    if (!empty($_SESSION['sales'])) {
        echo "<h3>Laporan Penjualan:</h3>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr><th>Nama</th><th>Harga Per Produk</th><th>Jumlah Terjual</th><th>Total</th></tr>";

        $grandTotalQuantity = 0;
        $grandTotalSales = 0;

        foreach ($_SESSION['sales'] as $sale) {
            echo "<tr>";
            echo "<td>{$sale['name']}</td>";
            echo "<td>{$sale['price']}</td>";
            echo "<td>{$sale['quantity']}</td>";
            echo "<td>{$sale['total']}</td>";
            echo "</tr>";

            $grandTotalQuantity += $sale['quantity'];
            $grandTotalSales += $sale['total'];
        }

        echo "<tr><td colspan='2'>Total Penjualan</td><td>$grandTotalQuantity</td><td>$grandTotalSales</td></tr>";
        echo "</table>";
    }
    ?>
</body>
</html>