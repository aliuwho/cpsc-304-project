<?php 

//A. REQUEST HANDLERS

//1. Locations
function handleInsertLocationRequest() {
    global $db_conn;

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

//2. Categories
function handleViewEmptyCategoriesRequest() {
    $result = executePlainSQL("SELECT COUNT(*) FROM category WHERE name NOT IN (SELECT category FROM belongsto)");
    echo "<br>" . printEmptyCategories($result) . "<br>";
}

function handleViewCategoryCountRequest() {
    $result = executePlainSQL("SELECT category, count(*) AS COUNT FROM BelongsTo b
    GROUP BY category");
    $heading = "Categories Containing Posts:";
    echo "<br>" . printCategoryCount($result, $heading) . "<br>";

}

function handleViewPopularCategoriesRequest() {
    $result = executePlainSQL("SELECT category, count(*) AS COUNT FROM Post p JOIN BelongsTo b ON p.post_id = b.post_id GROUP BY Category 
    HAVING Count(*) > (SELECT avg(count(*)) FROM Post p JOIN BelongsTo b ON p.post_id = b.post_id GROUP BY Category)");
    $heading = "Most Popular Categories:";
    echo "<br>" . printCategoryCount($result, $heading) . "<br>";
}

//3. Posts, Requests, and Listings
function handleViewPostsByCategoryRequest() {
    if(!empty($_GET['category'])) {
        $selected = $_GET['category'];
    } else {
        echo 'Please select the value.';
    }

    $requests = executePlainSQL("SELECT post_description FROM request r JOIN belongsto b
    ON r.post_id = b.post_id WHERE b.category = '" . $selected . "'");
    $listings = executePlainSQL("SELECT item FROM listing l JOIN belongsto b
    ON l.post_id = b.post_id WHERE b.category = '" . $selected . "'");
    echo "<br>" . printPosts($requests, $listings, $selected) . "<br>";
    
}

function handleListingInfoRequest() {
    //structure obtained from this post:
    //https://piazza.com/class/ks2hjsuk3qh2jo?cid=746
    global $db_conn;

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
    
        printListingInfo($result, $selected);
    } else {
        echo 'Please select an item.';
    }
}

//B. HANDLER-SPECIFIC DISPLAYS
function printLocations($result) {
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

function printEmptyCategories($result) {
    echo "<br>Number of empty categories: " . OCI_Fetch_Array($result, OCI_BOTH)[0] . "<br>";
}

function printPosts($requests, $listings, $selected) {
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

function printListingInfo($result, $selected) {
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