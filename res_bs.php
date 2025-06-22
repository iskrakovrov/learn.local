<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);

// Обработка очистки всех записей Bluestacks
if (isset($_POST['free_bluestacks'])) {
    try {
        $sql = "DELETE FROM `vm_work`";
        $q= create($sql);
        $success_message = "All Bluestacks instances have been cleared from the work queue!";
    } catch (PDOException $e) {
        $error_message = "Error clearing Bluestacks instances: " . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php require_once('inc/meta.php'); ?>
    <title>Bluestacks Manager</title>
    <style>
        .action-card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .requirement-card {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
        }
        .requirement-item {
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .requirement-item:last-child {
            border-bottom: none;
        }
        .slider-container {
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php require_once('inc/header.php'); ?>

<main class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Уведомления -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= $success_message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $error_message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Основные инструменты -->
            <div class="card action-card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-tools mr-2"></i>Bluestacks Tools</h3>
                </div>
                <div class="card-body">
                    <!-- 1. Download DLL Libraries -->
                    <div class="mb-4 p-4 border rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2"><i class="fas fa-file-archive mr-2"></i>Additional DLL Libraries</h4>
                                <p class="mb-0">Required for proper Bluestacks functioning</p>
                            </div>
                            <a href="https://soft.fbcombo.com/dll.zip" class="btn btn-success">
                                <i class="fas fa-download mr-2"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- 2. Download Bluestacks -->
                    <div class="mb-4 p-4 border rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2"><i class="fas fa-download mr-2"></i>Bluestacks Installer</h4>
                                <p class="mb-0">Custom configured version of Bluestacks</p>
                            </div>
                            <a href="https://soft.fbcombo.com/bs.zip" class="btn btn-primary">
                                <i class="fas fa-download mr-2"></i> Download
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- 1. Download DLL Libraries -->
                        <div class="mb-4 p-4 border rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-2"><i class="fas fa-file-archive mr-2"></i>All files</h4>
                                    <p class="mb-0"></p>
                                </div>
                                <a href="https://soft.fbcombo.com/reg.zip" class="btn btn-success">
                                    <i class="fas fa-download mr-2"></i> Download
                                </a>
                            </div>
                        </div>

                    <!-- 3. Clear All Bluestacks Instances -->
                    <div class="p-4 border rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2"><i class="fas fa-trash-alt mr-2"></i>Clear Work Queue</h4>
                                <p class="mb-0">Remove all instances from the work queue</p>
                                <small class="text-muted">Executes: DELETE FROM `vm_work`</small>
                            </div>
                            <form method="POST" onsubmit="return confirm('WARNING: This will delete ALL records from the work queue. Continue?');">
                                <button type="submit" name="free_bluestacks" class="btn btn-danger">
                                    <i class="fas fa-trash-alt mr-2"></i> Clear All
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Требования к системе -->
            <div class="card action-card mt-4">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0"><i class="fas fa-info-circle mr-2"></i>System Requirements (per 1 thread)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="requirement-card mb-3">
                                <div class="requirement-item">
                                    <h5><i class="fas fa-microchip mr-2"></i>CPU Requirements</h5>
                                    <ul>
                                        <li><strong>Minimum:</strong> 1 core per thread</li>
                                        <li><strong>Recommended:</strong> 2 cores per thread</li>
                                    </ul>
                                </div>
                                <div class="requirement-item">
                                    <h5><i class="fas fa-memory mr-2"></i>Memory Requirements</h5>
                                    <ul>
                                        <li><strong>Minimum:</strong> 2GB RAM per thread</li>
                                        <li><strong>Recommended:</strong> 3GB RAM per thread</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="requirement-card mb-3">
                                <div class="requirement-item">
                                    <h5><i class="fas fa-hdd mr-2"></i>Storage Requirements</h5>
                                    <ul>
                                        <li><strong>Minimum:</strong> 5GB free space per thread</li>
                                        <li><strong>Recommended:</strong> 10GB SSD (NVMe preferred)</li>
                                    </ul>
                                </div>
                                <div class="requirement-item">
                                    <h5><i class="fas fa-ethernet mr-2"></i>Other Requirements</h5>
                                    <ul>
                                        <li>VT-x/AMD-V enabled in BIOS</li>
                                        <li>Windows</li>
                                        <li>Stable internet connection</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Note:</strong> These requirements are for <strong>each running Bluestacks instance</strong>.
                        For multiple threads, multiply requirements accordingly.
                    </div>

                    <!-- Калькулятор потоков -->
                    <div class="slider-container mt-4">
                        <h4><i class="fas fa-calculator mr-2"></i>Thread Capacity Calculator</h4>
                        <div class="form-group">
                            <label for="cpuCores">Your CPU Cores:</label>
                            <input type="number" class="form-control mb-2" id="cpuCores" min="1" max="128" value="4">
                        </div>
                        <div class="form-group">
                            <label for="availableRam">Available RAM (GB):</label>
                            <input type="number" class="form-control mb-2" id="availableRam" min="2" max="256" step="0.5" value="8">
                        </div>
                        <button class="btn btn-outline-primary" onclick="calculateThreads()">
                            <i class="fas fa-calculator mr-2"></i>Calculate Max Threads
                        </button>
                        <div id="threadResult" class="mt-2 font-weight-bold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/dtjquery.js"></script>

<script>
    function calculateThreads() {
        const cores = parseInt(document.getElementById('cpuCores').value);
        const ram = parseFloat(document.getElementById('availableRam').value);

        // Оставляем 1 ядро для системы
        const availableCores = Math.max(1, cores - 1);

        // 1 thread = 2GB RAM
        const byCores = availableCores;
        const byRam = Math.floor(ram / 2);

        const maxThreads = Math.min(byCores, byRam);

        document.getElementById('threadResult').innerHTML = `
        <i class="fas fa-laptop-code mr-2"></i>
        You can run up to <span class="text-primary">${maxThreads}</span> Bluestacks instances simultaneously
        <br><small class="text-muted">(Limited by ${byCores <= byRam ? 'CPU cores' : 'available RAM'})</small>
    `;
    }
</script>
</body>
</html>