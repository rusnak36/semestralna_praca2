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
    $("#description").val("");
    $("#prispevok").val("");
    $("#closeBtn").fadeOut();
    $("#manageBtn").attr('value', 'Add New').attr('onclick', "manageData('addNew')").fadeIn();
});

function deleteRow(rowID){
    if(confirm("Naozaj chces tuto polozku odstanit?")) {
        $.ajax({
            url: 'includes/newsManager.inc.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            }, success: function (response) {
                $("#post_"+rowID).parent().remove();
                alert(response);
            }
        });
    }
}

function viewOREdit(rowID, type) {
    $.ajax({
        url: 'includes/newsManager.inc.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getRowData',
            rowID: rowID
        }, success: function (response) {
            if(type == "view") {

                $("#descriptionView").html(response.description);
                $("#editContent").fadeOut();
                $("#showContent").fadeIn();
            } else {
                $("#editContent").fadeIn();
                $("#showContent").fadeOut();
                $("#editRowID").val(rowID);
                $("#prispevok").val(response.name);
                $("#description").val(response.description);
                $("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
            }
            $("#tableManager").modal('show');
        }
    });
}

function getExistiongData() {
    $.ajax({
        url: 'includes/newsManager.inc.php',
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
    var name = $("#prispevok");
    var description = $("#description");
    var editRowID = $("#editRowID");

    if (isNotEmpty(name) && isNotEmpty(description)) {
        $.ajax({
            url: 'includes/newsManager.inc.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: key,
                name: name.val(),
                description: description.val(),
                rowID: editRowID.val()
            }, success: function (response) {
                if (response != "success")
                    alert(response);
                else {
                    $("#post_"+editRowID.val()).html(name.val());
                    name.val('');
                    description.val('');
                    $("#tableManager").modal('hide');
                    $("#manageBtn").attr('value', 'Add').attr('onclick', "manageData('addNew')");
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