<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $stock = query("SELECT * FROM shares WHERE id = ?", $_SESSION["id"]);
        if ($stock === false)
        {
            apologize("sorry that is an invalid symbol");
        }
        else
        {
            render("sell_form.php", ["s" => $stock, "title" => "Sell"]);
        }
    }
    //start the selling process
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sell = lookup($_POST["symbol"]);
        if ($sell === false)
        {
            apologize("sorry that is an invalid symbol");
        }
        else
        {   
            $shares = query("SELECT shares FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
            query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], "SELL" , strtoupper($_POST["symbol"]), $shares[0]["shares"],$sell["price"]);
            query("DELETE FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
            query("UPDATE users SET cash = cash + ? WHERE id = ?", $sell["price"]*$shares[0]["shares"],$_SESSION["id"]);
            redirect("index.php");
        }
    }

?>
