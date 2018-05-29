



<?php 
include('header.php');
include('Manufacturer.php');

$manufacturer = new Manufacturer();
$data = $manufacturer->getAllManufacturer();
?>



<div class="wrapper">
	<form id="model_form">
		 <div class="form-group">
			<label for="name">Manufacturer Name:</label>
			<select name="manufacturer">
				<option value="">Select Manufaturer</option>
				<?php if(!empty($data))
				{ foreach ($data as $key => $value) {
					?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['name']?></option>
				<?php } }?>
			</select>
		</div>

		 <div class="form-group">
			<label for="name">Model Name:</label>
			<input type="text" name="modelName" id="modelName" class="form-control"><span id="modelNameError" style="display: none; color:red;">* Please Enter Model Name.</span>
		</div>

		 <div class="form-group">
			<label for="name">Color:</label>
			<input type="text" name="color" id="color" class="form-control"><span id="colorError" style="display: none; color:red;">* Please Enter Model color.</span>
		</div>

		<div class="form-group">
			<label for="name">Quantity:</label>
			<input type="text" name="qty" id="qty" class="form-control"><span id="qtyError" style="display: none; color:red;">* Please Enter Model quantity.</span>
		</div>

		 <div class="form-group">
			<label for="name">Manufacturing year:</label>
			<input type="text" name="year" id="year" class="form-control"><span id="yearError" style="display: none; color:red;">* Please Enter year of manufacture.</span>
		</div>


		 <div class="form-group">
			<label for="name">Car Photo:</label>
			<input type="file" name="pic1" id="pic1" class="form-control">

		</div>

		 <div class="form-group">
			<label for="name">Car Photo2:</label>
			<input type="file" name="pic2" id="pic2" class="form-control">

		</div>
	

		 <div class="form-group">
			<label for="name">Registration Number:</label>
			<input type="text" name="regnum" id="regnum" class="form-control"><span id="regError" style="display: none; color:red;">* Please Enter Registration Number.</span>
		</div>

		 <div class="form-group">
			<label for="name">Description:</label>
			<input type="textarea" name="description" id="description" class="form-control">
		</div>
		<input type="hidden" name="addmodel">

		<button type="button" id="submit_model">Submit</button>
	</form>
</div>
<br><br>
<span id="ajaxerror" style="display: none; color:green;">Data Submitted Successfully.</span>

<?php 
include('footer.php');

?>



