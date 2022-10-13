<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Assignment 1</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
	<link rel="stylesheet" href="./style.css" />
  </head>
		   <body>
			<section class="intro">
				<div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img5.jpg');">
				  <div class="mask d-flex align-items-center h-100">
					<div class="container">
					  <div class="row justify-content-center">
						<div class="col-12 col-md-10 col-lg-7 col-xl-6">
						  <div class="card mask-custom">
							<div class="card-body p-5 text-white">
			  
							  <div class="my-4">
			  
								<h2 class="text-center mb-5">Report System</h2>
			  

								<table class="table">
									<thead>
									  <tr>
										<th scope="col">Class</th>
										<th scope="col">Heading</th>
										<th scope="col">Heading</th>
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<th scope="row">Default</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
								  
									  <tr class="table-primary">
										<th scope="row">Primary</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-secondary">
										<th scope="row">Secondary</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-success">
										<th scope="row">Success</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-danger">
										<th scope="row">Danger</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-warning">
										<th scope="row">Warning</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-info">
										<th scope="row">Info</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-light">
										<th scope="row">Light</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									  <tr class="table-dark">
										<th scope="row">Dark</th>
										<td>Cell</td>
										<td>Cell</td>
									  </tr>
									</tbody>
								  </table>
			  
							  </div>
			  
							</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </section>
</body>

<script>
	function openTab(evt, name) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tab-pane");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		  }
		tablinks = document.getElementsByClassName("nav-link");
		for (i = 0; i < tablinks.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(name).style.display = "block";
		evt.currentTarget.className += " fade show active";
	  }
</script>
</html>
