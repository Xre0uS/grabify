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
                    <th class="col0">Admin Username</th>
                    <th class="col1">Admin Roles</th>
                    <th class="col2"></th>
                    <th class="col3">
                        <div id="addAdminBtnContainer" class="addAdminBtnContainer" onclick="shAddModal()">
                            <div id="addAdminBtn" class="addAdminBtn">Add</div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody id="infoTableBody" class="body">
            </tbody>
        </table>
    </div>

    <div id="addModalContainer" class="modalContainer" style="display: none;">
        <div id="addModal" class="modal animate">
            <form id="adminAddFrom" class="login">
                <div class="modalHeader">ADD ADMIN</div>
                <div class="space"></div>
                <hr />
                <div class="space"></div>
                <div id="roleField" class="roleField">
                    Admin Role:
                    <input type="radio" id="addRoleBis" name="addRoleField" value="1">
                    <label for="addRoleBis">Business</label>
                    <input type="radio" id="addRoleUser" name="addRoleField" value="2">
                    <label for="addRoleUser">User</label>
                </div>
                <input type="text" id="addUnameField" name="" placeholder="Enter username">
                <input type="password" id="addPwField" name="" placeholder="Enter password" value="">
                <input type="password" id="addPwFieldConf" name="" placeholder="Confirm password" value="">
                <div id="addWarn" class="warningtext"></div>
                <div class="bigspace"></div>
                <input type="button" name="" value="SUBMIT" onclick="addAdmin()">
            </form>
            <div>
                <div class="space"></div>
            </div>
        </div>
    </div>

    <div id="editModalContainer" class="modalContainer" style="display: none;">
        <div id="editModal" class="modal animate">
            <form id="adminEditFrom" class="login">
                <div class="modalHeader">EDIT ADMIN</div>
                <div class="space"></div>
                <hr />
                <div class="space"></div>
                <div id="roleField" class="roleField">
                    Admin Role:
                    <input type="radio" id="editRoleBis" name="editRoleField" value="1">
                    <label for="editRoleBis">Business</label>
                    <input type="radio" id="editRoleUser" name="editRoleField" value="2">
                    <label for="editRoleUser">User</label>
                </div>
                <input type="text" id="oldUname" name="" style="display: none;">
                <input type="text" id="editUnameField" name="" placeholder="Enter new username">
                <input type="password" id="oldPwField" name="" placeholder="Enter old password" value="">
                <input type="password" id="editPwField" name="" placeholder="Enter new password" value="">
                <input type="password" id="editPwFieldConf" name="" placeholder="Confirm new password" value="">
                <div id="editWarn" class="warningtext"></div>
                <div class="bigspace"></div>
                <input type="button" name="" value="SUBMIT" onclick="editAdmin()">
            </form>
            <div>
                <div class="space"></div>
            </div>
        </div>
    </div>
</body>

<script>
    function reject() {
        alert('Unauthorised!');
        window.location.href = 'https://localhost/grabify/admin.php';
    }
</script>

</html>