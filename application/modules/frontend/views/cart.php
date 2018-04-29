<?php
	$CI =& get_instance(); 
	$frontend_assets = $CI->config->item('frontend_assets'); 
?>
<div class="container" style="padding: 20px;">
	<?php echo form_open('updatecart'); ?>

	<table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table table-hover table-responsive" id="cartTbl">

	<tr>
	  <th>Item Description</th>
	  <th>QTY</th>
	  
	  <th style="text-align:right">Item Price</th>
	  <th style="text-align:right">Sub-Total</th>
	</tr>

	<?php
		if(empty($this->cart->contents())){


	?>

	<span class="text-center">Your Shopping Cart is empty</span>
	
	<?php } ?>

	<?php $i = 1; ?>

	<?php foreach ($this->cart->contents() as $items){ ?>
		
		<input type="hidden" name="pro_ids[]" id="productId" value="<?php echo $items['id']; ?>">

		<input type="hidden" name="rowid[]" value="<?php echo $items['rowid']; ?>" class="rowid_<?php echo $i;?>">

		<tr>
		  <td>
			<?php echo $items['name']; ?>
		  	
		  	<input type="hidden" name="pro_name[]" id="productName" value="<?php echo $items['name']; ?>">

   		<td>
   			<input type="text" name="quantity[]" value="<?php echo $items['qty']; ?>" size="5" id="productQty">
   		</td>

		<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

			<p>
				<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

					<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

				<?php endforeach; ?>
			</p>

		<?php endif; ?>

		  </td>
		  <td style="text-align:right">Rs.<?php echo $this->cart->format_number($items['price']); ?></td>
		  <input type="hidden" name="pro_price[]" id="productPrice" value="<?php echo $items['price']; ?>">
		  <td style="text-align:right">Rs.<?php echo $this->cart->format_number($items['subtotal']); ?></td>
		  <input type="hidden" name="subtotal_price[]" id="productSubtotalPrice" value="<?php echo $this->cart->format_number($items['subtotal']); ?>">	
		  <td>
		  	<a class="cancel" href="javascript:void(0);" id="<?php echo $i; ?>"><i class="fa fa-times"></i></a>
		  </td>
		</tr>

	<?php $i++; ?>

	<?php } ?>

	<tr>
	  <td colspan="2"> </td>
	  <td class="right"><strong>Total</strong></td>
	  <td class="right">Rs.<?php echo $this->cart->format_number($this->cart->total()); ?>
	  <input type="hidden" name="productTotalPrice" id="productTotalPrice" value="<?php echo $this->cart->format_number($this->cart->total()); ?>">	
	  </td>
	</tr>

	</table>

	<p>
		<?php echo form_submit('', 'Update your Cart',"class='btn btn-info update'"); ?>
		<?php echo form_button('', 'Checkout',"class='btn btn-success checkoutBtn'"); ?>	
	</p>

	<div id="loader">
		<img src="<?php echo $frontend_assets; ?>images/ajax_loader.gif" style="display:none;margin-top:-59px;margin-left: 276px;" />
	</div>
	
</div>