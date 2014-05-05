<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>Open a semester</h4>
</div>

<?php
if ($CI->input->get("success") == "true") {
    ?>
    <div data-alert class="alert-box success radius">
        You have successfully opened a semester.
        <a href="#" class="close">&times;</a>

    </div>
<?php } else if ($CI->input->get("success") == "error") {
    ?>
    <div data-alert class="alert-box warning radius">
        There was a problem opening the semester. Semester might already exist.
        <a href="#" class="close">&times;</a>

    </div>
<?php } ?>
<form method="post" action="<?php echo base_url("index.php?/post/open_semester"); ?>" data-abide>
    <div class="large-6 column">
        <div class="slot-field">
            <label>Semester <small>required</small>
                <select name="data[semester][name]" required>
                    <option value="">-- Select a Semester --</option>
                    <option value="Fall">Fall</option>
                    <option value="Winter">Winter</option>
                    <option value="Spring">Spring</option>
                    <option value="Summer">Summer</option>
                </select>
                <small class="error">A semester is required!</small>
            </label>
        </div>
        <div>
            <label>Year <small>required</small>
                <?php
                $years = array();
                $range = 5;
                $startYear = (int) date("Y");

                // add our year range +/- 5years
                for ($i = 0; $i < $range; $i++) {
                    $year = $startYear + $i;
                    array_push($years, $year);
                }
                ?>
                <select name="data[semester][year]" required>
                    <option value="">-- Select a year --</option>
                    <?php
                    foreach ($years as $year) {
                        echo "<option value='$year'>$year</option>";
                    }
                    ?>
                </select>
                <small class="error">Please select a year!</small>
            </label>
        </div>        
        <input type="submit" class="button radius" value="Open a semester" />
    </div>
</form>