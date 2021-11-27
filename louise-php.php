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

function handleViewEmptyCategoriesRequest() {

    $result = executePlainSQL("SELECT COUNT(*) FROM category WHERE name NOT IN (SELECT category FROM belongsto)");
    echo "<br>" . printEmptyCategories($result) . "<br>";
    
}

function handleViewRequestsByCategoryRequest() {

    if(!empty($_GET['category'])) {
        $selected = $_GET['category'];
    } else {
        echo 'Please select the value.';
    }

    $result = executePlainSQL("select post_description from request r join belongsto b
    on r.post_id = b.post_id where b.category = '" . $selected . "'");
    echo "<br>" . viewRequests($result, $selected) . "<br>";
    
}

function printEmptyCategories($result) {
    echo "<br>Number of empty categories: " . OCI_Fetch_Array($result, OCI_BOTH)[0] . "<br>";
    //echo "<table>";
    //echo "<tr><th>Number of empty categories:</th></tr>";

    /* while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<tr><td>" . $row[0] . "</td></tr>";
    } */

    echo "</table>";
}

function viewRequests($result, $selected) {
    echo "<br>Requests in " . $selected . ":";

    if (($result->num_rows) == 0){
        echo "<br>No requests to display.<br>";
    }
    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<br>" . $row[0] . "<br>";
    }
}

function displayMenu($result) {
    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        $name = $row[0];
        echo "<tr><td>" . $row[0] . "</td></tr>";
        $menuDisplay .= '<li>'. $name . '</li>';
    }
    echo $menuDisplay;
}

function populateMenu() {
    global $db_conn;
    $categories = executePlainSQL("SELECT name FROM Category");
    echo "<option value='PLACEHOLDER'>" . "whoop" . "</option>";
    echo "<option value='PLACEHOLDER'>" . $categories[0] . "</option>";
    while ($row = OCI_Fetch_Array($categories, OCI_BOTH)) {
        echo "<option value='PLACEHOLDER'>" . $row[0] . "</option>"; 
    }
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