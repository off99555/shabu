<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 27-May-16
 * Time: 04:57
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["employee_id"];
    setcookie("employee_id", $id, time() + 10 * 60); // 10 minutes
}
header("Location: .");
