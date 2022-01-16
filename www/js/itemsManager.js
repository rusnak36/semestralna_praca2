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
    $("#description").val('');
    $("#prize").val('');
    $("#manageBtn").attr('value', 'Save').attr('onclick', "manageData('addNew')");
});

function deleteRow(rowID) {
    if(confirm("Naozaj chces odstranit tento prispevok?")) {
        $.ajax({
            url: 'includes/itemsManager.inc.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            }, success: function (response) {
                $("#item_"+rowID).parent().remove();
                alert(response);
            }
        });
    }
}

function viewOREdit(rowID, type) {
    $.ajax({
        url: 'includes/itemsManager.inc.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getRowData',
            rowID: rowID
        }, success: function (response) {
            if(type == "view") {
                $("#showContent").fadeIn();
                $("#editContent").fadeOut();
                $("#descriptionView").html(response.description)
                $("#prizeView").html(response.prize)
            } else {
                $("#showContent").fadeOut();
                $("#editContent").fadeIn();
                $("#editRowID").val(rowID);
                $("#name").val(response.name);
                $("#description").val(response.description);
                $("#prize").val(response.prize);
                $("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
            }
            $("#tableManager").modal('show');
        }
    });
}

function getExistiongData() {
    $.ajax({
        url: 'includes/itemsManager.inc.php',
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
    var description = $("#description");
    var prize = $("#prize");
    var editRowID = $("#editRowID");

    if(isNotEmpty(name) && isNotEmpty(description) && isNotEmpty(prize)) {
        $.ajax({
            url: 'includes/itemsManager.inc.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: key,
                name: name.val(),
                description: description.val(),
                prize: prize.val(),
                rowID: editRowID.val()
            }, success: function (response) {
                if(response != "success"){
                    alert(response);
                } else {
                    $("#item_"+editRowID.val()).html(name.val());
                    name.val('');
                    description.val('');
                    prize.val('');
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