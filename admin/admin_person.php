<?php 
	require_once  $_SERVER['DOCUMENT_ROOT'] . '/inc/globals.php'; 
	include_once ($_SERVER['DOCUMENT_ROOT'] . "/inc/comhead.php")
?>
<?php
	$_SESSION['msg'] = NULL;	
	if( isset($_POST["action"]) && strpos($_POST["action"], 'Person') !== false ) {
		$id       = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email    = $_POST['email'];
		$name     = $_POST['name'];
		$role     = $_POST['role'];
		$color    = $_POST['color'];
		$color = str_replace( '#', '', $color );
		if ( $role !== 'admin' )  { 
			$role = 'user'; 
		}
		
		switch( $_POST["action"] ) {
		case 'newPerson':
				
				if ( empty( $password ) || !isset($password) ) { $password = NULL; }
				if ( empty( $email) || !isset($email) ) { $email    = NULL; }
				
				
				//$_SESSION['msg'] = "added person";	
				Person::Insert($username,$password,$email,$name,$role,$color);
				
				break;
			case 'editPerson':
				//$_SESSION['msg'] ="updated person";
				if(isset($_POST["delete"])){
					Person::delete($id);
				}else{
					Person::update($id,$username,$password,$email,$name,$role,$color);
				}
				break;
		}
	}
//echo $_SESSION['msg']; 
?>

<table cellpadding="2" cellspacing="0" border="1"><tr>
<?php
$newPerson = new Person();
foreach($newPerson as $key=>$value) {
    print "<th>$key</th>";
}
?>
		<th>action</th>
	</tr>
	<tr>
		<td></td>
		<td><input form="addPerson" id="addUsername" type="text" name="username" size="10" /></td>
		<td><input form="addPerson" id="addPassword"type="password" name="password" size="10" /></td>
		<td><input form="addPerson" id="newEmail" type="email" name="email" size="10" /></td>
		<td><input form="addPerson" id="newName" type="text" name="name" size="10" /></td>
		<td><input form="addPerson" id="newRole" type="text" name="role" size="10" /></td>
		<td><input form="addPerson" id="newColor" type="color" name="color" size="10" /></td>
		<td>
			<form id="addPerson" method="post">
				<input form="addPerson" type="hidden" name="action" value="newPerson" />
				<button class="addButton"form="addPerson" type="submit" value="Add"></button>
			</form>
		</td>
	</tr>
<?php
foreach(Person::getAll() as $aPerson){
?>
	<tr>
<?php
	foreach($aPerson as $key=>$value) {
		$formId = "editPerson" . $aPerson->id;
		echo '<td>';
		switch ($key) {
			case 'id':
				$type = 'hidden';
				break;
			case 'password':
				$type = 'password';
				break;	
			case 'color':
				$type = 'color';
				$value = '#' . $value;
				break;
			default:
				$type = 'text';
		}
		if ($key === 'id') {
			echo $value;
		}
		echo '<input form="' . $formId . '" type="' . $type . '" name="' . $key . '" value="' . $value . '" size="10" />';
		echo '</td>';
	}
?>
		<td>
			<form id="<?php echo $formId; ?>" method="post" class="editPerson">
				<input form="<?php echo $formId; ?>" type="hidden" name="action" value="editPerson" class="formAction" />
				<button form="<?php echo $formId; ?>"  class ="updateButton" type="submit" value="Update"></button>
				<button form="<?php echo $formId; ?>" class="deleteButton" type="submit" name="delete" value="Delete"></button>
			</form>
		</td>
	</tr>
</form>
<?php
}
?>
</table>