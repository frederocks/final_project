
<ul class= "nav nav-pills"  >

    <li ><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="password.php">Change Password</a></li>  
    <li><a href="logout.php"><strong>Log Out</strong></a></li>

</ul>

<table class= "table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th style = text-align:right>Total</th>
        </tr>
    </thead>    
<?php foreach ($positions as $position): ?>
    <tbody> 
    <tr>
        <td style = text-align:left><?= $position["symbol"] ?></td>
        <td style = text-align:left><?= $position["name"] ?></td>
        <td style = text-align:left><?= $position["shares"] ?></td>
        <td style = text-align:left><?= '$' . number_format($position["price"], 2, '.', '') ?></td>
        <td style = text-align:right><?= '$' . number_format($position["price"] * $position["shares"], 2, '.', ',') ?></td>
    </tr>

<?php endforeach ?>


        <tr>
            <td colspan='4' style = text-align:left >CASH</td>
            <td style = text-align:right><?='$'. number_format($cash[0]["cash"], 2, '.', ',') ?></td>
        </tr>
        
    </tbody>

    </table>

