<div>
	@section('title', 'Admin | Blog | Add')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title"> Add Blog </h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.blog') }}">Blog</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Blog</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<h4 class="card-title">Blog Add</h4>
							<p><a href="{{ route('admin.blog') }}" class="btn btn-inverse-info">Back to Blogs</a></p>
						</div>
						<form class="forms-sample" wire:submit.prevent="updateBlog">
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
							<div class="form-group" wire:ignore>
								<label for="short_description">Short Description</label>
								<textarea class="form-control bg-secondary text-dark @error('short_description') is-invalid @enderror"
         id="short_description" rows="4" wire:model="short_description"></textarea>
								@error('short_description')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group" wire:ignore>
								<label for="description">Description</label>
								<textarea class="bg-secondary text-dark form-control @error('description') is-invalid @enderror description"
         id="description" rows="8" wire:model="description"></textarea>
								@error('description')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control @error('status') is-invalid @enderror" id="status" wire:model="status">
									<option value="0">Inactive</option>
									<option value="1">Active</option>
								</select>
								@error('status')
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
								<label>Image</label>
								{{-- <input type="file" name="image" class="file-upload-default" wire:model="image"> --}}
								<div class="input-group">
									<input type="file" name="newimage"
										class="form-control btn btn-primary p-2 @error('newimage') is-invalid @enderror" wire:model="newimage"
										placeholder="Upload Image" aria-describedby="button-image">
									@if ($newimage)
										<button class="btn btn-danger" type="button" id="button-image" wire:click="removeImage">Remove</button>
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
										<img src="{{ asset('storage/blog/small') }}/{{ $image }}" alt="">
									</div>
								@endif
							</div>

							<button type="submit" class="btn btn-primary mr-2">Submit</button>
							<button class="btn btn-dark" href="{{ route('admin.blog') }}">Cancel</button>
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
	 });
	</script>
@endpush
