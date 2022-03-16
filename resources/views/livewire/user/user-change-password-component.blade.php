<div>
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Checkout</h2>
						<div class="breadcrumb__option">
							<a href="/">Home</a>
							<span>Change Password</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->

	<!-- Checkout Section Begin -->
	<section class="checkout spad">
		<div class="container">
			<div class="checkout__form">
				<h4>Change Password</h4>
				<form wire:submit.prevent="changePassword">
					<div class="row">
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
					</div>
					<div class="row">
						<div class="col-lg-8 col-md-6">
							<div class="checkout__input">
								<p>Current Password<span>*</span></p>
								<input type="password" class="@error('current_password') is-invalid @enderror" placeholder="Current Password"
									wire:model="current_password">
								@error('current_password')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="checkout__input">
								<p>Password<span>*</span></p>
								<input type="password" class="@error('password') is-invalid @enderror" placeholder="Current Password"
									wire:model="password">
								@error('password')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="checkout__input">
								<p>Confirm Password<span>*</span></p>
								<input type="password" class="@error('password_confirmation') is-invalid @enderror"
									placeholder="Current Password" wire:model="password_confirmation">
								@error('password_confirmation')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i> Submit</button>
				</form>
			</div>
		</div>
	</section>
	<!-- Checkout Section End -->
</div>
