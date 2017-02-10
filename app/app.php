<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";

  $app = new Silex\Application();

  $app->get("/", function() {
    return "
    <!DOCTYPE html>
        <html>
        <head>
            <title>ToDo List</title>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        </head>
        <body>
            <div class='container'>
            <h1>ToDo List</h1>
            </div>
        </body>
    </html>
    ";
  });


  return $app;
 ?>
