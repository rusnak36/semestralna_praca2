<?php
    if(isset($_POST['key'])) {

        $conn = new mysqli('localhost', 'root', 'dtb456', 'db1');


        if($_POST['key'] == 'getRowData') {
            $rowID = $conn->real_escape_string($_POST['rowID']);
            $sql = $conn->query("SELECT name, mail, number FROM contacts WHERE id='$rowID'");
            $data = $sql->fetch_array();
            $jsonArray = array(
                'name' => $data['name'],
                'mail' => $data['mail'],
                'number' => $data['number']
            );
            exit(json_encode($jsonArray));
        }

        if($_POST['key'] == 'getExistingData') {
            $sql = $conn->query("SELECT id, name FROM contacts");
            if($sql->num_rows > 0) {
                $response = "";
                while($data = $sql->fetch_array()) {
                    $response .= '
                        <tr>
                            <td>'.$data["id"].'</td>
                            <td id="contact_'.$data["id"].'">'.$data["name"].'</td>
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
                exit("reachedMax");
            }
        }

        $rowID = $conn->real_escape_string($_POST['rowID']);

        if($_POST['key'] == 'deleteRow') {
            $conn->query("DELETE FROM contacts WHERE id='$rowID'");
            exit('deleted');
        }


        $name = $conn->real_escape_string($_POST['name']);
        $mail = $conn->real_escape_string($_POST['mail']);
        $number = $conn->real_escape_string($_POST['number']);


        if($_POST['key'] == 'updateRow') {
            $conn->query("UPDATE contacts SET name='$name', mail='$mail', number='$number' WHERE id='$rowID'");
            exit("success");
        }
        if($_POST['key'] == 'addNew') {
            $sql = $conn->query("SELECT id FROM contacts WHERE name='$name'");
            if($sql->num_rows > 0) {
                exit("Tento zapis uz existuje");
            } else {
                $conn->query("INSERT INTO contacts (name, mail, number) VALUES ('$name','$mail','$number')");
                exit("Zapis sa vykonal");
            }
        }
    }
