<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 11:44
 */
?>

<table border="1">
    <tr>
        <th><h2>วางแผนเวลาทำงานทีละชั่วโมง</h2></th>
        <th><h2>เวลาที่วางแผนไปแล้ว</h2></th>
    </tr>
    <tr>
        <td>
            <form action="/shabu/employee/plan_submit.php" method="post">

                <label for="employee_id">รหัสพนักงาน:</label>
                <input type="text" name="employee_id" id="employee_id" title="พนักงานที่ล็อกอินอยู่เท่านั้น"
                       value="<?php if (isset($_COOKIE['employee_id'])) echo $_COOKIE["employee_id"]; ?>" readonly><br>

                <label for="work_date">วันที่จะทำงาน:</label>
                <input type="text" name="work_date" id="work_date" class="datepicker"><br>

                <label for="hour_of_day">ชั่วโมง (กี่โมง):</label>
                <input type="text" name="hour_of_day" id="hour_of_day" class="hour_of_day"><br>
                <button type="submit">บันทึก</button>
            </form>
        </td>
        <td>
            <?php
            if (isset($_COOKIE['employee_id'])) {
                $emp_id = $_COOKIE['employee_id'];
                print_table('planned_work_hour', 'none', array('รหัสพนักงาน', 'วันที่', 'ชั่วโมงที่'), '*', 0, "WHERE EMPLOYEE_ID = $emp_id");
            }
            ?>
        </td>
    </tr>
</table>

<table border="1">
    <tr>
        <th><h2>บันทึกเวลาที่ทำงานแล้วทีละชั่วโมง</h2></th>
        <th><h2>เวลาที่ทำงานไปแล้ว</h2></th>
    </tr>
    <tr>
        <td>
            <form action="/shabu/employee/work_submit.php" method="post">
                <label for="employee_id">รหัสพนักงาน:</label>
                <input type="text" name="employee_id" id="employee_id" title="พนักงานที่ล็อกอินอยู่เท่านั้น"
                       value="<?php if (isset($_COOKIE['employee_id'])) echo $_COOKIE["employee_id"]; ?>" readonly><br>

                <label for="work_date">วันที่ทำงานแล้ว:</label>
                <input type="text" name="work_date" id="work_date" class="datepicker"><br>

                <label for="hour_of_day">ชั่วโมง (กี่โมง):</label>
                <input type="text" name="hour_of_day" id="hour_of_day" class="hour_of_day"><br>
                <button type="submit">ทำแล้ว</button>
            </form>
        </td>
        <td>
            <?php
            if (isset($_COOKIE['employee_id'])) {
                $emp_id = $_COOKIE['employee_id'];
                print_table('work_record', 'none', array('รหัสพนักงาน', 'วันที่', 'ชั่วโมงที่'), '*', 0, "WHERE EMPLOYEE_ID = $emp_id");
            }
            ?>
        </td>
    </tr>
</table>
