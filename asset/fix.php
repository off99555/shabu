<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 13:08
 */
$sql = "SELECT SUPPLIER_ID, SUPPLIER_NAME, SUPPLIER_PHONE
        FROM SUPPLIER";
$suppliers = $conn->query($sql);
$sql = "SELECT ASSET_ID, ASSET_NAME, ASSET_BROKEN
        FROM ASSET
        ORDER BY ASSET_BROKEN DESC";
$assets = $conn->query($sql);
?>

<h2>แจ้งซ่อมทรัพย์สิน (ที่พังแล้ว)</h2>
<form action="/shabu/asset/fix_submit.php" method="post">
    <label for="employee_id">รหัสพนักงาน:</label>
    <input type="text" name="employee_id" id="employee_id" title="พนักงานที่ล็อกอินอยู่เท่านั้น"
           value="<?php if (isset($_COOKIE['employee_id'])) echo $_COOKIE["employee_id"]; ?>" readonly><br>
    <label for="request_date">วันที่ส่งซ่อม:</label>
    <input type="text" id="request_date" value="<?php echo date('Y/m/d H:i'); ?>" disabled><br>

    <label for="supplier_id">ผู้ผลิต (ช่างซ่อม):</label>
    <select name="supplier_id" class="supplier_id" id="supplier_id">
        <option value=""></option>
        <?php
        while ($row = $suppliers->fetch_row()) {
            echo "<option value=\"$row[0]\" title='$row[2]'>$row[0] - $row[1]</option>";
        }
        ?>
    </select><br>

    <label for="asset_id">ทรัพย์สินที่จะซ่อม:</label>
    <select name="asset_id" id="asset_id" class="asset_id">
        <option value=""></option>
        <?php
        while ($row = $assets->fetch_row()) {
            $disabled = !$row[2] ? "disabled" : "";
            echo "<option value=\"$row[0]\" $disabled>$row[0] - $row[1]</option>";
        }
        ?>
    </select><br>
    <button type="submit">แจ้งซ่อม</button>
</form>

<h2>ยืนยันการซ่อม(ที่ได้แจ้งไป)ว่าช่างมาซ่อมแล้ว</h2>
<form action="/shabu/asset/fix_done.php" method="post">
    <label for="repair_id">รหัสการซ่อม:</label>
    <select name="repair_id" id="repair_id" class="repair_id">
        <option value=""></option>
        <?php
        $sql = "SELECT REPAIR_ID, REQUEST_DATE, ASSET_NAME
                FROM REPAIRING NATURAL JOIN ASSET
                WHERE REPAIR_DATE IS NULL";
        $rows = $conn->query($sql);
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\" title='แจ้งเมื่อวันที่ $row[1]'>$row[0] - $row[2]</option>";
        }
        ?>
    </select><br>

    <label for="repair_cost">ราคาซ่อม:</label>
    <input type="text" name="repair_cost" id="repair_cost"><br>

    <label for="repair_desc">คำอธิบายการซ่อม:</label>
    <input type="text" name="repair_desc" id="repair_desc" size="100" maxlength="200"><br>

    <label for="repair_date">วันที่ยืนยันว่าซ่อมแล้ว:</label>
    <input type="text" id="repair_date" value="<?php echo date('Y/m/d H:i'); ?>" disabled><br>
    <button type="submit">ซ่อมแล้ว</button>
</form>
