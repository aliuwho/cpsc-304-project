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
    $locations = printLocations($result);
    echo "<br>" . printLocations($result) . "<br>";

}

/* function printLocations($result) { //prints locations
    echo "<br>All Locations:<br>";
    echo "<table>";
    echo "<tr><th>StreetName</th> &nbsp;  <th>StreetNo</th> &nbsp; <th>PostalCode</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<tr><td>" . $row["STREETNAME"] . "</td><td>"
        . $row["STREETNO"] . "</td><td>"
        . $row["POSTALCODE"] . "</td></tr>";
    }

    echo "</table>";
} */

function printLocations($result) { //prints locations
    $locations = "<br>All Locations:<br>";
    $locations .= "<table>";
    $locations .= "<tr><th>StreetName</th> &nbsp;  <th>StreetNo</th> &nbsp; <th>PostalCode</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       $locations .= "<tr><td>" . $row["STREETNAME"] . "</td><td>"
        . $row["STREETNO"] . "</td><td>"
        . $row["POSTALCODE"] . "</td></tr>";
    }

    $locations .= "</table>";
    return $locations;
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
    echo "View";

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
    $empty = true;

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<br>" . $row[0] . "<br>";
       $empty = false;
    }
    if ($empty) {
        echo "<br>No requests to display.<br>";
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

?>