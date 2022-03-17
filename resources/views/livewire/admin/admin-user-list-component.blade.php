<div>
	@section('title', 'Admin | Users List')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Users List</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Users List</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Users List</h4>
						{{-- <p class="card-description"> Add class <code>.table-bordered</code>
                    </p> --}}
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> # </th>
										<th> Name </th>
										<th> Email </th>
										<th> Date Created </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $user)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->created_at }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- content-wrapper ends -->
</div>
