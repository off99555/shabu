<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 13:08
 */
require "../connect_db.php";
$sql = "INSERT INTO RECEIPT (EMPLOYEE_ID, MEMBERCARD_ID, RECEIPT_PAYTYPE, LEFTOVER_FINE)
        VALUES (?, ?, ?, ?)";
if ($_POST['membercard_id'] === '') {
    $_POST['membercard_id'] = null;
}
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisi", $_POST['employee_id'], $_POST['membercard_id'], $_POST['receipt_paytype'], $_POST['leftover_fine']);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    header("Location: /shabu/?receipt_id=$stmt->insert_id#tab-6");
}
$stmt->close();
