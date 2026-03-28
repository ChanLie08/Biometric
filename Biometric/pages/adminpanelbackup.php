<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../pictures/Ddo_logo.png"/>
    <title>HBS - BioAccess</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            min-height: 100vh;
            padding: 20px;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('../pictures/DDOPH PIC.jpg') no-repeat center center;
            background-size: cover;
            filter: blur(8px);
            z-index: -1;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .loading-overlay.hide {
            opacity: 0;
            pointer-events: none;
        }

        .loader {
            width: 80px;
            height: 80px;
            border: 8px solid rgba(255, 255, 255, 0.3);
            border-top: 8px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            color: white;
            font-size: 1.2em;
            margin-top: 20px;
            font-weight: 600;
        }

        .loading-subtext {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9em;
            margin-top: 10px;
        }

        .login-container {
            max-width: 500px;
            margin: 80px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .login-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .login-header h1 {
            font-size: 1.8em;
            margin-bottom: 5px;
        }

        .login-header p {
            opacity: 0.95;
            font-size: 0.95em;
            margin-top: 5px;
        }

        .hospital-name {
            font-size: 0.85em;
            opacity: 0.9;
            margin-top: 5px;
            font-weight: 500;
        }

        .login-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 0.95em;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
            display: none;
        }

        .user-info {
            background: #fff8e1;
            border: 1px solid #D4AF37;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            color: #6d4c00;
            font-size: 0.9em;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: none;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-text h1 {
            font-size: 1.8em;
            margin-bottom: 5px;
        }

        .header-text p {
            font-size: 0.95em;
            opacity: 0.95;
        }

        .hospital-subtitle {
            font-size: 0.85em;
            opacity: 0.9;
            margin-top: 3px;
        }

        .nav-links {
            display: flex;
            gap: 10px;
        }

        .nav-link {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .user-badge {
            background: rgba(255, 255, 255, 0.3);
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9em;
        }

        .content {
            padding: 40px;
        }

        .section-title {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #D4AF37;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .stat-card h3 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .stat-card p {
            opacity: 0.95;
            font-size: 1em;
        }

        .upload-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px dashed #dee2e6;
        }

        .file-upload-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .file-upload-box {
            background: white;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .file-upload-box.in-file {
            border-color: #28a745;
        }

        .file-upload-box.out-file {
            border-color: #dc3545;
        }

        .file-upload-box h4 {
            margin-bottom: 15px;
            color: #333;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px 0;
        }

        .file-input-wrapper input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        .file-input-label.in-label {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }

        .file-input-label.out-label {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .file-name {
            display: block;
            margin-top: 10px;
            color: #666;
            font-style: italic;
            font-size: 0.9em;
        }

        .file-name.selected {
            color: #28a745;
            font-weight: 600;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-success:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .table-container {
            overflow-x: auto;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-height: 600px;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #fff8e1;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        tbody tr:nth-child(even):hover {
            background: #fff8e1;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .type-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .type-in {
            background: #d4edda;
            color: #155724;
        }

        .type-out {
            background: #f8d7da;
            color: #721c24;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 1.1em;
        }

        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .filter-section input {
            padding: 10px 15px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 1em;
            width: 100%;
            max-width: 300px;
        }

        .filter-section input:focus {
            outline: none;
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .info-box {
            background: #e7f3ff;
            border: 2px solid #2196F3;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .info-box h4 {
            color: #1976D2;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .info-box ul {
            margin-left: 20px;
            color: #0d47a1;
        }

        .info-box li {
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 50px auto;
            }

            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-left {
                flex-direction: column;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
            }

            .content {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .file-upload-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.85em;
            }

            th, td {
                padding: 10px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loader"></div>
        <div class="loading-text">Loading Admin Panel...</div>
        <div class="loading-text">HBS - BioAccess</div>
        <div class="loading-subtext">Davao de Oro Provincial Hospital - Montevista</div>
    </div>

    <div class="login-container" id="loginScreen">
        <div class="login-header">
            <div class="login-logo">
                <img src="../pictures/Ddo_logo.png" alt="Davao de Oro Logo">
            </div>
            <h1>🔐 Admin Login</h1>
            <p>HBS - BioAccess</p>
            <p class="hospital-name">Davao de Oro Provincial Hospital - Montevista</p>
        </div>
        <div class="login-form">
            <div class="login-error" id="loginError"></div>
            
            <div class="user-info">
                <strong>⚠️ Authorized IT Personnel Only</strong>
            </div>

            <form onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="username">👤 Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        placeholder="Enter your username"
                        required
                        autocomplete="username"
                    >
                </div>

                <div class="form-group">
                    <label for="password">🔑 Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="login-btn">
                    Login to Admin Panel
                </button>
            </form>
        </div>
    </div>

    <div class="container" id="adminPanel">
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="../pictures/Ddo_logo.png" alt="Davao de Oro Logo">
                </div>
                <div class="header-text">
                    <h1>🔐 Admin Panel</h1>
                    <p>HBS - BioAccess</p>
                    <p class="hospital-subtitle">Davao de Oro Provincial Hospital - Montevista</p>
                </div>
            </div>
            <div class="nav-links">
                <span class="user-badge" id="currentUser">👤 Admin</span>
                <a href="employeeportal.php" class="nav-link">👤 Employee Portal</a>
                <button class="nav-link" onclick="logout()">🚪 Logout</button>
            </div>
        </div>

        <div class="content">
            <h2 class="section-title">📊 Dashboard Statistics</h2>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3 id="totalRecords">0</h3>
                    <p>Total Records</p>
                </div>
                <div class="stat-card">
                    <h3 id="totalEmployees">0</h3>
                    <p>Unique Employees</p>
                </div>
                <div class="stat-card">
                    <h3 id="inCount">0</h3>
                    <p>IN Records</p>
                </div>
                <div class="stat-card">
                    <h3 id="outCount">0</h3>
                    <p>OUT Records</p>
                </div>
            </div>

            <div class="upload-section">
                <h3 style="margin-bottom: 15px; color: #333; text-align: center;">📁 Import Biometric Records</h3>
                <p style="color: #666; margin-bottom: 20px; text-align: center;">Upload two separate files: BIOMETRIC IN and BIOMETRIC OUT</p>
                
                <div class="info-box">
                    <h4>📋 Upload Instructions</h4>
                    <ul>
                        <li><strong>Required columns (both files):</strong> CATS, DATE, TIME</li>
                        <li>IN file will be marked as "IN" type automatically</li>
                        <li>OUT file will be marked as "OUT" type automatically</li>
                        <li>Upload both files, then click "Import Data"</li>
                        <li>Data will be stored in SQL Server database (BIOMETRIC.dbo.Bio_records)</li>
                        <li>All devices on the network will see the same data in real-time</li>
                    </ul>
                </div>

                <div class="file-upload-grid">
                    <div class="file-upload-box in-file">
                        <h4>📥 BIOMETRIC IN File</h4>
                        <div class="file-input-wrapper">
                            <input type="file" id="fileInputIn" accept=".xlsx, .xls" onchange="handleFileSelectIn(event)">
                            <label for="fileInputIn" class="file-input-label in-label">
                                Choose IN File
                            </label>
                        </div>
                        <span class="file-name" id="fileNameIn">No file selected</span>
                    </div>

                    <div class="file-upload-box out-file">
                        <h4>📤 BIOMETRIC OUT File</h4>
                        <div class="file-input-wrapper">
                            <input type="file" id="fileInputOut" accept=".xlsx, .xls" onchange="handleFileSelectOut(event)">
                            <label for="fileInputOut" class="file-input-label out-label">
                                Choose OUT File
                            </label>
                        </div>
                        <span class="file-name" id="fileNameOut">No file selected</span>
                    </div>
                </div>

                <div class="button-group">
                    <button class="btn btn-success" onclick="importData()" id="importBtn" disabled>
                        ✓ Import Data
                    </button>
                    <button class="btn btn-danger" onclick="clearDatabase()">
                        🗑️ Clear Database
                    </button>
                    <button class="btn btn-secondary" onclick="exportAllData()">
                        📥 Export All Data
                    </button>
                </div>
            </div>

            <div id="adminMessage"></div>

            <div class="filter-section" id="filterSection" style="display: none;">
                <label for="searchInput" style="display: block; margin-bottom: 10px; font-weight: 600; color: #333;">
                    🔍 Search Records:
                </label>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Search by CATS No., Date, Time, or Type..."
                    oninput="filterTable()"
                >
            </div>

            <div class="table-container" id="tableContainer" style="display: none;">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>CATS</th>
                            <th>DATE AND TIME</th>
                            <th>TYPE</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>

            <div class="empty-state" id="emptyState">
                <h3>📋 No Data Available</h3>
                <p>Upload BIOMETRIC IN and OUT files to get started</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        // API Base URL - Change this to your server's IP address or domain
        const API_URL = '../process/API.php';

        const validUsers = {
            'ITS-rhones': 'Clickonce-01',
            'ITS-bogart': 'Clickonce-01',
            'ITS-harden': 'Clickonce-01',
            'ITS-jay': 'Clickonce-01'
        };

        let currentLoggedInUser = null;
        let biometricsRecords = [];
        let selectedFileIn = null;
        let selectedFileOut = null;

        window.onload = function() {
            showLoading();
            
            setTimeout(() => {
                const savedUser = sessionStorage.getItem('loggedInUser');
                if (savedUser) {
                    currentLoggedInUser = savedUser;
                    loadDataFromServer();
                } else {
                    hideLoading();
                }
            }, 1500);
        };

        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hide');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hide');
        }

        function handleLogin(event) {
            event.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorDiv = document.getElementById('loginError');

            if (validUsers[username] && validUsers[username] === password) {
                showLoading();
                
                setTimeout(() => {
                    currentLoggedInUser = username;
                    sessionStorage.setItem('loggedInUser', username);
                    errorDiv.style.display = 'none';
                    loadDataFromServer();
                }, 1200);
            } else {
                errorDiv.textContent = '❌ Invalid username or password. Please try again.';
                errorDiv.style.display = 'block';
                document.getElementById('password').value = '';
            }
        }

        function showAdminPanel() {
            document.getElementById('loginScreen').style.display = 'none';
            document.getElementById('adminPanel').style.display = 'block';
            document.getElementById('currentUser').textContent = `👤 ${currentLoggedInUser}`;
            hideLoading();
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                showLoading();
                
                setTimeout(() => {
                    sessionStorage.removeItem('loggedInUser');
                    currentLoggedInUser = null;
                    document.getElementById('loginScreen').style.display = 'block';
                    document.getElementById('adminPanel').style.display = 'none';
                    document.getElementById('username').value = '';
                    document.getElementById('password').value = '';
                    hideLoading();
                }, 800);
            }
        }

        // API Functions
        async function loadDataFromServer() {
            try {
                const response = await fetch(`${API_URL}?action=get_records`);
                const result = await response.json();
                
                if (result.success) {
                    biometricsRecords = result.data;
                    displayData();
                    updateStatsFromServer();
                    showAdminPanel();
                } else {
                    console.error('Error loading data:', result.message);
                    showMessage('Error loading data from server', 'error');
                    showAdminPanel();
                }
            } catch (error) {
                console.error('Error loading data:', error);
                showMessage('Error connecting to server', 'error');
                showAdminPanel();
            }
        }

        async function updateStatsFromServer() {
            try {
                const response = await fetch(`${API_URL}?action=get_stats`);
                const result = await response.json();
                
                if (result.success) {
                    document.getElementById('totalRecords').textContent = result.stats.total;
                    document.getElementById('totalEmployees').textContent = result.stats.uniqueEmployees;
                    document.getElementById('inCount').textContent = result.stats.inCount;
                    document.getElementById('outCount').textContent = result.stats.outCount;
                }
            } catch (error) {
                console.error('Error updating stats:', error);
            }
        }

        function handleFileSelectIn(event) {
            selectedFileIn = event.target.files[0];
            const fileName = document.getElementById('fileNameIn');
            
            if (selectedFileIn) {
                fileName.textContent = `✓ ${selectedFileIn.name}`;
                fileName.classList.add('selected');
            } else {
                fileName.textContent = 'No file selected';
                fileName.classList.remove('selected');
            }
            
            updateImportButton();
        }

        function handleFileSelectOut(event) {
            selectedFileOut = event.target.files[0];
            const fileName = document.getElementById('fileNameOut');
            
            if (selectedFileOut) {
                fileName.textContent = `✓ ${selectedFileOut.name}`;
                fileName.classList.add('selected');
            } else {
                fileName.textContent = 'No file selected';
                fileName.classList.remove('selected');
            }
            
            updateImportButton();
        }

        function updateImportButton() {
            const importBtn = document.getElementById('importBtn');
            importBtn.disabled = !(selectedFileIn && selectedFileOut);
        }

        function processFile(file, type) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    try {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                        const jsonData = XLSX.utils.sheet_to_json(firstSheet);

                        const records = [];
                        let skipped = 0;

                        jsonData.forEach(row => {
                            const catsNo = String(row['CATS'] || row['cats'] || '').trim();
                            const dateStr = row['DATE'] || row['Date'] || row['date'] || '';
                            const timeStr = row['TIME'] || row['Time'] || row['time'] || '';
                            
                            if (!catsNo || !dateStr || !timeStr) {
                                skipped++;
                                return;
                            }

                            const formattedDate = formatDate(dateStr);
                            const formattedTime = formatTime(timeStr);
                            
                            if (!formattedDate || !formattedTime) {
                                skipped++;
                                return;
                            }

                            records.push({
                                cats: catsNo,
                                dateTime: `${formattedDate} ${formattedTime}`,
                                type: type
                            });
                        });

                        resolve({ records, skipped });
                    } catch (error) {
                        reject(error);
                    }
                };

                reader.onerror = () => reject(new Error('Failed to read file'));
                reader.readAsArrayBuffer(file);
            });
        }

        async function importData() {
            if (!selectedFileIn || !selectedFileOut) {
                showMessage('Please select both IN and OUT files', 'error');
                return;
            }

            try {
                showMessage('Processing files...', 'info');

                const [inResults, outResults] = await Promise.all([
                    processFile(selectedFileIn, 'IN'),
                    processFile(selectedFileOut, 'OUT')
                ]);

                const newRecords = [...inResults.records, ...outResults.records];

                if (newRecords.length === 0) {
                    showMessage('No valid records found in the files', 'error');
                    return;
                }

                // Send to server
                const response = await fetch(`${API_URL}?action=import_records`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ records: newRecords })
                });

                const result = await response.json();

                if (result.success) {
                    // Reload data from server
                    await loadDataFromServer();
                    
                    let message = `✅ Successfully imported ${result.imported} records!<br>`;
                    message += `📥 IN records: ${inResults.records.length}`;
                    if (inResults.skipped > 0) message += ` (${inResults.skipped} skipped)`;
                    message += `<br>📤 OUT records: ${outResults.records.length}`;
                    if (outResults.skipped > 0) message += ` (${outResults.skipped} skipped)`;
                    showMessage(message, 'success');
                } else {
                    showMessage(`Error importing data: ${result.message}`, 'error');
                }
                
                // Reset file inputs
                document.getElementById('fileInputIn').value = '';
                document.getElementById('fileInputOut').value = '';
                document.getElementById('fileNameIn').textContent = 'No file selected';
                document.getElementById('fileNameOut').textContent = 'No file selected';
                document.getElementById('fileNameIn').classList.remove('selected');
                document.getElementById('fileNameOut').classList.remove('selected');
                selectedFileIn = null;
                selectedFileOut = null;
                updateImportButton();
                
            } catch (error) {
                showMessage(`Error importing files: ${error.message}`, 'error');
                console.error('Import error:', error);
            }
        }

        function formatDate(excelDate) {
            if (!excelDate) return '';
            
            if (typeof excelDate === 'string') {
                const parts = excelDate.split('/');
                if (parts.length === 3) {
                    const month = parts[0].padStart(2, '0');
                    const day = parts[1].padStart(2, '0');
                    const year = parts[2];
                    return `${month}/${day}/${year}`;
                }
                return excelDate;
            }
            
            if (typeof excelDate === 'number') {
                const date = XLSX.SSF.parse_date_code(excelDate);
                return `${String(date.m).padStart(2, '0')}/${String(date.d).padStart(2, '0')}/${date.y}`;
            }
            
            return '';
        }

        function formatTime(time) {
            if (!time) return '';
            
            if (typeof time === 'string') {
                if (/^\d{1,2}:\d{2}$/.test(time)) {
                    const parts = time.split(':');
                    return `${parts[0]}:${parts[1]}`;
                }
                return time;
            }
            
            if (typeof time === 'number') {
                const totalMinutes = Math.round(time * 24 * 60);
                const hours = Math.floor(totalMinutes / 60);
                const minutes = totalMinutes % 60;
                return `${hours}:${String(minutes).padStart(2, '0')}`;
            }
            
            return '';
        }

        function displayData() {
            const tbody = document.getElementById('tableBody');
            const container = document.getElementById('tableContainer');
            const emptyState = document.getElementById('emptyState');
            const filterSection = document.getElementById('filterSection');
            
            if (biometricsRecords.length === 0) {
                container.style.display = 'none';
                filterSection.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            container.style.display = 'block';
            filterSection.style.display = 'block';
            emptyState.style.display = 'none';
            
            tbody.innerHTML = '';
    
    // Sort records: by date/time ascending, then IN before OUT
    const sortedRecords = [...biometricsRecords].sort((a, b) => {
        // First sort by date/time
        const dateCompare = new Date(a.dateTime) - new Date(b.dateTime);
        if (dateCompare !== 0) return dateCompare;
        
        // If same date/time, IN comes before OUT
        if (a.type === 'IN' && b.type === 'OUT') return -1;
        if (a.type === 'OUT' && b.type === 'IN') return 1;
        return 0;
    });
    
    sortedRecords.forEach(record => {  // ← Changed from biometricsRecords to sortedRecords
        const row = tbody.insertRow();
        row.innerHTML = `
            <td>${record.cats}</td>
            <td>${record.dateTime}</td>
            <td><span class="type-badge type-${record.type.toLowerCase()}">${record.type}</span></td>
        `;
    });
        }

        function filterTable() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const tbody = document.getElementById('tableBody');
            const rows = tbody.getElementsByTagName('tr');

            for (let row of rows) {
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let cell of cells) {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }

        function exportAllData() {
            if (biometricsRecords.length === 0) {
                showMessage('No data to export', 'error');
                return;
            }

            const data = biometricsRecords.map(record => ({
                'CATS': record.cats,
                'DATE AND TIME': record.dateTime,
                'TYPE': record.type
            }));

            const ws = XLSX.utils.json_to_sheet(data);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Biometric Records');

            const filename = `Biometric_Records_${new Date().toISOString().split('T')[0]}.xlsx`;
            XLSX.writeFile(wb, filename);
            
            showMessage('Data exported successfully!', 'success');
        }

        async function clearDatabase() {
            if (biometricsRecords.length === 0) {
                showMessage('Database is already empty', 'info');
                return;
            }

            if (confirm(`Are you sure you want to clear all ${biometricsRecords.length} records? This action cannot be undone.`)) {
                try {
                    const response = await fetch(`${API_URL}?action=clear_database`, {
                        method: 'DELETE'
                    });

                    const result = await response.json();

                    if (result.success) {
                        biometricsRecords = [];
                        displayData();
                        updateStatsFromServer();
                        showMessage('Database cleared successfully', 'success');
                    } else {
                        showMessage(`Error clearing database: ${result.message}`, 'error');
                    }
                } catch (error) {
                    showMessage(`Error clearing database: ${error.message}`, 'error');
                    console.error('Clear error:', error);
                }
            }
        }

        function showMessage(message, type) {
            const messageDiv = document.getElementById('adminMessage');
            const className = type === 'error' ? 'alert-error' : 
                            type === 'success' ? 'alert-success' : 'alert-info';
            
            messageDiv.innerHTML = `<div class="alert ${className}">${message}</div>`;
            
            setTimeout(() => {
                messageDiv.innerHTML = '';
            }, 7000);
        }
    </script>
</body>
</html>