<?php 
	require_once  ($_SERVER['DOCUMENT_ROOT'] . '/inc/globals.php');
	include_once ($_SERVER['DOCUMENT_ROOT'] . "/inc/comhead.php");
?>
<?php
	if( isset($_POST["action"]) && strpos($_POST["action"], 'Task') !== false ){
		if(isset($_POST['category_id'])){
			$categoryId =$_POST['category_id'];
		}else{
			if(isset($_POST["addCategoryId"])) {
				$categoryId = $_POST["addCategoryId"];
				//var_dump($_POST['category_id']);	
			}
			
		}
		if (isset($_POST['id'])){
			$id =$_POST['id'];	
		}
		$title =$_POST['title'];
		
		if(empty($categoryId)){
			$categoryId = NULL;
		}
		
		switch( $_POST["action"] ) {
			
			case 'newTask':
				Task::Insert($title,$categoryId);
				break;
				
			case 'editTask':		
				if(isset($_POST['delete'])){
				 	Task::delete($id);
				} else{
					Task::update($id,$title,$categoryId);
				}
				
			break;
				
		}
	}

?>

<table cellpadding="2" cellspacing="0" border="1"><tr>
<?php
$categories = Category::getAll();
$newTask = new Task();
foreach($newTask as $key=>$value) {
    print "<th>$key</th>";
}
?>
		<th>action</th>
	</tr>
	<tr>
		<td></td>
		<td>
			<select form="addTask" id="addCategoryId" name="addCategoryId" >
				<option value="">none</option>
<?php 			
	foreach($categories as $category) {
    		print "<option value=\"".$category->id."\">".$category->title."</option>";
	} 
?>
			</select>
		</td>
		<td><input form="addTask" id="addTitle" type="text" name="title" size="10" /></td>
		<td>
			<form action="?tab=task" id="addTask" method="post">
				<input form="addTask" type="hidden" name="action" value="newTask" />
				<button class="addButton" form="addTask" type="submit" value="Add"></button>
			</form>
		</td>
	</tr>
<?php
$tasks = Task::getAll();
if(isset($tasks)){
	foreach( $tasks as $aTask){
?>
	<tr>
<?php
		foreach($aTask as $key=>$value) {
			$formId = "editTask" . $aTask->id;
			echo '<td>';
			
			switch($key){
				case "id":
					$type = 'hidden';
					echo $value;
					echo '<input form="' .$formId . '" type="' . $type . '" name="' . $key . '" value="' . $value . '" size="10" />';
					break;
				case "category_id": 
?>
			<select form="<?php echo $formId ?>" name="category_id" >
				<option value="">none</option>
<?php 			
			foreach($categories as $category) {
				if($value == $category->id){
					//$slected = "slected";
					print "<option value=\"".$category->id."\" selected>".$category->title."</option>";
					
				}else{
					print "<option value=\"".$category->id."\">".$category->title ."</option>";
				}
			}
?>
</select>
<?php
					break;
				default:
					$type = 'text';
					echo '<input form="' .$formId . '" type="' . $type . '" name="' . $key . '" value="' . $value . '" size="10" />';
			}
			echo '</td>';
			}

 ?>
		<td>
			<form action="?tab=task" id="<?php echo $formId; ?>" method="post" class="editTask">
				<input form="<?php echo $formId; ?>" type="hidden" name="action" value="editTask" class="formAction" />
				<button form="<?php echo $formId; ?>"  class ="updateButton" type="submit" value="Update"></button>
				<button form="<?php echo $formId; ?>" class="deleteButton" type="submit" name="delete" value="delete"></button>
			</form>
		</td>
	</tr>
</form>
<?php
	}
}
?>
</table>