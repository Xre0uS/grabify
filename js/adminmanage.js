function verifyAdmin() {
    var data = { function: "checkLoggedIn" };
    $.ajax({
        type: 'POST',
        url: "php/adminloginfn.php",
        data: data,

        success: function (response) {
            var response = JSON.parse(response);
            if (response.status == 0) {
                document.getElementById("adminFnWrapper").style.display = "block"
                document.getElementById("adminFnWrapper").innerHTML = "<h1 style='text-align: center;'>Please login</h1>";
            }
            else if (response.status == 1) {
                if (response.role == 0) {
                    document.getElementById("adminFnWrapper").style.display = "block"
                    var data = { function: "fillMasterTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/masteradminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillMasterTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
                else if (response.role == 1) {
                    document.getElementById("bisAdminFnWrapper").style.display = "block"
                    var data = { function: "fillBisTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/businessadminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillBisTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
                else if (response.role == 2) {
                    document.getElementById("userAdminFnWrapper").style.display = "block"
                    var data = { function: "fillUserTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/useradminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillUserTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            } else if (response.status == 2) {
                alert(response.err);
                window.location.href = response.redirect;
            }
            else if (response.status == 3) {
                alert(response.err);
                window.location.href = response.redirect;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function fillMasterTable(response) {
    var table = document.getElementById('infoTableBody');
    table.innerHTML = '';
    for (var i = 0; i < response.length; i++) {
        var cell = formMasterTableforDisplay(response[i]);
        table.insertAdjacentHTML('beforeEnd', cell);
    }
}


function formMasterTableforDisplay(content) {
    var aUsername = content.username;
    if (content.role == 1) {
        var aRole = "Business";
    }
    else if (content.role == 2) {
        var aRole = "User"
    }

    var cell =
        '<tbody id="body" class="body"><tr>' +
        '<td class="col0">' + aUsername + '</td><td class="col1">' + aRole + '</td>' +
        '<td class="col2"><div class="edit" onclick="shEditModal(\'' + aUsername + '\',\'' + content.role + '\')">Edit</div></td>' +
        '<td class="col3"><div class="delete" onclick="delAdmin(\'' + aUsername + '\')">Delete</div></td></tr></tbody>'
    return cell;
}

function fillBisTable(response) {
    var table = document.getElementById('bisTableBody');
    table.innerHTML = '';
    for (var i = 0; i < response.length; i++) {
        var cell = formBisTableforDisplay(response[i]);
        table.insertAdjacentHTML('beforeEnd', cell);
    }
}

function formBisTableforDisplay(content) {
    var id = content.business_id;
    var bisName = content.company_name;
    var email = content.email;
    var address = content.address;
    var contact = content.contact_number;
    if (content.active == 0) {
        var active = "Inactive";
    }
    else if (content.active == 1) {
        var active = "Active";
    }

    var cell =
        '<tr><td class="col0">' + bisName + '</td>' +
        '<td class="col1">' + email + '</td>' +
        '<td class="col2">' + address + '</td>' +
        '<td class="col3">' + contact + '</td>' +
        '<td class="col4">' + active + '</td>' +
        '<td class="col5"><div class="approve" onclick="approveBis(\'' + id + '\',\'' + bisName + '\')">Approve</div></td>' +
        '<td class="col6"><div class="deny" onclick="denyBis(\'' + id + '\',\'' + bisName + '\')">Deny</div></td></tr>'

    return cell;
}

function fillUserTable(response) {
    var table = document.getElementById('userTableBody');
    table.innerHTML = '';
    for (var i = 0; i < response.length; i++) {
        var cell = formUserTableforDisplay(response[i]);
        table.insertAdjacentHTML('beforeEnd', cell);
    }
}

function formUserTableforDisplay(content) {
    var reviewId = content.review_id;
    var username = content.username;
    var rating = content.rating;
    var reviewContent = content.content;
    var productName = content.name;
    var bisName = content.company_name;
    var time = content.timestamp;

    var cell =
    '<tr><td class="col0">'+ username +'</td>' +
    ' <td class="col1">'+ rating +'</td>' +
    '<td class="col2">'+ reviewContent +'</td>' +
    '<td class="col3">'+ productName +'</td>' +
    '<td class="col4">'+ bisName +'</td>' +
    '<td class="col5">'+ time +'</td>' +
    '<td class="col6"><div class="delete" onclick="delReview(\'' + reviewId + '\')">Delete</div></td></tr>'

    return cell;
}


function addAdmin() {
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    var addRole = $('input[name="addRoleField"]:checked').val();
    var addUname = document.getElementById("addUnameField").value;
    var addPassword = document.getElementById("addPwField").value;
    var addCPassword = document.getElementById("addPwFieldConf").value;

    if (addRole == null || addUname == "" || addPassword == "" || addCPassword == "") {
        document.getElementById("addWarn").innerText = "Please fill all fields."
    }
    else if (/^[A-Za-z0-9]+$/.test(addUname) == false) {
        document.getElementById("addWarn").innerText = "Only letters and numbers allowed in username."
    }
    else if (addPassword != addCPassword) {
        document.getElementById("addWarn").innerText = "Passwords do not match."
    }
    else if (!addPassword.match(passw)) {
        document.getElementById("addWarn").innerText = "Try a stronger password."
    }
    else {
        var data = { function: "addAdmin", addUname, addPassword, addCPassword, addRole };
        $.ajax({
            type: 'POST',
            url: "php/masteradminfn.php",
            data: data,

            success: function (response) {
                var response = JSON.parse(response);
                if (response.status == 0) {
                    document.getElementById("addWarn").innerText = response.err;
                }
                else if (response.status == 1) {
                    $(':input', '#adminAddFrom')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .prop('checked', false)
                        .prop('selected', false);
                    var data = { function: "fillMasterTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/masteradminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillMasterTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                    shAddModal();
                }
                else if (response.status == 2) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
                else if (response.status == 3) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function delAdmin(dUname) {
    if (confirm("Confirm delete " + dUname + "?")) {
        var data = { function: "delAdmin", dUname };
        $.ajax({
            type: 'POST',
            url: "php/masteradminfn.php",
            data: data,

            success: function (response) {
                var response = JSON.parse(response);
                if (response.status == 0) {
                    alert("Error");
                    document.location.href = "http://localhost/grabify/admin.php"
                }
                else if (response.status == 1) {
                    var data = { function: "fillMasterTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/masteradminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillMasterTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                    alert(dUname + " has been deleted.")
                }
                else if (response.status == 2) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
                else if (response.status == 3) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function editAdmin() {
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    var editRole = $('input[name="editRoleField"]:checked').val();
    var oldUname = document.getElementById("oldUname").value;
    var editUname = document.getElementById("editUnameField").value;
    var eOldPassword = document.getElementById("oldPwField").value;
    var editPassword = document.getElementById("editPwField").value;
    var editCPassword = document.getElementById("editPwFieldConf").value;

    if (editRole == null || editUname == "" || eOldPassword == "" || editPassword == "" || editCPassword == "") {
        document.getElementById("editWarn").innerText = "Please fill all fields."
    }
    else if (/^[A-Za-z0-9]+$/.test(editUname) == false) {
        document.getElementById("editWarn").innerText = "Only letters and numbers allowed in username."
    }
    else if (editPassword != editCPassword) {
        document.getElementById("editWarn").innerText = "Passwords do not match."
    }
    else if (!editPassword.match(passw)) {
        document.getElementById("editWarn").innerText = "Try a stronger password."
    }
    else {
        var data = { function: "editAdmin", oldUname, editRole, editUname, eOldPassword, editPassword, editCPassword };
        $.ajax({
            type: 'POST',
            url: "php/masteradminfn.php",
            data: data,

            success: function (response) {
                var response = JSON.parse(response);
                if (response.status == 0) {
                    document.getElementById("editWarn").innerText = response.err;
                }
                else if (response.status == 1) {
                    $(':input', '#adminEditFrom')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .prop('checked', false)
                        .prop('selected', false);
                    var data = { function: "fillMasterTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/masteradminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillMasterTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                    shEditModal();
                }
                else if (response.status == 2) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
                else if (response.status == 3) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function approveBis(id, bisName) {
    if (confirm("Confirm approve " + bisName + "?")) {
        var data = { function: "approveBis", id, approveStatus: 1 };
        $.ajax({
            type: 'POST',
            url: "php/businessadminfn.php",
            data: data,

            success: function (response) {
                var response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.err);
                }
                else if (response.status == 1) {
                    var data = { function: "fillBisTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/businessadminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillBisTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
                else if (response.status == 2) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
                else if (response.status == 3) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function denyBis(id, bisName) {
    if (confirm("Confirm deny " + bisName + "?")) {
        var data = { function: "approveBis", id, approveStatus: 0 };
        $.ajax({
            type: 'POST',
            url: "php/businessadminfn.php",
            data: data,

            success: function (response) {
                var response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.err);
                }
                else if (response.status == 1) {
                    var data = { function: "fillBisTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/businessadminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillBisTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
                else if (response.status == 2) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
                else if (response.status == 3) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function delReview(id) {
    if (confirm("Confirm delete?")) {
        var data = { function: "delReview", id};
        $.ajax({
            type: 'POST',
            url: "php/useradminfn.php",
            data: data,

            success: function (response) {
                console.log(response);
                var response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.err);
                }
                else if (response.status == 1) {
                    var data = { function: "fillUserTable" };
                    $.ajax({
                        type: 'POST',
                        url: "php/useradminfn.php",
                        data: data,

                        success: function (response) {
                            var response = JSON.parse(response);
                            fillUserTable(response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
                else if (response.status == 2) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
                else if (response.status == 3) {
                    alert(response.err);
                    window.location.href = response.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function shAddModal() {
    var x = document.getElementById("addModalContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

$(document).mouseup(function (e) {
    var container = $("#addModalContainer");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
    }
});

function shEditModal(aUsername, aRole) {
    document.getElementById("editUnameField").value = aUsername;
    document.getElementById("oldUname").value = aUsername;
    if (aRole == 1) {
        document.getElementById("editRoleBis").checked = true;
    }
    else {
        document.getElementById("editRoleUser").checked = true;
    }
    var x = document.getElementById("editModalContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

$(document).mouseup(function (e) {
    var container = $("#editModalContainer");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
    }
});