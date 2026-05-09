<?php

// Get form values
$stock = $_POST['stock'];
$amount = $_POST['amount'];
$rate = $_POST['rate'];
$years = $_POST['years'];

$errors = [];

if (empty($stock)) {
    $errors[] = "Stock name is required.";
}

if (!is_numeric($amount) || $amount <= 0) {
    $errors[] = "Investment amount must be greater than 0.";
}

if (!is_numeric($rate) || $rate < 0) {
    $errors[] = "Growth rate must be 0 or higher.";
}

if (!is_numeric($years) || $years <= 0) {
    $errors[] = "Years must be greater than 0.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Investment Results</h1>

<?php

// Show errors if there are any
if (!empty($errors)) {

    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }

    echo "</ul>";

    echo '<a href="index.php">Go Back</a>';

} else {

    echo "<h2>$stock Projection</h2>";

    echo "<table border='1' cellpadding='10'>";

    echo "
        <tr>
            <th>Year</th>
            <th>Value</th>
        </tr>
    ";

    $currentValue = $amount;

    for ($year = 1; $year <= $years; $year++) {

        $currentValue = $currentValue * (1 + ($rate / 100));

        echo "
            <tr>
                <td>$year</td>
                <td>$" . number_format($currentValue, 2) . "</td>
            </tr>
        ";
    }

    echo "</table>";

    echo "<br>";

    echo '<a href="index.php">Try Another</a>';
}

?>

</body>
</html>