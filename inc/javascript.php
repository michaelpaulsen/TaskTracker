<script>
	$(document).ready(function(){
		$( ".editPerson" ).on('submit', function(e) {
		});
		$( ".deletePerson" ).on('click', function(e) {
			if ( confirm('Are you sure?') ) {
				$( '.formAction', $(this).closest('form') ).val('deletePerson');
			} else{
				return false;
			}
		});
	});
</script>
