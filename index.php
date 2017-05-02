<?php

	require_once 'db.php';
	$db = new DB();

?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">

	<title> PHP + MySQL ajax delete with fade </title>
</head>
	<body>
	<div class="container" style="margin-top: 70px;">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-condensed table-hover table-stripped">

						<tr>
							<th> ID </th>
							<th> HASH </th>
							<th> DATE ADDED </th>
							<th> ACTIONS </th>
						</tr>

						<tbody>

							<?php $data = $db->getConnection()->query("SELECT * from hashes")->fetchAll(PDO::FETCH_ASSOC); ?>

							<?php foreach($data as $item):?>
								<tr>
									<td> <?php echo $item['id'].'.'; ?> </td>
									<td> <?php echo $item['hash_id']; ?> </td>
									<td> <?php echo $item['date_generated']; ?> </td>
									<td>
										<a data-hashid="<?php echo $item['id']; ?>" class="rmbutton btn btn-danger"> DELETE</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/jquery.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/bootbox.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	
		  $(".rmbutton").on('click',function(){

		  	var this_element = this;
		  	var selectedHashID = this.dataset.hashid;

		  		bootbox.confirm("DELETE THIS RECORD # "+selectedHashID,function(z){

		  			if(z==true){

						$.ajax({

							url: 'ajaxdelete.php',
							data:{
								id: selectedHashID,
								action: 'delete'
							},
							method: 'GET',
							cache: false,
							success:function(response){

								parsedData = JSON.parse(response);
								
								if(parsedData['status']===1){
									// fade on delete
									animateOnDelete(this_element);

								}

							}
								
						});

		  			}

		  		});

			function animateOnDelete(x){
			
				    $(x).closest('tr').find('td').fadeOut('slow', 
				        function(x){ 

				            $(x).parents('tr:first').remove();
				                                
				        });    

				    return false;

				}
		  		
			  });
		})
	</script>

	</body>
</html>