<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
        if ($stock === false)
        {
            apologize("sorry that is an invalid symbol");
        }
        else
        {
            render("quote.php", ["s" => $stock]);
        }
    }
    else
    {
        // else render form
        render("sell_form.php", ["title" => "Sell"]);
    }

?>
