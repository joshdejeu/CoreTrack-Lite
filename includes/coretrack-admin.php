<?php
require_once "auth.inc.php"; // Check login session
// User is authenticated, proceed with admin content

// Fetch all returns for the dealer's dealer_code
try {
    require_once "../includes/dbh.inc.php";
    $query = "SELECT part_number, quantity, dealer_code, return_date, status FROM core_returns WHERE dealer_code = :dealer_code";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":dealer_code", $_SESSION["dealer_code"]);
    $stmt->execute();
    $returns = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array
    $pdo = null;
    $stmt = null;
} catch (Exception $e) {
    // Log error and set empty array to avoid breaking the page
    error_log("Error fetching core returns: " . $e->getMessage(), 3, "../logs/error.log");
    $returns = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>CoreTrack Lite Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header class="bg-primary py-3 shadow-sm d-flex flex-row">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="flex-grow-1">
                <h1 class="display-5 fw-bold mb-0">CoreTrack Lite Admin</h1>
                <p class="lead mb-0">Welcome, <?php echo htmlspecialchars($_SESSION["dealer_code"]); ?>!</p>
            </div>
            <div class="flex-shrink-0">
                <a href="logout.inc.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </header>
    <main class="container py-4">
        <div class="row">
            <div class="col-12">
                <p class="fs-5">Manage new core returns here.</p>
            </div>
            <!-- Core Return Form -->
            <div class="col-12 col-md-6">
                <form action="submit-return.inc.php" method="POST" class="bg-secondary p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <label for="partNumber" class="form-label">Part Number</label>
                        <input type="text" class="form-control" id="partNumber" name="part_number" value="ABC123"
                            placeholder="e.g., ABC123" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1"
                            placeholder="e.g., 5" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit Core Return</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="fs-5">Manage your core returns here.</p>
                <!-- Success/Error Feedback -->
                <?php
                if (isset($_GET["success"])) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($_GET["success"]) . '</div>';
                } elseif (isset($_GET["error"])) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_GET["error"]) . '</div>';
                }
                ?>
                <!-- Core Returns Table -->
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Part Number</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Dealer Code</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assume $returns is fetched like: SELECT * FROM core_returns WHERE dealer_code = $_SESSION["dealer_code"]
                            foreach ($returns as $return) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($return["part_number"]); ?></td>
                                    <td><?php echo htmlspecialchars($return["quantity"]); ?></td>
                                    <td><?php echo htmlspecialchars($return["dealer_code"]); ?></td>
                                    <td><?php echo htmlspecialchars(date("Y-m-d", strtotime($return["return_date"]))); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($return["status"]); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Fallback if no returns -->
                <?php if (empty($returns)) { ?>
                    <p class="text-muted">No core returns found for dealer
                        <?php echo htmlspecialchars($_SESSION["dealer_code"]); ?>.
                    </p>
                <?php } ?>
            </div>
        </div>

    </main>
</body>

</html>