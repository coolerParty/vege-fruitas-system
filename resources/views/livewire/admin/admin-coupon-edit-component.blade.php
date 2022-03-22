<div>
	@section('title', 'Admin | Coupon | Edit')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Edit Coupon </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.coupon') }}">Coupon</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Coupon Edit</h4>
							<p><a href="{{ route('admin.coupon') }}" class="btn btn-inverse-info">Back to Coupon</a></p>
						</div>
						@if (Session::has('message'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<h5><i class="icon fas fa-check"></i> Coupon Updated!</h5>{{ Session::get('message') }}
							</div>
						@endif
						<form wire:submit.prevent="updateCoupon" class="forms-sample">
							<div class="form-group">
								<label for="exampleInputCurrentPassword1">Code</label>
								<input type="text" class="form-control @error('code') is-invalid @enderror" id="exampleInputCurrentPassword1"
									placeholder="Enter code" wire:model="code">
								@error('code')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="type">Coupon Type</label>
								<select class="form-control" id="type" wire:model="type">
									<option value="" selected>Select Type</option>
									<option value="fixed">Fixed</option>
									<option value="percent">Percent</option>
								</select>
								@error('type')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="exampleInputCurrentPassword1">Coupon Value</label>
								<input type="text" class="form-control @error('value') is-invalid @enderror" id="exampleInputCurrentPassword1"
									placeholder="Enter value" wire:model="value">
								@error('value')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
                            <div class="form-group">
								<label for="exampleInputCurrentPassword1">Cart Value</label>
								<input type="text" class="form-control @error('cart_value') is-invalid @enderror" id="exampleInputCurrentPassword1"
									placeholder="Enter cart value" wire:model="cart_value">
								@error('cart_value')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<button type="submit" class="btn btn-primary mr-2">Update</button>
							{{-- <button class="btn btn-dark">Cancel</button> --}}
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
</div>
