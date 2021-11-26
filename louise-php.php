<?php 
function handleInsertLocationRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['streetname'],
                ":bind2" => $_POST['streetno'],
                ":bind3" => $_POST['postalcode'],
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("INSERT INTO LocationAddress values (:bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);
}

function handleViewLocationsRequest() {

    $result = executePlainSQL("select * from LocationAddress");
    echo "<br>" . printLocations($result) . "<br>";

}

function printLocations($result) { //prints locations
    echo "<br>All Locations:<br>";
    echo "<table>";
    echo "<tr><th>StreetName</th> &nbsp;  <th>StreetNo</th> &nbsp; <th>PostalCode</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<tr><td>" . $row["STREETNAME"] . "</td><td>"
        . $row["STREETNO"] . "</td><td>"
        . $row["POSTALCODE"] . "</td></tr>";
    }

    echo "</table>";
}

function handleDeleteLocationRequest() {
    global $db_conn;
    
    $tuple = array (
        ":bind1" => $_POST['streetName'],
        ":bind2" => $_POST['streetNo']
    );

    $alltuples = array (
        $tuple
    );


    executeBoundSQL("delete from locationaddress where
    streetname=:bind1 and streetno=:bind2", $alltuples);
    OCICommit($db_conn);
}

?>
<!-- 
echo "<br>Retrieved data from table demoTable:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]" 
            }

            echo "</table>"; -->