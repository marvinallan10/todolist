<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
</head>
<body>

    <h1>To Do List</h1>

    <form method="post">  <input type="text" name="task" class="input-control" placeholder="Add task"> <div>
            <button type="submit" name="add">Add</button>
        </div>
    </form>

    <?php
    include "database.php";

    if(isset($_POST['add'])) {
        $task = $_POST['task']; 

        if(!empty($task)) {

            $task = mysqli_real_escape_string($conn, $task);

    
            $sql = "INSERT INTO tasks (task) VALUES ('$task')"; // Assuming your table is named 'tasks' and has a 'task' column
            if (mysqli_query($conn, $sql)) {
                // Task added successfully, you might want to redirect or refresh the page
                header("Location: ".$_SERVER['PHP_SELF']); // Refresh the page to show the new task
                exit(); // Important to stop further execution after redirecting
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }


    // Display the tasks from the database
    $sql = "SELECT * FROM tasks ORDER BY id DESC"; // Order by id to show latest task first
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result=mysqli_query()) > 0) {
        echo "<ul>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row["task"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No tasks yet.";
    }

    mysqli_close($conn); // Close the database connection
    ?>

</body>
</html>