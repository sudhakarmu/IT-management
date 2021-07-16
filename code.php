<?php
include('security.php');
require 'database/dbconfig.php';
$new_time = date("Y-m-d H:i:s", strtotime('+5 HOURS 30 MINUTES'));

if(isset($_POST['submit']))
    {
        $username = htmlentities($_POST['username']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $confirmpassword = htmlentities($_POST['confirmpassword']);
        $usertype = htmlentities($_POST['usertype']);

        if($password === $confirmpassword)
        {

            $query = "INSERT INTO users (`username`,`email`,`password`,`usertype`) VALUES('$username','$email','$password','$usertype')";
            $result =  mysqli_query($con, $query);

            if($result)
            {
            $_SESSION['success'] = "Admin Profile added";
            header('location:register.php');
            }
            else
            {
            $_SESSION['status'] = "Admin Profile not added";
            header('location:register.php');
            }
        }
        else{
            echo "Password not matched";
        }
    }



if(isset($_POST['update']))
{
    $id = htmlentities($_POST['edit_id']);
    $username = htmlentities($_POST['edit_username']);
    $email = htmlentities($_POST['edit_email']);
    $password = htmlentities($_POST['edit_password']);
    $usertype = htmlentities($_POST['update_usertype']);

    $query = "UPDATE users SET username = '$username', email ='$email', password ='$password', usertype ='$usertype' WHERE id ='$id'";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
        $_SESSION['success']="&nbsp;Your data is Updated successfully";
        header('location:register.php');
    }
    else
    {
        $_SESSION['status']="Your data is not Updated";
        header('location:register.php');
    }
    
}

if(isset($_POST['delete_btn']))
{
    $id = htmlentities($_POST['delete_id']);

    $query = "UPDATE users SET status=0 WHERE id='$id'";

    $result = mysqli_query($con, $query);

    if($result)
    {
        $_SESSION['success']="&nbsp;Your data is deleted successfully";
        header('location:register.php');
    }
    else
    {
        $_SESSION['status']="Your data is not deleted";
        header('location:register.php');
    }
}

if(isset($_POST['revieve_btn']))
{
    $id = htmlentities($_POST['revieve_id']);

    $query = "UPDATE users SET status=1 WHERE id='$id'";

    $result = mysqli_query($con, $query);

    if($result)
    {
        $_SESSION['success']="&nbsp;Your data is revieved successfully";
        header('location:deleted_user.php');
    }
    else
    {
        $_SESSION['status']="Your data is not revieved";
        header('location:deleted_user.php');
    }
}

if(isset($_POST['login_btn']))
{
    $email_login = htmlentities($_POST['email_login']);

    $password_login = htmlentities($_POST['password_login']);

    $query = "SELECT * FROM users WHERE email='$email_login' AND password='$password_login' AND status=1";

    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result)>0)
    {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $email_login;
        $_SESSION['name'] = $row['username'];

        if($row['usertype']=="admin")
        {
        $_SESSION['ROLE'] = "admin";
        header('location:index.php');
        }
        if($row['usertype']=="developer")
        {
        $_SESSION['ROLE'] = "developer";
        header('location:index.php');
        }
        if($row['usertype']=="developer admin")
        {
        $_SESSION['ROLE'] = "developer admin";
        header('location:index.php');
        }
        if($row['usertype']=="tester")
        {
        $_SESSION['ROLE'] = "tester";
        header('location:index.php');
        }
        if($row['usertype']=="planning")
        {
        $_SESSION['ROLE'] = "planning";
        header('location:index.php');
        }
    }
    else
    {
        echo "Looks like an wrong Username/Password";
    }
}

if(isset($_POST['update_task_button']))
{
$id = htmlentities($_POST['edit_id']);

$task_status = htmlentities($_POST['task_status']);

$query = "UPDATE task SET task_status='$task_status',update_at='$new_time' WHERE id='$id'";

$result = mysqli_query($con, $query);

if($result)
{
    header('location:view_task.php');
}
else
{
    header('location:view_task.php');
}
}

if(isset($_POST['submit_task']))
{
    $name = htmlentities($_POST['name']);
    $description = htmlentities($_POST['description']);
    $task_type = htmlentities($_POST['task_type']);
    $assigned_to = htmlentities($_POST['assigned_to']);
    $finishing_date = htmlentities($_POST['finishing_date']);
    $new_time = date("Y-m-d H:i:s", strtotime('+5 HOURS 30 MINUTES'));

    $query = "INSERT INTO task (`name`, `description`, `task_type`, `finishing_date`, `assigned_to`,`created_at`) VALUES ('$name','$description', '$task_type','$finishing_date','$assigned_to','$new_time')";
    $result =  mysqli_query($con, $query);

    if($result)
    {
    $_SESSION['success'] = "Task added";
    header('location:manage_task.php');
    }
    else
    {
    $_SESSION['status'] = "Task not added";
    header('location:manage_task.php');
    }
}


if(isset($_POST['update_task']))
{
    $id = htmlentities($_POST['edit_id']);
    $name = htmlentities($_POST['edit_name']);
    $description = htmlentities($_POST['edit_description']);
    $task_type = htmlentities($_POST['edit_task_type']);
    $assigned_to = htmlentities($_POST['edit_assigned_to']);
    $finishing_date = htmlentities($_POST['edit_finishing_date']);

    $query = "UPDATE task SET name = '$name',description = '$description', task_type ='$task_type', finishing_date ='$finishing_date', assigned_to ='$assigned_to',update_at='$new_time' WHERE id ='$id'";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
        $_SESSION['success']="&nbsp;Your data is registered successfully";
        header('location:manage_task.php');
    }
    else
    {
        $_SESSION['status']="Your data is not registered";
        header('location:manage_task.php');
    }
    
}

if(isset($_POST['revieve_btn_task']))
{
$id = htmlentities($_POST['revieve_id']);

$query = "UPDATE task SET status=1 WHERE id='$id'";

$result = mysqli_query($con, $query);

if($result)
{
    $_SESSION['success']="&nbsp;Your data is revieved successfully";
    header('location:deleted_task.php');
}
else
{
    $_SESSION['status']="Your data is not revieved";
    header('location:deleted_task.php');
}
}

if(isset($_POST['delete_btn_task']))
{
$id = htmlentities($_POST['delete_id']);

$query = "UPDATE task SET status=0 WHERE id='$id'";

$result = mysqli_query($con, $query);

if($result)
{
    $_SESSION['success']="&nbsp;Your data is deleted successfully";
    header('location:manage_task.php');
}
else
{
    $_SESSION['status']="Your data is not deleted";
    header('location:manage_task.php');
}
}

if(isset($_POST['update_current_project']))
{
    $project_notes = htmlentities($_POST['addnotes']);

    $project_name = htmlentities($_POST['edit_name']);

    $project_status = htmlentities($_POST['project_status']);

    $new_time = date("Y-m-d H:i:s", strtotime('+5 HOURS 30 MINUTES'));

    $id = $_POST['edit_id'];
    if($_SESSION['ROLE']=="planning")
    {
        $query = "INSERT INTO `plan`(`notes`,`project_name`,`created_at`) VALUES('$project_notes','$project_name','$new_time')";
        if($project_status=="Completed")
        {
            $query1 = "UPDATE project SET state='Development',planning_status='$project_status' WHERE id='$id'";
            $result = mysqli_query($con, $query);
        }
    }
    if($_SESSION['ROLE']=="developer")
    {
        $query = "INSERT INTO `current_project`(`notes`,`project_name`,`created_at`) VALUES('$project_notes','$project_name','$new_time')";
        if($project_status=="Completed")
        {
            $query1 = "UPDATE project SET state='Testing',development_status='$project_status' WHERE id='$id'";
            $result = mysqli_query($con, $query);
        }
    }
    elseif($_SESSION['ROLE']=="tester")
    {
        $query = "INSERT INTO `test`(`notes`,`project_name`,`created_at`) VALUES('$project_notes','$project_name','$new_time')";
        if($project_status=="Completed")
        {
            $query1 = "UPDATE project SET state='Closed',testing_status='$project_status' WHERE id='$id'";
            $result = mysqli_query($con, $query);
        }
    }


    $result1 = mysqli_query($con, $query1);

    if( $result1)
    {
        header('location:view_project.php');
    }
    else
    {
        header('location:view_project.php');
    }

}

if(isset($_POST['submit_project']))
{
    $name = htmlentities($_POST['name']);
    $description = htmlentities($_POST['description']);
    $notes = htmlentities($_POST['notes']);
    $assigned_to = htmlentities($_POST['assigned_to']);
    $deadline = htmlentities($_POST['deadline']);

    $query = "INSERT INTO project (`name`, `description`, `notes`, `deadline`, `assigned_to`,`created_at`) VALUES ('$name','$description', '$notes','$deadline','$assigned_to','$new_time')";
    $result =  mysqli_query($con, $query);

    if($result)
    {
    $_SESSION['success'] = "Project added";
    header('location:manage_project.php');
    }
    else
    {
    $_SESSION['status'] = "Project not added";
    header('location:manage_project.php');
    }
}


if(isset($_POST['update_project']))
{
    $id = htmlentities($_POST['edit_id']);
    $description = htmlentities($_POST['edit_description']);
    $notes = htmlentities($_POST['edit_notes']);
    $assigned_to = htmlentities($_POST['edit_assigned_to']);
    $deadline = htmlentities($_POST['edit_deadline']);

    $query = "UPDATE project SET description = '$description', notes ='$notes', deadline ='$deadline', assigned_to ='$assigned_to',created_at='$new_time' WHERE id ='$id'";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
        $_SESSION['success']="&nbsp;Your data is registered successfully";
        header('location:manage_project.php');
    }
    else
    {
        $_SESSION['status']="Your data is not registered";
        header('location:manage_project.php');
    }
    
}

if(isset($_POST['delete_btn_project']))
{
$id = htmlentities($_POST['delete_id']);

$query = "UPDATE project SET status=0 WHERE id='$id'";

$result = mysqli_query($con, $query);

if($result)
{
    $_SESSION['success']="&nbsp;Your data is deleted successfully";
    header('location:manage_project.php');
}
else
{
    $_SESSION['status']="Your data is not deleted";
    header('location:manage_project.php');
}
}

if(isset($_POST['revieve_btn_project']))
{
$id = htmlentities($_POST['revieve_id']);

$query = "UPDATE project SET status=1 WHERE id='$id'";

$result = mysqli_query($con, $query);

if($result)
{
    $_SESSION['success']="&nbsp;Your data is revieved successfully";
    header('location:deleted_project.php');
}
else
{
    $_SESSION['status']="Your data is not revieved";
    header('location:deleted_project.php');
}
}


if(isset($_POST['submit_teams']))
{
    $team_name = htmlentities($_POST['team_name']);
    $team_head = htmlentities($_POST['team_head']);
    $new_time = date("Y-m-d H:i:s", strtotime('+5 HOURS 30 MINUTES'));
    foreach ($_POST['team_members'] as $members) 
    {
    $query = "INSERT INTO teams (`team_name`, `team_head`, `member_name`,`created_at`) VALUES ('$team_name','$team_head','$members','$new_time')";
    $result =  mysqli_query($con, $query);
    }
    if($result)
    {
    $_SESSION['success'] = "Team added";
    header('location:teams.php');
    }
    else
    {
    $_SESSION['status'] = "Team not added";
    header('location:teams.php');
    }
}

if(isset($_POST['delete_btn_teams']))
{
    $team_name = htmlentities($_POST['delete_team_name']);

    $query = "UPDATE teams SET status=0 WHERE team_name='$team_name'";

    $result = mysqli_query($con, $query);

    if($result)
    {
        $_SESSION['success']="&nbsp;Your data is deleted successfully";
        header('location:teams.php');
    }
    else
    {
        $_SESSION['status']="Your data is not deleted";
        header('location:teams.php');
    }
}


?>