<div class="purchase-default-index">

<?php foreach($model->purchaseorderlines AS $record): ?>	
<div class="paper" style="background-color: #ffffff;">
	<hr>
	<h1>Purchase Order</h1>
	
	<div class="row">
		<div class="col-md-6">
			<blockquote>
				<h4>Supplier</h4>
				<p>
					<?= $record->supplier->organisationName; ?><br>
					<?= $record->supplier->addresses[0]->addressLine; ?><br>
				</p>
			</blockquote>
		</div>
		<div class="col-md-6">
			<blockquote>
				<h4>Requester</h4>
				<p>
					<?= $model->contact->contactName; ?>
				</p>
			</blockquote>
		</div>
	</div>
	<h2>Order</h2>
	<div class="row">
		<div class="col-md-1"><div class="pull-right"><?= $record->order_amount; ?></div></div>
		<div class="col-md-5"><?= $record->article; ?><br></div>		
		<div class="col-md-3"><div class="pull-right"><?= $record->order_price; ?></div></div>
		<div class="col-md-3"><?= $record->order_currency; ?></div>
	</div>
</div>
<?php endforeach; ?>

</div>
