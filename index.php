<?php

    $errors = "";


    //connect to database
    $db = mysqli_connect('localhost', 'root', '', 'to-do-list-database');



    //when you submit new task 
    if(isset($_POST['submit'])){

        $task = $_POST['task'];

        if (empty($task)){

            $errors = "You must fill in the task";

        }else{
            
            mysqli_query($db, "INSERT INTO tasks(task) VALUES ('$task')");

            header('location: index.php');

        }
    }


    //when you delete a task from list
    if(isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id = $id");
        header('location: index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");



?>



<!DOCTYPE html>
<html>
<head>
  <title>TODO List app using PHP and MySQL</title>

  <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class = "heading">
        <h2>TODO List</h2>
    </div>


    <form method = "POST" action = "index.php">
    <?php  if (isset($errors)){ ?>
        
        <p> <?php echo $errors; ?> </p>
        
    <?php }  ?>

        <input type = "text" name  = "task" class = "task_input">
        <button type = "submit" class = "task_btn" name = "submit">Add Task  </button>

    </form>

    <table>
        <thead>
            <tr>

                <th>Number</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php  $i = 1;
        
        while($row = mysqli_fetch_array($tasks)){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class = "task"><?php echo $row['task']; ?></td>
                <td class = "delete">
                    <a href = "index.php?del_task=<?php echo $row['id']; ?>">x</a>
                </td>
            </tr>
            
        
        <?php $i++; } ?>
            

        </tbody>





    </table>



</body>
</html>
