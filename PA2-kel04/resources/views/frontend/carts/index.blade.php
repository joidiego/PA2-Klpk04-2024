@extends('frontend.layout')

@section('content')
	<!-- header end -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Keranjang</title>
    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Lobster&display=swap" rel="stylesheet">
    <style>
        .breadcrumb-area {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 50vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .breadcrumb-content {
            color: #fff; /* White color for better contrast */
        }

        .breadcrumb-title {
            font-family: 'Lobster', cursive; /* Fancy font for the title */
            font-size: 4rem; /* Larger font size */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Subtle text shadow for depth */
            margin-bottom: 20px;
        }

        .breadcrumb-list {
            list-style: none; /* Remove default list styling */
            padding: 0;
            font-family: 'Roboto', sans-serif; /* Clean font for the list */
            font-size: 1.5rem; /* Adjust font size */
            display: flex;
            justify-content: center;
            gap: 15px; /* Space between list items */
        }

        .breadcrumb-list li {
            position: relative;
        }

        .breadcrumb-list li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            transition: color 0.3s;
        }

        .breadcrumb-list li a:hover {
            color: #ffeb3b; /* Hover color for links */
        }

        .breadcrumb-list li::after {
            content: '/';
            color: #fff;
            margin-left: 10px;
        }

        .breadcrumb-list li:last-child::after {
            content: ''; /* Remove slash after last item */
        }
    </style>
</head>
<body>
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('themes/ezone/assets/img/bg/slide.png') }});">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="breadcrumb-title">Halaman Keranjang</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li> Halaman Keranjang</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

	<!-- shopping-cart-area start -->
	<div class="cart-main-area pt-95 pb-100">
		<div class="container">
			@if(session()->has('message'))
				<div class="content-header mb-0 pb-0">
					<div class="container-fluid">
						<div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
							<strong>{{ session()->get('message') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div><!-- /.container-fluid -->
				</div>
			@endif
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="cart-heading">Keranjang</h1>
					<form action="">
						<div class="table-content table-responsive">
							<table>
								<thead>
									<tr>
										<th>Hapus</th>
										<th>Gambar</th>
										<th>Produk</th>
										<th>Biaya</th>
										<th>Quantity</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
										@php
											$product = isset($item->model->parent) ? $item->model->parent : $item->model;
											$image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg');
										@endphp
										<tr>
											<td class="product-remove">
												<a href="{{ url('carts/remove/'. $item->rowId)}}" class="delete"><i class="pe-7s-close"></i></a>
											</td>
											<td class="product-thumbnail">
												<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
											</td>
											<td class="product-name"><a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a></td>
											<td class="product-price-cart"><span class="amount">Rp{{ number_format($item->price, 0, ",", ".") }}</span></td>
											<td class="product-quantity">
											<select
												className="form-control"
												id="change-qty"
												data-productId="{{ $item->rowId }}"
                                                value="{{ $item->qty }}"
                                            >
												@foreach(range(1, $item->model->productInventory->qty) as $qty)
													<option {{ $qty == $item->qty ? 'selected' : null }} value="{{ $qty }}">{{ $qty }}</option>
												@endforeach
                                            </select>
											</td>
											<td class="product-subtotal">Rp{{ number_format($item->price * $item->qty, 0, ",", ".")}}</td>
										</tr>
									@empty
										<tr>
											<td colspan="6">Keranjang Belanja kosong!</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<!-- <div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="coupon-all">
									<div class="coupon2">
										<input class="button" name="update_cart" value="Update cart" type="submit">
									</div>
								</div>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-5 ml-auto">
								<div class="cart-page-total">
									<h2>Total Pesanan</h2>
									<ul>
										<li>Total<span>Rp{{ Cart::subtotal(0, ",", ".") }}</span></li>
										<!-- <li>Total<span>Rp{{ Cart::total(0, ",", ".") }}</span></li> -->
									</ul>
									<a href="{{ url('orders/checkout') }}">Pesan Sekarang</a>
								</div>
							</div>
						</div>
                        </form>
				</div>
			</div>
		</div>
	</div>
	<!-- shopping-cart-area end -->
@endsection

@push('script-alt')
<script>
	$(document).on("change", function (e) {
		var qty = e.target.value;
		var productId = e.target.attributes['data-productid'].value;

        $.ajax({
            type: "POST",
            url: "/carts/update",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                productId,
                qty
            },
            success: function (response) {
				location.reload(true);
				Swal.fire({
                        title: "Jumlah Produk",
                        text: "Berhasil di ganti !",
                        icon: "success",
                        confirmButtonText: "Close",
                    });
            },
        });
    });
</script>
@endpush
