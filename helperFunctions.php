 <?php
require('connect_db.php');

#turns the debugger on or off
$debug = true;

#function to show the query

function show_query($query)
{
  global $debug;
  if($debug)
  {
    echo "<p> Query = $query </p>";
  }
}


#function to rendert the logo

function render_logo()
{
  echo "<DIV STYLE=\"position:absolute; top:65px; left:0px; width:250px; height:25px\">";
  echo "<h1>Gridphoria version .0011 </h1>";
  echo "</DIV>";
  echo "<td width=\"10%\" style=\"position: relative;\">";
  echo "<img src=\"gridphoria.gif\" alt=\"Gridphoria\" style = \"z -index: -\"/>";
  echo "<div style=\"position:absolute;left:0px;top:0px;font-size: 32px;display: none\">";
  echo "</div>";
  echo "</td>";
}

#function to check query results
function check_results($results){
  global $dbc;
  if($results != true)
    echo'<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>' ;
}


#function to render the username and pin boxes

function render_login()
{
  echo "<form>";
  echo "<table border = \"0\">";
  echo "<form action= \"action_handler.php\", method = \"POST\">";
  echo "<dl>";
  echo "<td align = \"right\">";
  echo "<dt>username: <input type = \"text\" username = \"username\">";
  echo "</td>";
  echo "<tr>";
  echo "<td align = \"right\">";
  echo "<dt>pin: <input type = \"text\" pin = \"pin\">";
  echo "</td>";
  echo "</dl>";
  echo "</form>";
  echo "</table>";
  echo "</form>";
}


# function to render the semester drop down

function render_semester()
{
  echo "<form>";
  echo "<p>";
  echo "<label>Select a semester</label>";
  echo "<select id = \"Semester\">";
  echo "<option value = \"Semester\">Semester</option>";
  echo "<option value = \"Fall 2013\">Fall 2013</option>";
  echo "<option value = \"Winter 2013\">Winter 2013</option>";
  echo "<option value = \"Spring 2014\">Spring 2014</option>";
  echo "<option value = \"Summer 2014\">Summer 2014</option>";
  echo "</select>";
  echo "</p>";
  echo "</form>";
}

# Renders selections.
function render_selections($user_id)
{
  global $dbc;

  $query =  'SELECT courses.name,courses.section,courses.teacher, selectionss.id, selectionss.user_id ';
  $query .= 'FROM courses,selectionss where courses.course_id = selectionss.id and selectionss.user_id = selectionss.user_id ';
  #.$user_id;
  #show_query($query);
  $results = mysqli_query($dbc, $query);
  check_results($results);

  if($results) {
    echo "<TABLE border='0'>";
    echo "<TABLE id= myTable\>";
    echo "<tr>";
    echo "<th>Course number</th>";
    echo "<th>Class</th>";
    echo "<th>Status</th>";
    echo "<th>Owner</th>";
    echo "<th>Modify</th>";
    echo "</tr>";

    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $course_name = $row['name'];
      $section = $row['section'] ;
      $status = $row['status'];
      $teacher = $row['teacher'];

      echo "<tr>";
      echo "<td>";
      echo "<select>";
      echo "<option value = " . $course_name . ">". $course_name . "</option>";
      echo "</select>";
      echo "</td>";

      echo "<tr>";
      echo "<td>";
      echo "<select>";
      echo "<option value = " . $section . ">". $section . "</option>";
      echo "</select>";
      echo "</td>";

      echo "<tr>";
      echo "<td>";
      echo $status ;
      echo "</td>";

      echo "<tr>";
      echo "<td>";
      echo $teacher ;
      echo "</td>";

      echo "<tr>" ;
      echo "<td>" ;
      echo "<select>";
      echo "<option value = \"No Action\">No Action</option>";
      echo "<option value = \"Update\">Update</option>";
      echo "<option value = \"Delete\">Delete</option>";
      echo "</select>" ;
      echo "</td>" ;
    }

    echo "</table>";
  }
}

#function to render the buttons
function render_buttons()
{
  echo "<button onclick=\"displayResult()\">+</button>";
  echo "<p>&nbsp;</p>";
  echo "<button type=\"button\">Refresh</button>";
  echo "<button type=\"button\">Commit</button>";
  echo "<button type=\"button\">Save</button>";
}
?>
