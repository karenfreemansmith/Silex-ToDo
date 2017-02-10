<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";

  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  session_start();
  if(empty($_SESSION['list_of_tasks'])) {
    $_SESSION['list_of_tasks'] = array();
  }

  $app->get("/", function() use($app) {
    return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
  });

  $app->post("/delete_tasks", function() use($app) {
    Task::deleteAll();
    return $app['twig']->render('delete_tasks.html.twig');
  });

  $app->post("/tasks", function() use($app) {
    $task = new Task($_POST['description']);
    $task->save();
    return $app['twig']->render('clear_tasks.html.twig', array('newTask' => $task));
  });

  return $app;
 ?>
