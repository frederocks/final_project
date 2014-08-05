<?php

    // configuration
    require("../includes/config.php");

    // if history form was requested
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $history = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
        render("history_form.php", ["title" => "History", "history" => $history]);
    }
  
?>
