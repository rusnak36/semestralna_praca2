<?php
session_start();
if(!isset($_SESSION["id"])) {
    header("location: ../posts.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>contactManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div id="tableManager" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Content</h2>
                </div>
                <div class="modal-body">
                    <div id="editContent">
                        <input type="text" class="form-control" placeholder="Meno" id="name">
                        <br>
                        <input type="text" class="form-control" placeholder="Mail" id="mail">
                        <br>
                        <input type="text" class="form-control" placeholder="Cislo" id="number">
                        <input type="hidden" id="editRowID" value="0">
                    </div>
                    <div id="showContent" style="display: none;">
                        <h4>Mail</h4>
                        <div id="mailView"></div>
                        <br>
                        <h4>Number</h4>
                        <div id="numberView"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" id="manageBtn" onclick="manageData('addNew')" value="Save" class="btn btn-success">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <input type="button" id="addNew" style="float: right" class="btn btn-success" value="Add">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Options</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/contactManager.js"></script>
</body>
</html>
