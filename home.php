<html>
    <head>
        <title>My first PHP Website</title>
    </head>
   <?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
		echo "user logged in";
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>
    <body>
        <h2>Home Page</h2>
        
 <!--Display's user name-->
        <a href="logout.php">Click here to go logout</a><br/><br/>
        <form action="add.php" method="POST">
           Add more to list: <input type="text" name="details" /> <br/>
           Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
           <input type="submit" value="Add to list"/>
        </form>
    <h2 align="center">My list</h2>
	<table border="1px" width="100%">
		<tr>
			<th>ID</th>
			<th>Details</th>
			<th>Post Time</th>
			<th>Edit Time</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Public Post</th>
		<tr>
		<?php
			$con = new mysqli("localhost", "root", "","first_db");
			$select_query = "Select * from list";
			$res = mysqli_query($con, $select_query);
			while($row = $res->fetch_assoc())
			{
				Print "<tr>";
				Print '<td align="center">'. $row['id']."</td>";
				Print '<td align="center">'. $row['details']."</td>";
				Print '<td align="center">'. $row['date_posted']." - ".$row['time_posted']."</td>";
				Print '<td align="center">'. $row['date_edited']." - ".$row['time_edited']."</td>";
				Print '<td align="center"><a href="edit.php?id='.$row['id'].'">edit</a></td>';
				Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].')">delete</a> </td>';
				Print '<td align="center">'. $row['public']."</td>";
				Print "</tr>";
			}
		?>
	</table>
		<script>
			function myFunction(id)
			{
			var r=confirm("Are you sure you want to delete this record?");
			if (r==true)
			  {
			  	window.location.assign("delete.php?id=" + id);
			  }
			}
		</script>	
	</body>
</html>