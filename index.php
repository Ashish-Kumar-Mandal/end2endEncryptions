<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>End 2 End Encriptions</title>
	<style type="text/css">
		#left, #left-top{
			float: left;
			width: 35%;
			margin: 20px;
			padding: 30px;
			border: 3px solid #ababab;
			border-radius:10px;
		}

		#right{
			float: right;
			width: 35%;
			margin: 20px;
			padding: 15px;
			border: 3px solid #ababab;
			border-radius:10px;
		}
		table{
			width: 100%;
		}
		a{
			text-decoration: none;
			cursor: pointer;
		}
	</style>
	<script defer src="./validate.js"></script>
</head>
<body>
	<div id="right">

		<form method="post">
			<table>
				<center><h2>Add New Record<h2></center>
				<tr>
					<td>Name: </td>
					<td><input type="text" name="name" id="name" onkeypress="return names(this.id)" maxlength="30" required></td>
				</tr>
				<tr>
					<td>Mobile: </td>
					<td><input type="text" name="mobile" id="mobile" onkeypress="return numbers(this.id)" maxlength="10" minlength="10" required></td> 
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" required></td> 
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit"></td> 
				</tr>
			</table>
		</form>

		<form method="post"><hr><input type='submit' name='check_ip' value='Check Device IP'><hr></form>

		<form method="post">
			<table>
				<center><h2>Convert into MD5<h2></center>
				<tr>
					<td><input type="text" name="txt" id="txt" placeholder="Enter any text..." size="30" required> <input type="submit" name="convert" value="Convert -> MD5"></td>
				</tr>
				<tr>
					<td><span><?php if(isset($_POST['convert'])){ echo "<br><center>". md5($_POST['txt'])."</center><hr>"; } ?></span></td> 
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
<?php
	include_once('Database.php');
	include_once('Crypt.php');

	$qry = new Query();
	$crypt = new crypt();

		if(isset($_POST['submit'])){
			$name = $crypt->encrypt($qry->safe_str($_POST['name']));
			$mobile = $crypt->encrypt($qry->safe_str($_POST['mobile']));
			$password = $crypt->pass_hash($qry->safe_str($_POST['password']));

			$data = array('name'=>$name, 'mobile'=>$mobile, 'password'=>$password);
			$response = $qry->insert_data('users', $data);
			if($response){
				echo "New record Saved Successfully";
			}else{
				echo "Saved Failed";
			}	
		}


		// for displaying all data.
		$res=$qry->select_data('users');

		echo "<div id='left'><table border='1'><center><h3>end2endEncriptions Records 
			
		<h3></center>";
			echo "<tr><th>Id</th><th>Name</th><th>Email</th></tr>";
			if($res){
				foreach($res as $row){
					$name=$crypt->decrypt($row['name']);
					$mobile=$crypt->decrypt($row['mobile']);
					echo "<tr><td>".$row['usr_id']."</td><td>".$name."</td><td>".$mobile."</td></tr>";
				}
			}else{
				echo "<tr><td>No records Founds</td></tr>";
			}
		echo "</table></div>"
?>


<?php
	if(isset($_POST['check_ip'])){

		// This function is used for fetch all data from any url.
	    function call_api($dataSet='', $url='', $apiKey='', $username='', $password=''){           
	        $curl = curl_init($url);
	        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
	        curl_setopt($curl, CURLOPT_POST, true);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	        ($apiKey!='') ? curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-API-KEY:".$apiKey)) : '';
	        ($username!='' && $password!='') ? curl_setopt($curl, CURLOPT_USERPWD, "$username:$password") : '';
	        ($dataSet!='') ? curl_setopt($curl, CURLOPT_POSTFIELDS, $dataSet) : '';
	        $result = curl_exec($curl);        
	        curl_close($curl);
	        return $result;
	    }

	    $result = json_decode(call_api('', "http://ip-api.com/json"));

	    echo "<div id='left-top'>
	    	<table border='1'><center><h3>Informations about this Networks<h3></center>
				<tr><th>IP Address: </th><td>".$result->query."</td></tr>
				<tr><th>Country: </th><td>".$result->country."</td></tr>
				<tr><th>State: </th><td>".$result->regionName."</td></tr>
				<tr><th>City: </th><td>".$result->city."</td></tr>
				<tr><th>ZIP Code: </th><td>".$result->zip."</td></tr>
				<tr><th>Latitude: </th><td>".$result->lat."</td></tr>
				<tr><th>Longitude: </th><td>".$result->lon."</td></tr>
				<tr><th>ISP: </th><td>".$result->as."</td></tr>
			</table></div>
		";
	}
?>