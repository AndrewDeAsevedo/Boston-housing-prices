<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Increase memory limit if necessary
ini_set('memory_limit', '512M');

// Set the number of rows per page
$rowsPerPage = 50;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $rowsPerPage;

$data = [];
$header = [];

// Open the CSV file and read it line by line
if (($handle = fopen("../data.csv", "r")) !== FALSE) {
    $header = fgetcsv($handle); // Get the header
    while (($row = fgetcsv($handle)) !== FALSE) {
        $data[] = array_combine($header, $row); // Combine header with row data
    }
    fclose($handle);
}

// Sort the data if a sort field is provided
if (isset($_GET['sort'])) {
    $sortField = $_GET['sort'];
    usort($data, function($a, $b) use ($sortField) {
        return strcmp($a[$sortField], $b[$sortField]);
    });
}

// Get the total number of rows for pagination
$totalRows = count($data);
$totalPages = ceil($totalRows / $rowsPerPage);

// Slice the data for the current page
$data = array_slice($data, $offset, $rowsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CSV Data Sorter</title>
</head>
<body>
    <h1>CSV Data Sorter</h1>
    <table>
        <thead>
            <tr>
                <th><a href="?sort=CITY&page=<?php echo $currentPage; ?>">City</a></th>
                <th><a href="?sort=ZIP_CODE&page=<?php echo $currentPage; ?>">ZIP Code</a></th>
                <th><a href="?sort=NUM_BLDGS&page=<?php echo $currentPage; ?>">Number of Buildings</a></th>
                <th><a href="?sort=LU_DESC&page=<?php echo $currentPage; ?>">Land Use Description</a></th>
                <th><a href="?sort=BLDG_TYPE&page=<?php echo $currentPage; ?>">Building Type</a></th>
                <th><a href="?sort=RES_FLOOR&page=<?php echo $currentPage; ?>">Residential Floor</a></th>
                <th><a href="?sort=LAND_SF&page=<?php echo $currentPage; ?>">Land SF</a></th>
                <th><a href="?sort=GROSS_AREA&page=<?php echo $currentPage; ?>">Gross Area</a></th>
                <th><a href="?sort=LIVING_AREA&page=<?php echo $currentPage; ?>">Living Area</a></th>
                <th><a href="?sort=LAND_VALUE&page=<?php echo $currentPage; ?>">Land Value</a></th>
                <th><a href="?sort=BLDG_VALUE&page=<?php echo $currentPage; ?>">Building Value</a></th>
                <th><a href="?sort=TOTAL_VALUE&page=<?php echo $currentPage; ?>">Total Value</a></th>
                <th><a href="?sort=GROSS_TAX&page=<?php echo $currentPage; ?>">Gross Tax</a></th>
                <th><a href="?sort=YR_BUILT&page=<?php echo $currentPage; ?>">Year Built</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['CITY']); ?></td>
                    <td><?php echo htmlspecialchars($row['ZIP_CODE']); ?></td>
                    <td><?php echo htmlspecialchars($row['NUM_BLDGS']); ?></td>
                    <td><?php echo htmlspecialchars($row['LU_DESC']); ?></td>
                    <td><?php echo htmlspecialchars($row['BLDG_TYPE']); ?></td>
                    <td><?php echo htmlspecialchars($row['RES_FLOOR']); ?></td>
                    <td><?php echo htmlspecialchars($row['LAND_SF']); ?></td>
                    <td><?php echo htmlspecialchars($row['GROSS_AREA']); ?></td>
                    <td><?php echo htmlspecialchars($row['LIVING_AREA']); ?></td>
                    <td><?php echo htmlspecialchars($row['LAND_VALUE']); ?></td>
                    <td><?php echo htmlspecialchars($row['BLDG_VALUE']); ?></td>
                    <td><?php echo htmlspecialchars($row['TOTAL_VALUE']); ?></td>
                    <td><?php echo htmlspecialchars($row['GROSS_TAX']); ?></td>
                    <td><?php echo htmlspecialchars($row['YR_BUILT']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>&sort=<?php echo isset($sortField) ? $sortField : ''; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&sort=<?php echo isset($sortField) ? $sortField : ''; ?>"
               class="<?php echo $i === $currentPage ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>&sort=<?php echo isset($sortField) ? $sortField : ''; ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>
