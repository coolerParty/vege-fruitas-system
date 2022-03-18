<div>
	@section('title', 'Admin | Product | Edit')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Edit Product </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.product') }}">Product</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Product Edit</h4>
							<p><a href="{{ route('admin.product') }}" class="btn btn-inverse-info">Back to Products</a></p>
						</div>
						<form class="forms-sample" wire:submit.prevent="updateProduct">
							<div class="form-group">
								<label for="exampleInputName1">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1"
									placeholder="Name" wire:model="name" wire:keyup="generateSlug">
								@error('name')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="Slug">Slug</label>
								<input type="text" class="bg-dark form-control @error('slug') is-invalid @enderror" id="Slug" placeholder=""
									wire:model="slug" disabled>
								@error('slug')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="short_description">Short Description</label>
								<textarea class="form-control bg-secondary text-dark @error('short_description') is-invalid @enderror" id="short_description" rows="8"
         wire:model="short_description"></textarea>
								@error('short_description')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="8"
         wire:model="description"></textarea>
								@error('description')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="information">Information</label>
								<textarea class="form-control @error('information') is-invalid @enderror" id="information" rows="8"
         wire:model="information"></textarea>
								@error('information')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="regular_price">Regular Price</label>
								<input type="text" class="form-control @error('regular_price') is-invalid @enderror" id="regular_price"
									placeholder="Enter Regular Price" wire:model="regular_price">
								@error('regular_price')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="sale_price">Sale Price</label>
								<input type="text" class="form-control @error('sale_price') is-invalid @enderror" id="sale_price"
									placeholder="Enter Sale Price" wire:model="sale_price">
								@error('sale_price')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="stock_status">Stock Status</label>
								<select class="form-control @error('stock_status') is-invalid @enderror" id="stock_status"
									wire:model="stock_status">
									<option value="instock">Instock</option>
									<option value="outofstock">Out of Stock</option>
								</select>
								@error('stock_status')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="featured">Featured</label>
								<select class="form-control @error('featured') is-invalid @enderror" id="featured" wire:model="featured">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
								@error('featured')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="quantity">Quantity</label>
								<input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
									placeholder="Enter Regular Price" wire:model="quantity">
								@error('quantity')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="weight">Weight</label>
								<input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight"
									placeholder="Enter Regular Price" wire:model="weight">
								@error('weight')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="category_id">Category</label>
								<select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
									wire:model="category_id">
									<option value="" selected>Select Category</option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
								@error('category_id')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>

							<div class="form-group">
								<label>Cover Image</label>
								<div class="input-group">
									<input type="file" name="image"
										class="form-control btn btn-primary p-2 @error('newimage') is-invalid @enderror" wire:model="newimage"
										placeholder="Upload Image" aria-describedby="button-image">
									@if ($newimage)
										<button class="btn btn-danger" type="button" id="button-image" wire:click="removeCover">Remove</button>
									@endif
									@error('newimage')
										<p class="text-danger">{{ $message }}</p>
									@enderror
								</div>
								<div class="mt-1 mb-1 p-1 border">
									<div class="alert alert-danger m-1" style="width: 100%;" wire:loading wire:target="newimage">
										Uploading...
									</div>
									<ul>
										@if ($newimage)
											<li>{{ $newimage->getClientOriginalName() }}</li>
										@else
											<li>No Image Selected</li>
										@endif
									</ul>
								</div>
								@if ($image)
									<div>Current Image</div>
									<div class="mt-1 p-1 border">
										<img src="{{ asset('storage/product/small') }}/{{ $image }}" alt="">
									</div>
								@endif
							</div>

							<div class="form-group">
								<label>Images</label>
								<div class="input-group">
									<input type="file" name="image"
										class="form-control btn btn-primary p-2 @error('newimages.*') is-invalid @enderror" wire:model="newimages"
										multiple aria-describedby="button-images">
									@if ($newimages)
										<button class="btn btn-danger" type="button" id="button-images" wire:click="removeImages">Remove</button>
									@endif
									@error('newimages.*')
										<p class="text-danger">{{ $message }}</p>
									@enderror
								</div>
								<div class="mt-1 mb-1 p-1 border">
									<div class="alert alert-danger m-1" style="width: 100%;" wire:loading wire:target="newimages">
										Uploading...
									</div>
									<ul>
										@if ($newimages)
											@foreach ($newimages as $image)
												<li>{{ $image->getClientOriginalName() }}</li>
											@endforeach
										@else
											<li>No Image Selected</li>
										@endif
									</ul>
								</div>
								@if ($images)
									<div>Current Images</div>
									<div class="mt-1 p-1 border">
										@foreach ($images as $img)
											@if ($img)
												<img src="{{ asset('storage/product/large') }}/{{ $img }}" alt="" width="120">
											@endif
										@endforeach
									</div>
								@endif
							</div>

							<button type="submit" class="btn btn-primary mr-2">Submit</button>
							<button class="btn btn-dark" href="{{ route('admin.product') }}">Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
</div>
