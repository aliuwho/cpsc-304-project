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

    $requests = executePlainSQL("select post_description from request r join belongsto b
    on r.post_id = b.post_id where b.category = '" . $selected . "'");
    $listings = executePlainSQL("select item from listing l join belongsto b
    on l.post_id = b.post_id where b.category = '" . $selected . "'");
    echo "<br>" . viewRequests($requests, $listings, $selected) . "<br>";
    
}

function printEmptyCategories($result) {
    echo "<br>Number of empty categories: " . OCI_Fetch_Array($result, OCI_BOTH)[0] . "<br>";
    //echo "<table>";
    //echo "<tr><th>Number of empty categories:</th></tr>";

    /* while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<tr><td>" . $row[0] . "</td></tr>";
    } */

    //echo "</table>";
}

function viewRequests($requests, $listings, $selected) {
    echo "<br>Requests in " . $selected . ":";
    $empty = true;

    while ($row = OCI_Fetch_Array($requests, OCI_BOTH)) {
       echo "<br>" . $row[0] . "<br>";
       $empty = false;
    }
    if ($empty) {
        echo "<br>No requests to display.<br>";
    }

    echo "<br>Listings in " . $selected . ":";
    $empty = true;

    while ($row = OCI_Fetch_Array($listings, OCI_BOTH)) {
       echo "<br>" . $row[0] . "<br>";
       $empty = false;
    }
    if ($empty) {
        echo "<br>No listings to display.<br>";
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

function handleViewCategoryCountRequest() {

    $result = executePlainSQL("select category, count(*) as COUNT from BelongsTo b
    GROUP BY category");
    $heading = "Categories Containing Posts:";
    echo "<br>" . printCategoryCount($result, $heading) . "<br>";

}

function handleViewPopularCategoriesRequest() {

    $result = executePlainSQL("select category, count(*) as COUNT from Post p JOIN BelongsTo b ON p.post_id = b.post_id GROUP BY Category 
    Having Count(*) > (select avg(count(*)) from Post p JOIN BelongsTo b ON p.post_id = b.post_id GROUP BY Category)");
    $heading = "Most Popular Categories:";
    echo "<br>" . printCategoryCount($result, $heading) . "<br>";

}

function printCategoryCount($result, $heading) {
    echo "<br>" . $heading . "<br>";
    echo "<table>";
    echo "<tr><th>Category</th><th>Number of Posts</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<tr><td>" . $row["CATEGORY"] . "</td><td>"
        . $row["COUNT"] . "</td></tr>";
    }

    echo "</table>";
}

function handleListingInfoRequest() {
    //structure obtained from this post:
    //https://piazza.com/class/ks2hjsuk3qh2jo?cid=746
    global $db_conn;
    
/*     $name = $_GET['Poster Name'];
    $email = $_GET['Poster Email'];
    $created = $_GET['Created On'];
    $expiration = $_GET['Expiration'];
    $status = $_GET['Status']; */

    $attributes = $_GET['attributes'];
    $attributes = implode(', ', array_filter($attributes));


    if (empty($attributes)) {
        $attributes = '*';
    }

    if(!empty($_GET['item'])) {
        $selected = $_GET['item'];
        $result = executePlainSQL(
            "SELECT " . $attributes .
            " FROM Post p JOIN Account a ON a.id = p.account_id JOIN Listing l ON l.post_id = p.post_id WHERE 
            l.item = '" . $selected . "'");
    
        printPostInfo($result, $selected);
    } else {
        echo 'Please select an item.';
    }
}

function printPostInfo($result, $selected) {
    echo "<br> Listing Information for " . $selected . ": <br>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Created On</th><th>Expiration</th><th>Status</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
       echo "<tr><td>" . $row["NAME"] . "</td><td>"
        . $row["EMAIL"] . "</td><td>"
        . strtok($row["CREATED_ON"], " ") . "</td><td>"
        . strtok($row["EXPIRATION"], " ") . "</td><td>"
        . $row["POST_STATUS"] . "</td></tr>";
    }

    echo "</table>";
}


?>