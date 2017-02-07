<script>
	$(document).ready(function(){
		$( ".editPerson" ).on('submit', function(e) {
		});
		$( ".deletePerson" ).on('click', function(e) {
			if ( !confirm('Are you sure?') ) {
				return false;
			}
		});
		
		$( ".deleteCategory" ).on('click', function(e) {
			if ( !confirm('Are you sure?') ) {
				return false;
			}
		});
	});
</script>
