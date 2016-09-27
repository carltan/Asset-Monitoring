<html>
<body>

<?php
session_start();

if(isset($_POST['submit']))
	{
	$messageScreen = NULL;
	$_SESSION['employeeNo'] = 0;
	$_SESSION['position'] = null;
	if(empty($_POST['username']))
		{
		$username = false;
		$messageScreen.= '<p> Username is a required field! ';
		}
	else
		{
		$username = $_POST['username'];
		}
	
	if (empty($_POST['password']))
		{
		$password = false;
		$messageScreen.='<p> Password is a required field!';
		} 
	else 
		{
		$password = $_POST['password']; 
		}
	
	}
	else
	{
		$_SESSION['employeeNo'] = 0;
		$_SESSION['position'] = null;
		$_SESSION['employeeNo'] = null;
		$_SESSION['department'] = null;
		$_SESSION['employeeName'] = null;
	}
	
	if(!isset($message))
	{
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{		
			require_once('../mysql_connect.php');
			echo "<ul>";
			$sql = "SELECT * FROM employee";
			$qry = mysqli_query($dbc, $sql);
			$passwordUsername = false;
			while($row = mysqli_fetch_array($qry))
				{
				if($row['EmployeePassword'] == $password)
					{
					$passwordUsername = true;
					$_SESSION['employeeNo'] = $row['EmployeeNumber'];
					$_SESSION['position'] = $row['EmployeePosition'];
					$_SESSION['department'] = $row['DepartmentID'];
					$_SESSION['employeeName'] = $row['EmployeeName'];
					}
				}
				
			if($passwordUsername == true)
				{
				echo "<p> Log In Successfully!";
				if($_SESSION['department'] == 1001)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminPage.php");
					}
				else if($_SESSION['department'] == 1002)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/accountingDepartment.php");
					}
				else if($_SESSION['department'] == 1003)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/purchasingDepartment.php");
					}
				else if($_SESSION['department'] == 1004)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/managementDepartment.php");
					}
				else if($_SESSION['department'] == 1005)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/teachingDepartment.php");
					}
				}
				
			else
				echo "<p> Invalid password/username";
		}
	}
	
	
	
	if (isset($messageScreen)){
	echo '<font color="red">'.$messageScreen. '</font>';
	}
?>

<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
Please Log In Below:

<p> User Name: <input type="text" name="username" size="20" maxlength="30""<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"/>
<p> Password: <input type="password" name="password" size="20" maxlength="30" />
<div align="center"><input type="submit" name="submit" value="Login" /></div>

<body/>
<html/>