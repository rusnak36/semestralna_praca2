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
    <title>NewsManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<div class="container">
    <div id="tableManager" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Kontent</h2>
                </div>
                <div class="modal-body">
                    <div id="editContent">
                        <input type="text" class="form-control" placeholder="Nazov polozky..." id="prispevok"><br>
                        <textarea class="form-control" placeholder="Text" id="description"></textarea><br>
                        <input type="hidden" id="editRowID" value="0">
                    </div>
                    <div id="showContent" style="display:none;">
                        <h4>Description</h4>
                        <div id="descriptionView"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" id="manageBtn" value="Save" onclick="manageData('addNew')" class="btn btn-success">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
         <div>
             <input style="float: right" type="button" value="Add New" id="addNew" class="btn btn-success">
         </div>
        <table class="table table-hover table-bordered">
            <tr>
                <td class="column">id_post</td>
                <td class="column">post_name</td>
                <td class="column">options</td>
            </tr>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/newsManager.js"></script>
</html>