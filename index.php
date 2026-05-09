<!DOCTYPE html>
<html>
<head>
    <title>Stock Growth Simulator</title>
</head>
<body>

<h1>Stock Growth Simulator</h1>

<form action="results.php" method="POST">

    <label>Stock Name:</label>
    <input type="text" name="stock">

    <br><br>

    <label>Investment Amount:</label>
    <input type="number" name="amount">

    <br><br>

    <label>Growth Rate:</label>
    <input type="number" step="0.01" name="rate">

    <br><br>

    <label>Years:</label>
    <input type="number" name="years">

    <br><br>

    <button type="submit">Calculate</button>

</form>

</body>
</html>