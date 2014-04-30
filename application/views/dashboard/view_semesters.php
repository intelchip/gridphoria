<?php
$CI = & get_instance();
?>
<div class="panel">
    <h4>View Semesters - <?php echo $year; ?></h4>
</div>

<ul>
<?php
foreach ($semesters as $row)
{
   echo "<li><a href='".  base_url("index.php?/dashboard/view_courses/all/$row->year/$row->semester/1")."'>$row->semester - $row->year</a></li>"; 
}
?>
</ul>

<?php
if(!count($semesters)){
    echo "<strong>There are no semesters opened for this year!</a>";
}
?>