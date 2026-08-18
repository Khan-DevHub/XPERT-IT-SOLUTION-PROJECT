<?php
session_start();
include 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle Record Deletion
if (isset($_GET['delete_id']) && isset($_GET['type'])) {
    $id = (int)$_GET['delete_id'];
    $type = $_GET['type'];
    $table = ($type == 'registration') ? 'registrations' : 'projectdetails';
    
    $delSql = "DELETE FROM $table WHERE id = $id";
    mysqli_query($conn, $delSql);
    header("Location: admin_dashboard.php?msg=deleted");
    exit();
}

// Handle Status Update
if (isset($_GET['status_id']) && isset($_GET['new_status']) && isset($_GET['type'])) {
    $id = (int)$_GET['status_id'];
    $new_status = mysqli_real_escape_string($conn, $_GET['new_status']);
    $type = $_GET['type'];
    $table = ($type == 'registration') ? 'registrations' : 'projectdetails';
    
    $updateSql = "UPDATE $table SET status = '$new_status' WHERE id = $id";
    mysqli_query($conn, $updateSql);
    header("Location: admin_dashboard.php?msg=updated");
    exit();
}

// Sorting & Search
$sort = $_GET['sort'] ?? 'latest';
$orderBy = ($sort == 'oldest') ? "id ASC" : "id DESC";
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$whereClause = !empty($search) ? " WHERE id LIKE '%$search%' OR full_name LIKE '%$search%' " : "";

// Data for Tables
$inquiries = mysqli_query($conn, "SELECT * FROM projectdetails $whereClause ORDER BY $orderBy");
$registrations = mysqli_query($conn, "SELECT * FROM registrations $whereClause ORDER BY $orderBy");

// Data for Charts (SYNCCED WITH SEARCH)
$course_data = mysqli_query($conn, "SELECT course_name, COUNT(*) as count FROM registrations $whereClause GROUP BY course_name");
$service_data = mysqli_query($conn, "SELECT interest_in, COUNT(*) as count FROM projectdetails $whereClause GROUP BY interest_in");

$course_labels = []; $course_values = [];
while($r = mysqli_fetch_assoc($course_data)) { $course_labels[] = $r['course_name']; $course_values[] = $r['count']; }

$service_labels = []; $service_values = [];
while($r = mysqli_fetch_assoc($service_data)) { $service_labels[] = $r['interest_in']; $service_values[] = $r['count']; }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | XPERT IT SOLUTIONS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #07111f; color: #fff; padding-top: 90px; font-family: 'Inter', sans-serif; }
        .admin-nav { display: flex; justify-content: space-between; align-items: center; padding: 10px 40px; position: fixed; top: 0; left: 0; right: 0; background: var(--navy); border-bottom: 2px solid var(--orange); z-index: 1000; }
        .admin-brand { display: flex; align-items: center; gap: 15px; }
        .admin-logo-img { height: 45px; }
        .admin-logo-text { font-family: 'Outfit', sans-serif; font-size: 1.2rem; font-weight: 800; color: #fff; }
        .admin-logo-text span { color: var(--orange); }
        .admin-user-info { display: flex; align-items: center; gap: 20px; font-size: 0.85rem; }
        .btn-logout { background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 8px 16px; border-radius: 8px; font-weight: 600; border: 1px solid rgba(239, 68, 68, 0.2); }

        .dashboard-wrapper { padding: 30px 40px; max-width: 1500px; margin: 0 auto; }

        /* Analytics Section - 4 Columns */
        .analytics-grid { display: grid; grid-template-columns: 1fr 1fr 1.5fr 1.5fr; gap: 30px; margin-bottom: 40px; }
        .chart-card { background: #0d1f38; border: 1px solid var(--border); border-radius: 20px; padding: 15px 20px; height: 300px; display: flex; flex-direction: column; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
        .chart-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(243, 115, 33, 0.15); border-color: rgba(243, 115, 33, 0.4); }
        .chart-card h3 { font-size: 0.75rem; color: var(--orange); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-family: 'Outfit'; text-align: center; }
        
        /* Custom Chart Layout */
        .chart-inner { display: flex; flex-direction: row; align-items: center; flex: 1; gap: 20px; overflow: hidden; }
        .chart-canvas-wrap { flex: 0 0 auto; width: 180px; height: 100%; }
        .chart-legend-wrap { flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 6px; overflow-y: auto; padding-right: 5px; }
        .chart-legend-item { display: flex; align-items: flex-start; gap: 8px; }
        .chart-legend-dot { width: 9px; height: 9px; border-radius: 2px; flex-shrink: 0; margin-top: 3px; }
        .chart-legend-label { font-size: 0.7rem; color: #ffffff; font-family: 'Outfit', sans-serif; font-weight: 300; white-space: normal; word-break: break-word; line-height: 1.4; }

        .stat-card-mini { background: #0d1f38; border: 1px solid var(--border); border-radius: 20px; padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; height: 300px; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
        .stat-card-mini:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(243, 115, 33, 0.15); border-color: rgba(243, 115, 33, 0.4); }
        .stat-card-mini i { font-size: 1.8rem; color: var(--orange); margin-bottom: 10px; opacity: 0.8; }
        .stat-card-mini h2 { font-size: 2.5rem; font-weight: 900; line-height: 1; margin-bottom: 5px; }
        .stat-card-mini p { color: var(--muted); font-size: 0.7rem; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; }

        /* Table Data Visibility Removed - Merged below */

        /* Controls */
        .controls-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; background: rgba(255,255,255,0.02); padding: 12px 20px; border-radius: 15px; border: 1px solid var(--border); gap: 20px; }
        .tabs-header { display: flex; gap: 10px; }
        .tab-btn { padding: 9px 20px; background: transparent; border: 1px solid var(--border); color: var(--muted); border-radius: 99px; cursor: pointer; font-weight: 700; font-size: 0.8rem; transition: 0.3s; }
        .tab-btn.active { background: var(--orange); border-color: var(--orange); color: #fff; }

        .search-form { 
            display: flex; 
            align-items: center; 
            background: var(--navy); 
            padding: 5px 15px; 
            border-radius: 12px; 
            border: 1px solid var(--orange);
            flex: 1; 
            max-width: 300px; 
            transition: 0.3s;
        }
        .search-input { background: transparent; border: none; color: #fff; padding: 8px; width: 100%; outline: none; font-size: 0.85rem; }
        .search-btn { background: transparent; border: none; color: var(--muted); cursor: pointer; }

        .btn-export { background: #22c55e; color: #fff; padding: 10px 20px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-export:hover { background: #16a34a; transform: translateY(-2px); }

        /* Table */
        .table-container { background: #0d1f38; border: 1px solid var(--border); border-radius: 20px; overflow-x: auto; display: none; box-shadow: var(--shadow); }
        .table-container.active { display: block; }
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        th { background: rgba(255,255,255,0.03); padding: 18px 20px; font-size: 0.95rem; text-transform: uppercase; color: var(--orange); font-weight: 800; text-align: center; border-bottom: 1px solid var(--border); white-space: nowrap; letter-spacing: 0.5px; }
        td { padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.95rem; color: #ffffff; font-weight: 500; white-space: nowrap; text-align: center; }
        
        .status-badge { padding: 4px 10px; border-radius: 99px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; }
        .status-pending { background: rgba(245, 158, 11, 0.1); color: var(--orange); border: 1px solid var(--orange); }
        .status-approved { background: rgba(34, 197, 94, 0.1); color: #22c55e; border: 1px solid #22c55e; }
        .status-rejected { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #ef4444; }

        .action-btns { display: flex; gap: 8px; align-items: center; justify-content: center; }
        .btn-action { padding: 7px 14px; border-radius: 8px; border: 1px solid var(--border); color: #fff; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; transition: 0.2s; cursor: pointer; }
        .btn-view { background: rgba(255,255,255,0.05); color: #fff; }
        .btn-view:hover { background: #fff; color: var(--navy); }
        .btn-approve { border-color: #22c55e; color: #22c55e; }
        .btn-approve:hover { background: #22c55e; color: #fff; }
        .btn-reject { border-color: #ef4444; color: #ef4444; }
        .btn-reject:hover { background: #ef4444; color: #fff; }
        .btn-delete { color: var(--muted); border-color: transparent; }
        .btn-delete:hover { color: #ef4444; background: rgba(239, 68, 68, 0.1); }

        /* Modal Styles */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px); display: none; align-items: center; justify-content: center; z-index: 2000; padding: 20px; }
        .modal-content { background: var(--navy-mid); border: 1px solid var(--orange); width: 100%; max-width: 600px; border-radius: 24px; padding: 40px; position: relative; animation: slideUp 0.3s ease; }
        @keyframes slideUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        .modal-close { position: absolute; top: 25px; right: 25px; font-size: 1.5rem; color: var(--muted); cursor: pointer; transition: 0.3s; }
        .modal-close:hover { color: #fff; }
        .modal-header { margin-bottom: 30px; }
        .modal-header h2 { font-family: 'Outfit'; font-size: 1.8rem; margin-bottom: 5px; color: var(--orange); }
        .modal-body { display: grid; gap: 20px; }
        .detail-item { border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 10px; }
        .detail-item label { display: block; font-size: 0.7rem; text-transform: uppercase; color: var(--muted); font-weight: 800; margin-bottom: 5px; }
        .detail-item p { font-size: 1rem; color: #fff; font-weight: 500; }
    </style>
</head>
<body>

    <nav class="admin-nav">
        <div class="admin-brand">
            <img src="assets/image.png" alt="XPERT" class="admin-logo-img">
            <div class="admin-logo-text">XPERT <span>PORTAL</span></div>
        </div>
        <div class="admin-user-info">
            <span>Welcome, <strong><?php echo $_SESSION['admin_user']; ?></strong></span>
            <a href="admin_logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>

    <div class="dashboard-wrapper">
        
        <!-- Analytics Section -->
        <div class="analytics-grid">
            <div class="stat-card-mini">
                <i class="fas fa-users"></i>
                <h2><?php echo mysqli_num_rows($registrations); ?></h2>
                <p>Total Students</p>
            </div>
            <div class="stat-card-mini">
                <i class="fas fa-briefcase"></i>
                <h2><?php echo mysqli_num_rows($inquiries); ?></h2>
                <p>Project Leads</p>
            </div>
            <div class="chart-card">
                <h3>Students Distribution</h3>
                <div class="chart-inner">
                    <div class="chart-canvas-wrap"><canvas id="studentChart"></canvas></div>
                    <div class="chart-legend-wrap" id="studentLegend"></div>
                </div>
            </div>
            <div class="chart-card">
                <h3>Leads Distribution</h3>
                <div class="chart-inner">
                    <div class="chart-canvas-wrap"><canvas id="leadsChart"></canvas></div>
                    <div class="chart-legend-wrap" id="leadsLegend"></div>
                </div>
            </div>
        </div>

        <div class="controls-bar">
            <div class="tabs-header">
                <button class="tab-btn active" onclick="showTab('inquiries', this)">Project Leads</button>
                <button class="tab-btn" onclick="showTab('registrations', this)">Student Registrations</button>
            </div>

            <form action="" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search by ID or Name..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
            
            <div style="display: flex; gap: 15px;">
                <select class="sort-select" style="background: rgba(255,255,255,0.05); padding: 10px 15px; border-radius: 10px; border: 1px solid var(--border); color:#fff;" onchange="location = 'admin_dashboard.php?search=<?php echo $search; ?>&sort=' + this.value">
                    <option value="latest" <?php echo $sort == 'latest' ? 'selected' : ''; ?>>Latest</option>
                    <option value="oldest" <?php echo $sort == 'oldest' ? 'selected' : ''; ?>>Oldest</option>
                </select>
                <a href="export_data.php?type=registration" id="exportBtn" class="btn-export">
                    <i class="fas fa-file-excel"></i> Download Report
                </a>
            </div>
        </div>

        <!-- Inquiries Table -->
        <div id="inquiries" class="table-container active">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Interest</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($inquiries)): ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td><strong><?php echo $row['full_name']; ?></strong></td>
                        <td><span style="color: #ffffff;"><?php echo $row['interest_in']; ?></span></td>
                        <td><?php echo $row['estimated_budget']; ?></td>
                        <td><span class="status-badge status-<?php echo strtolower($row['status'] ?? 'pending'); ?>"><?php echo $row['status'] ?? 'Pending'; ?></span></td>
                        <td class="action-btns">
                            <button class="btn-action btn-view" onclick="viewDetails(<?php echo htmlspecialchars(json_encode($row)); ?>, 'project')">View</button>
                            <a href="?status_id=<?php echo $row['id']; ?>&new_status=Approved&type=project" class="btn-action btn-approve">Approve</a>
                            <a href="?status_id=<?php echo $row['id']; ?>&new_status=Rejected&type=project" class="btn-action btn-reject">Reject</a>
                            <a href="?delete_id=<?php echo $row['id']; ?>&type=project" onclick="return confirm('Delete?')" class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Registrations Table -->
        <div id="registrations" class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($registrations)): ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td><strong><?php echo $row['full_name']; ?></strong></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><span class="status-badge status-<?php echo strtolower($row['status'] ?? 'pending'); ?>"><?php echo $row['status'] ?? 'Pending'; ?></span></td>
                        <td class="action-btns">
                            <button class="btn-action btn-view" onclick="viewDetails(<?php echo htmlspecialchars(json_encode($row)); ?>, 'registration')">View</button>
                            <a href="?status_id=<?php echo $row['id']; ?>&new_status=Approved&type=registration" class="btn-action btn-approve">Approve</a>
                            <a href="?status_id=<?php echo $row['id']; ?>&new_status=Rejected&type=registration" class="btn-action btn-reject">Reject</a>
                            <a href="?delete_id=<?php echo $row['id']; ?>&type=registration" onclick="return confirm('Delete?')" class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="modal-overlay">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2 id="modalTitle">Details</h2>
                <p id="modalID" style="color: var(--muted); font-weight: 700;"></p>
            </div>
            <div id="modalBody" class="modal-body">
                <!-- Content will be injected here -->
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId, btn) {
            document.querySelectorAll('.table-container').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            btn.classList.add('active');
            // Update export link based on active tab
            document.getElementById('exportBtn').href = 'export_data.php?type=' + (tabId == 'inquiries' ? 'project' : 'registration');
        }

        function viewDetails(data, type) {
            const modal = document.getElementById('detailsModal');
            const body = document.getElementById('modalBody');
            document.getElementById('modalTitle').innerText = data.full_name;
            document.getElementById('modalID').innerText = 'Record ID: #' + data.id;

            let html = '';
            if(type === 'registration') {
                html = `
                    <div class="detail-item"><label>Email</label><p>${data.email}</p></div>
                    <div class="detail-item"><label>Phone</label><p>${data.phone_number}</p></div>
                    <div class="detail-item"><label>Course</label><p>${data.course_name}</p></div>
                    <div class="detail-item"><label>Registered At</label><p>${data.registered_at}</p></div>
                    <div class="detail-item"><label>Current Status</label><p>${data.status || 'Pending'}</p></div>
                `;
            } else {
                html = `
                    <div class="detail-item"><label>Business Email</label><p>${data.business_email}</p></div>
                    <div class="detail-item"><label>Interested In</label><p>${data.interest_in}</p></div>
                    <div class="detail-item"><label>Budget Range</label><p>${data.estimated_budget}</p></div>
                    <div class="detail-item"><label>Project Message</label><p>${data.message}</p></div>
                    <div class="detail-item"><label>Current Status</label><p>${data.status || 'Pending'}</p></div>
                `;
            }
            body.innerHTML = html;
            modal.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('detailsModal').style.display = 'none';
        }

        // --- Charts Implementation ---
        Chart.register(ChartDataLabels);
        
        const vibrantColors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', 
            '#2ecc71', '#e74c3c', '#3498db', '#f1c40f', '#1abc9c', '#e67e22'
        ];

        // Helper: build custom HTML legend
        function buildLegend(containerId, labels, colors) {
            const wrap = document.getElementById(containerId);
            wrap.innerHTML = '';
            labels.forEach((label, i) => {
                const item = document.createElement('div');
                item.className = 'chart-legend-item';
                item.innerHTML = `<span class="chart-legend-dot" style="background:${colors[i % colors.length]}"></span><span class="chart-legend-label">${label}</span>`;
                wrap.appendChild(item);
            });
        }

        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            hoverOffset: 20,
            layout: { padding: 8 },
            plugins: { 
                legend: { display: false }, // Use custom HTML legend
                datalabels: { 
                    color: '#fff',
                    font: { weight: '600', size: 10 },
                    formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => Number(a) + Number(b), 0);
                        return sum > 0 ? (value * 100 / sum).toFixed(0) + '%' : '';
                    },
                    display: (context) => context.dataset.data[context.dataIndex] > 0
                },
                tooltip: { 
                    backgroundColor: 'rgba(15, 23, 42, 0.92)', 
                    titleFont: { family: 'Outfit', size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 10, cornerRadius: 10,
                    borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1
                }
            }
        };

        // Student Chart
        const courseLabels = <?php echo json_encode($course_labels); ?>;
        const courseValues = <?php echo json_encode($course_values); ?>;
        buildLegend('studentLegend', courseLabels, vibrantColors);
        new Chart(document.getElementById('studentChart'), {
            type: 'pie',
            data: {
                labels: courseLabels,
                datasets: [{ data: courseValues, backgroundColor: vibrantColors, borderWidth: 0 }]
            },
            options: baseOptions
        });

        // Leads Chart
        const serviceLabels = <?php echo json_encode($service_labels); ?>;
        const serviceValues = <?php echo json_encode($service_values); ?>;
        buildLegend('leadsLegend', serviceLabels, vibrantColors);
        new Chart(document.getElementById('leadsChart'), {
            type: 'pie',
            data: {
                labels: serviceLabels,
                datasets: [{ data: serviceValues, backgroundColor: vibrantColors, borderWidth: 0 }]
            },
            options: baseOptions
        });
    </script>
</body>
</html>
