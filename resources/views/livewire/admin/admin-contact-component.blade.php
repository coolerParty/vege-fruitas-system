<div>
	@section('title', 'Admin | Contact')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Contact</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Contact</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Contact</h4>
						{{-- <p class="card-description"> Add class <code>.table-bordered</code></p> --}}
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> # </th>
										<th> Name </th>
										<th> Email </th>
										<th> Comment </th>
										<th> Date Created </th>
									</tr>
								</thead>
								<tbody>
									<!-- ======= Search Bar Start ======= -->
									<form class="row p-1" action="{{ route('admin.contact') }}">
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" placeholder="Search contact name" aria-label="Search contact name"
													aria-describedby="basic-addon2" id="searchname" name="searchname" type="search"
													value="{{ $searchname }}">
												<div class="input-group-append">
													<button class="btn btn-sm btn-primary" type="submit">Search</button>
												</div>
											</div>
										</div>
									</form>
									<!-- ======= Search Bar End ======= -->
									@foreach ($contacts as $contact)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $contact->name }}</td>
											<td>{{ $contact->email }}</td>
											<td>{{ $contact->comment }}</td>
											<td>{{ $contact->created_at }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<!-- ======= Pagination Start ======= -->
							<div class="row p-2" style="width: 100%;">
								<div class="col-md-6 col-sm-6 pt-2">
									<div class="float-left" style="width: 100%;">
										{!! $contacts->onEachSide(2)->links() !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6  pt-2">
									<p class="text-secondary float-right">
										{!! $contacts->total() !!} Total Contacts
									</p>
								</div>
							</div>
							<!-- ======= Pagination End ======= -->
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- content-wrapper ends -->
</div>
