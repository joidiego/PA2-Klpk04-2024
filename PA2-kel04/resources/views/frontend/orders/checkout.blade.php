@extends('frontend.layout')

@section('content')
	<!-- header end -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url('{{ asset('themes/ezone/assets/img/bg/slider.png') }}');">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h2 class="breadcrumb-title">Halaman Pembayaran </h2>
                <ul class="breadcrumb-list">
                    <li><a href="#">home</a></li>
                    <li>Pembayaran</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Apply styles using JavaScript
        document.addEventListener('DOMContentLoaded', function () {
            const breadcrumbArea = document.querySelector('.breadcrumb-area');
            const breadcrumbTitle = document.querySelector('.breadcrumb-title');
            const breadcrumbList = document.querySelector('.breadcrumb-list');
            const breadcrumbLinks = document.querySelectorAll('.breadcrumb-list li a');

            // Styles for breadcrumb area
            breadcrumbArea.style.backgroundSize = 'cover';
            breadcrumbArea.style.backgroundPosition = 'center';
            breadcrumbArea.style.backgroundRepeat = 'no-repeat';
            breadcrumbArea.style.width = '100%';
            breadcrumbArea.style.height = '50vh';
            breadcrumbArea.style.margin = '0';
            breadcrumbArea.style.padding = '0';
            breadcrumbArea.style.display = 'flex';
            breadcrumbArea.style.alignItems = 'center';
            breadcrumbArea.style.justifyContent = 'center';

            // Styles for breadcrumb content
            document.querySelector('.breadcrumb-content').style.color = '#fff';

            // Styles for breadcrumb title
            breadcrumbTitle.style.fontFamily = "'Lobster', cursive";
            breadcrumbTitle.style.fontSize = '4rem';
            breadcrumbTitle.style.textShadow = '2px 2px 4px rgba(0, 0, 0, 0.5)';
            breadcrumbTitle.style.marginBottom = '20px';

            // Styles for breadcrumb list
            breadcrumbList.style.listStyle = 'none';
            breadcrumbList.style.padding = '0';
            breadcrumbList.style.fontFamily = "'Roboto', sans-serif";
            breadcrumbList.style.fontSize = '1.5rem';
            breadcrumbList.style.display = 'flex';
            breadcrumbList.style.justifyContent = 'center';
            breadcrumbList.style.gap = '15px';

            // Styles for breadcrumb list items and links
            breadcrumbLinks.forEach(link => {
                link.style.color = '#fff';
                link.style.textDecoration = 'none';
                link.style.padding = '5px 10px';
                link.style.transition = 'color 0.3s';

                link.addEventListener('mouseover', function () {
                    link.style.color = '#ffeb3b';
                });

                link.addEventListener('mouseout', function () {
                    link.style.color = '#fff';
                });
            });

            // Add slashes between breadcrumb list items
            const breadcrumbItems = document.querySelectorAll('.breadcrumb-list li');
            breadcrumbItems.forEach((item, index) => {
                if (index < breadcrumbItems.length - 1) {
                    const slash = document.createElement('span');
                    slash.textContent = '/';
                    slash.style.color = '#fff';
                    slash.style.marginLeft = '10px';
                    item.appendChild(slash);
                }
            });
        });
    </script>
</body>
</html>

	<!-- checkout-area start -->
	<div class="checkout-area ptb-100">
		<div class="container">
            <form action="{{ route('orders.checkout') }}" method="post">
				@csrf
			<div class="row">
				<div class="col-lg-6 col-md-12 col-12">
					<div class="checkbox-form">
						<h3>Detail Penagihan</h3>
						<div class="row">
							<div class="col-6">
								<div class="checkout-form-list">
									<label>Nama Pertama <span class="required">*</span></label>
									<input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}">
								</div>
							</div>
							<div class="col-6">
								<div class="checkout-form-list">
									<label>Nama Akhir <span class="required">*</span></label>
									<input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}">
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Alamat <span class="required">*</span></label>
									<input type="text" name="address1" value="{{ old('address1', auth()->user()->address1) }}">
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Provinsi<span class="required">*</span></label>
									<select name="province_id" id="shipping-province">
										<option value="">-- Pilih Provinsi --</option>
										@foreach($provinces as $id => $province)
											<option {{ auth()->user()->province_id == $id ? 'selected' : null }} value="{{ $id }}">{{ $province }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>City<span class="required">*</span></label>
									<select name="shipping_city_id" id="shipping-city">
										<option value="">-- Pilih Kota --</option>
										@if($cities)
											@foreach($cities as $id => $city)
												<option value="{{ $id }}">{{ $city }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Postcode / Zip <span class="required">*</span></label>
									<input type="text" name="postcode" value="{{ old('postcode', auth()->user()->postcode) }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Phone  <span class="required">*</span></label>
									<input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
								</div>
							</div>
						</div>
						<div class="different-address">
							<div class="ship-different-title">
								<h3>
									<label>Ship to a different address?</label>
									<input id="ship-box" type="checkbox" name="ship_to"/>
								</h3>
							</div>
							<div id="ship-box-info">
								<div class="row">
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Nama Pertama <span class="required">*</span></label>
											<input type="text" name="customer_first_name" value="{{ old('customer_first_name') }}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Nama Akhir <span class="required">*</span></label>
											<input type="text" name="customer_last_name" value="{{ old('customer_last_name') }}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Alamat <span class="required">*</span></label>
											<input type="text" name="customer_address1" value="{{ old('address1') }}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Province<span class="required">*</span></label>
											<select name="customer_province_id" id="">
												<option value="ntm">Ntb</option>
												<option value="jaksel">Jakarta Selatan</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>City<span class="required">*</span></label>
											<select name="customer_shipping_city_id" id="customer_shipping_city">
												<option value="mataram">Mataram</option>
												<option value="kuta">Kuta</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Kode Pos <span class="required">*</span></label>
											<input type="text" name="customer_postcode" value="{{ old('postcode') }}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Telepon<span class="required">*</span></label>
											<input type="text" name="customer_phone" value="{{ old('customer_phone') }}">
										</div>
									</div>

								</div>
							</div>
							<div class="order-notes">
								<div class="checkout-form-list mrg-nn">
									<label>Catatan Pesanan</label>
									<input type="text" name="note" value="{{ old('note') }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 col-12">
					<div class="your-order">
						<h3>Pesanan Anda</h3>
						<div class="your-order-table table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-name">Produk</th>
										<th class="product-total">Total</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
										@php
											$product = isset($item->model->parent) ? $item->model->parent : $item->model;
											$image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
										@endphp
										<tr class="cart_item">
											<td class="product-name">
												{{ $item->name }}	<strong class="product-quantity"> × {{ $item->qty }}</strong>
											</td>
											<td class="product-total">
												<span class="amount">Rp{{ $item->price * $item->qty }}</span>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="2">Keranjang Kosong </td>
										</tr>
									@endforelse
								</tbody>
								<tfoot>
									<tr class="cart-subtotal">
										<th>Subtotal</th>
										<td><span class="amount">Rp{{ Cart::subtotal(0, ",", ".") }}</span></td>
									</tr>
									<!-- <tr class="cart-subtotal">
										<th>Tax</th>
										<td><span class="amount">jnfjk</span></td>
									</tr> -->
									<tr class="cart-subtotal">
										<th>Biaya pengiriman (100 kg)</th>
										<td><select id="shipping-cost-option" required name="shipping_service">

										</select></td>
									</tr>
									<tr class="order-total">
										<th>Total Pesanan</th>
										<td><strong>Rp<span class="total-amount">{{ Cart::subtotal(0, ",", ".") }}</span></strong>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="payment-method">
							<div class="payment-accordion">
								<div class="panel-group" id="faq">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment-1">Transfer. Bank l</a></h5>
										</div>
										<div id="payment-1" class="panel-collapse collapse show">
											<div class="panel-body">
												<p>Lakukan pembayaran Anda langsung ke rekening bank kami. Silakan gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana telah masuk ke rekening kami.</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2">Cek Pembayaran</a></h5>
										</div>
										<div id="payment-2" class="panel-collapse collapse">
											<div class="panel-body">
												<p>Lakukan pembayaran Anda langsung ke rekening bank kami. Silakan gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana telah masuk ke rekening kami.</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-3">PayPal</a></h5>
										</div>
										<div id="payment-3" class="panel-collapse collapse">
											<div class="panel-body">
												<p>Lakukan pembayaran Anda langsung ke rekening bank kami. Silakan gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirim sampai dana telah masuk ke rekening kami.</p>
											</div>
										</div>
									</div>
								</div>
								<div class="order-button-payment">
									<input type="submit" value="Bayar" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            </form>
		</div>
	</div>
@endsection
