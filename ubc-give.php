
<!--Built using the test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  Modified by Louise Cooke, Amy Liu, and Krish Thukral
  
  IF YOU HAVE TABLES MATCHING THOSE IN tables.sql THEY WILL BE DESTROYED

  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the 
  OCILogon below to be your ORACLE username and password -->
  <html>
    <head>
        <link rel="stylesheet" href="index.css">
        <title>UBC GIVE</title>
    </head>

    <body>
        <h1>
            <center>
            UBC GIVE
</center>
        </h1>
        <div class="column">
        <h2>Reset</h2>
        <p>Click the reset button to drop the tables. Proceed with caution!</p>

        <form method="POST" action="ubc-give.php">
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <h2>Insert Listing</h2>
        <form method="POST" action="ubc-give.php">
            <input type="hidden" id="insertListingQueryRequest" name="insertListingQueryRequest">
            Item: <input type="text" name="insItemL">
            
            <input type="submit" value="Insert Listing" name="insertListingSubmit"></p>
        </form>
        
        <h2>Insert Review</h2>
        <form method="POST" action="ubc-give.php">
            <input type="hidden" id="insertReviewQueryRequest" name="insertReviewQueryRequest">
            Item: <input type="text" name="insReviewDescription">
            
            <input type="submit" value="Insert Review" name="insertReviewSubmit"></p>
        </form>
 
        <h2>Insert Request</h2>
        <form method="POST" action="ubc-give.php">
            <input type="hidden" id="insertRequestQueryRequest" name="insertRequestQueryRequest">
            Description: <input type="text" name="insDescription">
        <input type="submit" value="Insert Request" name="insertRequestSubmit"></p> 
        </form>
        
<!--         <h2>Update Name in Account</h2>
       
        <form method="POST" action="ubc-give.php"> 
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form> -->

        <h2>Queries for Listings</h2>
        <form method="GET" action="ubc-give.php"> 
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" value="Count All" name="countTuples">

            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
            <input type="submit" value="Display All" name="displayTuples"></p>
        </form>


        <?php 
        include "./krish-remaining-queries.html";
        include "./louise-queries.html";
        include "./amy-queries.html";
        include "./krish-php.php";
        include "./louise-php.php";
        include "./amy-php.php";


        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr); 

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. 
		See the sample code below for how this function is used */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function printListings($result) { //prints results from a select statement
            echo "<br>All Listings:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Item</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["POST_ID"] . "</td><td>" . $row["ITEM"] . "</td></tr>"; //or just use "echo $row[0]" 
            }

            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
			// ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_aimyul", "a12757563", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE demoTable SET name='" . $new_name . "' WHERE name='" . $old_name . "'");
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Delete tables
            echo "<br> Creating new tables <br>";
            executePlainSQL("DROP TABLE Suggests");
            executePlainSQL("DROP TABLE Pickup");
            executePlainSQL("DROP TABLE LocationAddress");
            executePlainSQL("DROP TABLE BelongsTo");
            executePlainSQL("DROP TABLE Bid");
            executePlainSQL("DROP TABLE Receives");
            executePlainSQL("DROP TABLE Review");
            executePlainSQL("DROP TABLE Broadcast");
            executePlainSQL("DROP TABLE Flag");
            executePlainSQL("DROP TABLE Ticket");
            executePlainSQL("DROP TABLE Category");
            executePlainSQL("DROP TABLE Request");
            executePlainSQL("DROP TABLE Listing");
            executePlainSQL("DROP TABLE Post");
            executePlainSQL("DROP TABLE Moderator");
            executePlainSQL("DROP TABLE Account");
            

            // // Add tuples
            // echo "<br> Filling tables <br>";
            // // executePlainSQL("start tuples.sql");
            // // TODO ADD STATEMENTS FOR INSERTING TUPLES
            // executePlainSQL("@tuples.sql");
            OCICommit($db_conn);
        }

        // TEMPLATE FOR INSERTS
        function handleInsertRequest() {
            global $db_conn;

            $tuple = array (
                ":bind1" => $_POST['insNo'],
                ":bind2" => $_POST['insName']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into demoTable values (:bind1, :bind2)", $alltuples);
            OCICommit($db_conn);
        }

        function categoryDropDown() {
            connectToDB();
            $result = executePlainSQL("SELECT name from Category");
            echo "<select name='category'>";
                echo "<option value=''>--Select--</option>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<option value='" . $row['NAME'] . "'>" . $row['NAME'] . "</option>";
                }
            echo "</select>";
            disconnectFromDB();
            
        }
        
        function itemDropDown() {
            connectToDB();
            $result = executePlainSQL("SELECT item from Listing");
            echo "<select name='item'>";
                echo "<option value=''>--Select--</option>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<option value='" . $row['ITEM'] . "'>" . $row['ITEM'] . "</option>";
                }
            echo "</select>";
            disconnectFromDB();
        } 
       
        function handleListingInsertRequest() {
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

           
        function handleInsertListingRequest() {
            global $db_conn;
            echo "<br>IM HERE<br>";
            //$postID= microtime() + floor(rand()*10000);
             $id = hexdec( uniqid() );
            $today = date("j, n, Y");
            $today2=date("Y-m-d H:i:s");
            echo "<br>IM HERE<br>"; 
            $postID = $id;
            $postStatus = "Open";


            //$today1 = TO_DATE('26/02/2010', 'DD/MM/YYYY');
            // echo "<br>IM HERE<br>";
            // $timestamp = date('Y-m-d H:i:s');
            // $exp = date("j, n, Y+1");
                
            //     $postType="Listing";
            
            //     $account = 34;
            //     $createdon = $today;
            //     $updatedOn =$today;
            //     $expire = $today;
            //     $pid = 9;
            //     $listing = $_POST['insItemL']; 
            //   executePlainSQL("insert into Post values ('$postID','$postType','$account',
            //  CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$postStatus')");
            // executePlainSQL("insert into Listing values ('$postID','$listing')"); 

           // echo "<br>IMHERREEE<br>";
           // OCICommit($db_conn);
           echo "<br>IM HEREEE<br>";
           
            //$today1 = TO_DATE('26/02/2010', 'DD/MM/YYYY');
            // $updatedOn =$today1;
            // $expire = $today1;
            echo "<br>IM HERE1<br>";
            
            
            
           //$createdon = $today2;
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
                ":bind1" => $_POST['insItemL']
            );
            $alltuples = array (
                $tuple
            ); 
            echo "<br>IM HER2E<br>";
            executeBoundSQL("insert into Post(post_id,post_type,account_id,created_on,updated_on,expiration,post_status) values (:bind0,:bind1,:bind2,TO_DATE('26/02/2010', 'DD/MM/YYYY'),TO_DATE('26/02/2010', 'DD/MM/YYYY'),TO_DATE('26/02/2010', 'DD/MM/YYYY'),:bind6)", $allPosttuples);
        //    executeBoundSQL("insert into Post(post_id,post_type,account_id,created_on,
        //    updated_on,expiration,post_status) values (:bind0,:bind1,:bind2,:bind3,:bind3,:bind3,:bind6)", $allPosttuples);
           OCICommit($db_conn);
           echo "<br>IM HERE1<br>";
           executeBoundSQL("insert into Listing(post_id,item) values (:bind0,:bind1)", $alltuples);
           echo "<br>IM HERE<br>";
            OCICommit($db_conn);
        }


        
        function handleInsertReviewRequest() {
            global $db_conn;
            //$postID= microtime() + floor(rand()*10000);
            $id = hexdec( uniqid() );
            $fulfilledid = hexdec( uniqid() );
            
            $today = date('26/02/2010');
            $postStatus = "Open";
            //$today1 = TO_DATE('26/02/2010', 'DD/MM/YYYY');
            echo "<br>IM HERE1<br>";
            $receiver_id=0;
            $poster_id=0;
            //Listing tuples 
             $tuple = array (
                ":bind0" => $id,
                ":bind1" => $receiver_id,
                ":bind2" => $poster_id,
                ":bind3" => $_POST['insReviewDescription'],
                ":bind3" => $today,
                ":bind4" => 0,

                
            );
            $alltuples = array (
                $tuple
            ); 
            
            echo "<br>IM HERE1<br>";
            executeBoundSQL("insert into Review values(:bind0,:bind1,:bind2,TO_DATE('26/02/2010', 'DD/MM/YYYY'),:bind4)", $alltuples);
            echo "<br>IM HERE<br>";
             OCICommit($db_conn);
        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM Listing");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in Listing: " . $row[0] . "<br>";
            }
        }
        function handleDisplayRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Listing");
		    printListings($result);
            
        } 


        // HANDLE ALL POST ROUTES
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                }else if (array_key_exists('updateListingRequest', $_POST)) {
                    handleUpdateListing();
                } else if (array_key_exists('fulfillListingRequest', $_POST)) {
                    handleFulfillRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('insertLocationRequest', $_POST)) {
                    handleInsertLocationRequest();
                } else if (array_key_exists('insertListingQueryRequest', $_POST)) {
                    handleInsertListingRequest();
                } else if (array_key_exists('insertRequestQueryRequest', $_POST)) {
                    handleInsertRequestRequest();
                } else if (array_key_exists('postCategoryRequest', $_POST)) {
                    handlePostToCat();
                } else if (array_key_exists('insertReviewQueryRequest', $_POST)) {
                    handleReviewRequest();
                } else if (array_key_exists('insertAccountRequest', $_POST)) {
                    handleInsertAccountRequest();
                } else if (array_key_exists('deleteAccountRequest', $_POST)) {
                    handleSuspendAccountRequest();
                } else if (array_key_exists('insertBroadcastRequest', $_POST)) {
                    handleInsertBroadcastRequest();
                } else if (array_key_exists('insertTicketRequest', $_POST)) {
                    handleInsertTicketRequest();
                } else if (array_key_exists('resolveTicketRequest', $_POST)) {
                    handleResolveTicketRequest();
                }
                echo "Database updated.";
                disconnectFromDB();
            }
        }
        
        // HANDLE ALL GET ROUTES
	    function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('displayTuples', $_GET)) {
                    handleDisplayRequest();
                } else if (array_key_exists('countRequestF', $_GET)) {
                    handleCountFulfilledRequest();
                } else if (array_key_exists('viewUsersRequest', $_GET)) {
                    handleViewUsersRequest();
                }else if (array_key_exists('displayCategoryhaving', $_GET)) {
                    handleCategoryHaving();
                }else if (array_key_exists('viewLocationsRequest', $_GET)) {
                    handleViewLocationsRequest();
                } else if (array_key_exists('viewEmptyCategoriesRequest', $_GET)) {
                    handleViewEmptyCategoriesRequest();
                } else if (array_key_exists('viewPostsByCategoryRequest', $_GET)) {
                    handleViewPostsByCategoryRequest();
                } else if (array_key_exists('viewCategoryCountRequest', $_GET)) {
                    handleViewCategoryCountRequest();
                } else if (array_key_exists('viewPopularCategoriesRequest', $_GET)) {
                    handleViewPopularCategoriesRequest();
                } else if (array_key_exists('listingInfoRequest', $_GET)) {
                    handleListingInfoRequest();
                } else if (array_key_exists('everySeverityRequest', $_GET)) {
                    handleEverySeverityRequest();
                }

                disconnectFromDB();
            }
        }

        function handleDELETERequest() {
            if (connectToDB()) {
                if (array_key_exists('deleteLocationRequest', $_POST)) {
                    handleDeleteLocationRequest();
                } else if (array_key_exists('deleteAccountRequest', $_POST)) {
                    handleDeleteAccountRequest();
                } else if (array_key_exists('deleteListingRequest', $_POST)) {
                    handleDeleteListingRequest();
                } 
                echo "Executed deletion.";
                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || 
		isset($_POST['updateListingRequest']) || 
        isset($_POST['insertSubmit']) || 
        isset($_POST['insertListingSubmit']) ||
        isset($_POST['insertRequestSubmit']) ||
        isset($_POST['insertRequestQueryRequest']) ||
        isset($_POST['insertLocationSubmit']) ||
        isset($_POST['insertAccountSubmit']) ||
        isset($_POST['fulfillListingRequest']) ||
        isset($_POST['countRequestF']) ||
        isset($_POST['insertReviewQueryRequest']) ||
        isset($_POST['postCategoryRequest']) ||
        isset($_POST['suspendAccountSubmit']) || isset($_POST['insertBroadcastSubmit']) ||
        isset($_POST['insertTicketSubmit']) || isset($_POST['resolveTicketSubmit'])) {
            handlePOSTRequest();

        } else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTupleRequest']) ||
        isset($_GET['displayCategoryhaving'])||
        isset($_GET['viewUsersRequest']) || isset($_GET['viewLocationsRequest'])
        || isset($_GET['countRequestF'])
        || isset($_GET['viewEmptyCategoriesRequest']) ||  isset($_GET['viewPostsByCategoryRequest'])
        ||  isset($_GET['viewCategoryCountRequest']) ||   isset($_GET['viewPopularCategoriesRequest'])
        ||  isset($_GET['listingInfoRequest']) || isset($_GET['listingInfoSubmit'])
        || isset($_GET['everySeverityRequest'])) {
            handleGETRequest();

        } else if (isset($_POST['deleteLocationSubmit']) || isset($_POST['deleteAccountSubmit']) || isset($_POST['deleteListingSubmit'])) {
            handleDELETERequest();
        }
    
		?>
        </table>
	</body>
</html>