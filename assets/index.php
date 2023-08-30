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
												<form action="" method="POST" id="deletest">
													<div>Are your sure you want to delete this?</div>
													<p id="namedel"></p>
													<div>
														<input type="submit" value="Delete User" class="btn btn-danger" name="submit-delete">
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
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>

									<!-- end of addd user model -->

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
															<input type="text" class="form-control" name="name-edit" id="nameedit"  placeholder="Enter your name!">
														</div>
														<div class="mb-3">
															<label for="email-edit">Email</label>
															<input type="text" class="form-control" name="emailedit" id="emailedit" placeholder="Enter your email!">
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
		let erroradd = document.getElementById('error-add');
		let success = document.getElementById('success-add');
		let form = document.getElementById('add-user-form');

		form.addEventListener('submit', async function(e)
		{
			e.preventDefault();
			let nameadd = document.getElementById('name-add').value;
			let emailadd = document.getElementById('email-add').value;

			erroradd.innerHTML = success.innerHTML = '';
			if (nameadd == "") {
				erroradd.innerText = "Please enter Your name ...";

			} else if (emailadd == "") 
			{
				erroradd.innerText = "Please enter Your Email...";
			} else {
				erroradd.innerHTML = success.innerHTML = '';
				const data = 
				{
					name: nameadd,
					email: emailadd,
					submit: 1
				};

				let res = await fetch('./controller/add.php', {
					method: 'POST',
					body: JSON.stringify(data)
				});
				res = await res.text();
				let result = JSON.parse(res);
				showusers();
			}
		});
		showusers();
		async function showusers() {
			let ress = await fetch('./controller/showusers.php');
			ress = await ress.text();
			let ressss = JSON.parse(ress);

			let row = "";
			ressss.forEach(function(value) {
				row += `<tr><td>${value['id']}</td><td>${value['name']}</td><td>${value['email']}</td><td>${value['time']}</td><td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser" onclick="showsingle(${value['id']})"id="btn-add">Edit</button><button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteUser" onclick="delete(${value['id']})" id="btn-add">Delete</button></td></tr>`;
			});
			document.getElementById('tbody').innerHTML = row;
		}
		showusers();
		showsingle();

		async function showsingle(lahoredapawa) {
			
			let data = {
				id: lahoredapawa,
				submit: 1
			}
			let reply = await fetch("./controller/showsingle.php",
			{
				method: 'POST',
				body: JSON.stringify(data)
			});

			reply = await reply.text();
			let pawa = JSON.parse(reply);

			let nameedt = document.getElementById('nameedit');
			let emailedt = document.getElementById('emailedit');
			
			let edtid = document.getElementById('edtid');
			
			nameedt.setAttribute('value', pawa.name);
			emailedt.setAttribute('value', pawa.email);

			let editform = document.getElementById('edit-user-form');
			editform.addEventListener('submit', async function(e) {
				showusers();
				e.preventDefault();
				let edtname = document.getElementById('nameedit').value;
				let edtemail = document.getElementById('emailedit').value;

				if (edtname == "") {
					erroradd.innerText = "Please enter Your name ...";

				} else if (edtemail == "") {
					erroradd.innerText = "Please enter Your Email...";
				} else {


					const data = {
						id: lahoredapawa,
						name: edtname,
						email: edtemail,
						submit: 1
					}
					let reply = await fetch("./controller/update.php", {
						method: 'POST',
						body: JSON.stringify(data)
					});

					reply = await reply.text();
					console.log(reply);
					let lawa = JSON.parse(reply);
				}

			});

		}
		showsingle();
	</script>
</body>

</html>