<div>
	@section('title', 'Shop / ' . $product->name)
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>{{ $product->name }}</h2>
						<div class="breadcrumb__option">
							<a href="{{ route('home') }}">Home</a>
							<a href="{{ route('shop.index') }}">{{ $product->category->name }}</a>
							<span>{{ $product->name }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->

	<!-- Product Details Section Begin -->
	<section class="product-details spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="product__details__pic">
						<div class="product__details__pic__item">
							<img class="product__details__pic__item--large"
								src="{{ asset('storage/product/large') }}/{{ $product->image }}" alt="">
						</div>
						<div class="product__details__pic__slider owl-carousel">
							<img data-imgbigurl="{{ asset('storage/product/large') }}/{{ $product->image }}"
									src="{{ asset('storage/product/small') }}/{{ $product->image  }}" alt="">
							@foreach (explode(',', $product->images) as $productimage)
								<img data-imgbigurl="{{ asset('storage/product/large') }}/{{ $productimage }}"
									src="{{ asset('storage/product/small') }}/{{ $productimage }}" alt="">
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="product__details__text">
						<h3>{{ $product->name }}</h3>
						<div class="product__details__rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
							<span>(18 reviews)</span>
						</div>
						<div class="product__details__price">
							$@if ($product->sale_price != null && $product->sale_price > 0)
								{{ number_format($product->regular_price, 2) }}
							@else
								{{ number_format($product->sale_price, 2) }}
							@endif
						</div>
						{!! $product->short_description !!}
						<div class="product__details__quantity">
							<div class="quantity">
								<div class="pro-qty1">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<button class="btn btn-outline-secondary" type="button" wire:click.prevent="decreaseQuantity">-</button>
										</div>
										<input type="text" class="form-control text-center" style="max-width: 5rem;" value="1" data-max="120" pattern="[0-9]*"
											wire:model="qty" aria-describedby="Qty">
										<div class="input-group-prepend">
											<button class="btn btn-outline-secondary" type="button" wire:click.prevent="increaseQuantity">+</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<a href="#" class="primary-btn">ADD TO CARD</a>
						<a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
						<ul>
							<li><b>Availability</b>
								@if ($product->stock_status === 'instock')
									<span>In Stock</span>
								@elseif ($product->stock_status === 'outofstock')
									<span>Out of Stock</span>
								@endif
							</li>
							<li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
							<li><b>Weight</b> <span>{{ $product->weight }} kg</span></li>
							<li><b>Share on</b>
								<div class="share">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-instagram"></i></a>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="product__details__tab">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Information</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews
									<span>(1)</span></a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tabs-1" role="tabpanel">
								<div class="product__details__tab__desc">
									<h6>Products Description</h6>
									{!! $product->description !!}
								</div>
							</div>
							<div class="tab-pane" id="tabs-2" role="tabpanel">
								<div class="product__details__tab__desc">
									<h6>Products Information</h6>
									{!! $product->information !!}
								</div>
							</div>
							<div class="tab-pane" id="tabs-3" role="tabpanel">
								<div class="product__details__tab__desc">
									<h6>Products Infomation</h6>
									{!! $product->information !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Product Details Section End -->

	<!-- Related Product Section Begin -->
	<section class="related-product">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title related__product__title">
						<h2>Related Product</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach ($related_products as $related_product)
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product__item">
							<div class="product__item__pic set-bg"
								data-setbg="{{ asset('storage/product/medium') }}/{{ $related_product->image }}">
								<ul class="product__item__pic__hover">
									<li><a href="#"><i class="fa fa-heart"></i></a></li>
									<li><a href="#"><i class="fa fa-retweet"></i></a></li>
									<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
								</ul>
							</div>
							<div class="product__item__text">
								<h6><a
										href="{{ route('product.details', ['product_id' => $related_product->id, 'slug' => $related_product->slug]) }}">{{ $related_product->name }}</a>
								</h6>
								<h5>$
									@if ($related_product->sale_price != null && $related_product->sale_price > 0)
										{{ number_format($related_product->sale_price, 2) }}
									@else
										{{ number_format($related_product->regular_price, 2) }}
									@endif
								</h5>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Related Product Section End -->
</div>
