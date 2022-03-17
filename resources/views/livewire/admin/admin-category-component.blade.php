<div>
	@section('title', 'Admin | Category')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Category</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Category</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Category</h4>
							<p><a href="{{ route('admin.categoryadd') }}" class="btn btn-inverse-success">Add Category</a></p>
						</div>
						{{-- <p class="card-description"> Add class <code>.table-bordered</code></p> --}}
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> # </th>
										<th> Name </th>
										<th> Status </th>
										<th> Date Created </th>
										<th class="col-sm-2"> Action </th>
									</tr>
								</thead>
								<tbody>
									@if (Session::has('message'))
										<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
									@endif
									<!-- ======= Search Bar Start ======= -->
									<form class="row p-1" action="{{ route('admin.category') }}">
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" placeholder="Search category name"
													aria-label="Search category name" aria-describedby="basic-addon2" id="searchname" name="searchname" type="search"
                                                    value="{{ $searchname }}">
												<div class="input-group-append">
													<button class="btn btn-sm btn-primary" type="submit">Search</button>
												</div>
											</div>
										</div>
									</form>
									<!-- ======= Search Bar End ======= -->
									@foreach ($categories as $category)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $category->name }}</td>
											<td>
												<div class="dropdown">
													<button
														class="@if ($category->status == 0) btn btn-dark @else btn btn-inverse-success @endif dropdown-toggle"
														type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														{{ $category->status == 1 ? 'Active' : 'Inactive' }} </button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														@if ($category->status == 0)
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateStatus({{ $category->id }},1,'{{ url()->full() }}')">Active</a>
														@else
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateStatus({{ $category->id }},0,'{{ url()->full() }}')">Inactive</a>
														@endif
													</div>
												</div>
											</td>
											<td>{{ $category->created_at }}</td>
											<td><a href="{{ route('admin.categoryedit', ['category_id' => $category->id]) }}"
													class="btn btn-inverse-success btn-sm">Edit</a>
												<a href="#" class="btn btn-inverse-danger btn-sm"
													onclick="confirm('Are you sure, You want to delete this category?') || event.stopImmediatePropagation()"
													wire:click.prevent="deleteCategory({{ $category->id }})">Delete</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<!-- ======= Pagination Start ======= -->
							<div class="row p-2" style="width: 100%;">
								<div class="col-md-6 col-sm-6 pt-2">
									<div class="float-left" style="width: 100%;">
										{!! $categories->onEachSide(2)->links() !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6  pt-2">
									<p class="text-secondary float-right">
										{!! $categories->total() !!} Total Categories
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
