
<!--Test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  This file shows the very basics of how to execute PHP commands
  on Oracle.  
  Specifically, it will drop a table, create a table, insert values
  update values, and then query for values
 
  IF YOU HAVE A TABLE CALLED "demoTable" IT WILL BE DESTROYED

  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the 
  OCILogon below to be your ORACLE username and password -->

<html>
    <head>
        <title>UBC GIVE--bug</title>
    </head>

    <body>
        <h2>Reset</h2>
        <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

        <form method="POST" action="ubc-give-krishbug.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <hr />

        <h2>Insert Values into DemoTable</h2>
        <form method="POST" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Number: <input type="text" name="insNo"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />
       

        <h2>Insert new Listing</h2>
        <form method="POST" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertListingQueryRequest" name="insertListingQueryRequest">
            Item: <input type="text" name="insItemL"> <br /><br />
            
            <input type="submit" value="InsertListing" name="insertListingSubmit"></p>
        </form>

        <hr />
        <h2>Insert new Request</h2>
        <form method="POST" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertReviewQueryRequest" name="insertReviewQueryRequest">
            Description: <input type="text" name="insDescription"> <br /><br />
            <label>DropDownList Status</label>
            <select name ="status">
                <option value=""> --Select--</option>
                <option value="POST"> POST </option>
                <option value="GET"> GET </option>
                <option value="PUT"> PUT </option>
                <option value="PATCH"> PATCH </option>
                <option value="DELETE"> DELETE </option>
            <input type="submit" value="InsertRequest" name="insertRequestSubmit"></p>
        </form>

        <hr />

        <h2>Create a new user account</h2>
        <form method="POST" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertAccountRequest" name="insertAccountRequest">
            Name: <input type="text" name="insertAccountName"> <br /><br />
            Password: <input type="text" name="insertAccountPassword"> <br /><br />
            Email: <input type="text" name="insertAccountEmail"> <br /><br />
            <input type="submit" value="Create New Account" name="insertAccountSubmit"></p>
        </form>

        <hr />

        <h2>Delete a user</h2>

        <hr />

        <h2>Suspend a user</h2>

        <hr />

        <h2>View other users</h2>

        <hr />

        <h2>Create a broadcast</h2>

        <hr />

        <h2>Write a ticket</h2>

        <hr />

        <h2>Resolve a ticket</h2>

        <hr />

        <h2>Update Name in DemoTable</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

        <form method="POST" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <hr />

        <h2>Count the Tuples in DemoTable</h2>
        <form method="GET" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" name="countTuples"></p>
        </form>
        <hr />

        <h2>Display the Tuples in Listing</h2>
        <form method="GET" action="ubc-give-krishbug.php"> <!--refresh page when submitted-->
            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
            <input type="submit" name="displayTuples"></p>
        </form>
        <hr />

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

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

        function printResult($result) { //prints results from a select statement
            echo "<br>Retrieved data from table demoTable:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]" 
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
            // Delete tables and create new tables
            echo "<br> Creating new tables <br>";
            executePlainSQL("start tables.sql");

            // Add tuples
            echo "<br> Filling tables <br>";
            executePlainSQL("start tuples.sql");
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
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
       
            //Getting the values from user and insert data into the table
            
           //post tuple 
           /*  $tuplePost = array (
                ":bind0" => $postID,
                ":bind1" => "Listing",
                ":bind2" => 0,
                ":bind3" => TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                ":bind4" => $_POST['insItemL']
            );
            $allPosttuples = array (
                $tuplePost
            ); */
            //Listing tuples 
            /* $tuple = array (
                ":bind0" => 9,
                ":bind1" => $_POST['insItemL']
            ); */
function handleInsertListingRequest() {
            global $db_conn;
            //$postID= microtime() + floor(rand()*10000);
            $id = hexdec( uniqid() );
            $today = date("j, n, Y");
            $today1 = TO_DATE('26/02/2010', 'DD/MM/YYYY');
             
            $timestamp = date('Y-m-d H:i:s');
            $exp = date("j, n, Y+1");
                $postID = $id;
                $postType="Listing";
                $postStatus = "Open";
                $account = 0;
                $createdon = $today1;
                $updatedOn =$today1;
                $expire = $today1;
                $pid = 9;
                $listing = $_POST['insItemL'];
             executePlainSQL("insert into Post values ('$postID','$postType','$account',
             '$createdon','$updatedon','$expire','$postStatus')");
            executePlainSQL("insert into Listing values ('$postID','$listing')");
            OCICommit($db_conn);
            /* $alltuples = array (
                $tuple
            ); */
            /* post_id INTEGER,
            post_type VARCHAR(10) NOT NULL,
            account_id INTEGER NOT NULL,
            created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            expiration TIMESTAMP NOT NULL,
            post_status */
         //   executeBoundSQL("insert into Post(post_id,post_type,account_id,created_on,updated_on,expiration,post_status) values (:bind0,:bind1,:bind2,:bind3,:bind4,:bind5,:bind6)", $$allPosttuples);
            //executeBoundSQL("insert into Listing(post_id,item) values (:bind0,:bind1)", $alltuples);
           
            
        }

        function handleInsertAccountRequest() {
            global $db_conn;
            
            // generate new id for new account
            // sourced from https://stackoverflow.com/questions/13932259/unique-id-consisting-of-only-numbers
            // for demonstration purposes, this will suffice for generating unique entries
            $newId = microtime() + floor(rand()*10000);

            // Getting the values from user and insert data into the table
            $tuple = array (
                ":bind0" => 34,
                ":bind1" => $_POST['insertAccountName'],
                ":bind2" => $_POST['insertAccountPassword'],
                ":bind3" => $_POST['insertAccountEmail']
            );

            $alltuples = array (
                $tuple
            );


            executeBoundSQL("insert into account(id, name, password, email) values (:bind0, :bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);
        }

        function handleInsertRequestRequest() {
            global $db_conn;
            //$postID= microtime() + floor(rand()*10000);
            $id = hexdec( uniqid() );
            $today = date("j, n, Y");
            $today1 = TO_DATE('26/02/2010', 'DD/MM/YYYY');
             
            $timestamp = date('Y-m-d H:i:s');
            $exp = date("j, n, Y+1");
                $postID = $id;
                $postType="Review";
                $postStatus = "Open";
                $account = 0;
                $createdon = $today1;
                $updatedOn =$today1;
                $expire = $today1;
                $pid = 9;
                $requestDescription = $_POST['insDescription'];
             executePlainSQL("insert into Post values ('$postID','$postType','$account',
             '$createdon','$updatedon','$expire','$postStatus')");
            executePlainSQL("insert into Review values ('$postID','$requestDescription',)");
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
		printResult($result);
            
            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in Listing: " . $row[0] . "<br>";
            }
        } 


        // HANDLE ALL POST ROUTES
	    // A better coding practice is to have one method that reroutes your requests accordingly. 
        // It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('insertListingQueryRequest', $_POST)) {
                    handleInsertListingRequest();
                } else if (array_key_exists('insertReviewQueryRequest', $_POST)) {
                    handleReviewRequest();
                } else if (array_key_exists('insertAccountRequest', $_POST)) {
                    handleInsertAccountRequest();
                }

                disconnectFromDB();
            }
        }
        

        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                }else if (array_key_exists('displayTuples', $_GET)) {
                    handleDisplayRequest();
                }


                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || 
        isset($_POST['insertSubmit']) || isset($_POST['insertListingSubmit']) ||
        isset($_POST['insertAccountSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTupleRequest'])) {
            handleGETRequest();
        }
    
		?>
	</body>
</html>