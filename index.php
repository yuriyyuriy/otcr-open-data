<?php
function removeElem_PHP($divname) {
  echo '<script type="text/javascript"> removeElement("'.$divname.'");</script>';
}
?>
<html>
	<head>
		<script src="masonry.min.js" type="text/javascript"></script>
    	<link href="masonry.css" rel="stylesheet" type="text/css" />
    	<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    	<script type="text/javascript">
    		$(window).load(function() {
    			$('#container').masonry({
        			columnWidth: '.box',
        			itemSelector: '.box',
        			isAnimated: true
			    });
			});
    	</script>
		<script type="text/javascript">
		function removeElement(childDiv){
			if (document.getElementById(childDiv)){   
			  	var child = document.getElementById(childDiv);
			  	child.parentNode.removeChild(child);
				return true;
			}
			return false;
		}
		</script>

		<title>PHP Test</title>
	</head>
	<body>

		<div class = "topright" >
			<form  method="post" action="index.php?go"  id="searchform"> 
		    	<input type="text" name="name" size="45" placeholder="You may search either by first or last name">
	       		<input type="submit" name="submit" value="" > 
			</form> 
		</div>
	   <div class="masonry js-masonry centered " id="tile_container" data-masonry-options='{ "columnWidth": ".grid-sizer", "itemSelector": ".item" , "gutter": 15 , "isFitWidth": true}'>
	   <div class="grid-sizer" id="grid_sizer"></div>
<?php
		$dom = new DOMDocument('1.0', 'iso-8859-1');
		$con = mysqli_connect("localhost","root","");
		$database="testdb";
		mysqli_select_db($con,$database);
		$result = mysqli_query($con,"SELECT * FROM testtable");
		$total_divs=0;
		$n="div_{$total_divs}_name"; 
		$n_child= "html_child_{$total_divs}";
		//echo "<p>".$div_0_name."</p>";
		$attr_array= array( 'class' => 'item', 'width' => '200px', 'height' => '200px');
		//$stream=streamWrapper::__construct();
		if (!$result)
		{
			echo "Whaaat";
		}
		while($row=mysqli_fetch_array($result))
		{
				$FirstName  =$row['Name'];
				$n="div_{$total_divs}_name";
				${$n}= $dom->appendChild($dom->createElement('div'));
				${$n_child}= ${$n}->appendChild($dom->createElement('p', $FirstName));
				${$n_child}->setAttribute('class','text');
				foreach ($attr_array as $key => $value) {
       				$$n->setAttribute($key, $value);
    			}
				$$n->setAttribute('id', $n);
				$total_divs= $total_divs+1;
	  	}
		$dom->formatOutput = true;
		echo $dom->saveHTML();
		$total_divs= $total_divs -1;

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
					while($total_divs!=-1)
					{
						removeElem_PHP($n);
						$dom->removeChild(${$n});
						if ($total_divs==0)
						{
							break;
						}
						$total_divs=$total_divs -1;
						$n="div_{$total_divs}_name";
					}
					//echo $dom->saveHTML();
					//$total_divs=0;			
					while($row=mysqli_fetch_array($result))
					{
						$FirstName  =$row['Name'];
						$n="div_{$total_divs}_name";
						${$n}= $dom->appendChild($dom->createElement('div'));
						${$n_child}= ${$n}->appendChild($dom->createElement('p', $FirstName));
						${$n_child}->setAttribute('class','text');
						foreach ($attr_array as $key => $value) {
			   				$$n->setAttribute($key, $value);
						}
						$$n->setAttribute('id', $n);
						$total_divs= $total_divs+1;
				  	}
					echo $dom->saveHTML();
				}
			}
		}
?>
</div>
</body>
</html>
