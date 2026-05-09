<?php

include 'functions.php';

$portfolios = loadPortfolios();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Saved Portfolios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Saved Portfolio Simulations</h1>

<?php

if (empty($portfolios)) {

    echo "<p>No saved portfolios yet.</p>";

} else {

    foreach ($portfolios as $portfolio) {

        echo "<div class='stock-box'>";

        foreach ($portfolio as $stock) {

            echo "<h3>" . $stock['stock'] . "</h3>";

            echo "<p>Starting Amount: $" . $stock['amount'] . "</p>";

            echo "<p>Growth Rate: " . $stock['rate'] . "%</p>";

            echo "<hr>";
        }

        echo "</div>";
    }
}

?>

<a href="index.php">Back Home</a>

</body>
</html>