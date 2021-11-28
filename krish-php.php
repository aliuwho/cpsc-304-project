<?php 
function handleDeleteListingRequest() {
    global $db_conn;
            
            // Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['PostID']
            );

            $alltuples = array (
                $tuple
            );
            echo "<br>IM HER2E<br>";

            executeBoundSQL("delete from listing where id=:bind1", $alltuples);
            echo "<br>IM HER3E<br>";
            OCICommit($db_conn);
        }
function handleFulfillRequest() {
    global $db_conn;
    $tuple = array (
        ":bind1" => $_POST['PostIDR'],
        ":bind2" => 1,
        //":bind3" => 1
    );

    $alltuples = array (
        $tuple
    );

    executeBoundSQL("update request set fulfilled=:bind2 where post_id=:bind1", $alltuples);
    OCICommit($db_conn);
    executeBoundSQL("update request set fulfilled_on=1 where post_id=:bind1", $alltuples); 
        }
?>