<?php
require('connect_db.php');
require('login_tools.php');
require('helperFunctions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{


  list($check, $data) = validate($dbc, $_POST['username'], $_POST['pin']);

  if($check)
  {
    session_start();
    $_SESSION['user_id'] = $data['id'];
    load ('gridphoria.php');
  }
  else
  {
    $errors = $data;
  }

  mysqli_close($dbc);
}
include('login.php');
?>
