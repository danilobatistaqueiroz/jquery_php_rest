function sendAndLoad(sUrl, params, sType){
  $.validator.addMethod("valueNotEquals", function(value, element, arg){
   return arg !== value;
  }, "Value must not equal arg.");
  $("form[name='productform']").validate({
    rules: {
      SelectName: { valueNotEquals: "" },
      name: { required: true,
        minlength: 5},
      description: "required",
      categories: {
        required: true
      },
      price: {
        required: true
      }
    },
    messages: {
      SelectName: { valueNotEquals: "Please select an item!" },
      name: { required: "Please enter the name", minlength: "The minimum length for the name is 5"},
      description: "Please enter the description",
      categories: {
        required: "Please provide a category"
      },
      price: { required: "Please enter the price"}
    },
    submitHandler: function(form) {
      $.ajax({
        url: sURL,
        type: sType,
        data: params,
        success: function(response) {
          $.notify("success:\r\n" + JSON.stringify(response), "success");
        },
        error: function(xhr) {
          $.notify("error:\r\n" + JSON.stringify(xhr), "error");
        }
      });
    }
  });
}

function listProducts(){
  $.getJSON('/jquery_php_rest/rest/Product' , function(data) {
    var tbl_body = document.createElement("tbody");
    var odd_even = false;
    var rowid = 1;
    $.each(data, function() {
        var tbl_row = tbl_body.insertRow();
        tbl_row.id = rowid;
        tbl_row.className = odd_even ? "odd" : "even";
        var columnid = 1;
        $.each(this, function(k , v) {
            var cell = tbl_row.insertCell();
            if(columnid==1){
              cell.style.display = "none";
            }
            cell.id = rowid + "_" + columnid++;
            var strV = "";
            if(v !== null){
              strV = v.toString();
            }
            cell.appendChild(document.createTextNode(strV));
        })
        var cell = tbl_row.insertCell();
        var btnEdit = document.createElement("input");
        btnEdit.className = "btn btn-warning";
        btnEdit.type = "button";
        btnEdit.id = "btnEdit_" + rowid + "_" + columnid;
        btnEdit.name = "btnEdit_" + rowid + "_" + columnid;
        btnEdit.value = "edit";
        cell.appendChild(btnEdit);
        var span = document.createElement("span");
        span.innerHTML = " ";
        cell.appendChild(span);
        var btnDelete = document.createElement("input");
        btnDelete.className = "btn btn-danger";
        btnDelete.type = "button";
        btnDelete.id = "btnDelete_" + rowid + "_" + columnid;
        btnDelete.name = "btnDelete_" + rowid + "_" + columnid;
        //btnDelete.onclick = function(){alert($('#'+rowid+'_'+columnid+'').val());};
        btnDelete.addEventListener("click", function(){alert($('#'+btnDelete.name.substring(10,11)+'_1').text());});
        btnDelete.value = "delete";
        cell.appendChild(btnDelete);
        rowid++;
        odd_even = !odd_even;
    })
    $("#tableProducts").append(tbl_body);
  });
}

function buttonProductClick(type){
  var params = {
    name: $("#name").val(),
    description: $("#description").val(),
    categoryid: $("#categoryid").val(),
    price: $("#price").val()
  };
  sendAndLoad('/jquery_php_rest/rest/Product',params,type);
}

function getCategories(){
  $.ajax({
    url: '/jquery_php_rest/rest/Category',
    type:'GET',
    success: function(response){
      var options = $("#categories");
      options.append($("<option />").val("").text("select..."));
      $.each(response, function() {
        options.append($("<option />").val(this.id).text(this.name));
      });
    },
    error: function(response){
      $.notify("error:\r\n" + JSON.stringify(response), "error");
    }
  });
}

getCategories();
