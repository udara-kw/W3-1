<?php
session_start();

if (!isset($_SESSION['u_id'], $_SESSION['r_id'])) {
  header('location:index.php?lmsg=true');
  exit;
}

if (isset($_GET['tool_id'])) {
  $toolId = $_GET['tool_id'];
}

require_once('../../controller/user/userController.php');
require_once('../../controller/inventory/toolController.php');
require_once('header.php');

$tool = new Tool();
$row = $tool->getSingleToolCategory($toolId);
?>

<h1>Tool Category</h1>
<div class="container">
  <div class="row">
    <div class="col">
      <h2>Update tool category</h2>
    </div>
  </div>
  <form method="post" action="./../../controller/inventory/toolController.php">
    <div class="form-group field">
      <input type="text" id="tName" name="tName" class="form-field" value="<?php echo $row['tool-name'] ?> " required>
      <label for="tName" class="form-label">Name</label>
    </div>
    <div class="form-group field">
      <input type="text" id="tDesc" name="tDesc" class="form-field" value="<?php echo $row['inv-desc'] ?> " required>
      <label for="tDesc" class="form-label">Description</label>
    </div>
    <div class="form-group field">
      <input type="text" id="tMinQty" name="tMinQty" class="form-field" value="<?php echo $row['min-qty'] ?> " required>
      <label for="tMinQty" class="form-label">Minimum Quantity</label>
    </div>
    <div class="form-group field">
      <select class="form-field" id="abc" name="abc">
        <?php if ($row['abc-category'] == 'A') {
          echo "<option value='A' selected>A</option>";
        } else {
          echo "<option value='A'>A</option>";
        }
        if ($row['abc-category'] == 'B') {
          echo "<option value='B' selected>B</option>";
        } else {
          echo "<option value='B'>B</option>";
        }
        if ($row['abc-category'] == 'C') {
          echo "<option value='C' selected>C</option>";
        } else {
          echo "<option value='C'>C</option>";
        } ?>
      </select>
      <label for="abc" class="form-label">ABC Analysis</label>
    </div>
    <div class="right">
      <a href="./inventoryHome.php" class="btn btn-secondary">Cancel</a>
      <input type="hidden" value="<?php echo $row['inv-code'] ?>" name="toolId">
      <input type="submit" class="btn btn-primary" value="Update Tool Category" name="updateToolCategry">
    </div>
  </form>
</div>

<?php
require_once('leftSidebar.php');
require_once('footer.php');
?>