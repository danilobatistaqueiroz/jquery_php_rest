<meta charset="UTF-8">
<script src="../bower_components/jquery/dist/jquery.js"></script>

<!-- CLIENT -->
<script>
function sendAndLoad(sURL, params, sType) {
    $.ajax({
      url: sURL,
      type: sType,
      data: params,
      success: function(response) {
        console.log(response);
        document.all['output'].value = "success:\r\n" + JSON.stringify(response);
      },
      error: function(xhr) {
        console.log(xhr);
        document.all['output'].value = "error " + xhr;
      }
    });
}
function buttonProductClick(){
  var type = document.all['type'].value;
  var params = {name: 'productX', description: 'Xbox', categoryid: 1, price: '2'};
  sendAndLoad('/jquery_php_rest/rest/Product',params,type);
}
function buttonUserClick(){
  var type = document.all['type'].value;
  var params = {login:'super', name: 'super user', passwd: '123', email: 'super@gmail.com', type: 'Admin', address: 'Avenue New World'};
  sendAndLoad('/jquery_php_rest/rest/User',params,type);
}
</script>

<button onclick="buttonProductClick();">Test Rest Call Product</button>
<BR/>
<button onclick="buttonUserClick();">Test Rest Call User</button>
<select id="type">
  <option value="POST">create</option>
  <option value="PUT">update</option>
  <option value="GET">retrieve</option>
  <option value="DELETE">delete</option>
</select>
<BR/>
<textarea rows="16" cols="80" id="output" value=""></textarea>
<BR/>
