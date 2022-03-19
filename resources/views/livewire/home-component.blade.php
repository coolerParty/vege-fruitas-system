<div>
    @section('title', 'Vege Fruitas Online')

    {{-- <div class="hero__item set-bg col-lg-9 col-md-9 col-sm-9" style="margin: 5px auto 20px auto;" data-setbg="{{ asset('assets/img/hero/banner.jpg') }}">
        <div class="hero__text">
            <span>FRUIT FRESH</span>
            <h2>Vegetable <br />100% Organic</h2>
            <p>Free Pickup and Delivery Available</p>
            <a href="#" class="primary-btn">SHOP NOW</a>
        </div>
    </div> --}}

	<!-- Categories Section Begin -->
	<section class="categories">
		<div class="container">
			<div class="row">
				<div class="categories__slider owl-carousel">
					@foreach ($image_categories as $image_category)
						<div class="col-lg-3">
							<div class="categories__item set-bg"
								data-setbg="{{ asset('storage/category/medium') }}/{{ $image_category->image }}">
								<h5><a href="#">{{ $image_category->name }}</a></h5>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<!-- Categories Section End -->

	<!-- Featured Section Begin -->
	<section class="featured spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Featured Product</h2>
					</div>
					<div class="featured__controls">
						<ul>
							<li class="active" data-filter="*">All</li>
							@foreach ($featured_cats as $featured_cat)
								<li data-filter=".c{{ $featured_cat->id }}c">{{ $featured_cat->name }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="row featured__filter">
				@foreach ($featured_products as $featured_product)
					<div class="col-lg-3 col-md-4 col-sm-6 mix c{{ $featured_product->category_id }}c">
						<div class="featured__item">
							<div class="featured__item__pic set-bg"
								data-setbg="{{ asset('storage/product/medium') }}/{{ $featured_product->image }}">
								<ul class="featured__item__pic__hover">
									<li><a href="#"><i class="fa fa-heart"></i></a></li>
									<li><a href="#"><i class="fa fa-retweet"></i></a></li>
									<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
								</ul>
							</div>
							<div class="featured__item__text">
								<h6><a href="#">{{ $featured_product->name }}</a></h6>
								<h5>${{ number_format($featured_product->regular_price, 2) }}</h5>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Featured Section End -->

	<!-- Banner Begin -->
	<div class="banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="banner__pic">
						<img src="{{ asset('assets/img/banner/banner-1.jpg') }}" alt="">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="banner__pic">
						<img src="{{ asset('assets/img/banner/banner-2.jpg') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Banner End -->

	<!-- Latest Product Section Begin -->
	<section class="latest-product spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="latest-product__text">
						<h4>Latest Products</h4>
						<div class="latest-product__slider owl-carousel">
							<div class="latest-prdouct__slider__item">
								@foreach ($l_top_products as $l_top_product)
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="{{ asset('storage/product/small') }}/{{ $l_top_product->image }}" alt="">
										</div>
										<div class="latest-product__item__text">
											<h6>{{ $l_top_product->name }}</h6>
											<span>${{ number_format($l_top_product->regular_price,2) }}</span>
										</div>
									</a>
								@endforeach
							</div>
							<div class="latest-prdouct__slider__item">
								@foreach ($l_buttom_products as $l_buttom_product)
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="{{ asset('storage/product/small') }}/{{ $l_buttom_product->image }}" alt="">
										</div>
										<div class="latest-product__item__text">
											<h6>{{ $l_buttom_product->name }}</h6>
											<span>${{ number_format($l_buttom_product->regular_price,2) }}</span>
										</div>
									</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="latest-product__text">
						<h4>Top Rated Products</h4>
						<div class="latest-product__slider owl-carousel">
							<div class="latest-prdouct__slider__item">
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-1.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-2.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-3.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
							</div>
							<div class="latest-prdouct__slider__item">
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-1.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-2.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-3.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="latest-product__text">
						<h4>Review Products</h4>
						<div class="latest-product__slider owl-carousel">
							<div class="latest-prdouct__slider__item">
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-1.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-2.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-3.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
							</div>
							<div class="latest-prdouct__slider__item">
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-1.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-2.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
								<a href="#" class="latest-product__item">
									<div class="latest-product__item__pic">
										<img src="{{ asset('assets/img/latest-product/lp-3.jpg') }}" alt="">
									</div>
									<div class="latest-product__item__text">
										<h6>Crab Pool Security</h6>
										<span>$30.00</span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Latest Product Section End -->

	<!-- Blog Section Begin -->
	<section class="from-blog spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title from-blog__title">
						<h2>From The Blog</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach ($blogs as $blog)
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="blog__item">
							<div class="blog__item__pic">
								<img src="{{ asset('storage/blog/medium') }}/{{ $blog->image }}" alt="">
							</div>
							<div class="blog__item__text">
								<ul>
									<li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</li>
									<li><i class="fa fa-comment-o"></i> 5</li>
								</ul>
								<h5><a href="#">{{ $blog->name }}</a></h5>
								<p>{{ $blog->short_description }}</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Blog Section End -->
</div>
