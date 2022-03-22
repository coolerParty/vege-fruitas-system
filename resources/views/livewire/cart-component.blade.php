<div>
	@section('title', 'Shopping Cart')
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}" wire:ignore>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Shopping Cart</h2>
						<div class="breadcrumb__option">
							<a href="{{ route('home') }}">Home</a>
							<span>Shopping Cart</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->
	<div>
		@if (Session::has('cart_message'))
			<div class="alert alert-primary text-center" role="alert">
				<h5>{{ Session::get('cart_message') }}</h5>
			</div>
		@endif
	</div>
	<!-- Shoping Cart Section Begin -->
	<section class="shoping-cart spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					@if (Cart::instance('cart')->count() > 0)
						<div class="shoping__cart__table">
							<table>
								<thead>
									<tr>
										<th class="shoping__product">Products</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach (Cart::instance('cart')->content() as $item)
										<tr>
											<td class="shoping__cart__item">
												<img src="{{ asset('storage/product/small') }}/{{ $item->model->image }}" alt="">
												<h5>{{ $item->model->name }}</h5>
											</td>
											<td class="shoping__cart__price">
												${{ number_format($item->model->regular_price, 2) }}
											</td>
											<td class="shoping__cart__quantity">
												<div class="quantity">
													<div class="pro-qty1">
														<div class="input-group">
															<div class="input-group-prepend">
																<button class="btn btn-outline-secondary" type="button"
																	wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')">-</button>
															</div>
															<input type="text" name="product-quantity" class="form-control text-center" style="max-width: 5rem;"
																value="{{ $item->qty }}" data-max="120" pattern="[0-9]*">
															<div class="input-group-prepend">
																<button class="btn btn-outline-secondary" type="button"
																	wire:click.prevent="increaseQuantity('{{ $item->rowId }}')">+</button>
															</div>
														</div>
													</div>
												</div>
											</td>
											<td class="shoping__cart__total">
												${{ number_format($item->subtotal, 2) }}
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
						<h3 class="text-center m-5 p-5">No Item in Cart.</h3>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="shoping__cart__btns">
						<a href="{{ route('shop.index') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
						<a href="#" class="primary-btn cart-btn cart-btn-right btn btn-danger" wire:click.prevent="destroyAll()">
							{{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span> --}}
							Clear Cart</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="shoping__continue">
						@if (!Session::has('coupon'))
							<div class="shoping__discount">
								<input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox"
									wire:model="haveCouponCode">
								<label for="have-code">Enter your coupon code</label>
							</div>
							@if ($haveCouponCode == 1)
								<div class="shoping__discount">
									@if (Session::has('coupon_message'))
										<div class="alert alert-danger" role="danger">{{ Session::get('coupon_message') }}</div>
									@endif
									<h5>Discount Codes</h5>
									<form wire:submit.prevent="applyCouponCode">
										<input type="text" placeholder="Enter your coupon code" name="couponCode" wire:model="couponCode">
										<button type="submit" class="site-btn">APPLY COUPON</button>
									</form>
								</div>
							@endif
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="shoping__checkout">
						<h5>Cart Total</h5>
						<ul>
							@if (Session::has('coupon'))
								<li>Discount ({{ number_format(Session::get('coupon')['code'],2) }}) <span>-${{ number_format($discount,2) }} <a href="#" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger"></i></a></span></li>
								<li>Subtotal with Discount ({{ Cart::instance('cart')->tax() }}%) <span>${{ number_format($subtotalAfterDiscount,2) }}</span></li>
								<li>Tax ({{ Cart::instance('cart')->tax() }}%)<span>${{ number_format($taxAfterDiscount,2) }}</span></li>
								<li>Total <span>${{ number_format($totalAfterDiscount,2) }}</span></li>
							@else
								<li>Subtotal <span>${{ number_format(Cart::instance('cart')->subtotal(),2) }}</span></li>
								<li>Tax <span>${{ number_format(Cart::instance('cart')->tax(),2) }}</span></li>
								<li>Total <span>${{ number_format(Cart::instance('cart')->total(),2) }}</span></li>
							@endif
						</ul>
						<a href="{{ route('checkout.index') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Shoping Cart Section End -->
</div>
