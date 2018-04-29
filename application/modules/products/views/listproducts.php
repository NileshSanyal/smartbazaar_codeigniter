<div class="inner_content">
	<button type="button" class="btn btn-success pull-right" style="margin-top: 14px;" data-toggle="modal" data-target="#productModal" data-backdrop="static" data-keyboard="false">Add Product</button>
		
	<!-- begin modal -->	
	<!-- Modal -->
	<div id="productModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add Product</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-danger" id="productadderror" style="display:none;"></div>
		        <form action="" method="post" enctype="multipart/form-data" id="productform">
		        	<div class="col-sm-12"> 
		        		<input class="form-control" id="productname" name="productname" placeholder="Product Name" type="text" style="height:45px;"> 
		        	</div>

		        	<div class="col-sm-12">
					  <label for="productcategory">Category:</label>
					  <select class="form-control" id="productcategory" style="height:50px;" name="productcategory">

					  	<?php
					  		if( isset($categorynames) && !empty($categorynames)){
					  			foreach ($categorynames as $catnames) {
					  				
					  			
					  	?>

					    <option value="<?php echo $catnames->id; ?>"><?php echo $catnames->cat_name; ?></option>

					    <?php
					    		}
					  		}

					    ?>

					  </select>
					</div>

					<div class="col-sm-12"> 
						<label for="productprice">Price:</label>
		        		<input class="form-control" id="productprice" name="productprice" placeholder="Product Price" type="text" style="height:45px;"> 
		        	</div>

		        	<div class="col-sm-12"> 
		        		<label for="productdesc">Description:</label>
		        		<textarea class="form-control" id="productdesc" name="productdesc" placeholder="Product Description" style="height:45px;"></textarea> 
		        	</div>  
					
					<!-- product image upload with preview will be here -->
					<div class="row">
						<div class="col-sm-6"> 
			        		<label for="productimage">Choose Product Image:</label>
			        		<input type="file" class="form-control" id="productimage" name="productimage" style="height:50px;" />
			        		
			        	</div>  

			        	<div class="col-sm-6"> 
			        		<div id="productimgpreview">Image Preview Shown Here</div>
			        	</div>  

		        	</div>	


		        	<div class="col-sm-12"> 
		        		<label for="productstock">Items In Stock:</label>
		        		<input class="form-control" id="productstock" name="productstock" placeholder="Product Stock" type="text" style="height:45px;"> 
		        	</div>

		        	
		        	<div class="col-sm-12"> 

                        <label class="control-label">Status</label>
	                        <select class="form-control1" id="productstatus" name="productstatus">
	                          
	                          <option value="y">Yes</option>
	                          <option value="n">No</option> 

	                        </select>
		        	</div>
		        	<button type="button" id="saveproductbtn" class="btn btn-default">Add</button>
		        	<input type="hidden" id="productid" name="productid" value="">
		        	<input type="hidden" id="isedit" name="isedit" value="0">
		        </form>
		      </div>
	    </div>

	  </div>
	</div>

	<!-- end modal codes -->

	<div class="inner_content_w3_agile_info">

		<!-- showing flash messages after insertion or update of products -->
		<?php if($this->session->flashdata('success')){ ?>
	    <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;"> 
	    	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $this->session->flashdata('success'); ?> 
	    </div>
	    <?php }else if($this->session->flashdata('error')){?>
	    <div class="alert alert-danger fade in alert-dismissable"> 
	    	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $this->session->flashdata('error'); ?> 
	    </div>
	    <?php }?>
		<!-- end -->

		<!-- begin categories list datatable -->
		<table id="categories_tbl" class="cell-border" cellspacing="0" width="100%">
			<thead>
	            <tr>
	                <th>Id</th>
	                <th>Product Name</th>
	                <th>Price</th>
	                <th>Description</th>
	                <th>Image</th>
	                <th>Items In Stock</th>
	                <th>Active</th>
	                <th>Actions</th>  
	            </tr>
	        </thead>
	        <tbody>  
	        	<?php
	        		if(isset($products) && !empty($products)){
	        			foreach($products as $prod){
	        	?>
	            <tr> 
	                <td><?php echo $prod->id; ?></td>
	                <td><?php echo $prod->name; ?></td>
	                <td>Rs.<?php echo $prod->price; ?></td>
	                <td><?php echo word_limiter($prod->description, 20); ?></td>
	                <td><img src="<?php echo UPLOAD_PRODUCTS_IMAGE_URL . '/' . $prod->image; ?>" /> </td>
	                <td><?php echo $prod->stock; ?></td>
	                <td><?php echo ($prod->status == 'y') ? 'Yes' : 'No'; ?></td>

					<td><a data-toggle="modal" href="#productModal" data-backdrop="static" data-keyboard="false" class="btn btn-primary editproductbtn" prod-id="<?php echo $prod->id; ?>"> Edit</a>&nbsp;&nbsp;<button type="button" class="btn btn-danger deleteproductbtn" prod-id="<?php echo $prod->id; ?>">Delete</button></td> 

	            </tr>

	            <?php
	            		}
	        		}
	            ?>
	          
	        </tbody>
	    </table>     
		<!-- end categories list datatable -->

	</div>
	
</div>		