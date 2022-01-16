$(document).ready(function () {
    $("#addNew").on('click', function () {
        $("#tableManager").modal('show');
    });
    getExistiongData();
});

$("#tableManager").on('hidden.bs.modal', function () {
    $("#showContent").fadeOut();
    $("#editContent").fadeIn();
    $("#editRowID").val(0);
    $("#name").val('');
    $("#mail").val('');
    $("#number").val('');
    $("#manageBtn").attr('value', 'Save').attr('onclick', "manageData('addNew')");
});

function deleteRow(rowID) {
    if(confirm("Naozaj chces odstranit tento kontakt?")) {
        $.ajax({
            url: 'includes/contactsManager.inc.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            }, success: function (response) {
                $("#contact_"+rowID).parent().remove();
                alert(response);
            }
        });
    }
}

function viewOREdit(rowID, type) {
    $.ajax({
        url: 'includes/contactsManager.inc.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getRowData',
            rowID: rowID
        }, success: function (response) {
            if(type == "view") {
                $("#showContent").fadeIn();
                $("#editContent").fadeOut();
                $("#mailView").html(response.mail)
                $("#numberView").html(response.number)
            } else {
                $("#showContent").fadeOut();
                $("#editContent").fadeIn();
                $("#editRowID").val(rowID);
                $("#name").val(response.name);
                $("#mail").val(response.mail);
                $("#number").val(response.number);
                $("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
            }
            $("#tableManager").modal('show');
        }
    });
}

function getExistiongData() {
    $.ajax({
        url: 'includes/contactsManager.inc.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'getExistingData',
        }, success: function (response) {
            if (response != "reachedMax") {
                $('tbody').append(response);
            }
        }
    });
}

function manageData(key) {
    var name = $("#name");
    var mail = $("#mail");
    var number = $("#number");
    var editRowID = $("#editRowID");

    if(isNotEmpty(name) && isNotEmpty(mail) && isNotEmpty(number)) {
        $.ajax({
            url: 'includes/contactsManager.inc.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: key,
                name: name.val(),
                mail: mail.val(),
                number: number.val(),
                rowID: editRowID.val()
            }, success: function (response) {
                if(response != "success"){
                    alert(response);
                } else {
                    $("#contact_"+editRowID.val()).html(name.val());
                    name.val('');
                    mail.val('');
                    number.val('');
                    $("#tableManager").modal('hide');
                    $("#manageBtn").attr('value', 'Save').attr('onclick', "manageData('addNew')");
                }
            }
        });
    }


}

function isNotEmpty(caller) {
    if (caller.val() == '') {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');

    return true;
}