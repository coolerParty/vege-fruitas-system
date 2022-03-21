<div>
    @section('title', 'Wishlist')
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}" wire:ignore>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Wishlist</h2>
						<div class="breadcrumb__option">
							<a href="{{ route('home') }}">Home</a>
							<span>Wishlist</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->

	<!-- Shoping Cart Section Begin -->
	<section class="shoping-cart spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					@if (Cart::instance('wishlist')->count() > 0)
						<div class="shoping__cart__table">
							<table>
								<thead>
									<tr>
										<th class="shoping__product">Products</th>
										<th>Price</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach (Cart::instance('wishlist')->content() as $item)
										<tr>
											<td class="shoping__cart__item">
												<img src="{{ asset('storage/product/small') }}/{{ $item->model->image }}" alt="">
												<h5>{{ $item->model->name }}</h5>
											</td>
											<td class="shoping__cart__price">
												${{ number_format($item->model->regular_price, 2) }}
											</td>
											<td class="shoping__cart__item__close">
												<a href="#" wire:click.prevent="destroy('{{ $item->rowId }}')" title="">
													<span class="icon_close"></span>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<h3 class="text-center m-5 p-5">No Item in Wishlist.</h3>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="shoping__cart__btns">
						<a href="{{ route('shop.index') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
						<a href="#" class="primary-btn cart-btn cart-btn-right btn btn-danger" wire:click.prevent="destroyAll()">
							{{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span> --}}
							Clear Wishlist</a>
					</div>
				</div>		
				
			</div>
		</div>
	</section>
	<!-- Shoping Cart Section End -->
</div>
