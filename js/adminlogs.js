function verifyAdmin() {
    var data = { function: "fillLogTable" };
    $.ajax({
        type: 'POST',
        url: "php/adminlogsfn.php",
        data: data,

        success: function (response) {
            var response = JSON.parse(response);
            if (response.status == 0) {
                alert(response.err);
                window.location.href = response.redirect;
            } else if (response.status == 2) {
                alert(response.err);
                window.location.href = response.redirect;
            } else if (response.status == 3) {
                alert(response.err);
                window.location.href = response.redirect;
            } else {
                fillLogTable(response);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function fillLogTable(response) {
    var table = document.getElementById('logTableBody');
    table.innerHTML = '';
    for (var i = 0; i < response.length; i++) {
        var cell = formLogTableforDisplay(response[i]);
        table.insertAdjacentHTML('beforeEnd', cell);
    }
}


function formLogTableforDisplay(content) {
    var log = content.log_content;
    var ip = content.log_ip;
    var time = content.log_time;

    var cell =
        '<tbody id="body" class="body"><tr>' +
        '<td class="col0">' + log + '</td><td class="col1">' + ip + '</td>' +
        '<td class="col2">' + time + '</div></td></tr></tbody>'

    return cell;
}
