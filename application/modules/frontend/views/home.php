<?php $CI =& get_instance(); $frontend_assets = $CI->config->item('frontend_assets'); $usersessiondata = $CI->session->userdata('loginuserdata'); ?>
<!--content-->
<div class="content-mid">
	<div class="container">
		
		<div class="col-md-4 m-w3ls">
			<div class="col-md1 ">
				<a href="javascript:void(0);">
					<img src="<?php echo $frontend_assets; ?>images/co1.jpg" class="img-responsive img" alt="">
					<div class="big-sa">
						<h6>New Collections</h6>
						<h3>Season<span>ing </span></h3>
						<p>There are many variations of passages of Lorem Ipsum available, but the majority </p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="javascript:void(0);">
					<img src="<?php echo $frontend_assets; ?>images/co.jpg" class="img-responsive img" alt="">
					<div class="big-sale">
						<div class="big-sale1">
							<h3>Big <span>Sale</span></h3>
							<p>It is a long established fact that a reader </p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-4 m-w3ls">
			<div class="col-md2 ">
				<a href="javascript:void(0);">
					<img src="<?php echo $frontend_assets; ?>images/co2.jpg" class="img-responsive img1" alt="">
					<div class="big-sale2">
						<h3>Cooking <span>Oil</span></h3>
						<p>It is a long established fact that a reader </p>		
					</div>
				</a>
			</div>
			<div class="col-md3 ">
				<a href="javascript:void(0);">
					<img src="<?php echo $frontend_assets; ?>images/co3.jpg" class="img-responsive img1" alt="">
					<div class="big-sale3">
						<h3>Vegeta<span>bles</span></h3>
						<p>It is a long established fact that a reader </p>
					</div>
				</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--content-->
  <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
         <a href="javascript:void(0);"> <img class="first-slide" src="<?php echo $frontend_assets; ?>images/ba.jpg" alt="First slide"></a>
       
        </div>
        <div class="item">
         <a href="javascript:void(0);"> <img class="second-slide " src="<?php echo $frontend_assets; ?>images/ba1.jpg" alt="Second slide"></a>
         
        </div>
        <div class="item">
          <a href="javascript:void(0);"><img class="third-slide " src="<?php echo $frontend_assets; ?>images/ba2.jpg" alt="Third slide"></a>
          
        </div>
      </div>
    
    </div><!-- /.carousel -->

<!--content-->
	<div class="product">
		<div class="container">
			<div class="spec ">
				<h3>Special Offers</h3>
				<div class="ser-t">
					<b></b>
					<span><i></i></span>
					<b class="line"></b>
				</div>
			</div>
				<div class=" con-w3l">
					<?php
						if(isset($specialproducts) && !empty($specialproducts)){
							foreach ($specialproducts as $sprod) {	
							
					?>	
					<div class="col-md-3 pro-1 prodImgDetail" prod-id="<?php echo $sprod->id; ?>">
						<div class="col-m">
						<a href="#" data-toggle="modal" data-target="#productDetailModal" class="offer-img">
								<img src="<?php echo UPLOAD_PRODUCTS_IMAGE_URL.'/'.$sprod->image; ?>" class="img-responsive" alt="">
							</a>
							<div class="mid-1">
								<div class="women">
									<h6><a href="javascript:void(0);"><?php echo $sprod->name; ?></a></h6>							
								</div>
								<div class="mid-2">
									<p ><em class="item_price">Rs. <?php echo $sprod->price; ?></em></p><br>
									<p><em class="item_price">Stock: <?php echo $sprod->stock; ?></em></p>
									  <div class="block">
										<div class="starbox small ghosting"> </div>
									</div>
									<div class="clearfix"></div>
								</div>
									<div class="add add-2">
								   <!-- <button class="btn btn-danger my-cart-btn my-cart-b" data-id="1" data-name="product 1" data-summary="summary 1" data-price="6.00" data-quantity="1" data-image="images/of16.png">Add to Cart</button> -->
								<!-- <form action="<?php echo base_url('addtocart'); ?>" method="post">
									<input type="hidden" name="id" id="prodId" value="<?php echo $sprod->id; ?>" />
									<input type="hidden" name="qty" id="prodQty" value="1" />
									<input type="hidden" name="name" id="prodName" value="<?php echo $sprod->name; ?>">
									<input type="hidden" name="price" id="prodPrice" value="<?php echo $sprod->price; ?>">	
								
									<img id="loader" src="<?php echo $frontend_assets; ?>images/loader.gif" style="display:none;margin-top: 224px;margin-left: 83px;" height="60" width="60" class="img-head" alt="">
								
									<button id="addToCartBtn" class="btn btn-danger my-cart-btn my-cart-b" type="submit">Add to Cart</button>
								</form>	 -->
								</div>
							</div>
						</div>
					</div>

					<?php
							}
						}
					?>

					<?php //echo $this->pagination->create_links(); ?>

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
								<form action="<?php echo base_url('addtocart'); ?>" method="post">
									<button id="addToCartBtn" data-id="" data-name="" data-price="" data-quantity="1" class="btn btn-danger my-cart-btn my-cart-b" type="submit">Add to Cart</button>
								</form>	
							</div>

						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	<!-- end product modal-->