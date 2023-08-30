<!DOCTYPE html>
<html lang="en">
<?php require_once './includes/head.php'; ?>

<body>
	<div class="wrapper">

		<?php require_once './includes/sidebar.php'; ?>

		<div class="main">

			<?php require_once './includes/navbar.php'; ?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-6">
							<h1 class="h3 mb-3">Users</h1>
						</div>
						<div class="col-6 text-end">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser" id="btn-add">
								Add User
							</button>
						</div>

					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<!-- delete model -->
								<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h1 class="modal-title fs-5" id="deleteUserLabel">Delete User</h1>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">

												<div class="text-success" id="success-delete"></div>
												<form action="" method="POST" id="deleteuser">
													<div>Are your sure you want to delete this?</div>
													<p id="namedel"></p>
													<div>
														<input type="submit" value="Delete User" class="btn btn-danger" name="submit-delete" data-bs-dismiss="modal">
													</div>
												</form>

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">

									<!-- add student -->
									<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="addUserLabel">Add User</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="text-danger" id="error-add"></div>
													<div class="text-success" id="success-add"></div>
													<form action="index.php" method="POST" id="add-user-form">
														<div class="mb-3">
															<label for="name-add">Name</label>
															<input type="text" class="form-control" name="name-add" id="name-add" placeholder="Enter your name!">
														</div>
														<div class="mb-3">
															<label for="email-add">Email</label>
															<input type="text" class="form-control" name="email-add" id="email-add" placeholder="Enter your email!">
														</div>
														<div>
															<input type="submit" value="Add User" class="btn btn-primary" name="submit-add">
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<input type="button" value="Submit" class="btn btn-secondary" data-bs-dismiss="modal">
													<input type="reset" value="Reset" class="btn btn-dark">
												</div>
											</div>
										</div>
									</div>

									<!-- end of add user model -->

									<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<p id="uname"></p>
													<h1 class="modal-title fs-5" id="editUserLabel">Edit User</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="text-danger" id="error-edit"></div>
													<div class="text-success" id="success-edit"></div>
													<form action="" method="POST" id="edit-user-form">
														<div class="mb-3">
															<p id="edtid"></p>
															<label for="name-edit">Name</label>
															<input type="text" class="form-control" name="name-edit" id="nameedit" placeholder="Enter your name!">
														</div>
														<div class="mb-3">
															<label for="email-edit">Email</label>
															<input type="text" class="form-control" name="email-edit" id="emailedit" placeholder="Enter your email!">
														</div>
														<div>
															<input type="submit" value="Edit User" class="btn btn-primary" name="submit-edit">
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>



									<div class="row">
										<div class="card">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th>ID</th>
																<th>Name</th>
																<th>Email</th>
																<th>Created at</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody id="tbody">


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

				</div>
			</main>
			<?php require_once './includes/footer.php'; ?>
		</div>
	</div>
	<?php require_once './includes/script.php'; ?>

	<script>
		let emailerror = document.getElementById('error-add');
		let success = document.getElementById('success-add');
		let form = document.getElementById('add-user-form');

		form.addEventListener('submit', async function(e) {
			e.preventDefault();

			let name = document.getElementById('name-add').value;
			let email = document.getElementById('email-add').value;

			if (name == "") {
				emailerror.innerText = "Please Enter Your Name...";
			} else if (email == "") {
				emailerror.innerText = "Please Enter Your Email...";
			} else {
				emailerror.innerText = "";

				const data = {
					Name: name,
					Email: email,
					Submit: 1
				};

				let result = await fetch('./controller/add.php', {
					method: 'Post',
					body: JSON.stringify(data)
				});
				result = await result.text();
				let res = await JSON.parse(result);
				showuser();
			}
		});
		showuser();
		async function showuser() {
			let res = await fetch('./controller/showusers.php');
			let response = await res.text();
			let data = await JSON.parse(response);

			let row = "";
			data.forEach(function(value) {
				row += `<tr><td>${value['id']}</td><td>${value['name']}</td><td>${value['email']}</td><td>${value['time']}<td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser" id="btn-add" style="margin:0px 20px" onclick="deleteuser(${value['id']})">Delete</button><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editUser" onclick="showsingle(${value['id']})" id="btn-add">Edit</button></td></tr>`;
			});
			document.getElementById('tbody').innerHTML = row;													
		}
	 async	function deleteuser(delid)
		{
			let form =document.getElementById('deleteuser');
			form.addEventListener('submit',async function (e) 
			{
				e.preventDefault();
			  let res = await	fetch('./controller/delete.php',
				 {
					method: 'Post',
					body: JSON.stringify(
						{
							id : delid
						})
				 });
				 let responsee = await res.text();
			     let dataa = await JSON.parse(responsee);
				
				 showuser();
			});
			showuser();
		}


	async	function showsingle(editid) 
		{
			let res = await	fetch('./controller/showsingle.php',
				 {
					method: 'Post',
					body: JSON.stringify(
						{
							id : editid,
							submit : 1
						})
				 });
				 let response1 = await res.text();
			     let data1 = await JSON.parse(response1);
				 console.log(data1.name);
				 console.log(data1.email);
				
				 let nameedit = document.getElementById('nameedit');
				 let emailedit = document.getElementById('emailedit');
				 

				 nameedit.setAttribute('value',data1.name);
				 emailedit.setAttribute('value',data1.email);

				 let editform = document.getElementById('edit-user-form');

				 editform.addEventListener('submit', async function(e) {
			e.preventDefault();
					let namevalue = nameedit.value;
					let emailvalue = emailedit.value;
			
			if (namevalue == "") {
				emailerror.innerText = "Please Enter Your Name...";
			} else if (emailvalue == "") {
				emailerror.innerText = "Please Enter Your Email...";
			} else {
				emailerror.innerText = "";

				const data = {
					id : editid,
					Name: namevalue,
					Email: emailvalue,
					Submit: 1
				};

				let result = await fetch('./controller/update.php', {
					method: 'Post',
					body: JSON.stringify(data)
				});

				result = await result.text();
				let res = await JSON.parse(result);
				console.log(res);
				showuser();
			}
		});
		showuser();
		}

	</script>
</body>

</html>