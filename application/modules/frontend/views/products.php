<?php $CI =& get_instance(); $frontend_assets = $CI->config->item('frontend_assets'); $usersessiondata = $CI->session->userdata('loginuserdata'); ?>
<div class="product">
		<div class="container">
			<div class="spec ">
				<h3>Products</h3>
				<div class="ser-t">
					<b></b>
					<span><i></i></span>
					<b class="line"></b>
				</div>
			</div>
				<div class=" con-w3l">
					<?php
						if(isset($productsbycategory) && !empty($productsbycategory)){
							foreach ($productsbycategory as $pcat) {	
							
					?>	
					<div class="col-md-3 pro-1 singleProdImgDetail" prod-id="<?php echo $pcat->id; ?>">
						<div class="col-m">
						<a href="#" data-toggle="modal" data-target="#productDetailModal" class="offer-img">
								<img src="<?php echo '../'. UPLOAD_PRODUCTS_IMAGE_URL.'/'.$pcat->image; ?>" class="img-responsive" alt="">
							</a>
							<div class="mid-1">
								<div class="women">
									<h6><a href="single.html"><?php echo $pcat->name; ?></a></h6>							
								</div>
								<div class="mid-2">
									<p ><em class="item_price">Rs. <?php echo $pcat->price; ?></em></p><br>
									<p><em class="item_price">Stock: <?php echo $pcat->stock; ?></em></p>
									  <div class="block">
										<div class="starbox small ghosting"> </div>
									</div>
									<div class="clearfix"></div>
								</div>
									<!-- <div class="add add-2">
																	   <button class="btn btn-danger my-cart-btn my-cart-b" data-id="1" data-name="product 1" data-summary="summary 1" data-price="6.00" data-quantity="1" data-image="images/of16.png">Add to Cart</button>
																	</div> -->
							</div>
						</div>
					</div>

					<?php
							}
						}
					?>

					<div class="clearfix"></div>
				</div>
		</div>
	</div>

	<!-- product modal-->
	<div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-info">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<div class="modal-body modal-spa">
						<div class="col-md-5 span-2">
									<div class="item">
										<img src="" alt="Product Image" class="img-responsive">
									</div>
						</div>
						<div class="col-md-7 span-1 ">
							<h3></h3>
							<div class="price_single">
							  <!-- <span class="reducedfrom ">$0.80</span> -->
								Rs.&nbsp;<span class="reducedfrom"></span>
							 <div class="clearfix"></div>
							</div>
							<h4 class="quick">Quick Overview:</h4>
							<p class="quick_desc"> Product Short description</p>
							 <div class="add-to">
								   <!-- <button class="btn btn-danger my-cart-btn my-cart-btn1 " data-id="17" data-name="Moisturiser" data-summary="summary 17" data-price="0.80" data-quantity="1" data-image="images/of16.png">Add to Cart</button> -->


								   <form action="" method="post">
									<button id="addedCartProduct" data-prodid="" data-prodname="" data-prodprice="" data-prodquantity="1" class="btn btn-danger my-cart-btn my-cart-b" type="submit">Add to Cart</button>
								</form>	
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	<!-- end product modal-->