<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
     
            render("pass_form.php", ["title" => "Change Password"]);
        
    }
    //start the selling process
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["password"]== NULL || $_POST["confirmation"]== NULL)
        {
            apologize("One or more fields is blank");
        }
        if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
        else
        {  
            query("UPDATE users SET hash = ? WHERE id = ?",  crypt($_POST["password"],$_SESSION["id"]));
            redirect("index.php");
        }
    }

?>
