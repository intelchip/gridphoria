<?php

function load($page = 'login.php')
{
  $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[ 'PHP_SELF']);
  $url = rtrim($url, '/\\');
  $url .= '/'.$page;
  header("Location: $url");
  exit();
}

function validate($dbc , $username = '', $pin = '')
{

  $errors  = array();

  if(empty($username))
  {
    $errors[] = 'Enter your username.';
  }
  else
  {
    $username = mysqli_real_escape_string($dbc, trim($username));
  }

  if(empty($pin))
  {
    $errors[] = 'Enter your pin.';
  }
  else
  {
    $pin = mysqli_real_escape_string($dbc, trim($pin));
  }

  if(empty($errors))
  {
    $query = 'SELECT id FROM users WHERE username = "' . $username . '" AND pin = ' . $pin ;
    show_query($query);

    $results = mysqli_query ($dbc, $query);
    check_results($results);

    if(mysqli_num_rows($results) == 1)
    {
      $row = mysqli_fetch_array($results, MYSQLI_ASSOC);

      $id = $row['id'] ;

      return $id;
    }
    else
    {
      $errors[] = 'Username and pin not found.';
    }
  }
  return array(false, $errors);
}

?>
