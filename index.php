<html>
	<head>
		<style>
			div{
				background: grey;
			}
		 </style>

		<script src="masonry.min.js" type="text/javascript"></script>
    	<link href="masonry.css" rel="stylesheet" type="text/css" />


		<title>PHP Test</title>
	</head>
	<body>
		
	   <p>You  may search either by first or last name</p> 
	   <form  method="post" action="index.php?go"  id="searchform"> 
	       <input  type="text" name="name"> 
	       <input  type="submit" name="submit" value="Search"> 
	   </form> 
	   <div class="masonry js-masonry centered"  data-masonry-options='{ "columnWidth": ".grid-sizer", "itemSelector": ".item" , "gutter": 15 , "isFitWidth": true}'>
	   <div class="grid-sizer">HIIII</div>
<?php
		$name='Yuriy'; 
		$con = mysqli_connect("localhost","root","");
		$database="testdb";
		mysqli_select_db($con,$database);
		$result = mysqli_query($con,"SELECT * FROM testtable");
		$i=1;
		if (!$result)
		{
			echo "Whaaat";
		}
		while($row=mysqli_fetch_array($result))
		{
			echo '<div class= "item" width="200px" height="200px" id= "item_$i">';
			$FirstName  =$row['Name'];
			echo '<p class="text">' .$FirstName . "</p>\n";
			echo '</div>';
		//	i++;
	  	}

		if(isset($_POST['submit']))
		{
	  		if(isset($_GET['go']))
			{
	  			if(preg_match("/^[  a-zA-Z]+/", $_POST['name']))
				{
	  				$name=$_POST['name'];
	  				//connect  to the database
	 				//$db=mysql_connect  ("servername", "username",  "password") or die ('I cannot connect to the database  because: ' . mysql_error());
	  				//-select  the database to use
	  				//$mydb=mysql_select_db("yourDatabase");
	  				//-query  the database table
	  				$sql="SELECT Name FROM testtable WHERE Name LIKE '%" . $name .  "%' OR Month LIKE '%" . $name ."%'";
	  				//-run  the query against the mysql query function1
	 				$result=mysqli_query($con,$sql);	
					//-create  while loop and loop through result set
					$i=1;			
					while($row=mysqli_fetch_array($result))
					{
						echo '<div class= "item" width="200px" height="200px" id= "item_$i">';
						$FirstName  =$row['Name'];
						echo '<p class="text">' .$FirstName . "</p>\n";
						echo '</div>';
					//	i++;
				  	}
				}
				else
				{
				  echo  "<p>Please enter a search query</p>";
				}
			}
		}
?>
</div>
</body>
</html>

