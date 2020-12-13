<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="reject()">
<div id="adminInfoTable" class="tableWrapper">
        <table class="table">
            <thead>
                <tr id="header" class="header">
                    <th class="col0">Review by</th>
                    <th class="col1">Rating</th>
                    <th class="col2">Content</th>
                    <th class="col3">On Product</th>
                    <th class="col4">By Business</th>
                    <th class="col5">Time</th>
                    <th class="col6"></th>
                </tr>
            </thead>
            <tbody id="userTableBody" class="body">
            </tbody>
        </table>
    </div>
</body>

<script>
    function reject() {
        alert('Unauthorised!');
        window.location.href = 'http://localhost/grabify/admin.php';
    }
</script>

</html>