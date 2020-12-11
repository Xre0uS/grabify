<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <style>
        <?php include 'css/styles.css'; ?><?php include 'css/admin.css'; ?>
    </style>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/adminlogs.js"></script>
</head>

<body>
    <?php include 'php/navbar.php'; ?>
    <div id="logsTable" class="tableWrapper">
        <table class="table">
            <thead>
                <tr id="header" class="header">
                    <th class="col0">Content</th>
                    <th class="col1">IP</th>
                    <th class="col2">Time</th>
                    <th class="col3"></th>
                </tr>
            </thead>
            <tbody id="logTableBody" class="body">
            </tbody>
        </table>
    </div>
</body>
<script>
    $(document).ready(function() {
        verifyAdmin();
    });
</script>

</html>