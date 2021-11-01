<?php

	class Database
	{
		private $servername;
		private $username;
		private $password;
		private $dbname;

		protected function dbc(){
			$this->servername = 'localhost';
			$this->username = 'root';
			$this->password = '';
			$this->dbname = 'end2endencryptions';

			$con = @new mysqli($this->servername, $this->username, $this->password, $this->dbname);

			if($con->connect_error) {
				return die('Database connection failed!');
			}else{
				return $con;
			}
		}
	}

	class Query extends Database
	{
		public function exist_data($table, $condition=''){

			$qry = "SELECT * FROM $table ";

			if($condition){
				$qry .= "WHERE ";
				$i = 1;
				$c = count($condition);
				foreach($condition as $key => $value){
					if($i == $c){
						$qry .= "$key='$value' ";
					}else{
						$qry .= "$key='$value' AND ";
					}
					$i++;
				}
			}

			$result = $this->dbc()->query($qry);

			if(!empty($result) && $result->num_rows > 0 ){
				return 1;
			}else{
				return 0;
			}
		}


		public function select_data($table, $field='*', $condition='', $order_by_field='', $order_by_type='DESC', $limit=''){

			$qry = "SELECT $field FROM $table ";

			if($condition){
				$qry .= "WHERE ";
				$i = 1;
				$c = count($condition);
				foreach($condition as $key => $value){
					if($i == $c){
						$qry .= "$key='$value' ";
					}else{
						$qry .= "$key='$value' AND ";
					}
					$i++;
				}
			}

			if($order_by_field){
				$qry .= "ORDER BY $order_by_field $order_by_type ";
			}

			if($limit){
				$qry .= "LIMIT $limit ";
			}

			$result = $this->dbc()->query($qry);

			if(!empty($result) && $result->num_rows > 0 ){
				$arr = array();
				while($row = $result->fetch_assoc()){
					$arr[] = $row;
				}
				return $arr;
			}else{
				return 0;
			}
		}


		public function insert_data($table, $field_value=''){

			$qry = "INSERT INTO $table ";

			if($field_value){
				foreach($field_value as $field => $value){
					$field_arr[] = $field;
					$value_arr[] = $value;
				}
				$field = implode(", ", $field_arr);
				$value = implode("', '", $value_arr);
				$value = "'".$value."'";

				$qry .= "($field) VALUES ($value) ";

				$result = $this->dbc()->query($qry);

				return $result;

			}

		}


		public function update_data($table, $field_value='', $condition=''){

			$qry = "UPDATE $table SET ";

			if($field_value){
				foreach($field_value as $field => $value){
					$fieldvalue[] = $field."='".$value."'";
				}
				$fieldvalue = implode(", ", $fieldvalue);

				$qry .= "$fieldvalue ";
			}

			if($condition){
				$qry .= "WHERE ";
				$i = 1;
				$c = count($condition);
				foreach($condition as $key => $value){
					if($i == $c){
						$qry .= "$key='$value' ";
					}else{
						$qry .= "$key='$value' AND ";
					}
					$i++;
				}
			}

			$result = $this->dbc()->query($qry);

			return $result;
		}


		public function delete_data($table, $condition=''){

			$qry = "DELETE FROM $table ";

			if($condition){
				$qry .= "WHERE ";
				$i = 1;
				$c = count($condition);
				foreach($condition as $key => $value){
					if($i == $c){
						$qry .= "$key='$value' ";
					}else{
						$qry .= "$key='$value' AND ";
					}
					$i++;
				}
			}

			$result = $this->dbc()->query($qry);

			return $result;
		}


		/** Safe data input allow from users **/
		public function safe_str($str){
			return mysqli_real_escape_string($this->dbc(), $str);
		}


	}
?>