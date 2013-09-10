<?php
function output()
{
	// Check authorization
	if(is_authorized())
	{
		$authorized = true;
		include('/path/to/' . $_REQUEST['module'] . '.php');
	}
	echo "<ul>"
	$conn = mysql_connect( "mysql.foo.org:412", "kum", "overmoon" );
	mysql_select_db( "kum", $conn ); // selects a database
	$q = " SELECT * FROM main WHERE id > " . $_GET["id"]. ";";
	$res = mysql_query( $q, $conn);
	while( $row = mysql_fetch_assoc( $res ) )
	{
		echo "<li>".$row['description']."</li>";
	}
	echo "</ul><br><ul>";
	$q = " SELECT * FROM main WHERE id < " . $_GET["id"]. ";";
	$res = mysql_query( $q, $conn);
	while( $row = mysql_fetch_assoc( $res ) )
	{
		// Display the status if it is authorized, othewise display N/A
		echo "<li>".$row['description']. "(" .
		$authorized ? $row['status'] : "N/A" . ")</li>";
	}
	echo "</ul>";
}

/*
 * 01. Missing parameter validation on ( $_REQUEST['module'] )
 * 02. Missing file validation on ( include('/path/to/' . $_REQUEST['module'] . '.php'); ), will cause a php error if file not exists
 * 03. Missing semicolon on ( echo "<ul>" )
 * 04. Missing validation  on ( $conn = mysql_connect( "mysql.foo.org:412", "kum", "overmoon" ) ). May cause error if host|username|password is incorrect
 * 05. Missing validation  on (  mysql_select_db( "kum", $conn ) ). May cause error if dbname is incorrect
 * 06. Missing validation on ( $_GET["id"] ). May cause sql error if parameter is not givrn
 * 07. SQL Query should not end with semicolon for ( $q   = " SELECT * FROM main WHERE id > " . $id . ";"; )
 * 08. SQL Query sholud not end with semicolon for ( $q   = " SELECT * FROM main WHERE id < " . $id . ";"; )
 * 09. Missing validation on ( $res = mysql_query( $q, $conn); )
 * 10. No default value for ( $authorized )
 * 11. Assuming ( is_authorized() ) function exists, else will cause php error
 */

function output_rectify(){
    //CHECK IF FUNCTION EXISTS
    if(!function_exists('is_authorized')){
        echo 'Missing function is_authorized()';
        return false;
    }

	// Check authorization
    $authorized = false;
	if(is_authorized()){
		$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : '';

        //CHECK IF PARAMETER HAS VALUE
        if(empty($module)){
            echo 'Missing module';
            return false;
        }

        //CHECK IF FILE EXISTS
        if(!file_exists('/path/to/' . $module . '.php')){
            echo 'Invalid Module';
            return false;
        }

        $authorized = true;
		include('/path/to/' . $module . '.php');
	}

    $conn = mysql_connect( "mysql.foo.org:412", "kum", "overmoon" );
    //CHECK IF CONNECTION IS VALID
    if (!$conn) {
        echo "Unable to connect to server: " . mysql_error();
        return false;
    }

    $db = mysql_select_db( "kum", $conn ); // selects a database
    //CHECK IF DATABASE EXISTS | VALID
    if (!$db) {
        echo "Unable to connect to db: " . mysql_error();
        return false;
    }

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    //CHECK IF PARAMTER HAS VALUE
    if(empty($id)){
        echo 'Invalid ID';
        return false;
    }

	$q   = " SELECT * FROM main WHERE id > " . $id . ";";
	$res = mysql_query( $q, $conn);
    //CHECK IF QUERY RUN SUCCESSFULLY
    if (!$res) {
        echo "Could not successfully run query ($q) from DB: " . mysql_error();
        return false;
    }

    echo "<ul>";
    if (mysql_num_rows($res) == 0) {
        //No rows found, print message
        echo '<li>No data found</li>';
    }
    else{
        while ($row = mysql_fetch_assoc($res)) {
            echo "<li>" . $row['description'] . "</li>";
        }
    }
    echo "</ul>";

	$q   = " SELECT * FROM main WHERE id < " . $id . ";";
	$res = mysql_query( $q, $conn);
    //CHECK IF QUERY RUN SUCCESSFULLY
    if (!$res) {
        echo "Could not successfully run query ($q) from DB: " . mysql_error();
        return false;
    }

    echo "<br/><ul>";
    if (mysql_num_rows($res) == 0) {
        //No rows found, print message
        echo '<li>No data found</li>';
    }
    else{
        while( $row = mysql_fetch_assoc( $res ) ){
            // Display the status if it is authorized, othewise display N/A
            echo "<li>".$row['description']. "(" . $authorized ? $row['status'] : "N/A" . ")</li>";
        }
    }
	echo "</ul>";
}
?>
