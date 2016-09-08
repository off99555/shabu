<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 27-May-16
 * Time: 08:05
 */
require "../connect_db.php";

$sql = "INSERT INTO ORDERING (MATERIAL_ID, SUPPLIER_ID, EMPLOYEE_ID, ORDER_AMOUNT, ORDER_COST)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiidd", $_POST['material_id'], $_POST['supplier_id'], $_POST['employee_id'], $_POST['order_amount'], $_POST['order_cost']);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    header("Location: /shabu");
}
$stmt->close();
