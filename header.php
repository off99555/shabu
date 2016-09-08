<div style="text-align: center;">
    <h1>
        <a href="/shabu" title="คลิกเพื่อไปหน้าแรก" class="#">Shabu Manager</a><br>
        (ระบบจัดการร้านอาหารชาบูชิสุดเทพ) <br>
        Version 0.3.1 Alpha
    </h1>
</div>
<div style="text-align: right">
    <form action="/shabu/authorize.php" method="post">

        <label for="employee_id">Who are you? </label>
        <select name="employee_id" class="employee_id">
            <option value=""></option>
            <?php
            $sql = "SELECT EMPLOYEE_ID, EMPLOYEE_FNAME, EMPLOYEE_LNAME, EMPLOYEE_WORKING, EMPLOYEE_RANK
                    FROM employee ORDER BY EMPLOYEE_WORKING";
            $result = $conn->query($sql);
            if (isset($_COOKIE["employee_id"])) {
                $id = $_COOKIE["employee_id"];
            }
            while ($row = $result->fetch_row()) {
                $title = $disabled = $selected = "";
                if ($row[0] == $id) {
                    $selected = "selected";
                    $fname = $row[1];
                    $lname = $row[2];
                    $rank = $row[4];
                }
                if ($row[3] === "ลาออก") {
                    $disabled = "disabled";
                    $title = "พวกลาออกไปแล้วก็อยู่ล่างๆอย่างงี้แหละ";
                }
                echo "<option value=\"$row[0]\" $selected $disabled title='$title $row[4]'>$row[0] - $row[1] $row[2]</option>";
            }
            ?>
        </select>
        <button type="submit" title="ยืนยันตัวตนเก็บใส่ Cookie ไว้เป็นเวลา 10 นาที">Authorize</button>
        <br>
        <?php
        if (isset($id)) {
            echo "พนักงานปัจจุบัน คือ $fname $lname มีตำแหน่งเป็น $rank";
        }
        ?>
    </form>
</div>
<hr>
