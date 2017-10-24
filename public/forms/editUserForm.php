<form class="form-horizontal">
  <h3 class="text-center">Update User Details</h3>
  <div class="form-group">
    <label for="Name">Login:</label>
    <input type="text" class="form-control" ng-model="currentUser.name" value="{{currentUser.name}}">
  </div>
  <div class="form-group">
    <label for="Email">Email:</label>
    <input type="email" class="form-control" ng-model="currentUser.email" value="{{currentUser.email}}">
  </div>
  <div class="form-group">
    <label for="Type">Type:</label>
    <label for="" class="radio-inline type">
      <input type="radio" ng-model="currentUser.type" value="Admin">Administrator
    </label>
    <label for="" class="radio-inline type">
      <input type="radio" name="type" ng-model="currentUser.type" value="Shipper">Shipper
    </label>
    <label for="" class="radio-inline type">
      <input type="radio" name="type" ng-model="currentUser.type" value="Supplier">Supplier
    </label>
  </div>
  <div class="form-group">
    <label for="Address">Address:</label>
    <input type="text" class="form-control" ng-model="currentUser.address" value="{{currentUser.address}}">
  </div>
  <div class="form-group">
    <button class="btn btn-warning" ng-disabled="userList.$invalid" ng-click="updateMsg(currentUser.id)">Update</button>
    <button type="button" class="btn btn-info" formnovalidate onclick="$('#editUserForm').slideToggle();">Cancel</button>
  </div>
</form>
