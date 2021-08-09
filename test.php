<?php
$filter=0;
if(isset($_GET['option'])){
	$dept=$_GET['option'];
	$con=mysqli_connect("localhost","root","","trial");
	if($con){
		
		$query='select * from student where dept="'.$dept.'"';
		$query_stmnt=mysqli_query($con,$query);
		$row=mysqli_fetch_all($query_stmnt,MYSQLI_ASSOC);
		$row_num=mysqli_num_rows($query_stmnt);
		$filter=1;
		


	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ajax Practice</title>
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <style type="text/css">
	    body{
		    background-color: #ccc;
		    padding: 0px;
		    margin: 0px;
		    font-family: helvetica,sanssarif;
	   }
	   .container{
	   	overflow: hidden;
	   }
	   .select-filter{
	   	height: 40px;
	   	width: 30%;
	   	padding: 2px;
	   	float: right;
	   	border:none;
	   }
</style>
</head>
<body id="body">
	<h1 style="text-align: center;">Student's Info</h1>
<div class="container" >
	<div class="container" style="width:100%; margin-bottom:20px; ">
	    <select class="select-filter" id="filter">
			<option disabled="true" selected="true">Select department</option>
			<option value="EEE">EEE</option>
			<option value="CSE">CSE</option>
			<option value="ECE">ECE</option>
			<option value="BME">BME</option>
			<option value="Civil">CIVIL</option>
			<option value="BECM">BECM</option>
			<option value="Architecture">ARCHITECTURE</option>
		    <option value="Mechanical">MECHANICAL</option>
		    <option value="TE">TE</option>
	    </select>
	</div>
	<div class="container" style="width:100%" id="std_table">
	<table class="table table-striped table-bordered dt-responsive">
		<thead>
			<tr>
				<th>Roll</th>
				<th>Name</th>
				<th>Department</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$con=mysqli_connect("localhost","root","","trial");
				if($con){
				
					if($filter!=1){
						$query="select * from student";
						$query_stmnt=mysqli_query($con,$query);
						$row=mysqli_fetch_all($query_stmnt,MYSQLI_ASSOC);
						$row_num=mysqli_num_rows($query_stmnt);
					}
					echo $row_num;
					if($row_num) {
						for($i=0; $i < $row_num; $i++){ ?>
							<tr>
								<td><?= $row[$i]['roll'] ?></td>
								<td><?= $row[$i]['name'] ?></td>
								<td><?= $row[$i]['dept'] ?></td>
							</tr>
				<?php	}
					} else {   ?>
						<tr colspan="3"><td>NO DATA FOUND!!</td> </tr>
				<?php	}
				  }
			?>
		</tbody>
		
	</table>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#filter").on("change", function(){
			var option = $(this).val();
			console.log(option);
			$.ajax({
				type: "GET",
				url: "test.php",
				contentType:"application/x-www-form-urlencoded",
				data:'option=' + option,
				success:function(data){
					$("#body").html(data);
				}
			})
		});
	});
</script>
</body>
</html>
