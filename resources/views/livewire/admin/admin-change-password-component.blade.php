<div>
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Change Password </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Change Password</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						{{-- <h4 class="card-title">Default form</h4>
						<p class="card-description"> Basic form layout </p> --}}
                        @if (Session::has('password_success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<h5><i class="icon fas fa-check"></i> Change Password!</h5>{{ Session::get('password_success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						@if (Session::has('password_error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<h5><i class="icon fas fa-check"></i> Change Password!</h5>{{ Session::get('password_error') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						<form wire:submit.prevent="changePassword" class="forms-sample">
							<div class="form-group">
								<label for="exampleInputCurrentPassword1">Current Password</label>
								<input type="password" class="form-control @error('current_password') is-invalid @enderror"
									id="exampleInputCurrentPassword1" placeholder="Current Password" wire:model="current_password">
								@error('current_password')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
									placeholder="Password" wire:model="password">
								@error('password')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="exampleInputConfirmPassword1">Confirm Password</label>
								<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
									id="exampleInputConfirmPassword1" placeholder="Confirm Password" wire:model="password_confirmation">
								@error('password_confirmation')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<button type="submit" class="btn btn-primary mr-2">Submit</button>
							{{-- <button class="btn btn-dark">Cancel</button> --}}
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
</div>
