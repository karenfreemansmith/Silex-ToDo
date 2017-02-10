<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";

  $app = new Silex\Application();

  session_start();
  if(empty($_SESSION['list_of_tasks'])) {
    $_SESSION['list_of_tasks'] = array();
  }

  $app->get("/", function() {
    $output = "";
    $all_tasks = Task::getAll();

    if(!empty($all_tasks)) {
      $output = $output . "
        <h1>To Do List</h1>
        <p><strong>Here are all your tasks:</strong></p>
      ";

      foreach(Task::getAll() as $task) {
        $output = $output . "<li>" . $task->getDescription() ."</li>";
      }
    }

    $output = $output . "
      <h2>Add a Task:</h2>
      <form action='/tasks' method='post'>
        <label for='description'>Task Description</label>
        <input id='description' name='description' type='text'>
        <button type='submit'>Add Task</button>
      </form>
    ";

    $output .= "
      <form action='/delete_tasks' method='post'>
        <button type='submit'>delete</button>
      </form>
    ";

    return $output;
  });

  $app->post("/delete_tasks", function() {
    Task::deleteAll();

    return "
      <h1>List Cleared!</h1>
      <p><a href='/'>Home</a></p>
    ";
  });

  $app->post("/tasks", function() {
    $task = new Task($_POST['description']);
    $task->save();
    return "
      <h1>You created a task!</h1>
      <p>" . $task->getDescription() . "</p>
      <p><a href='/'>View your list of things to do.</a></p>
    ";
  });

  return $app;
 ?>
