@extends('frontend.layout')

@section('content')
	<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('themes/ezone/assets/img/bg/breadcrumb.jpg') }})">
		<div class="container-fluid">
			<div class="breadcrumb-content text-center">
				<h2>My Order</h2>
				<ul>
					<li><a href="{{ url('/') }}">home</a></li>
					<li>my order</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="shop-page-wrapper shop-page-padding ptb-100">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					@include('frontend.partials.user_menu')
				</div>
				<div class="col-lg-9">
					<div class="d-flex justify-content-between">
						<h2 class="text-dark font-weight-medium">Order ID #{{ $order->code }}</h2>
					</div>
					<div class="row pt-5">
						<div class="col-xl-4 col-lg-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Alamat Tagihan</p>
							<address>
								{{ $order->customer_first_name }} {{ $order->customer_last_name }}
								<br> {{ $order->customer_address1 }}
								<br> {{ $order->customer_address2 }}
								<br> Email: {{ $order->customer_email }}
								<br> Telepon: {{ $order->customer_phone }}
								<br> Kode Pos: {{ $order->customer_postcode }}
							</address>
						</div>
						@if ($order->shipment)
							<div class="col-xl-4 col-lg-4">
								<p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Alamat Pengirim</p>
								<address>
									{{ $order->shipment->first_name }} {{ $order->shipment->last_name }}
									<br> {{ $order->shipment->address1 }}
									<br> {{ $order->shipment->address2 }}
									<br> Email: {{ $order->shipment->email }}
									<br> Telepon: {{ $order->shipment->phone }}
									<br> kode Pos: {{ $order->shipment->postcode }}
								</address>
							</div>
						@endif
						<div class="col-xl-4 col-lg-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Detail</p>
							<address>
								ID: <span class="text-dark">#{{ $order->code }}</span>
								<br> {{ date('d M Y', strtotime($order->order_date)) }}
								<br> Status: {{ $order->status }} {{ $order->isCancelled() ? '('. date('d M Y', strtotime($order->cancelled_at)) .')' : null}}
								@if ($order->isCancelled())
									<br>Catatan Pembatalan : {{ $order->cancellation_note}}
								@endif
								<br> Status Pembayaran: {{ $order->payment_status }}
								<br> Dikirim oleh: {{ $order->shipping_service_name }}
							</address>
						</div>
					</div>
					<div class="table-content table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Item</th>
									<th>Deskripsi</th>
									<th>Quantity</th>
									<th>Biaya</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@php
									function showAttributes($jsonAttributes)
									{
										$jsonAttr = (string) $jsonAttributes;
										$attributes = json_decode($jsonAttr, true);
										$showAttributes = '';
										if ($attributes) {
											$showAttributes .= '<ul class="item-attributes">';
											foreach ($attributes as $key => $attribute) {
												if(count($attribute) != 0){
													foreach($attribute as $value => $attr){
														$showAttributes .= '<li>'.$value . ': <span>' . $attr . '</span><li>';
													}
												}else {
													$showAttributes .= '<li><span> - </span></li>';
												}
											}
											$showAttributes .= '</ul>';
										}
										return $showAttributes;
									}
								@endphp
								@forelse ($order->orderItems as $item)
									<tr>
										<td>{{ $item->sku }}</td>
										<td>{{ $item->name }}</td>
										<td>{!! showAttributes($item->attributes) !!}</td>
										<td>{{ $item->qty }}</td>
										<td>{{ number_format($item->base_price, 0, ",", ".") }}</td>
										<td>{{ number_format($item->sub_total, 0, ",", ".") }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="6">Barang pesanan tidak ditemukan!</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
