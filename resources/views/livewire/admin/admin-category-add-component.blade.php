<div>
	@section('title', 'Admin | Category | Add')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Add Category </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Category</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Category</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Category Add</h4>
							<p><a href="{{ route('admin.category') }}" class="btn btn-inverse-info">Back to Category</a></p>
						</div>
						{{-- <h4 class="card-title">Default form</h4>
						<p class="card-description"> Basic form layout </p> --}}
						@if (Session::has('message'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<h5><i class="icon fas fa-check"></i> Category Added!</h5>{{ Session::get('message') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						<form wire:submit.prevent="storeCategory" class="forms-sample">
							<div class="form-group">
								<label for="exampleInputCurrentPassword1">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputCurrentPassword1"
									placeholder="Name" wire:model="name" wire:keyup="generateslug">
								@error('name')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Slug</label>
								<input type="text" class="bg-dark form-control @error('slug') is-invalid @enderror" id="exampleInputPassword1"
									wire:model="slug" disabled>
								@error('slug')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="type">Type</label>
								<select class="form-control" id="type" wire:model="type">
									<option value="" selected>Select Type</option>
									<option value="1">Product</option>
									<option value="2">Blog</option>
								</select>
								@error('type')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<label>Cover Image</label>
								<div class="input-group">
									<input type="file" name="image" class="form-control btn btn-primary p-2 @error('image') is-invalid @enderror"
										wire:model="image" placeholder="Upload Image" aria-describedby="button-image">
									@if ($image)
										<button class="btn btn-danger" type="button" id="button-image" wire:click="removeImage">Remove</button>
									@endif
									@error('image')
										<p class="text-danger">{{ $message }}</p>
									@enderror
								</div>
								<div class="mt-1 p-1 border">
									<div class="alert alert-danger m-1" style="width: 100%;" wire:loading wire:target="image">
										Uploading...
									</div>
									<ul>
										@if ($image)
											<li>{{ $image->getClientOriginalName() }}</li>
										@else
											<li>No Image Selected</li>
										@endif
									</ul>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleSelectStatus">Status</label>
								<select class="form-control" id="exampleSelectStatus" wire:model="status">
									<option value="0">Inactive</option>
									<option value="1">Active</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary mr-2">Save</button>
							{{-- <button class="btn btn-dark">Cancel</button> --}}
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
</div>
