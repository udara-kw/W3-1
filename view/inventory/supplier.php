<?php 
	session_start();
	
	if(!isset($_SESSION['u_id'],$_SESSION['r_id'])){
		header('location:index.php?lmsg=true');
		exit;
	}		
	
  require_once('../../controller/user/userController.php');
  require_once('../../controller/inventory/supplierController.php');
  require_once('header.php');

  $supplier = new Supplier();
  $result = $supplier->getActiveSuppliers();
?>

<h1>Suppliers</h1>
<div class="container">
    <h2>Add new supplier</h2>
    <form method="post" action="./../../controller/inventory/supplierController.php">
      <div class="form-group field">
          <input type="text" id="supName" name="supName" class="form-field">
          <label for="supName" class="form-label">Name</label>
      </div>
      <div class="form-group field">
          <input type="email" id="supMail" name="supMail" class="form-field">
          <label for="supMail" class="form-label">Email</label>
      </div>
      <div class="form-group field">
          <input type="text" id="supMob" name="supMob" class="form-field">
          <label for="supMob" class="form-label">Mobile</label>
      </div>
      <div class="form-group field">
          <input type="text" id="supAddress" name="supAddress" class="form-field">
          <label for="supAddress" class="form-label">Address</label>
      </div>
      <div class="right">
          <input type="submit" class="btn btn-primary" value="Add Supplier" name="addSupplier">
      </div>
    </form>
</div>
<br>
<div class="container">
  <h2>Active Suppliers</h2>
  <div class="row">
		<div class="col">
			<div class="left">
				<span>Show: </span>
				<select name="" id="" class="" width="15px">
					<option value="">10 records</option>
					<option value="">25 records</option>
					<option value="">50 records</option>
					<option value="">100 records</option>
				</select>
			</div>
		</div>
		<div class="col">
			<div class="right">
				<span>Sort By: </span>
				<select name="" id="">
					<option value="">Name</option>
					<option value="">Status</option>
					<option value="">Added Date</option>
				</select>
				<select name="" id="">
					<option value="">ASC</option>
					<option value="">DESC</option>
				</select>
			</div>
		</div>
	</div>
  <br>
  <table>
    <thead>
      <tr>
        <th width="20%">Name</th>
        <th width="20%">Email</th>
        <th width="10%">Telephone</th>
        <th width="25%">Address</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i=0;
        while($row = mysqli_fetch_array($result)) {
      ?>
      <tr>
        <td data-label="Name"><?php echo $row["sup-name"]; ?></td>
        <td data-label="Email"><?php echo $row["sup-email"]; ?></td>
        <td data-label="Telephone"><?php echo $row["sup-mobile"]; ?></td>
        <td data-label="Address"><?php echo $row["sup-address"]; ?></td>
      </tr>
      <?php
          $i++;
        }
        if($i==0){
      ?>
      <tr><td colspan="8"><center>Sorry, No Results to Show!</center></td></tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
  require_once('leftSidebar.php'); 
  require_once('footer.php'); 
?>	