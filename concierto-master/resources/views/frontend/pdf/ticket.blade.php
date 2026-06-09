<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;700&display=swap"
			rel="stylesheet"
		/>
		<title>Ticket</title>
	</head>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		html {
			font-family: 'Assistant', sans-serif;
			font-size: 14px;
		}
		table,
		.container {
			width: 100%;
		}
		.contenido {
			padding: 10px;
		}
		.container {
			border: 10px solid #c2bfbe;
		}
		.header, .header td  {
			height: 100px;
			background-color: #0c3943;
		}
		.header td {
			text-align: center;
		}
		.header img {
			height: 70px;
			width: 500px;
			object-fit: contain;
			margin: 0 auto;
			padding: 10px;
			margin-left: 120px
		}
		.body {
			margin-top: 10px;
		}
		.body td {
			padding: 10px;
			
		}
		.body figure {
			float: left;
			margin-right: 20px;
		}
		.body .logo img {
			width: 100px;
			height: 100px;
			object-fit: contain;
		}
		.font-green {
			color: #0c3943;
		}
		.font-gray {
			color: #888888;
		}
		.price .child-1 {
			padding: 0px;
			width: 70%;
		}
		.price .child-2 {
			padding: 0px;
			width: 30%;
			text-align: center;
		}
		.price .child-2 div{
			background-color: #c2bfbe;
			padding: 20px;
			border-radius: 10px;
		}
		.price .child-2 div .font-green-big {
			font-size: 30px;
		}
		.price td {
			border: 0px;
		}
		.font-green-big {
			font-size: 24px;
			font-weight: bold;
			color: #0c3943;
		}
		.td-right {
			text-align: center;
		}
		.td-right figure {
			float: none;
			margin: 0px;
			padding-left: 0px
		}
		.td-right .barras img {
			height: 80px;
			widows: 100px;
			object-fit: contain;
			padding-left: 0px;
			margin-left: 0px;
			margin-right: 120px;
			float: none !important;
		}
		.td-right .text {
			text-align: center;
			font-size: 12px;
			text-align: left;
		}
		.td-right .text p{
			text-align: center;
		}
		.td-right .text p:first-child {
			margin: 5px 0px;
		}
	</style>
	<body>

		@foreach ($request->massive_sale as $item)
			@php
				$seat_sold = DB::select('select * from seat_sold where seat_number = ?',[$item]);
				$seat = DB::select('select * from seats where id = ?', [$item]);
				$buyer = DB::select('select * from buyer where id = ?', [$seat_sold[0]->buyer_id]);
			@endphp
			<div class="container">
				<div class="contenido">
					<table class="header">
						<tr>
							<td>
								<img src=" ../../../public/assets/images/logo 4.0.png " alt="" />
							</td>
						</tr>
					</table>
					<table class="body">
						<tr>
							<td class="td-left1" style="width: 70%; border: 1px solid #c2bfbe ">
								<figure class="logo">
									<img src="https://www.mrpct.org/images/logo.svg" alt="" />
								</figure>
								<p class="font-green">Friday, December 3rd, 2021. Entrance: 6 PM</p>
								<p class="font-green">Viernes 3 de Diciembre, 2021. Entrada: 6 PM</p>
								<p class="font-gray">Address:</p>
								<p class="font-green">494 New Britain Avenue, Hartford, CT 06106</p>
							</td>
							<td class="td-right" rowspan="2" style="border: 1px solid #c2bfbe; width: 30%">
								<figure class="barras">
									{!! DNS1D::getBarcodeHTML($seat_sold[0]->id, 'CODABAR') !!}
								</figure>
								<br>
								<div class="text">
									<p class="font-green">
										Para más información comunícate al correo: planning@mrpct.org
									</p>
									<p class="font-green">For more information contact us: planning@mrpct.org</p>
								</div>
							</td>
						</tr>
						<tr>
							<td class="td-left2" style="border: 1px solid #c2bfbe; ">
								<p class="font-gray">Location - Chair:</p>
								<table class="price">
									<tr>
										<td class=" child-1 font-green-big" style="border: 0px">
											Location: {{$seat[0]->location}} - Seat: {{$seat[0]->seat_number}} Ticket No: {{$seat_sold[0]->id}}
										</td>
										<td class=" child-2" style="border-radius: 20px"><div class="font-green-big">@money($seat[0]->price*100,'USD')</div></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
		@endforeach
	</body>
</html>
