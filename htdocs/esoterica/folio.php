<?php 
session_start();
include 'config/setup_idiorm.php';
$user = ORM::for_table('users')->where('user_id','1')->find_one();
$record = ORM::for_table('records')->where('folio',$_REQUEST['id'])->find_one();
$total = ORM::for_table('records')->where('folio', $_REQUEST['id'])->sum('pfs');
$records = ORM::for_table('records')->where('folio',$_REQUEST['id'])->find_many();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Nota/Factura</title>
		<link rel="stylesheet" href="css/html5invoice.css">
	</head>
	<body>
		<header>
			<!--<h1>Invoice</h1>-->
			<address contenteditable>
				
			<!-- this is the logo of the company
			<span><img alt="" src="img/nodejs-light.png"></span>
			-->
				<p>
				<p><?php echo $user->name; ?></p>
				<p><?php echo $user->street_name. " ".$user->house_number; ?></p>
				<p><?php echo $user->address_zipcode. " ".$user->address_county. " " .$user->address_state; ?></p>
				<p><?php echo "tel ". $user->phone;?>
				<p><?php echo "rfc ". $user->rfc;?>
			</address>
			<!--This is another image
			<span><img alt="" src="logo.png"><input type="file" accept="image/*"></span>
			-->
		</header>
		<article>
			<h1>Cliente</h1>
			<address contenteditable>
				<p><?php echo $_SESSION['client_name']; ?></p>
				<p><?php echo $_SESSION['client_address']. " ".$_SESSION['client_city']; ?></p>
				<p><?php echo $_SESSION['client_zipcode']; ?></p>
				<p><?php echo $_SESSION['client_rfc']; ?></p>
			</address>
			<table class="meta">
				<tr>
					<th><span contenteditable>folio #</span></th>
					<td><span contenteditable><?php echo $record->folio; ?></span></td>
				</tr>
				<tr>
					<th><span contenteditable>fecha de expedicion</span></th>
					<td><span contenteditable><?php echo $record->date; ?></span></td>
				</tr>
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span id="prefix" contenteditable>$</span><span><?php echo $total;?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Concepto</span></th>
						<th><span contenteditable>Precio Unitario</span></th>
						<th><span contenteditable>Cantidad</span></th>
						<th><span contenteditable>Importe</span></th>

					</tr>
				</thead>
				<tbody>
					
					<?php foreach ($records as $record) {
								echo '<tr>';
    							echo '<td><span contenteditable>'.$record->product.'</span></td>';
    							echo '<td><span contenteditable>'.$record->pfs.'</span></td>';
    							echo '<td><span contenteditable>'.$record->quantity.'</span></td>';
    							echo '<td><span contenteditable>$ '.$record->quantity * $record->pfs.'</span></td>';
								echo '</tr>';
								}
					?>


				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
				<tr>
					<th><span contenteditable>SubTotal</span></th>
					<td><span data-prefix>$</span><span><?php echo $total;?></span></td>
				</tr>
				<tr>
					<th><span contenteditable>I.V.A</span></th>
					<td><span data-prefix>$</span><span contenteditable>0.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span data-prefix>$</span><span><?php echo $total;?></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span contenteditable></span></h1>
			<div contenteditable>
				<p>“Efectos fiscales al pago” de conformidad con lo señalado en la fracción III del Art.133 de la Ley del Impuesto sobre la Renta.</p>
			</div>
		</aside>
	</body>
</html>