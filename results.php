<?php

include 'functions.php';

// Gets form data
$stocks = $_POST['stocks'];
$amounts = $_POST['amounts'];
$rates = $_POST['rates'];
$years = $_POST['years'];

$errors = [];

$portfolio = [];

$totalPortfolioValue = 0;

// Validates years
if (!is_numeric($years) || $years <= 0) {
    $errors[] = "Years must be greater than 0.";
}

// Validates stocks
for ($i = 0; $i < count($stocks); $i++) {

    $stock = trim($stocks[$i]);
    $amount = $amounts[$i];
    $rate = $rates[$i];

    // Skip empty rows
    if (empty($stock) && empty($amount) && empty($rate)) {
        continue;
    }

    // Validate using function
    $stockErrors = validateStock($stock, $amount, $rate);

    foreach ($stockErrors as $error) {
        $errors[] = "$stock: $error";
    }

    // Save valid stock
    $portfolio[] = [
        "stock" => $stock,
        "amount" => $amount,
        "rate" => $rate
    ];
}

// Save portfolio if no errors
if (empty($errors) && !empty($portfolio)) {
    savePortfolio($portfolio);
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Results</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<h1>Results</h1>

<?php

// Show validation errors
if (!empty($errors)) {

    echo "<div class='error-box'>";

    echo "<h2>Errors Found</h2>";

    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }

    echo "</ul>";

    echo "</div>";

    echo '<a href="index.php">Go Back</a>';

} else {

    // Display each stock
    foreach ($portfolio as $stockData) {

        $stock = $stockData['stock'];
        $amount = $stockData['amount'];
        $rate = $stockData['rate'];

        echo "<div class='stock-box'>";

        echo "<h2>$stock</h2>";

        echo "<p>Starting Investment: $" . number_format($amount, 2) . "</p>";

        echo "<p>Annual Growth Rate: $rate%</p>";

        echo "<p>Projection Length: $years Years</p>";

        echo "<table border='1' cellpadding='10'>";

        echo "
            <tr>
                <th>Year</th>
                <th>Projected Value</th>
            </tr>
        ";

        // Calculate yearly values
        for ($year = 1; $year <= $years; $year++) {

            $futureValue = calculateGrowth($amount, $rate, $year);

            echo "
                <tr>
                    <td>$year</td>
                    <td>$" . number_format($futureValue, 2) . "</td>
                </tr>
            ";
        }

        // Final value for totals
        $finalValue = calculateGrowth($amount, $rate, $years);

        $profit = $finalValue - $amount;

        $totalPortfolioValue += $finalValue;

        echo "<h3>Final Value: $" . number_format($finalValue, 2) . "</h3>";

        echo "<h3>Total Profit: $" . number_format($profit, 2) . "</h3>";

        echo "</div>";

        echo "<br>";
    }

    // Portfolio totals
    echo "<div class='stock-box'>";

    echo "<h2>Total Portfolio Summary</h2>";

    echo "<h3>Total Portfolio Value After $years Years:</h3>";

    echo "<h2>$" . number_format($totalPortfolioValue, 2) . "</h2>";

    echo "</div>";

    echo "<br>";

    echo '<a href="index.php">Run Another Simulation</a>';

    echo "<br><br>";

    echo '<a href="saved.php">View Saved Portfolios</a>';
}

?>

</body>
</html>