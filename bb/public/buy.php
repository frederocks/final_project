<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $buy = lookup($_POST["symbol"]);
        $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $exist = query("SELECT shares FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["symbol"]));
        if ($buy === false)
        {
            apologize("sorry that is an invalid symbol");
        }
        if ($buy["price"] * $_POST["shares"] > $cash[0]["cash"])
        {
            apologize("you do not have enough cash for this transaction");
        }
        if ($_POST["shares"] == 0)
            {apologize("you're kidding right?");}
        if (preg_match("/^\d+$/", $_POST["shares"]) != false)
        {   
            if($exist == false)
            {
                query("INSERT INTO shares (id, symbol, shares) VALUES(?, ?, ?)", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"]);
                query("UPDATE users SET cash = cash - ? WHERE id = ?", $buy["price"]*$_POST["shares"],$_SESSION["id"]);
                query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], "BUY", strtoupper($_POST["symbol"]), $_POST["shares"],$buy["price"]);
                redirect("index.php");
            }
            else
            {
            query("UPDATE users SET cash = cash - ? WHERE id = ?", $buy["price"]*$_POST["shares"],$_SESSION["id"]);
            query("UPDATE shares SET shares = shares + ? WHERE id = ? AND symbol = ?", $_POST["shares"],$_SESSION["id"], $_POST["symbol"]);
            query("INSERT INTO history (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], "BUY", strtoupper($_POST["symbol"]), $_POST["shares"],$buy["price"]);
            redirect("index.php");
            }
        }
        else    {apologize("enter a whole number jagoff");}
    }
    else
        {
            render("buy_form.php", ["title" => "Sell"]);
        }
?>
