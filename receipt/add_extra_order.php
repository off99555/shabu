<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 13:08
 */
require "../connect_db.php";
$menu_id = $_POST['menu_id'];
$sql = "SELECT MENU_PRICE FROM EXTRA_MENU WHERE MENU_ID = '$menu_id'";
$menu_price = $conn->query($sql)->fetch_row()[0];


$sql = "INSERT INTO EXTRA_ORDERING (RECEIPT_ID, MENU_ID, ORDER_AMOUNT, ORDER_PRICE)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$total_price = $_POST['order_amount'] * $menu_price;
$receipt_id = $_POST['receipt_id'];
$stmt->bind_param("isii", $receipt_id, $menu_id, $_POST['order_amount'], $total_price);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    $sql = "UPDATE RECEIPT
            SET TOTAL_PRICE = TOTAL_PRICE + $total_price
            WHERE RECEIPT_ID = $receipt_id";
    $conn->query($sql);
    header("Location: /shabu/?receipt_id=$stmt->insert_id#tab-6");
}
$stmt->close();
