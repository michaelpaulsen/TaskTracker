<?php 
	require_once  ($_SERVER['DOCUMENT_ROOT'] . '/inc/globals.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . "/inc/comhead.php");
?>
<?php
	if( isset($_POST["action"]) && strpos($_POST["action"], 'Category') !== false ){
		if(isset($_POST['person_id'])){
			$personId =$_POST['person_id'];
		}else{
			if(isset($_POST["addPersonId"])) {
				$personId = $_POST["addPersonId"];
				//var_dump($_POST['person_id']);	
			}
			
		}
		if (isset($_POST['id'])){
			$id =$_POST['id'];	
		}
		$title =$_POST['title'];
		
		if(empty($personId)){
			$personId = NULL;
		}
		
		switch( $_POST["action"] ) {
			
			case 'newCategory':
				Category::Insert($title,$personId);
				break;
				
			case 'editCategory':		
				if(isset($_POST['delete'])){
				 	Category::delete($id);
				} else{
					Category::update($id,$title,$personId);
				}
				
			break;
				
		}
	}

?>

<table cellpadding="2" cellspacing="0" border="1"><tr>
<?php
$people = Person::getAll();
$newCategory = new Category();
foreach($newCategory as $key=>$value) {
    print "<th>$key</th>";
}
?>
		<th>action</th>
	</tr>
	<tr>
		<td></td>
		<td><input form="addCategory" id="addTitle" type="text" name="title" size="10" /></td>
		<td>
			<select form="addCategory" id="addPersonId" name="addPersonId" >
<?php 
	foreach($people as $person) {
    		print "<option value=\"".$person->id."\">".$person->username."</option>";
	} 
?>
			</select>
		</td>
		<td>
			<form id="addCategory" method="post">
				<input form="addCategory" type="hidden" name="action" value="newCategory" />
				<button class="addCategory" form="addCategory" type="submit" value="Add"></button>
			</form>
		</td>
	</tr>
<?php
$categories = Category::getAll();
if(isset($categories)){
	foreach( $categories as $aCategory){
?>
	<tr>
<?php
		foreach($aCategory as $key=>$value) {
			$formId = "editCategory" . $aCategory->id;
			echo '<td>';
			
			if($key == 'id'){
				$type = 'hidden';
				echo $value;
			} else{
				$type = 'text';
			}		
			
			echo '<input form="' .$formId . '" type="' . $type . '" name="' . $key . '" value="' . $value . '" size="10" />';
			echo '</td>';
			}

 ?>
		<td>
			<form id="<?php echo $formId; ?>" method="post" class="editCategory">
				<input form="<?php echo $formId; ?>" type="hidden" name="action" value="editCategory" class="formAction" />
				<button form="<?php echo $formId; ?>"  class ="updateCategory" type="submit" value="Update"></button>
				<button form="<?php echo $formId; ?>" class="deleteCategory" type="submit" name="delete" value="delete"></button>
			</form>
		</td>
	</tr>
</form>
<?php
	}
}
?>
</table>