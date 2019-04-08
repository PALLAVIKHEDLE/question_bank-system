<?phpjQuery
	include("db-config.php");

	session_start();
	
	if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
    $role = $_POST['role'];
    switch ($role) {
        case '1':
            $sql = "SELECT role_id FROM user WHERE email='$email' AND password = '$password'";
            $res = mysqli_query($conn, $sql);
            if($res==true)
            {
            	header("location:main.php");
            }
            else
            {
            	mysqli_error($conn);
            }
        	// header("location:main.php");
            break;
        case '2':
            $query = "SELECT role_id FROM user WHERE email='$email' AND password = '$password'";
            $result = mysqli_query($conn, $query);
            if($result==true)
            {
            	header("location:author.php");
            }
            else
            {
            	mysqli_error($conn);jQuery
            }
            break;
        default:
            echo "default";
            break;
    }
	}
	
	
?>jQuery