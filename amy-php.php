
<?php
function handleResolveTicketRequest()
{
    global $db_conn;

    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind1" => $_POST['resolveTicketTID'],
        ":bind2" => $_POST['resolveTicketMID'],
    );

    $alltuples = array(
        $tuple,
    );

    executeBoundSQL("update ticket set mid=:bind2 where tid=:bind1", $alltuples);
    OCICommit($db_conn);
}

function handleInsertTicketRequest()
{
    global $db_conn;

    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind0" => hexdec(uniqid()),
        ":bind1" => $_POST['insertTicketAID'],
        ":bind2" => $_POST['insertTicketSubject'],
        ":bind3" => $_POST['insertTicketCategory'],
        ":bind4" => $_POST['insertTicketPriority'],
    );

    $alltuples = array(
        $tuple,
    );

    $result = executeBoundSQL("insert into ticket(tid, aid, t_subject, t_category, t_priority) values(:bind0, :bind1, :bind2, :bind3, :bind4) ", $alltuples);
    OCICommit($db_conn);
}

function handleInsertBroadcastRequest()
{
    global $db_conn;

    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind0" => hexdec(uniqid()),
        ":bind1" => $_POST['insertBroadcastMessage'],
    );

    $alltuples = array(
        $tuple,
    );

    $result = executeBoundSQL("insert into broadcast(b_id, b_message) values (:bind0, :bind1)", $alltuples);
    OCICommit($db_conn);
}

function printUsers($result)
{ //prints users
    echo "<br>Other users:<br>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        // echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>"; //or just use "echo $row[0]"
        echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["EMAIL"];
    }

    echo "</table>";
}

function handleViewUsersRequest()
{
    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind1" => $_GET['viewUserID'],
    );

    $alltuples = array(
        $tuple,
    );

    $result = executePlainSQL("select * from account where id <> " . $_GET['viewUserID']);
    echo "<br>" . printUsers($result) . "<br>";

}

function handleSuspendAccountRequest()
{
    global $db_conn;

    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind1" => $_POST['suspendAccountAID'],
        ":bind2" => $_POST['suspendAccountMID'],
    );

    $alltuples = array(
        $tuple,
    );

    executeBoundSQL("insert into suspends(aid, mid) value(:bind1, :bind2)", $alltuples);
    OCICommit($db_conn);
}

function handleDeleteAccountRequest()
{
    global $db_conn;

    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind1" => $_POST['deleteAccountID'],
    );

    $alltuples = array(
        $tuple,
    );

    // we need to remove all data associated with an account
    $result = executeBoundSQL("SELECT count(*) FROM moderator where id=:bind1", $alltuples);
    if (($row = oci_fetch_row($result)) != false) {
        echo "<br> The number of tuples in Moderator: " . $row[0] . "<br>";
    }
    executeBoundSQL("delete from moderator where id=:bind1", $alltuples);
    executeBoundSQL("delete from account where id=:bind1", $alltuples);
    OCICommit($db_conn);
}

function handleInsertAccountRequest()
{
    global $db_conn;

    // Getting the values from user and insert data into the table
    $tuple = array(
        ":bind0" => hexdec(uniqid()),
        ":bind1" => $_POST['insertAccountName'],
        ":bind2" => $_POST['insertAccountPassword'],
        ":bind3" => $_POST['insertAccountEmail'],
    );

    $alltuples = array(
        $tuple,
    );

    executeBoundSQL("insert into account(id, name, password, email) values (:bind0, :bind1, :bind2, :bind3)", $alltuples);
    OCICommit($db_conn);
}
?>