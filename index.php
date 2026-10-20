<?php
// EcoTrace Africa - Digital Organic Tracking Framework
// Target Location: Kigali, Rwanda
$lat = -1.9403;
$lon = 30.0619;

// Connect to free agricultural meteorology streams to verify farm conditions
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&current=temperature_2m,relative_humidity_2m";
$response = @file_get_contents($apiUrl);

if ($response) {
    $data = json_decode($response, true);
    $temp = $data['current']['temperature_2m'] ?? 'N/A';
    $humidity = $data['current']['relative_humidity_2m'] ?? 'N/A';
} else {
    $temp = "Connecting...";
    $humidity = "Connecting...";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrace Africa | AgTech Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f9f4; color: #2e4a2e; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 500px; }
        h1 { color: #1e561e; border-bottom: 2px solid #e2eee2; padding-bottom: 10px; }
        .metric { font-size: 1.2em; margin: 15px 0; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <h1>EcoTrace Africa Dashboard</h1>
        <p><strong>Status:</strong> Active Pilot Tracker for Compliance & Certification Mapping</p>
        <div class="metric">Local Air Temperature: <?php echo $temp; ?>°C</div>
        <div class="metric">Soil/Air Humidity Level: <?php echo $humidity; ?>%</div>
        <p><small>System calibrated for region coordinates: Lat <?php echo $lat; ?>, Lon <?php echo $lon; ?></small></p>
    </div>
</body>
</html>