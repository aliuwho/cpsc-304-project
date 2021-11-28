<?php 
function handleInsertRequestRequest() {
    global $db_conn;
    //$postID= microtime() + floor(rand()*10000);
    $id = hexdec( uniqid() );
    $fulfilledid = hexdec( uniqid() );
    $postID = $id;
    $today = date('26/02/2010');
    $postStatus = "Open";
    //$today1 = TO_DATE('26/02/2010', 'DD/MM/YYYY');
    echo "<br>IM HERE1<br>";
    echo "<br>IM HERE3<br>";
    $tuplePost = array (
        ":bind0" => $postID,
        ":bind1" => "Listing",
        ":bind2" => 0,
        ":bind3" => $createdon,
        ":bind4" => $createdon,
        ":bind5" => $createdon,
        ":bind6" => $postStatus
    );
    $allPosttuples = array (
        $tuplePost
    ); 
    //Listing tuples 
     $tuple = array (
        ":bind0" => $postID,
        ":bind1" => $_POST['insDescription'],
        ":bind2" => 0,
        ":bind3" => $today,
        ":bind4" => 0,

        
    );
    $alltuples = array (
        $tuple
    ); 
    echo "<br>IM HER2E<br>";
    executeBoundSQL("insert into Post(post_id,post_type,account_id,created_on,updated_on,expiration,post_status) values (:bind0,:bind1,:bind2,TO_DATE('26/02/2010', 'DD/MM/YYYY'),TO_DATE('26/02/2010', 'DD/MM/YYYY'),TO_DATE('26/02/2010', 'DD/MM/YYYY'),:bind6)", $allPosttuples);
    OCICommit($db_conn);
    echo "<br>IM HERE1<br>";
    executeBoundSQL("insert into Request values(:bind0,:bind1,:bind2,TO_DATE('26/02/2010', 'DD/MM/YYYY'),:bind4)", $alltuples);
    echo "<br>IM HERE<br>";
     OCICommit($db_conn);

    // $timestamp = date('Y-m-d H:i:s');
    // $exp = date("j, n, Y+1");
    //     $postID = $id;
    //     $postType="Review";
    //     $postStatus = "Open";
    //     $account = 0;
    //     $createdon = $today1;
    //     $updatedOn =$today1;
    //     $expire = $today1;
    //     $pid = 9;
    //     $requestDescription = $_POST['insDescription'];
    //  executePlainSQL("insert into Post values ('$postID','$postType','$account',
    //  '$createdon','$updatedon','$expire','$postStatus')");
    // executePlainSQL("insert into Review values ('$postID','$requestDescription',)");
    // OCICommit($db_conn);

}
function handleDeleteListingRequest() {
    global $db_conn;
    echo "<br>IM HER2E<br>";
            // Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['PostID']
            );

            $alltuples = array (
                $tuple
            );
            echo "<br>IM HER2E<br>";

            executeBoundSQL("delete from listing where post_id=:bind1", $alltuples);
            echo "<br>IM HER3E<br>";
            OCICommit($db_conn);
        }
function handleFulfillRequest() {
    echo "<br>IM HER2E<br>";
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
    executeBoundSQL("update request set fulfilled_on=TO_DATE('26/02/2010', 'DD/MM/YYYY') where post_id=:bind1", $alltuples); 
        }
function handleUpdateListing() {
    echo "<br>IM HERzE<br>";
    global $db_conn;
    $tuple = array (
        ":bind1" => $_POST['PostIDU'],
        ":bind2" => $_POST['NewItem'],
        //":bind3" => 1
    );

    $alltuples = array (
        $tuple
    );

    executeBoundSQL("update listing set item=:bind2 where post_id=:bind1", $alltuples);
    OCICommit($db_conn);
    //executeBoundSQL("update request set fulfilled_on=1 where post_id=:bind1", $alltuples); 
        }
function handleCountFulfilledRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM Request WHERE fulfilled=1");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples fulfilled in Request: " . $row[0] . "<br>";
            }
        }


function handlePostToCat(){
    echo "<br>IM HERzE<br>";
    global $db_conn;
    $tuple = array (
        ":bind1" => $_POST['CategoryP'],
        ":bind2" => $_POST['POSTIDC']

        //":bind2" => $_POST['NewItem'],
        //":bind3" => 1
    );

    $alltuples = array (
        $tuple
    );

    executeBoundSQL("update post set post_type=:bind1 where post_id=:bind2", $alltuples);
    OCICommit($db_conn);

}       
// function handleSelectCategoryRequest() {
//             global $db_conn;

//              $result = executePlainSQL("SELECT * FROM Request WHERE");
// 		printResult($result);
            
//             if (($row = oci_fetch_row($result)) != false) {
//                 echo "<br> The number of tuples in Listing: " . $row[0] . "<br>";
//             }
//         }

// function viewPost($result, $selected){
//     echo "<br>Posts in " . $selected . ":";
//     $empty = true;

//     while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
//        echo "<br>" . $row[0] . "<br>";
//        $empty = false;
//     }
//     if ($empty) {
//         echo "<br>No Posts in Category.<br>";
//     }

// }

?>