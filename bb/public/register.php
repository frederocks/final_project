<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if($_POST["username"] == NULL || $_POST["password"]== NULL || $_POST["confirmation"]== NULL)
        {
            apologize("One or more fields is blank");
        }
        if( $_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match");
        }
        else
        {
            $return = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
            if ($return === false)
            {
                apologize("That user name is already taken, please select again");
            }
            else
            {
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                redirect("index.php");
            }
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
