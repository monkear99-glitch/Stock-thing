<!DOCTYPE html>
<html>
<head>
    <title>Portfolio Growth Simulator</title>
    <a href="saved.php">View Saved Portfolios</a>

<br><br>

    <link rel="stylesheet" href="style.css">

    <style>
        .stock-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            background: white;
        }
    </style>
</head>
<body>

<h1>Portfolio Growth Simulator</h1>

<form action="results.php" method="POST">

    <div id="stock-container">

        <div class="stock-box">

            <h2>Stock 1</h2>

            <label>Stock Name:</label>
            <input type="text" name="stocks[]">

            <br><br>

            <label>Starting Amount:</label>
            <input type="number" name="amounts[]">

            <br><br>

            <label>Growth %:</label>
            <input type="number" step="0.01" name="rates[]">

        </div>

    </div>

    <button type="button" onclick="addStock()">
        Add Another Stock
    </button>

    <br><br>

    <label>Years:</label>
    <input type="number" name="years">

    <br><br>

    <button type="submit">
        Calculate Portfolio
    </button>

</form>

<script>

let stockCount = 1;

function addStock() {

    stockCount++;

    let stockContainer = document.getElementById("stock-container");

    let newStock = document.createElement("div");

    newStock.classList.add("stock-box");

    newStock.innerHTML = `
    
        <h2>Stock ${stockCount}</h2>

        <label>Stock Name:</label>
        <input type="text" name="stocks[]">

        <br><br>

        <label>Starting Amount:</label>
        <input type="number" name="amounts[]">

        <br><br>

        <label>Growth %:</label>
        <input type="number" step="0.01" name="rates[]">

    `;

    stockContainer.appendChild(newStock);
}

</script>

</body>
</html>