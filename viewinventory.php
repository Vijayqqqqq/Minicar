
<?php 
include('Carmodel.php');

include('header.php');
$model = new Carmodel();
$data = $model->getAllModels();
define("HOST_ROOT", "http://".$_SERVER['HTTP_HOST']."/");
define("IMAGE_UPLOADS", HOST_ROOT."minicar/uploads/");

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <a href="addmanufacturer.php">Add Manufacturer</a> | <a href="addeditmodel.php">Add Model</a> 
<table id="table_id" class="display" ">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Manufacturer Name</th>
            <th>Model Name</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
    	<?php
    	$i = 1;
    	 foreach ($data as $key => $value) { ?>
        <tr data-target="#myModal<?php echo $i; ?>" data-toggle="modal">
            <td><?php echo $i; ?></td>
            <td><?php echo $value['name'];?></td>
            <td><?php echo $value['model_name'];?></td>
            <td><?php echo $value['quantity'];?></td>
        </tr>
        <?php  $i++; } ?>
    </tbody>
</table>

<?php
$j = 1;
foreach ($data as $key => $value) { ?>
<div id="myModal<?php echo $j; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="carousel-inner">
            <div class="item active">
              <?php if(!empty($value['picture1'])){?>
              <img src="<?php echo IMAGE_UPLOADS.$value['picture1'];?>" id="imagepreview" style="width: 400px; height: 264px;" >
               <?php } ?> 
            </div>
            <div class="item">
              <?php if(!empty($value['picture2'])){?>
              <img src="<?php echo IMAGE_UPLOADS.$value['picture2'];?>" id="imagepreview" style="width: 400px; height: 264px;" >
                <?php } ?>
            </div>
          </div>

          <div>
            Color : <?php echo $value['color'];?>    
          </div>


          <div>
            Manufacturing Year: <?php echo $value['manufacture_year'];?>    
          </div>

          <div>
              <button type="button" id="delete_model" data-id="<?php echo $value['id']; ?>">Sold</button>
          </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php $j++; } ?>



<?php 
include('footer.php');

?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>