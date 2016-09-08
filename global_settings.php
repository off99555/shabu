<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 27-May-16
 * Time: 04:39
 */
$TITLE = "Shabu Manager";

require 'connect_db.php';

// assuming that the id is the first attribute
function print_table($table, $selector_class, $keys, $attrs = "*", $id_index=0, $condition=null)
{
    $sql = "SELECT $attrs FROM $table ";
    if (!is_null($condition)) {
        $sql .= $condition;
    }
    $records = $GLOBALS["conn"]->query($sql);
    $table_var = "{$table}_table";
    echo "<div>";
    if ($records->num_rows == 0) {
        echo "</div>";
        return;
    }
    echo "<table id='$table_var'>";
    echo "<thead>";
    echo "<tr>";
    foreach ($keys as $key) {
        echo "<th>$key</th>";
    }
    echo "</thead>";
    echo "<tbody>";
    echo "</tr>";
    while ($row = $records->fetch_row()) {
        echo "<tr id=\"{$selector_class}_$row[$id_index]\">";
        foreach ($row as $field) {
            echo "<td>$field</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<script>
        $(function() {
            $table_var = $('#$table_var').DataTable({
                jQueryUI: true,
                select: 'single'
            });
            $(\".$selector_class\").change(function () {
                $table_var.rows('#{$selector_class}_' + this.value).select();
            });
            $table_var.on('select', function(e, dt, type, indexes) {
                var selected_id = $table_var.row(indexes[0]).data()[$id_index];
                $('.$selector_class').val(selected_id).trigger('chosen:updated');
            });
        });
        </script>";
    echo "</div>";
}

?>
<script src="/shabu/js/jquery-1.12.4.min.js"></script>
<script src="/shabu/js/jquery-ui-1.12.0-rc.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/shabu/js/jquery-ui-1.12.0-rc.2/jquery-ui.min.css">
<!--<link rel="stylesheet" href="/shabu/js/jquery-ui-1.11.4/jquery-ui.theme.min.css">-->
<!--<link rel="stylesheet" href="/shabu/js/jquery-ui-1.11.4/jquery-ui.structure.min.css">-->
<script src="/shabu/js/chosen_v1.5.1/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="/shabu/js/chosen_v1.5.1/chosen.min.css">
<script src="/shabu/js/dataTables/jquery.dataTables.min.js"></script>
<!--<link rel="stylesheet" href="/shabu/js/dataTables/jquery.dataTables.min.css">-->
<link rel="stylesheet" href="/shabu/js/dataTables/dataTables.jqueryui.min.css">
<script src="/shabu/js/Select/js/dataTables.select.js"></script>
<link rel="stylesheet" href="/shabu/js/datetimepicker/build/jquery.datetimepicker.min.css">
<script src="/shabu/js/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script>
    $(function () {
        $(document).tooltip({
            track: true,
            show: {
                effect: 'slideDown',
            },
            hide: {
                effect: 'explode',
            }
        });
        $("button").button();
        $("select").chosen({
            placeholder_text_single: "เลือกสักอันสิ...",
            search_contains: true,
            no_results_text: "ไม่พบคำว่า",
            allow_single_deselect: true
        });
//        table = $("table").DataTable({
//            jQueryUI: true,
//            select: 'single'
//        });
    });
</script>
