<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <title>formDemo.html</title>
    <meta charset = "UTF-8">
    <script>
	function displayResult()
	{
	var table=document.getElementById("myTable");
	var row=table.insertRow(-1);
	var cell1=row.insertCell(0);
	var cell2=row.insertCell(1);
	var cell3=row.insertCell(2);
	var cell4=row.insertCell(3);
	var cell5=row.insertCell(4);
	}

</script>
  </head>
  <body>

  <DIV STYLE="position:absolute; top:65px; left:0px; width:250px; height:25px">
  <h1>Gridphoria version .0011 </h1>
</DIV>
  <td width="10%" style="position: relative;">
      <img src="https://lh4.googleusercontent.com/C3Pvo5DFCQlMjlFxrnqOV98rrxBjvpC6QFUIKbgvXuuJTVcGvd6oXwwdDo1-03VCbNjgCRPTgBSPCZzi8MofXcf2Gqu8YBICI5Ooprarj6C7VZ8WlS-ktf5E9w" alt="Gridphoria" style = "z -index: -"/>
      <div style="position:absolute;left:0px;top:0px;font-size: 32px;display: none">
        Test
      </div>
</td>

    <form>
    <table border = "0">
			<form action= "action_handler.php", method = "POST">
			<dl>
			<td align = "right">
			<dt>username: <input type = "text" username = "username">
			</td>
			<tr>
			<td align = "right">
			<dt>pin: <input type = "text" pin = "pin">
			</td>
			</dl>
			</form>
			</table>
    </form>
    <form>
          <p>
             <label>Select a semester</label>
             <select id = "Semester">
             <option value = "Semester">Semester</option>
               <option value = "Fall 2013">Fall 2013</option>
               <option value = "Winter 2013">Winter 2013</option>
               <option value = "Spring 2014">Spring 2014</option>
               <option value = "Summer 2014">Summer 2014</option>
             </select>
          </p>

    </form>
    <label> </label>
    <label> </label>

	    <h2>Selections</h2>


<?php

$rows = 4; // define number of rows

echo "<table border='0'>
<table id= \"myTable\" >
	    <tr>
	    <th>Course number</th>
	    <th>Class</th>
	    <th>Status</th>
	    <th>Owner</th>
	    <th>Modify</th>
	    </tr>";

for($tr=1;$tr<=$rows;$tr++){

    echo "<tr>";
               echo "  <td>			<select id = \"Number\">
							<option value = \"Course Number 1\">Course Number 1</option>
							<option value = \"Course Number 2\">Course Number 2</option>
							<option value = \"Course Number 3\">Course Number 3</option>
							<option value = \"Course Number 4\">Course Number 4</option>
			                </select></td>
	        <td><select id = \"Class\">
						    <option value = \"Class 1\">Class 1</option>
						    <option value = \"Class 2\">Class 2</option>
						    <option value = \"Class 3\">Class 3</option>
						    <option value = \"Class 4\">Class 4</option>
			    </select></td>
	        <td>Pending</td>
	        <td>N/A</td>
	        <td><select id = \"Update\">
							<option value = \"No Action\">No Action</option>
							<option value = \"Update\">Update</option>
							<option value = \"Delete\">Delete</option>
			    </select></td>";
    echo "</tr>";
}

echo "</table>";
?>
</table>
<button onclick="displayResult()">+</button>
<p>&nbsp;</p>
<button type="button">Refresh</button>
<button type="button">Commit</button>
<button type="button">Save</button>


  </body>
</html>
