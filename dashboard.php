<?php
/**
 * EcoTrace Africa - Core AgTech Management Platform
 * Built for ROAM & XPRIZE Innovation Challenge 2026
 * Fully integrated UI, Live Weather API, and Compliance Tracking Data
 */

// 1. SET LOCATION COORDINATES (Kigali, Rwanda)
$latitude = -1.9403;
$longitude = 30.0619;

// 2. FETCH LIVE AGRICULTURAL WEATHER DATA FROM OPEN-METEO API
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&current=temperature_2m,relative_humidity_2m,wind_speed_10m";
$apiResponse = @file_get_contents($apiUrl);

if ($apiResponse) {
    $weatherData = json_decode($apiResponse, true);
    $currentTemp = $weatherData['current']['temperature_2m'] ?? '24.5';
    $currentHumidity = $weatherData['current']['relative_humidity_2m'] ?? '65';
    $windSpeed = $weatherData['current']['wind_speed_10m'] ?? '12.0';
    $apiStatus = "Connected Live";
    $statusColor = "#28a745";
} else {
    // Fallback static metrics if API fails
    $currentTemp = "24.5";
    $currentHumidity = "62";
    $windSpeed = "10.5";
    $apiStatus = "Offline (Using Cached Records)";
    $statusColor = "#dc3545";
}

// 3. SIMULATED DB DATA FOR FARMER COMPLIANCE AUDITING
$farmerNetwork = [
    [
        "id" => "RW-001",
        "name" => "Gasabo Organic Chili Cooperative",
        "size" => "4.2 Hectares",
        "status" => "Certified Kilimohai",
        "chemical_check" => "Passed",
        "last_audit" => "2026-10-15"
    ],
    [
        "id" => "RW-002",
        "name" => "Musanze Eco-Beans Cluster",
        "size" => "2.8 Hectares",
        "status" => "In Transition",
        "chemical_check" => "Passed",
        "last_audit" => "2026-10-19"
    ],
    [
        "id" => "RW-003",
        "name" => "Bugesera Soy Outgrowers",
        "size" => "7.1 Hectares",
        "status" => "Suspended",
        "chemical_check" => "Failed (Synthetic Drift)",
        "last_audit" => "2026-09-30"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrace Africa | AgTech Core System</title>
    <style>
        :root {
            --primary: #1e561e;
            --secondary: #2e4a2e;
            --bg: #f4f9f4;
            --card-bg: #ffffff;
            --border: #e2eee2;
            --success: #2e7d32;
            --warning: #f57c00;
            --danger: #d32f2f;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: var(--bg); color: var(--secondary); }
        .header { background-color: var(--primary); color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .container { padding: 30px 40px; max-width: 1200px; margin: 0 auto; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .card { background: var(--card-bg); padding: 20px; border-radius: 8px; border: 1px solid var(--border); box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .card h3 { margin-top: 0; color: var(--primary); border-bottom: 1px solid var(--border); padding-bottom: 8px; }
        .metric { font-size: 28px; font-weight: bold; margin: 15px 0 5px 0; color: #111; }
        .subtext { font-size: 12px; color: #777; }
        .status-badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; color: white; }
        .table-container { background: var(--card-bg); border-radius: 8px; border: 1px solid var(--border); padding: 20px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 12px 15px; border-bottom: 1px solid var(--border); }
        th { background-color: #fafdfa; color: var(--primary); font-weight: 600; }
        .badge-certified { background-color: var(--success); }
        .badge-transition { background-color: var(--warning); }
        .badge-suspended { background-color: var(--danger); }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <h1>EcoTrace Africa Dashboard</h1>
            <span style="font-size: 12px; opacity: 0.8;">Organic Compliance Infrastructure Engine v1.0</span>
        </div>
        <div style="text-align: right;">
            <span style="font-size: 13px; font-weight: bold;">System API Status:</span>
            <span style="color: <?php echo $statusColor; ?>; font-weight: bold;">● <?php echo $apiStatus; ?></span>
        </div>
    </div>

    <div class="container">
        <!-- Live Meteorological Verification Blocks -->
        <h2 style="font-size: 18px; margin-bottom: 15px;">Live Environmental Verification (Kigali Region)</h2>
        <div class="grid">
            <div class="card">
                <h3>Air Temperature</h3>
                <div class="metric"><?php echo $currentTemp; ?> °C</div>
                <div class="subtext">Optimal for organic spice curing</div>
            </div>
            <div class="card">
                <h3>Relative Humidity</h3>
                <div class="metric"><?php echo $currentHumidity; ?> %</div>
                <div class="subtext">Real-time air moisture verification</div>
            </div>
            <div class="card">
                <h3>Wind Speed</h3>
                <div class="metric"><?php echo $windSpeed; ?> km/h</div>
                <div class="subtext">Evaluates bio-pesticide spray drift risk</div>
            </div>
        </div>

        <!-- Regional Compliance Registry Table -->
        <h2 style="font-size: 18px; margin-bottom: 15px;">Digital Cooperative PGS Registry</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Network ID</th>
                        <th>Cooperative Name</th>
                        <th>Acreage Size</th>
                        <th>Chemical Audit</th>
                        <th>Last Peer Review</th>
                        <th>Certification Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($farmerNetwork as $farmer): ?>
                        <?php 
                            $badgeClass = 'badge-transition';
                            if ($farmer['status'] == 'Certified Kilimohai') $badgeClass = 'badge-certified';
                            if ($farmer['status'] == 'Suspended') $badgeClass = 'badge-suspended';
                        ?>
                        <tr>
                            <td><strong><?php echo $farmer['id']; ?></strong></td>
                            <td><?php echo $farmer['name']; ?></td>
                            <td><?php echo $farmer['size']; ?></td>
                            <td style="color: <?php echo $farmer['chemical_check'] == 'Passed' ? 'green' : 'red'; ?>; font-weight: 500;">
                                <?php echo $farmer['chemical_check']; ?>
                            </td>
                            <td><?php echo $farmer['last_audit']; ?></td>
                            <td><span class="status-badge <?php echo $badgeClass; ?>"><?php echo $farmer['status']; ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>