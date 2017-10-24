<meta charset="UTF-8">
<script src="../bower_components/jquery/dist/jquery.js"></script>
<script src="../bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<link href="../bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="https://www.w3schools.com/lib/w3.js"></script>
<!--script src="js/product-validation.js"></script-->
  <div class="container" style="margin-top:20px;">
    <div id="editform" class="panel panel-default col-md-6 col-md-offset-3" w3-include-html="forms/editProductForm.html" style="display:none"></div>
    <form action="" name="productform">
      <label for="name">Name:</label><input type="text" name="name" id="name" value="" placeholder="pet socks" /><BR/>
      <label for="description">Description:</label><input type="text" name="description" id="description" value="" placeholder="cute and soft" /><BR/>
      <label for="price">Price:</label><input type="text" id="price" name="price" value="" placeholder="33.11" /><BR/>
      <label for="categories">Category:</label><select name="categories" id="categories" class="required"></select>
      <BR/>
      <button onclick="buttonProductClick('POST');" class="btn btn-info">New</button>
      <button onclick="buttonProductClick('PUT');" class="btn btn-primary">Update</button>
      <button onclick="buttonProductClick('DELETE');" class="btn btn-danger">Delete</button>
      <button type="button" onclick="listProducts();" class="btn btn-success">List</button>
      <BR/>
      <BR/>
      <table id="tableProducts" name="tableProducts" class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th style="display:none">id</th>
            <th>name</th>
            <th>description</th>
            <th>category</th>
            <th>price</th>
            <th></th>
          </tr>
        </thead>
      </table>
      <BR/>
    </form>
  </div>
<script src="js/products.js"></script>
<script>
w3.includeHTML();
</script>
