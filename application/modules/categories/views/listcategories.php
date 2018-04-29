<div class="inner_content">
	<button type="button" class="btn btn-success pull-right" style="margin-top: 14px;" data-toggle="modal" data-target="#categoryModal" data-backdrop="static" data-keyboard="false">Add Category</button>
		
	<!-- begin modal -->	
	<!-- Modal -->
	<div id="categoryModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add Category</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-danger" id="catadderror" style="display:none;"></div>
		        <form action="" method="post" id="catform">
		        	<div class="col-sm-12"> 
		        		<input class="form-control" id="catname" name="catname" placeholder="Category Name" type="text" style="height:45px;"> 
		        	</div>
		        	<div class="col-sm-12"> 

                        <label class="control-label">Status</label>
	                        <select class="form-control1" id="catstatus" name="catstatus">
	                          
	                          <option value="y">Yes</option>
	                          <option value="n">No</option> 

	                        </select>
		        	</div>
		        	<button type="button" id="savecatbtn" class="btn btn-default">Add</button>
		        	<input type="hidden" id="catid" name="catid" value="">
		        	<input type="hidden" id="isedit" name="isedit" value="0">
		        </form>
		      </div>
	    </div>

	  </div>
	</div>

	<!-- end modal codes -->

	<div class="inner_content_w3_agile_info">

		<!-- showing flash messages after insertion or update of categories -->
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
	                <th>Category Name</th>
	                <th>Active</th>
	                <th>Actions</th>  
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        		if(isset($categories) && !empty($categories)){
	        			foreach($categories as $cat){

	        			  if($cat->status == "y")
	        			  	$status = "Yes";
	        			  else
	        			  	$status = "No";
	        	?>   
	            <tr> 
	                <td><?php echo isset($cat->id) ? $cat->id : ''; ?></td>
	                <td><?php echo isset($cat->cat_name) ? $cat->cat_name : ''; ?></td>
	                <td><?php echo $status; ?></td>

					<td><a data-toggle="modal" href="#categoryModal" data-backdrop="static" data-keyboard="false" class="btn btn-primary editcatbtn" cat-id="<?php echo $cat->id; ?>"> Edit</a>&nbsp;&nbsp;<button type="button" class="btn btn-danger deletecatbtn" cat-id="<?php echo $cat->id; ?>">Delete</button></td> 

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