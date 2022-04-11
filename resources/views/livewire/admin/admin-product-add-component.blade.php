<div>
	@section('title', 'Admin | Product | Add')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Add Product </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.product') }}">Product</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Product</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Product Add</h4>
							<p><a href="{{ route('admin.product') }}" class="btn btn-inverse-info">Back to Products</a></p>
						</div>
						{{-- <h4 class="card-title">Basic form elements</h4>
						<p class="card-description"> Basic form elements </p> --}}
						<form class="forms-sample" wire:submit.prevent="addProduct">
							<div class="form-group">
								<label for="exampleInputName1">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1"
									placeholder="Name" wire:model="name" wire:keyup="generateSlug">
								@error('name')
									<p class="text-danger">{{ $message }}</p>
								@enderror
								@error('short_description')
									<p class="text-danger">{{ $message }}</p>
								@enderror
								@error('description')
									<p class="text-danger">{{ $message }}</p>
								@enderror
								@error('information')
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
							<div class="form-group" wire:ignore>
								<label for="short_description">Short Description</label>
								<textarea class="form-control bg-secondary text-dark @error('short_description') is-invalid @enderror"
         id="short_description" rows="4" wire:model="short_description"></textarea>
							</div>
							<div class="form-group" wire:ignore>
								<label for="description">Description</label>
								<textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4"
         wire:model="description"></textarea>
							</div>
							<div class="form-group" wire:ignore>
								<label for="information">Information</label>
								<textarea class="form-control @error('information') is-invalid @enderror" id="information" rows="4"
         wire:model="information"></textarea>
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
								<input type="text" class="form-control @error('sale_price') is-invalid @enderror" value="0" id="sale_price"
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
								{{-- <input type="file" name="image" class="file-upload-default" wire:model="image"> --}}
								<div class="input-group">
									<input type="file" name="image" class="form-control btn btn-primary p-2 @error('image') is-invalid @enderror"
										wire:model="image" placeholder="Upload Image" aria-describedby="button-image">
									@if ($image)
										<button class="btn btn-danger" type="button" id="button-image" wire:click="removeCover">Remove</button>
									@endif
									@error('image')
										<p class="text-danger">{{ $message }}</p>
									@enderror
									{{-- <input type="text" class="form-control file-upload-info @error('image') is-invalid @enderror" disabled
										placeholder="Upload Image"> --}}
									{{-- <span class="input-group-append">
										<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
									</span> --}}


								</div>
								<div class="mt-1 p-1 border">
									<div class="alert alert-danger m-1" style="width: 100%;" wire:loading wire:target="image">
										Uploading...
									</div>
									<ul>
										@if ($image)
											<li>{{ $image->getClientOriginalName() }}</li>

											{{-- <img src="{{ $cover_image->temporaryUrl() }}" width="120" style="margin: 5px;"> --}}
										@else
											<li>No Image Selected</li>
										@endif
									</ul>
								</div>
							</div>

							<div class="form-group">
								<label>Images</label>
								{{-- <input type="file" name="image" class="file-upload-default" wire:model="image"> --}}
								<div class="input-group">
									<input type="file" name="image"
										class="form-control btn btn-primary p-2 @error('images.*') is-invalid @enderror" wire:model="images" multiple
										aria-describedby="button-images">
									{{-- <input type="text" class="form-control file-upload-info @error('image') is-invalid @enderror" disabled
										placeholder="Upload Image"> --}}
									{{-- <span class="input-group-append">
										<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
									</span> --}}
									@if ($images)
										<button class="btn btn-danger" type="button" id="button-images" wire:click="removeImages">Remove</button>
									@endif
									@error('images.*')
										<p class="text-danger">{{ $message }}</p>
									@enderror
								</div>
								<div class="mt-1 p-1 border">
									<div class="alert alert-danger m-1" style="width: 100%;" wire:loading wire:target="images">
										Uploading...
									</div>
									<ul>
										@if ($images)
											@foreach ($images as $image)
												{{-- <img src="{{ $image->temporaryUrl() }}" width="120" alt=""> --}}
												<li>{{ $image->getClientOriginalName() }}</li>
											@endforeach
										@else
											<li>No Image Selected</li>
										@endif
									</ul>
								</div>
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
@push('scripts')
	<script>
	 $(function() {
	  tinymce.init({
	   selector: '#short_description',
	   setup: function(editor) {
	    editor.on('Change', function(e) {
	     tinyMCE.triggerSave();
	     var sd_data = $('#short_description').val();
	     @this.set('short_description', sd_data);
	    })
	   }
	  });

	  tinymce.init({
	   selector: '#description',
	   setup: function(editor) {
	    editor.on('Change', function(e) {
	     tinyMCE.triggerSave();
	     var d_data = $('#description').val();
	     @this.set('description', d_data);
	    })
	   }
	  });

	  tinymce.init({
	   selector: '#information',
	   setup: function(editor) {
	    editor.on('Change', function(e) {
	     tinyMCE.triggerSave();
	     var d_data = $('#information').val();
	     @this.set('information', d_data);
	    })
	   }
	  });

	 });
	</script>
@endpush
