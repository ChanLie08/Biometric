<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Microsoft SQL Server configuration
$serverName = "CHANLIE"; // or your server IP address, e.g., "192.168.1.100"
$database = "BIOMETRIC";
$username = "sa";  // Change this to your SQL Server username
$password = "chan1234";    // Change this to your SQL Server password

// Connection info array
$connectionInfo = array(
    "Database" => $database,
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

// Create connection
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    $errors = sqlsrv_errors();
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection failed',
        'error' => $errors[0]['message']
    ]);
    exit;
}

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle different actions
switch($action) {
    case 'get_records':
        if ($method === 'GET') {
            getRecords($conn);
        }
        break;
        
    case 'import_records':
        if ($method === 'POST') {
            importRecords($conn);
        }
        break;
        
    case 'clear_database':
        if ($method === 'DELETE') {
            clearDatabase($conn);
        }
        break;
        
    case 'get_stats':
        if ($method === 'GET') {
            getStats($conn);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

// Close connection
sqlsrv_close($conn);

function getRecords($conn) {
    $sql = "SELECT * FROM dbo.Bio_records ORDER BY date_time ASC, CASE WHEN type = 'IN' THEN 0 ELSE 1 END";
    $stmt = sqlsrv_query($conn, $sql);
    
    if ($stmt === false) {
        $errors = sqlsrv_errors();
        echo json_encode([
            'success' => false, 
            'message' => 'Error fetching records',
            'error' => $errors[0]['message']
        ]);
        return;
    }
    
    $records = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $records[] = array(
            'id' => $row['id'],
            'cats' => $row['cats_no'],
            'dateTime' => $row['date_time'],
            'type' => $row['type']
        );
    }
    
    sqlsrv_free_stmt($stmt);
    echo json_encode(['success' => true, 'data' => $records]);
}

function importRecords($conn) {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['records']) || !is_array($input['records'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid data format']);
        return;
    }
    
    $records = $input['records'];
    $imported = 0;
    
    $sql = "INSERT INTO dbo.Bio_records (cats_no, date_time, type) VALUES (?, ?, ?)";
    
    foreach ($records as $record) {
        if (isset($record['cats']) && isset($record['dateTime']) && isset($record['type'])) {
            $params = array($record['cats'], $record['dateTime'], $record['type']);
            $stmt = sqlsrv_query($conn, $sql, $params);
            
            if ($stmt === false) {
                $errors = sqlsrv_errors();
                echo json_encode([
                    'success' => false, 
                    'message' => 'Error importing record',
                    'error' => $errors[0]['message']
                ]);
                return;
            }
            
            sqlsrv_free_stmt($stmt);
            $imported++;
        }
    }
    
    echo json_encode([
        'success' => true, 
        'message' => "Successfully imported $imported records",
        'imported' => $imported
    ]);
}

function clearDatabase($conn) {
    $sql = "DELETE FROM dbo.Bio_records";
    $stmt = sqlsrv_query($conn, $sql);
    
    if ($stmt === false) {
        $errors = sqlsrv_errors();
        echo json_encode([
            'success' => false, 
            'message' => 'Error clearing database',
            'error' => $errors[0]['message']
        ]);
        return;
    }
    
    $rowsAffected = sqlsrv_rows_affected($stmt);
    sqlsrv_free_stmt($stmt);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Database cleared successfully', 
        'deleted' => $rowsAffected
    ]);
}

function getStats($conn) {
    // Get total count
    $sql = "SELECT COUNT(*) as total FROM dbo.Bio_records";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error fetching stats']);
        return;
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $total = $row['total'];
    sqlsrv_free_stmt($stmt);
    
    // Get unique employees
    $sql = "SELECT COUNT(DISTINCT cats_no) as unique_count FROM dbo.Bio_records";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $uniqueEmployees = $row['unique_count'];
    sqlsrv_free_stmt($stmt);
    
    // Get IN count
    $sql = "SELECT COUNT(*) as in_count FROM dbo.Bio_records WHERE type = 'IN'";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $inCount = $row['in_count'];
    sqlsrv_free_stmt($stmt);
    
    // Get OUT count
    $sql = "SELECT COUNT(*) as out_count FROM dbo.Bio_records WHERE type = 'OUT'";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $outCount = $row['out_count'];
    sqlsrv_free_stmt($stmt);
    
    echo json_encode([
        'success' => true,
        'stats' => [
            'total' => $total,
            'uniqueEmployees' => $uniqueEmployees,
            'inCount' => $inCount,
            'outCount' => $outCount
        ]
    ]);
}
?>