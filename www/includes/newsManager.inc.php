<?php
    if(isset($_POST['key'])) {

        $conn = new mysqli('localhost', 'root', 'dtb456', 'db1');

        if ($_POST['key'] == 'getRowData') {
            $rowID = $conn->real_escape_string($_POST['rowID']);

            $insert = $conn->prepare("SELECT post_name, post_description FROM posts WHERE id_post=?");
            $insert->bind_param("i", $rowID);
            $insert->execute();
            $insert->store_result();
            $insert->bind_result($post_name, $post_description);
            $insert->fetch();
            $jsonArray = array(
                'name' => $post_name,
                'description' => $post_description,
            );
            exit(json_encode($jsonArray));


//            $sql = $conn->query("SELECT post_name, post_description FROM posts WHERE id_post='$rowID'");
//            $data = $sql->fetch_array();
//            $jsonArray = array(
//                'name' => $data['post_name'],
//                'description' => $data['post_description']
//            );
//
//            exit(json_encode($jsonArray));
        }


        if ($_POST['key'] == 'getExistingData') {
            $sql = $conn->query("SELECT id_post, post_name FROM posts");
            if ($sql->num_rows > 0) {
                $response = "";
                while ($data = $sql->fetch_array()) {
                    $response .= '
                        <tr>
                            <td>'.$data["id_post"].'</td>
                            <td id="post_'.$data["id_post"].'">'.$data["post_name"].'</td>
                            <td>
                                <input type="button" value="Edit" onclick="viewOREdit('.$data["id_post"].', \'edit\')" class="btn btn-primary">
                                <input type="button" value="View" onclick="viewOREdit('.$data["id_post"].', \'view\')" class="btn btn-warning">
                                <input type="button" onclick="deleteRow('.$data["id_post"].')" value="Delete" class="btn btn-danger">
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
        if ($_POST['key'] == 'deleteRow') {

            $insert = $conn->prepare("DELETE FROM posts WHERE id_post=?");
            $insert->bind_param("i", $rowID);
            $insert->execute();

            //$conn->query("DELETE FROM posts WHERE id_post='$rowID'");
            exit('Prispevok bol znazany!');
        }

        $name = $conn->real_escape_string($_POST['name']);
        $description = $_POST['description'];
        $rowID = $conn->real_escape_string($_POST['rowID']);

        if ($_POST['key'] == 'updateRow') {

            $insert = $conn->prepare("UPDATE posts SET post_name=?, post_description=? WHERE id_post=?");
            $insert->bind_param("ssi", $name, $description, $rowID);
            $insert->execute();

//            $conn->query("UPDATE posts SET post_name='$name', post_description='$description' WHERE id_post='$rowID'");
            exit('success');
        }


        if ($_POST['key'] == 'addNew') {

            $insert = $conn->prepare("SELECT * FROM posts WHERE post_name = ?");
            $insert->bind_param("s", $name);
            $insert->execute();
            $insert->store_result();
            $insert->fetch();
            if($insert->num_rows > 0) {
                exit("Tento zapis exituje");
            } else {
                $insert = $conn->prepare("INSERT INTO posts (post_name, post_description) VALUES (?, ?)");
                $insert->bind_param("ss", $name, $description);
                $insert->execute();

                exit("Bol pridany zapis");
            }


//            $sql = $conn->query("SELECT * FROM posts WHERE post_name = '$name'");
//            if($sql->num_rows > 0) {
//                exit("Prispevok exituje");
//            } else {
//               $conn->query("INSERT INTO posts (post_name, post_description) VALUES ('$name', '$description')");
//                exit("Prispevok bol pridany");
//            }
        }
    }
