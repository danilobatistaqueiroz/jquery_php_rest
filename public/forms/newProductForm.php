<!-- Form used to add new entries of users in database -->
<form class="form-horizontal" name="productList" id="productForm" ng-submit="insertInfo(productInfo);" >
  <h3 class="text-center">Insert Product Details</h3>
  <div class="form-group row">
  </div>
  <div class="form-group">
    <label for="Name">Name:</label>
    <input type="text" name="name" class="form-control" placeholder="Enter Product Name" ng-model="productInfo.name" autofocus required />
  </div>
  <div class="form-group">
    <p class="text-danger" ng-show="productList.name.$invalid && productList.name.$dirty">Name field is Empty!</p>
  </div>
  <div class="form-group">
    <label for="Description">Description:</label>
    <input type="text" name="description" class="form-control" placeholder="Enter Product Description" ng-model="productInfo.description" autofocus required />
  </div>
  <div class="form-group">
    <p class="text-danger" ng-show="productList.description.$invalid && productList.description.$dirty">Invalid Description!</p>
  </div>
  <div class="form-group">
    <label for="Category">Category:</label>
    <label for="" class="radio-inline category">
      <input type="radio" name="category" value="Admin" ng-model="productInfo.category">Administrator
    </label>
    <label for="" class="radio-inline category">
      <input type="radio" name="category" value="Supplier" ng-model="productInfo.category">Supplier
    </label>
    <label for="" class="radio-inline category">
      <input type="radio" name="category" value="Shipper" ng-model="productInfo.category">Shipper
    </label>
  </div>
  <div class="form-group">
    <label for="Price">Price:</label>
    <input type="text" name="price" class="form-control" placeholder="Enter Product Price" ng-model="productInfo.price" autofocus required />
  </div>
  <div class="form-group">
    <p class="text-danger" ng-show="productList.price.$invalid && productList.price.$dirty">Price field is Empty!</p>
  </div>
  <div class="form-group">
    <button class="btn btn-success" ng-disabled="productList.$invalid" ng-click="insertMsg(productInfo.name)">Add New Product</button>
    <input type="button" class="btn btn-warning" formnovalidate onclick="cancelNewProductForm();" value="Cancel" />
  </div>
</form>
<script>
  function cancelNewProductForm(){
    $('#newProductForm').slideUp();
    $('#btnNewProduct').prop('disabled',false);
  }
</script>
