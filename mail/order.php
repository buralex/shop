	<div class="table-responsive">
		<table class="table table-hover table-striped" style="width: 100%; border: 1px solid; border-collapse: collapse;">
			<thead>
			<tr style="background: #f9f9f9;">
				<th style="border: 1px solid; padding: 8px;">Name</th>
				<th style="border: 1px solid; padding: 8px;">Quantity</th>
				<th style="border: 1px solid; padding: 8px;">Price</th>
				<th style="border: 1px solid; padding: 8px;">Sum</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($session['cart'] as $id => $item): ?>
				<tr>
					<td style="border: 1px solid; padding: 8px;"><?= $item['name'] ?></td>
					<td style="border: 1px solid; padding: 8px;"><?= $item['qty'] ?></td>
					<td style="border: 1px solid; padding: 8px;"><?= $item['price'] ?></td>
                    <td style="border: 1px solid; padding: 8px;"><?= $item['price'] * $item['qty'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="" style="border: 1px solid; padding: 8px;">Total quantity: </td>
				<td style="border: 1px solid; padding: 8px;"><?= $session['cart.qty'] ?></td>
				<td style="border: 1px solid; padding: 8px;"></td>
				<td style="border: 1px solid; padding: 8px;"></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid; padding: 8px;">Total sum: </td>
				<td style="border: 1px solid; padding: 8px;"><?= $session['cart.sum'] ?></td>
			</tr>
			</tbody>
		</table>
	</div>