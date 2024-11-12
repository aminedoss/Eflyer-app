<?php
    include('../function/myfunction.php');
    if(isset($_SESSION['auth']))
    {
        if($_SESSION['role_as'] == 0)
        {
            redirect("../index.php", "You are not authorized to access to this page  ");
        }
    }
    else
    {
        redirect("../login.php", "Login To continue ");
    }
?>