
<?php include_once('partials/header.php'); 
@include 'connection.php';
?>


	<style type="text/css">
 
	/*h2 {
		text-align: center;
		font-family: sans-serif;
	}*/

	.content {
		text-align: justify-all;
		width: 70%;
		margin: 50px;
		padding: 30px;
		
		font-size: 20px;
		font-family: helvetica;
		
	
	}

	
	.p {
		text-align: center;

	}

	.members-contents {
 	 display: flex;
 	 width: 100%;
	}

	.flex-container {
		height: auto;
		position: relative;
 	 background-color: green;
 	 display: flex;
 	 font-size: 15px;
 	 flex-direction: column;
 	 align-items: center;
 	 
	}

	.img-fluid {
	 align-content: center;
	 padding: 10px;
	}

	.members-column{
		margin: 30px;
		align-content: center;
		padding: 5px;
		display: flex;
	   padding-left: 30px;
	   background-color: white;
	   justify-content: space-between;
	  height: auto;

	}

	
</style>
<body>
		<section class="about">
			<div class="content">

					<p>The franchised structure of the business together with the disciplined procedures and recipes helped create a consistency of quality that has led to 'The Cheesecake Shop' brand achieving exceptionally strong consumer awareness and preference.<br>Today the brand is synonymous with immaculately presented, hand-crafted delicious cakes, loved by a generations of Australians and New Zealanders. </p>
			</div>	

	</section>


						<div class="flex-container">
						<h2> Team Members</h2>
						
						<div class="members-contents">
						<div class="members-column">
						<img class="img-fluid" src="images/sandhya.jpeg" width="25%" height="auto" alt="" /> 
						<h6 class="card-title mb-3">Sandhya kharal</h6>
						<span>Student ID K190640</span>
						</div>  

						<div class="members-column">
						<img class="img-fluid" src="images/isha.png" width="25%" height="auto" alt="" />
						<h6 class="card-title mb-3">Isha Bajgain</h6>
						<span>Student ID K191247</span>
						</div>
			</div>
</div>

	</body>		

<?php include_once('partials/footer.php'); ?>

