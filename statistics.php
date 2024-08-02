<?php
// statistics.php
session_start();
include 'db_config.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

$current_year = date('Y');

// Проверка и добавление колонки created_at, если она отсутствует
$check_column_query = "SHOW COLUMNS FROM resumes LIKE 'created_at'";
$column_result = $conn->query($check_column_query);
if ($column_result->num_rows == 0) {
    $alter_table_query = "ALTER TABLE resumes ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
    $conn->query($alter_table_query);
}

// Получение выбранного периода, месяца, квартала и года
$selected_period = isset($_GET['period']) ? $_GET['period'] : 'month';
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('m');
$selected_quarter = isset($_GET['quarter']) ? $_GET['quarter'] : ceil(date('m') / 3);
$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Запрос для месячной статистики
$sql_status_month = "SELECT 
    COUNT(CASE WHEN status = 0 THEN 1 END) as stage_1,
    COUNT(CASE WHEN status = 1 THEN 1 END) as stage_2,
    COUNT(CASE WHEN status = 2 THEN 1 END) as stage_3,
    COUNT(CASE WHEN status = 3 THEN 1 END) as stage_4,
    COUNT(CASE WHEN status = 4 THEN 1 END) as stage_5,
    COUNT(CASE WHEN is_archived = 1 THEN 1 END) as archived,
    COUNT(*) as uploaded
    FROM resumes 
    WHERE MONTH(created_at) = $selected_month AND YEAR(created_at) = $current_year";

$result_status_month = $conn->query($sql_status_month);
$status_stats_month = $result_status_month->fetch_assoc();

// Запрос для квартальной статистики
$quarter_start_month = ($selected_quarter - 1) * 3 + 1;
$quarter_end_month = $quarter_start_month + 2;
$sql_status_quarter = "SELECT 
    COUNT(CASE WHEN status = 0 THEN 1 END) as stage_1,
    COUNT(CASE WHEN status = 1 THEN 1 END) as stage_2,
    COUNT(CASE WHEN status = 2 THEN 1 END) as stage_3,
    COUNT(CASE WHEN status = 3 THEN 1 END) as stage_4,
    COUNT(CASE WHEN status = 4 THEN 1 END) as stage_5,
    COUNT(CASE WHEN is_archived = 1 THEN 1 END) as archived,
    COUNT(*) as uploaded
    FROM resumes 
    WHERE MONTH(created_at) BETWEEN $quarter_start_month AND $quarter_end_month AND YEAR(created_at) = $current_year";

$result_status_quarter = $conn->query($sql_status_quarter);
$status_stats_quarter = $result_status_quarter->fetch_assoc();

// Запрос для годовой статистики
$sql_status_year = "SELECT 
    COUNT(CASE WHEN status = 0 THEN 1 END) as stage_1,
    COUNT(CASE WHEN status = 1 THEN 1 END) as stage_2,
    COUNT(CASE WHEN status = 2 THEN 1 END) as stage_3,
    COUNT(CASE WHEN status = 3 THEN 1 END) as stage_4,
    COUNT(CASE WHEN status = 4 THEN 1 END) as stage_5,
    COUNT(CASE WHEN is_archived = 1 THEN 1 END) as archived,
    COUNT(*) as uploaded
    FROM resumes 
    WHERE YEAR(created_at) = $selected_year";

$result_status_year = $conn->query($sql_status_year);
$status_stats_year = $result_status_year->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #FAF3E0;
            color: #000000;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: transparent;
        }

        header .logo {
            height: 50px;
        }


        .sidebar {
            width: 15%;
            background-color: #FAF3E0;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Changed to flex-start to align items at the top */
            align-items: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .sidebar .top, .sidebar .bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            color: #000000;
            text-decoration: none;
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

        .sidebar a:hover {
            background-color: #F8A455;
        }
        .content {
            width: 65%;
            padding: 20px;
            overflow-y: auto;
            position: center;
            background-color: #000000; /* Updated background color */
            margin-left: 10px;
            border-radius: 10px;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 1000px;
            text-align: left;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 18px;
        }

        canvas {
            max-width: 100%;
            height: 250px; /* Уменьшение высоты графиков */
        }

        form {
            margin-bottom: 20px;
        }
        .divider {
            position: absolute;
            left: 15%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #ff4c61; /* Updated divider color */
        }

    </style>
</head>
<body>
<div class="sidebar">
    <div class="top">
        <div class="logo">
            <img src="Logo1.1.png" alt="HRMS Logo">
            <br>
            <br>
        </div>
        <a href="main.php">HOME</a>
        <a href="add_cv.php">ADD CV</a>
        <a href="list_cv.php">CVs LIST</a>
        <a href="archive.php">ARCHIVE</a>
        <a href="statistics.php">STATISTICS</a>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <br>
    <div class="bottom">
        <a href="about.php">ABOUT</a>
        <a href="faq.php">FAQ</a>
        <a href="contacts.php">CONTACTS</a>
    </div>
</div>
<div class="divider"></div>
    <div class="container">
        <h1>Resume Statistics</h1>
        <form id="periodForm" method="get" action="statistics.php">
            <label for="period">Select Period: </label>
            <select id="period" name="period" onchange="showPeriod()">
                <option value="month" <?php if ($selected_period == 'month') echo 'selected'; ?>>Month</option>
                <option value="quarter" <?php if ($selected_period == 'quarter') echo 'selected'; ?>>Quarter</option>
                <option value="year" <?php if ($selected_period == 'year') echo 'selected'; ?>>Year</option>
            </select>
            <br>
            <div id="monthSelect" style="display: none;">
                <label for="month">Select Month: </label>
                <input type="month" id="month" name="month" value="<?php echo $current_year . '-' . str_pad($selected_month, 2, '0', STR_PAD_LEFT); ?>">
            </div>
            <div id="quarterSelect" style="display: none;">
                <label for="quarter">Select Quarter: </label>
                <select id="quarter" name="quarter">
                    <option value="1" <?php if ($selected_quarter == 1) echo 'selected'; ?>>Q1</option>
                    <option value="2" <?php if ($selected_quarter == 2) echo 'selected'; ?>>Q2</option>
                    <option value="3" <?php if ($selected_quarter == 3) echo 'selected'; ?>>Q3</option>
                    <option value="4" <?php if ($selected_quarter == 4) echo 'selected'; ?>>Q4</option>
                </select>
            </div>
            <div id="yearSelect" style="display: none;">
                <label for="year">Select Year: </label>
                <input type="number" id="year" name="year" value="<?php echo $selected_year; ?>" min="2000" max="<?php echo $current_year; ?>">
            </div>
            <br>
            <button type="submit">Show</button>
        </form>

        <div id="monthSection" style="display: none;">
            <h2>Monthly Statistics</h2>
            <canvas id="statusMonthChart"></canvas>
        </div>

        <div id="quarterSection" style="display: none;">
            <h2>Quarterly Statistics</h2>
            <canvas id="statusQuarterChart"></canvas>
        </div>

        <div id="yearSection" style="display: none;">
            <h2>Yearly Statistics</h2>
            <canvas id="statusYearChart"></canvas>
        </div>
    </div>
    <script>
        function showPeriod() {
            var period = document.getElementById("period").value;
            document.getElementById("monthSelect").style.display = (period == "month") ? "block" : "none";
            document.getElementById("quarterSelect").style.display = (period == "quarter") ? "block" : "none";
            document.getElementById("yearSelect").style.display = (period == "year") ? "block" : "none";

            document.getElementById("monthSection").style.display = (period == "month") ? "block" : "none";
            document.getElementById("quarterSection").style.display = (period == "quarter") ? "block" : "none";
            document.getElementById("yearSection").style.display = (period == "year") ? "block" : "none";
        }

        // Initialize with selected period
        showPeriod();

        // Data for monthly status chart
        var statusMonthData = {
            labels: ['Uploaded', 'Этап 1', 'Этап 2', 'Этап 3', 'Этап 4', 'Этап 5', 'Archived'],
            datasets: [{
                label: 'Number of Resumes',
                data: [
                    <?php echo $status_stats_month['uploaded']; ?>,
                    <?php echo $status_stats_month['stage_1']; ?>,
                    <?php echo $status_stats_month['stage_2']; ?>,
                    <?php echo $status_stats_month['stage_3']; ?>,
                    <?php echo $status_stats_month['stage_4']; ?>,
                    <?php echo $status_stats_month['stage_5']; ?>,
                    <?php echo $status_stats_month['archived']; ?>
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        var statusMonthCtx = document.getElementById('statusMonthChart').getContext('2d');
        var statusMonthChart = new Chart(statusMonthCtx, {
            type: 'bar',
            data: statusMonthData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for quarterly status chart
        var statusQuarterData = {
            labels: ['Uploaded', 'Этап 1', 'Этап 2', 'Этап 3', 'Этап 4', 'Этап 5', 'Archived'],
            datasets: [{
                label: 'Number of Resumes',
                data: [
                    <?php echo $status_stats_quarter['uploaded']; ?>,
                    <?php echo $status_stats_quarter['stage_1']; ?>,
                    <?php echo $status_stats_quarter['stage_2']; ?>,
                    <?php echo $status_stats_quarter['stage_3']; ?>,
                    <?php echo $status_stats_quarter['stage_4']; ?>,
                    <?php echo $status_stats_quarter['stage_5']; ?>,
                    <?php echo $status_stats_quarter['archived']; ?>
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        var statusQuarterCtx = document.getElementById('statusQuarterChart').getContext('2d');
        var statusQuarterChart = new Chart(statusQuarterCtx, {
            type: 'bar',
            data: statusQuarterData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for yearly status chart
        var statusYearData = {
            labels: ['Uploaded', 'Этап 1', 'Этап 2', 'Этап 3', 'Этап 4', 'Этап 5', 'Archived'],
            datasets: [{
                label: 'Number of Resumes',
                data: [
                    <?php echo $status_stats_year['uploaded']; ?>,
                    <?php echo $status_stats_year['stage_1']; ?>,
                    <?php echo $status_stats_year['stage_2']; ?>,
                    <?php echo $status_stats_year['stage_3']; ?>,
                    <?php echo $status_stats_year['stage_4']; ?>,
                    <?php echo $status_stats_year['stage_5']; ?>,
                    <?php echo $status_stats_year['archived']; ?>
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        var statusYearCtx = document.getElementById('statusYearChart').getContext('2d');
        var statusYearChart = new Chart(statusYearCtx, {
            type: 'bar',
            data: statusYearData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>