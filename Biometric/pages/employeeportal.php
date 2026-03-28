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
            background: linear-gradient(135deg, #8B6914 0%, #D4AF37 100%);
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
            background: linear-gradient(135deg, #8B6914 0%, #D4AF37 100%);
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

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
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

        .nav-link {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
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

        .search-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 1em;
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

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
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

        .btn-primary {
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
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

        .summary-section {
            background: linear-gradient(135deg, #D4AF37 0%, #8B6914 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item h3 {
            font-size: 2em;
            margin-bottom: 5px;
        }

        .summary-item p {
            opacity: 0.95;
            font-size: 0.9em;
        }

        .info-box {
            background: #fff8e1;
            border-left: 4px solid #D4AF37;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-box p {
            color: #6d4c00;
            font-size: 0.95em;
            line-height: 1.6;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 3px solid #D4AF37;
            margin-top: 40px;
        }

        .footer p {
            color: #6c757d;
            font-size: 0.9em;
            margin: 5px 0;
        }

        .footer strong {
            color: #333;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-left {
                flex-direction: column;
            }

            .content {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            table {
                font-size: 0.85em;
            }

            th, td {
                padding: 10px 8px;
            }

            .summary-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loader"></div>
        <div class="loading-text">Loading Employee Portal...</div>
        <div class="loading-text">HBS - BioAccess</div>
        <div class="loading-subtext">Davao de Oro Provincial Hospital - Montevista</div>
    </div>

    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="../pictures/Ddo_logo.png" alt="Davao de Oro Logo">
                </div>
                <div class="header-text">
                    <h1>👤 Employee Portal</h1>
                    <p>View Your Biometric Records</p>
                    <p class="hospital-subtitle">Davao de Oro Provincial Hospital - Montevista</p>
                </div>
            </div>
        </div>

        <div class="content">
            <h2 class="section-title">🔍 Search Your Records</h2>

            <div class="info-box">
                <p><strong>📌 Instructions:</strong> Enter your CATS number and select the date range to view your attendance records. You can export your records to Excel for your personal records.</p>
            </div>

            <div class="search-section">
                <div class="form-row">
                    <div class="form-group">
                        <label for="catsNo">
                            <span style="color: #dc3545;">*</span> CATS No.
                        </label>
                        <input 
                            type="text" 
                            id="catsNo" 
                            placeholder="e.g., 11942"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="startDate">
                            <span style="color: #dc3545;">*</span> Start Date
                        </label>
                        <input type="date" id="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">
                            <span style="color: #dc3545;">*</span> End Date
                        </label>
                        <input type="date" id="endDate" required>
                    </div>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" onclick="searchRecords()">
                        🔎 Search Records
                    </button>
                    <button class="btn btn-success" onclick="exportToExcel()" id="exportBtn" style="display: none;">
                        📥 Export to Excel
                    </button>
                    <button class="btn btn-secondary" onclick="clearSearch()">
                        🔄 Clear Search
                    </button>
                </div>
            </div>

            <div id="employeeMessage"></div>

            <div id="summarySection" class="summary-section" style="display: none;">
                <h3 style="margin-bottom: 10px;">📊 Summary</h3>
                <div class="summary-grid">
                    <div class="summary-item">
                        <h3 id="totalRecords">0</h3>
                        <p>Total Records</p>
                    </div>
                    <div class="summary-item">
                        <h3 id="inCount">0</h3>
                        <p>IN Records</p>
                    </div>
                    <div class="summary-item">
                        <h3 id="outCount">0</h3>
                        <p>OUT Records</p>
                    </div>
                    <div class="summary-item">
                        <h3 id="dateRange">N/A</h3>
                        <p>Date Range</p>
                    </div>
                </div>
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
                <h3>🔍 Search for Your Records</h3>
                <p>Enter your CATS number and select a date range to view your biometric attendance records</p>
            </div>

            <div class="footer">
                <p><strong>Developed by IT-IHOMS</strong></p>
                <p>Davao de Oro Provincial Hospital - Montevista</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        // API Base URL - Change this to your server's IP address or domain
        const API_URL = '../process/API.php';
        
        let currentResults = [];

        window.onload = function() {
            showLoading();

            setTimeout(() => {
                const today = new Date();
                const thirtyDaysAgo = new Date(today);
                thirtyDaysAgo.setDate(today.getDate() - 30);

                document.getElementById('endDate').value = today.toISOString().split('T')[0];
                document.getElementById('startDate').value = thirtyDaysAgo.toISOString().split('T')[0];

                hideLoading();
            }, 1200);
        };

        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hide');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hide');
        }

        async function searchRecords() {
            const catsNo = document.getElementById('catsNo').value.trim();
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (!catsNo) {
                showMessage('Please enter your CATS number', 'error');
                return;
            }

            if (!startDate || !endDate) {
                showMessage('Please select both start and end dates', 'error');
                return;
            }

            if (new Date(startDate) > new Date(endDate)) {
                showMessage('Start date cannot be after end date', 'error');
                return;
            }

            showLoading();

            try {
                // Fetch records from server
                const response = await fetch(`${API_URL}?action=get_records`);
                const result = await response.json();

                if (!result.success) {
                    showMessage('Error loading data from server: ' + result.message, 'error');
                    displayResults([]);
                    hideLoading();
                    return;
                }

                const database = result.data;

                if (!database || database.length === 0) {
                    showMessage('No biometric data available. Please contact your administrator.', 'error');
                    displayResults([]);
                    hideLoading();
                    return;
                }

                // Filter records by CATS and date range
                const filteredRecords = database.filter(record => {
                    // Extract date from dateTime (format: "MM/DD/YYYY HH:MM")
                    const dateTimeParts = record.dateTime.split(' ');
                    if (dateTimeParts.length < 2) return false;
                    
                    const dateParts = dateTimeParts[0].split('/');
                    if (dateParts.length !== 3) return false;
                    
                    const recordDate = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]);
                    const start = new Date(startDate);
                    const end = new Date(endDate);
                    
                    return record.cats === catsNo && 
                           recordDate >= start && 
                           recordDate <= end;
                });

                currentResults = filteredRecords;
                displayResults(filteredRecords);

                if (filteredRecords.length === 0) {
                    showMessage('No records found for the specified criteria', 'info');
                } else {
                    showMessage(`Found ${filteredRecords.length} record(s) for CATS No. ${catsNo}`, 'success');
                    document.getElementById('exportBtn').style.display = 'inline-block';
                }

                hideLoading();
            } catch (error) {
                console.error('Error fetching records:', error);
                showMessage('Error connecting to server. Please contact to BOGART.', 'error');
                displayResults([]);
                hideLoading();
            }
        }

        function displayResults(records) {
            const tbody = document.getElementById('tableBody');
            const container = document.getElementById('tableContainer');
            const emptyState = document.getElementById('emptyState');
            const summarySection = document.getElementById('summarySection');
            
            if (records.length === 0) {
                container.style.display = 'none';
                summarySection.style.display = 'none';
                emptyState.style.display = 'block';
                document.getElementById('exportBtn').style.display = 'none';
                return;
            }

            container.style.display = 'block';
            summarySection.style.display = 'block';
            emptyState.style.display = 'none';
            
            tbody.innerHTML = '';
            
            // Helper function to parse date string "MM/DD/YYYY H:MM"
            function parseDateTime(dateTimeStr) {
                try {
                    const parts = dateTimeStr.split(' ');
                    if (parts.length !== 2) return new Date(0);
                    
                    const dateParts = parts[0].split('/');
                    const timeParts = parts[1].split(':');
                    
                    if (dateParts.length !== 3 || timeParts.length !== 2) return new Date(0);
                    
                    const month = parseInt(dateParts[0]) - 1; // Month is 0-indexed
                    const day = parseInt(dateParts[1]);
                    const year = parseInt(dateParts[2]);
                    const hour = parseInt(timeParts[0]);
                    const minute = parseInt(timeParts[1]);
                    
                    return new Date(year, month, day, hour, minute);
                } catch (e) {
                    return new Date(0);
                }
            }
            
            // Sort by date/time ascending, then IN before OUT
            const sortedRecords = [...records].sort((a, b) => {
                // First sort by date/time
                const dateA = parseDateTime(a.dateTime);
                const dateB = parseDateTime(b.dateTime);
                const dateCompare = dateA - dateB;
                
                if (dateCompare !== 0) return dateCompare;
                
                // If same date/time, IN comes before OUT
                if (a.type === 'IN' && b.type === 'OUT') return -1;
                if (a.type === 'OUT' && b.type === 'IN') return 1;
                return 0;
            });
            
            sortedRecords.forEach(record => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td>${record.cats}</td>
                    <td>${record.dateTime}</td>
                    <td><span class="type-badge type-${record.type.toLowerCase()}">${record.type}</span></td>
                `;
            });

            updateSummary(records);
        }

        function updateSummary(records) {
            const totalRecords = records.length;
            const inCount = records.filter(r => r.type === 'IN').length;
            const outCount = records.filter(r => r.type === 'OUT').length;

            // Get date range
            if (records.length > 0) {
                const dates = records.map(r => {
                    const dateTimeParts = r.dateTime.split(' ');
                    const dateParts = dateTimeParts[0].split('/');
                    return new Date(dateParts[2], dateParts[0] - 1, dateParts[1]);
                }).sort((a, b) => a - b);

                const firstDate = dates[0];
                const lastDate = dates[dates.length - 1];
                
                const formatDate = (date) => {
                    return `${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`;
                };

                document.getElementById('dateRange').textContent = `${formatDate(firstDate)} - ${formatDate(lastDate)}`;
            } else {
                document.getElementById('dateRange').textContent = 'N/A';
            }

            document.getElementById('totalRecords').textContent = totalRecords;
            document.getElementById('inCount').textContent = inCount;
            document.getElementById('outCount').textContent = outCount;
        }

        function exportToExcel() {
            if (currentResults.length === 0) {
                showMessage('No records to export. Please search first.', 'error');
                return;
            }

            const data = currentResults.map(record => ({
                'CATS': record.cats,
                'DATE AND TIME': record.dateTime,
                'TYPE': record.type
            }));

            const ws = XLSX.utils.json_to_sheet(data);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'My Biometrics');

            const catsNo = document.getElementById('catsNo').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const filename = `Biometrics_${catsNo}_${startDate}_to_${endDate}.xlsx`;

            XLSX.writeFile(wb, filename);
            
            showMessage('Records exported successfully!', 'success');
        }

        function clearSearch() {
            document.getElementById('catsNo').value = '';
            
            const today = new Date();
            const thirtyDaysAgo = new Date(today);
            thirtyDaysAgo.setDate(today.getDate() - 30);

            document.getElementById('endDate').value = today.toISOString().split('T')[0];
            document.getElementById('startDate').value = thirtyDaysAgo.toISOString().split('T')[0];
            
            currentResults = [];
            displayResults([]);
            
            const messageDiv = document.getElementById('employeeMessage');
            messageDiv.innerHTML = '';
        }

        function showMessage(message, type) {
            const messageDiv = document.getElementById('employeeMessage');
            const className = type === 'error' ? 'alert-error' : 
                            type === 'success' ? 'alert-success' : 'alert-info';
            
            messageDiv.innerHTML = `<div class="alert ${className}">${message}</div>`;
            
            setTimeout(() => {
                messageDiv.innerHTML = '';
            }, 5000);
        }
    </script>
</body>
</html>