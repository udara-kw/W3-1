<?php 
  session_start();
  require_once('./../../controller/user/userController.php'); 
  require_once('./header.php');
  require_once('./../../controller/contract/quotationController.php');
  require_once('./search.php');
  $quo = new Quotation();
  $result = $quo->getAllQuotation();
  
  if (isset($_GET['quo_con_id'])) {
    $a = $_GET['quo_con_id'];
  }

  if(isset($_POST['quotationAdd'])){
    $item_no = $_POST['q_itemno'];
    $name = $POST['q_name'];
    $description = $POST['q_desc'];
    $quantity = $POST['q_quantity'];
    $discount = $POST['q_discount'];

    $validateQuotation = addQuotation($item_no,$name,$description,$quantity,$discount);
  }
?>

<div class="container"> 
  <h1>Add New Quotation</h1>  
  <!-- searching -->
  
  <!-- Form Starts -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div class="form-group field">
      <input type="text" class="form-field" id="q_itemno" name="q_itemno" autocomplete="off">
      <label for="q_itemno" class="form-label">Furniture Item Code</label>
      <small id="" class="form-text text-muted">select the furniture item model</small>
      <div id="output"></div>
      <h6>If you haven't a furniture item code. Add a new item here</h6>
      <!-- Add new Item to Quotation -->
      <a class="btn btn-warning" onclick="document.getElementById('id01').style.display='block'">Add new Item</a>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" id="q_name" name="q_name">
      <label for="q_name" class="form-label">Quotation Name</label>
      <small id="" class="form-text text-muted">Provide a suitable quotation name </small>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" name="q_desc" id="q_desc">  
      <label for="q_desc" class="form-label">Quotation Description</label>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" id="q_quantity" name="q_quantity">
      <label for="q_budget" class="form-label">Quantity</label>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" id="q_discount" name="q_discount">
      <label for="q_discount" class="form-label">Discount</label>
    </div>
    <div class="right">
      <button type="submit" class="btn btn-primary" name ="quotationAdd">Add Quotation</button>
    </div>
  </form>
  <!-- Form Ends -->
</div> 
<script type="text/javascript">
    $(document).ready(function(){
       $("#q_itemno").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: './search.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $('#output').html(data);
                $('#output').css('display', 'block');
 
                $("#q_itemno").focusout(function(){
                    $('#output').css('display', 'none');
                });
                $("#q_itemno").focusin(function(){
                    $('#output').css('display', 'block');
                });
              }
            });
          } else {
          $('#output').css('display', 'none');
        }
      });
    });
  </script>   
<!-- Prompt Box -->
<div id="id01" class="confirm-box">
      <div class="right" style="margin-right:25px;">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <h1>Add new Item</h1>
        <div class="form-group field">
          <input type="text" class="form-field" id="item_id" name="item_id">
          <label for="q_name" class="form-label" placeholder="I0001">Item ID</label>
          <small id="" class="form-text text-muted">Provide a suitable item name</small>
        </div>
        <div class="form-group field">
          <input type="text" class="form-field" id="item_name" name="item_name">
          <label for="q_budget" class="form-label">Item Name</label>
        </div>
        <div class="form-group field">
          <input type="text" class="form-field" name="unit_price" id="unit_price">  
          <label for="unit_price" class="form-label">Unit Price</label>
        </div>
        <div class="form-group field">
          <input type="file" class="form-field" id="q_discount" name="q_discount">
          <label for="q_budget" class="form-label">Image</label>
        </div>
        
        <div class="clearfix right">
          <button type="button" class="btn btn-secondary" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
          <button type="submit" name="delete_con" class="btn btn-primary">Add Item</button>
        </div>
      </form>
    </div>
    <!-- End Prompt Box -->
    
<?php
  require_once('leftSidebar.php'); 
  require_once('footer.php'); 
?>	