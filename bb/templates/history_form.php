<ul class= "nav nav-pills" >

    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>    
</ul>

<table class= "table table-striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>        

<?php foreach ($history as $position): ?>

<tr>
    <td style = text-align:left><?= $position["transaction"] ?></td>
    <td style = text-align:left><?= $position["date"] ?></td>
    <td style = text-align:left><?= $position["symbol"] ?></td>
    <td style = text-align:left><?= $position["shares"] ?></td>
    <td style = text-align:left><?= '$' . $position["price"] ?></td>
</tr>

<?php endforeach ?>

    </tbody>

    </table>
<div>
    <a href="logout.php"><strong>Log Out</strong></a>
</div>

