<?php
    if(isset($_POST['key'])) {

        $conn = new mysqli('localhost', 'root', 'dtb456', 'db1');

        if($_POST['key'] == 'getRowData') {
            $rowID = $conn->real_escape_string($_POST['rowID']);
            $sql = $conn->query("SELECT name, description, prize FROM items WHERE id='$rowID'");
            $data = $sql->fetch_array();
            $jsonArray = array(
                'name' => $data['name'],
                'description' => $data['description'],
                'prize' => $data['prize']
            );
            exit(json_encode($jsonArray));
        }
        if($_POST['key'] == 'getExistingData') {

            $sql = $conn->query("SELECT id, name FROM items");
            if($sql->num_rows > 0) {
                $response = "";
                while ($data = $sql->fetch_array()) {
                    $response .= '
                        <tr>
                            <td>'.$data["id"].'</td>
                            <td id="item_'.$data["id"].'">'.$data["name"].'</td>
                            <td>
                                <input type="button" onclick="viewOREdit('.$data["id"].', \'edit\')" value="Edit" class="btn btn-primary">
                                <input type="button" onclick="viewOREdit('.$data["id"].', \'view\')" value="View" class="btn btn-warning">
                                <input type="button" onclick="deleteRow('.$data["id"].')" value="Delete" class="btn btn-danger">
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            } else {
                exit('reachedMax');
            }
        }
        $rowID = $conn->real_escape_string($_POST['rowID']);

        if($_POST['key'] == 'deleteRow') {
            $conn->query("DELETE FROM items WHERE id='$rowID'");
            exit('deleted');
        }

        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $prize = $conn->real_escape_string($_POST['prize']);


        if($_POST['key'] == 'updateRow') {
            $conn->query("UPDATE items SET name='$name', description='$description', prize='$prize' WHERE id='$rowID'");
            exit("success");
        }
        if($_POST['key'] == 'addNew') {
            $sql = $conn->query("SELECT id FROM items WHERE name= '$name'");
            if($sql->num_rows > 0) {
                exit("Tento zapis exituje");
            } else {
                $conn->query("INSERT INTO items (name, description, prize) VALUES ('$name', '$description', '$prize')");
                exit("Bol pridany zapis");
            }
        }
    }
