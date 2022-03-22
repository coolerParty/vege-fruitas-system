<div>
	@section('title', 'Admin | Coupon')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Coupon</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Coupon</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Coupon</h4>
							<p><a href="{{ route('admin.couponadd') }}" class="btn btn-inverse-success">Add Coupon</a></p>
						</div>
						{{-- <p class="card-description"> Add class <code>.table-bordered</code></p> --}}
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> # </th>
										<th> Code </th>
										<th> Type </th>
										<th> Value </th>
										<th> Cart Value </th>
										<th> Date </th>
										<th class="col-sm-2"> Action </th>
									</tr>
								</thead>
								<tbody>

									@if (Session::has('message'))
										<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
									@endif

									@if (Session::has('del_message'))
										<div class="alert alert-danger" role="alert">{{ Session::get('del_message') }}</div>
									@endif

									@if (Session::has('up_message'))
										<div class="alert alert-info" role="alert">{{ Session::get('up_message') }}</div>
									@endif
                                    
									<!-- ======= Search Bar Start ======= -->
									<form class="row p-1" action="{{ route('admin.coupon') }}">
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" placeholder="Search code / name" aria-label="Search code / name"
													aria-describedby="basic-addon2" id="searchname" name="searchname" type="search"
													value="{{ $searchname }}">
												<div class="input-group-append">
													<button class="btn btn-sm btn-primary" type="submit">Search</button>
												</div>
											</div>
										</div>
									</form>
									<!-- ======= Search Bar End ======= -->
									@foreach ($coupons as $coupon)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $coupon->code }}</td>
											<td>{{ $coupon->type }}</td>
											@if ($coupon->type == 'fixed')
												<td>${{ $coupon->value }}</td>
											@else
												<td>{{ $coupon->value }} %</td>
											@endif
											<td>{{ $coupon->cart_value }}</td>
											<td>{{ $coupon->created_at }}</td>
											<td><a href="{{ route('admin.couponedit', ['coupon_id' => $coupon->id]) }}"
													class="btn btn-inverse-success btn-sm">Edit</a>
												<a href="#" class="btn btn-inverse-danger btn-sm"
													onclick="confirm('Are you sure, You want to delete this coupon?') || event.stopImmediatePropagation()"
													wire:click.prevent="deleteCoupon({{ $coupon->id }})">Delete</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<!-- ======= Pagination Start ======= -->
							<div class="row p-2" style="width: 100%;">
								<div class="col-md-6 col-sm-6 pt-2">
									<div class="float-left" style="width: 100%;">
										{!! $coupons->onEachSide(2)->links() !!}
									</div>
								</div>
								<div class="col-md-6 col-sm-6  pt-2">
									<p class="text-secondary float-right">
										{!! $coupons->total() !!} Total Coupons
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
