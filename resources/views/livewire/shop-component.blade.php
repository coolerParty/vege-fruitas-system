<div>
	@section('title', 'Shop')
	<style>
		.wish-product {
			background: rgb(240, 46, 175) !important;
			color: white !important;
		}

		.green-wish-box {
			border: 1px solid rgb(240, 46, 175) !important;
		}

	</style>
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}" wire:ignore.self>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Organi Shop</h2>
						<div class="breadcrumb__option">
							<a href="{{ route('home') }}">Home</a>
							<span>Shop</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->

	<!-- Product Section Begin -->
	<section class="product spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-5">
					<div class="sidebar">
						<div class="sidebar__item">
							<h4>Department</h4>
							<ul>
								@foreach ($categories as $category)
									<li><a href="#">{{ $category->name }}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="sidebar__item">
							<h4>Price</h4>
							<div class="price-range-wrap">
								<div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10"
									data-max="540">
									<div class="ui-slider-range ui-corner-all ui-widget-header"></div>
									<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
									<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
								</div>
								<div class="range-slider">
									<div class="price-input">
										<input type="text" id="minamount">
										<input type="text" id="maxamount">
									</div>
								</div>
							</div>
						</div>
						<div class="sidebar__item sidebar__item__color--option">
							<h4>Colors</h4>
							<div class="sidebar__item__color sidebar__item__color--white">
								<label for="white">
									White
									<input type="radio" id="white">
								</label>
							</div>
							<div class="sidebar__item__color sidebar__item__color--gray">
								<label for="gray">
									Gray
									<input type="radio" id="gray">
								</label>
							</div>
							<div class="sidebar__item__color sidebar__item__color--red">
								<label for="red">
									Red
									<input type="radio" id="red">
								</label>
							</div>
							<div class="sidebar__item__color sidebar__item__color--black">
								<label for="black">
									Black
									<input type="radio" id="black">
								</label>
							</div>
							<div class="sidebar__item__color sidebar__item__color--blue">
								<label for="blue">
									Blue
									<input type="radio" id="blue">
								</label>
							</div>
							<div class="sidebar__item__color sidebar__item__color--green">
								<label for="green">
									Green
									<input type="radio" id="green">
								</label>
							</div>
						</div>
						<div class="sidebar__item">
							<h4>Popular Size</h4>
							<div class="sidebar__item__size">
								<label for="large">
									Large
									<input type="radio" id="large">
								</label>
							</div>
							<div class="sidebar__item__size">
								<label for="medium">
									Medium
									<input type="radio" id="medium">
								</label>
							</div>
							<div class="sidebar__item__size">
								<label for="small">
									Small
									<input type="radio" id="small">
								</label>
							</div>
							<div class="sidebar__item__size">
								<label for="tiny">
									Tiny
									<input type="radio" id="tiny">
								</label>
							</div>
						</div>
						<div class="sidebar__item">
							<div class="latest-product__text">
								<h4>Latest Products</h4>
								<div class="latest-product__slider owl-carousel" wire:ignore>
									<div class="latest-prdouct__slider__item">
										@foreach ($l_top_products as $l_top_product)
											<a
												href="{{ route('product.details', ['product_id' => $l_top_product->id, 'slug' => $l_top_product->slug]) }}"
												class="latest-product__item">
												<div class="latest-product__item__pic">
													<img src="{{ asset('storage/product/small') }}/{{ $l_top_product->image }}" alt="" wire:ignore.self>
												</div>
												<div class="latest-product__item__text">
													<h6>{{ $l_top_product->name }}</h6>
													<span>${{ number_format($l_top_product->regular_price, 2) }}</span>
												</div>
											</a>
										@endforeach
									</div>
									<div class="latest-prdouct__slider__item">
										@foreach ($l_buttom_products as $l_buttom_product)
											<a
												href="{{ route('product.details', ['product_id' => $l_buttom_product->id, 'slug' => $l_buttom_product->slug]) }}"
												class="latest-product__item">
												<div class="latest-product__item__pic">
													<img src="{{ asset('storage/product/small') }}/{{ $l_buttom_product->image }}" alt=""
														wire:ignore.self>
												</div>
												<div class="latest-product__item__text">
													<h6>{{ $l_buttom_product->name }}</h6>
													<span>${{ number_format($l_buttom_product->regular_price, 2) }}</span>
												</div>
											</a>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-7">
					<div>
						@if (Session::has('cart_message'))
							<div class="alert alert-primary text-center" role="alert">
								<h5>{{ Session::get('cart_message') }}</h5>
							</div>
						@endif
					</div>
					<div class="product__discount">
						<div class="section-title product__discount__title">
							<h2>Sale Off</h2>
						</div>
						<div class="row">
							@if ($sale_products)
								<div class="product__discount__slider owl-carousel" wire:ignore>
									@foreach ($sale_products as $sale_product)
										<div class="col-lg-4 col-md-4 col-sm-4">
											<div class="product__discount__item">
												<div class="product__discount__item__pic set-bg"
													data-setbg="{{ asset('storage/product/medium') }}/{{ $sale_product->image }}">
													<div class="product__discount__percent">
														-{{ number_format(100 - ($sale_product->sale_price / $sale_product->regular_price) * 100) }}%</div>
													<ul class="product__item__pic__hover">
														<li><a href="#" class="@if ($witems->contains($sale_product->id)) wish-product @endif"
																wire:click.prevent="addToWishlist({{ $sale_product->id }}, '{{ $sale_product->name }}',{{ $sale_product->regular_price }})"><i
																	class="fa fa-heart"></i></a></li>
														<li><a href="#"><i class="fa fa-retweet"></i></a></li>
														<li><a href="#"
																wire:click.prevent="store({{ $sale_product->id }}, '{{ $sale_product->name }}',{{ $sale_product->regular_price }})"><i
																	class="
															fa fa-shopping-cart"></i></a></li>
													</ul>
												</div>
												<div class="product__discount__item__text">
													<span>{{ $sale_product->category->name }}</span>
													<h5><a
															href="{{ route('product.details', ['product_id' => $sale_product->id, 'slug' => $sale_product->slug]) }}">{{ $sale_product->name }}</a>
													</h5>
													<div class="product__item__price">${{ number_format($sale_product->sale_price, 2) }}
														<span>${{ number_format($sale_product->regular_price, 2) }}</span>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							@endif
						</div>
					</div>
					<div class="filter__item" wire:ignore>
						<div class="row">
							<div class="col-lg-4 col-md-5">
								<div class="filter__sort">
									<span>Sort By</span>
									<select>
										<option value="0">Default</option>
										<option value="0">Default</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-4">
								<div class="filter__found">
									<h6><span>{!! $products->total() !!}</span> Total Products</h6>
								</div>
							</div>
							<div class="col-lg-4 col-md-3">
								<div class="filter__option">
									<span class="icon_grid-2x2"></span>
									<span class="icon_ul"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						@foreach ($products as $product)
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item">
									<div class="product__item__pic set-bg"
										data-setbg="{{ asset('storage/product/medium') }}/{{ $product->image }}" wire:ignore.self>
										<ul class="product__item__pic__hover">
											<li><a href="#" class="@if ($witems->contains($product->id)) wish-product @endif"
													wire:click.prevent="addToWishlist({{ $product->id }}, '{{ $product->name }}',{{ $product->regular_price }})"><i
														class="fa fa-heart"></i></a></li>
											<li><a href="#"><i class="fa fa-retweet"></i></a></li>
											<li><a href="#"
													wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}',{{ $product->regular_price }})"><i
														class="fa fa-shopping-cart"></i></a></li>
										</ul>
									</div>
									<div class="product__item__text">
										<h6><a
												href="{{ route('product.details', ['product_id' => $product->id, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
										</h6>
										<h5>${{ number_format($product->regular_price, 2) }}</h5>
									</div>
								</div>
							</div>
						@endforeach
					</div>
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
	</section>
	<!-- Product Section End -->

</div>
