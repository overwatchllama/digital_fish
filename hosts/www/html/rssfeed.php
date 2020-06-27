<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
 
<div class="container">
<div><h1 class="headinds">RSS LOG</h1></div>   
	<div class="card mb-3">
		<div class="card-body">
        	<div class="table-responsive">
				<table class="table table-bordered" id="rssfeedTable" width="100%" cellspacing="0">

					<thead>
						<tr>
							<th class="bg-light">id</th>
							<th class="bg-light">Title</th>
							<th class="bg-light">Message</th>
							<th class="bg-light">Published</th>
							<th class="bg-light">Action</th>
						</tr>
					</thead>

							<?php
							// print '<table class="table table-bordered">';

							include "connection.php";
							$stmt = $db->query("SELECT * FROM alert where collection='rss' ORDER BY id DESC;");
							    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

							$id = $row['id'];
							$message = $row['message'];
							$title = '# '.$id .' '.$row['title'];
							$pubdate = $row['dateset_timeset'];
							$pubdate= date("D, d M Y H:i:s T", strtotime($pubdate));
							$category= $row['category'];
							$collection = $row['collection'];

							print '<tr><td>'.$id.'</td><td>'.$title.'</td><td>'.$message.'</td><td>'.$pubdate.'</td><td>'.$category.'</td></tr>';


							};
							?>
				</table>
			</div>
		</div>
	</div>
	<form action="submit.php" method="POST">
	<input name="option" value="rssflush" hidden>
	<div align="right"><button class="btn btn-danger">FLUSH RSS LOG</button></div>
	</form>
</div>



<!-- # Data table sorting -->
<script src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){$("#rssfeedTable").DataTable({
    "aaSorting": [[0,'desc']]
  })});
</script>

<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

