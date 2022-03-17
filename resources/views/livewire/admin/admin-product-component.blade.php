<div>
	@section('title', 'Admin | Product')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Product</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Product</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Product</h4>
							<p><a href="{{ route('admin.productadd') }}" class="btn btn-inverse-success">Add Product</a></p>
						</div>
						{{-- <p class="card-description"> Add class <code>.table-bordered</code></p> --}}
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> # </th>
										<th> Image </th>
										<th> Title </th>
										<th> Stock </th>
										<th> Featured </th>
										<th> Quantity </th>
										<th> Category </th>
										<th> Date Created </th>
										<th> Action </th>
									</tr>
								</thead>
								<tbody>
									@if (Session::has('message'))
										<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
									@endif
									<!-- ======= Search Bar Start ======= -->
									<form class="row p-1" action="{{ route('admin.product') }}">
										<div class="form-group">
											<div class="input-group col-md-6">
												<input class="form-control" placeholder="Search product name" aria-label="Search product name"
													aria-describedby="basic-addon2" id="searchname" name="searchname" type="search"
													value="{{ $searchname }}">
												<div class="input-group-append">
													<button class="btn btn-sm btn-primary" type="submit">Search</button>
												</div>
											</div>
										</div>
									</form>
									<!-- ======= Search Bar End ======= -->
									@foreach ($products as $product)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td><img src="{{ asset('storage/product_small') }}/{{ $product->image }}" alt=""></td>
											<td>{{ $product->name }}</td>
											<td>
												<div class="dropdown">
													<button
														class="@if ($product->stock_status == 'outofstock') btn btn-dark @else btn btn-inverse-success @endif dropdown-toggle"
														type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														{{ $product->stock_status == 'instock' ? 'Instock' : 'Out of stock' }} </button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														@if ($product->stock_status == 'outofstock')
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateStatus({{ $product->id }},'instock','{{ url()->full() }}')">Instock</a>
														@else
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateStatus({{ $product->id }},'outofstock','{{ url()->full() }}')">Out of
																stock</a>
														@endif
													</div>
												</div>
											</td>
											<td>
												<div class="dropdown">
													<button
														class="@if ($product->featured == 0) btn btn-dark @else btn btn-inverse-success @endif dropdown-toggle"
														type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														{{ $product->featured == 1 ? 'Yes' : 'No' }} </button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
														@if ($product->featured == 0)
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateFeatured({{ $product->id }},1,'{{ url()->full() }}')">Yes</a>
														@else
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateFeatured({{ $product->id }},0,'{{ url()->full() }}')">No</a>
														@endif
													</div>
												</div>
											</td>
											<td>{{ $product->quantity }}</td>
											<td>{{ $product->category->name }}</td>
											{{-- <td>
												<div class="dropdown">
													<button
														class="@if ($product->status == 0) btn btn-inverse-secondary @else btn btn-inverse-success @endif dropdown-toggle"
														type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														{{ $product->status == 1 ? 'Active' : 'Inactive' }} </button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														@if ($product->status == 0)
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateStatus({{ $product->id }},1,'{{ url()->full() }}')">Active</a>
														@else
															<a class="dropdown-item text-secondary" href="#"
																wire:click.prevent="updateStatus({{ $product->id }},0,'{{ url()->full() }}')">Inactive</a>
														@endif
													</div>
												</div>
											</td> --}}
											<td>{{ $product->created_at }}</td>
											<td><a href="{{ route('admin.productedit', ['product_id' => $product->id]) }}"
													class="btn btn-inverse-success btn-sm">Edit</a>
												<a href="#" class="btn btn-inverse-danger btn-sm"
													onclick="confirm('Are you sure, You want to delete this product?') || event.stopImmediatePropagation()"
													wire:click.prevent="deleteProduct({{ $product->id }})">Delete</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<!-- ======= Pagination Start ======= -->
							<div class="row p-2" style="width: 100%;">
								<div class="col-md-6 col-sm-6 pt-2">
									<div class="float-left" style="width: 100%;">
										{!! $products->onEachSide(2)->links() !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6  pt-2">
									<p class="text-secondary float-right">
										{!! $products->total() !!} Total Products
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
