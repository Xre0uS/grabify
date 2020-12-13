<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body onload="reject()">
    <div id="adminInfoTable" class="tableWrapper">
        <table class="table">
            <thead>
                <tr id="header" class="header">
                    <th class="col0">Business Name</th>
                    <th class="col1">Business Email</th>
                    <th class="col2">Business Address</th>
                    <th class="col3">Business Number</th>
                    <th class="col4">Business Status</th>
                    <th class="col5"></th>
                    <th class="col6"></th>
                </tr>
            </thead>
            <tbody id="bisTableBody" class="body">
            </tbody>
        </table>
    </div>

    <script>
        function reject() {
            alert('Unauthorised!');
            window.location.href = 'https://localhost/grabify/admin.php';
        }
    </script>

</html>