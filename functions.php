<?php

// Validate stock input
function validateStock($stock, $amount, $rate) {

    $errors = [];

    if (empty($stock)) {
        $errors[] = "Stock name is required.";
    }

    if (!is_numeric($amount) || $amount <= 0) {
        $errors[] = "Amount must be greater than 0.";
    }

    if (!is_numeric($rate) || $rate < 0) {
        $errors[] = "Growth rate must be 0 or higher.";
    }

    return $errors;
}

// Calculate future stock value
function calculateGrowth($amount, $rate, $year) {

    return $amount * pow((1 + ($rate / 100)), $year);
}

// Save portfolio to JSON file
function savePortfolio($portfolio) {

    $file = "portfolio.json";

    $existingData = [];

    // Load old data if file exists
    if (file_exists($file)) {

        $json = file_get_contents($file);

        $existingData = json_decode($json, true);

        if (!$existingData) {
            $existingData = [];
        }
    }

    // Add new portfolio
    $existingData[] = $portfolio;

    // Save back to file
    file_put_contents(
        $file,
        json_encode($existingData, JSON_PRETTY_PRINT)
    );
}

// Load saved portfolios
function loadPortfolios() {

    $file = "portfolio.json";

    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);

    return json_decode($json, true) ?? [];
}

?>