$(document).ready(function(){
  // save comment to database
  $(document).on('click', '#submit_btn', function(){
    var name = $('#name').val();
    $.ajax({
      url: 'Manufacturer.php',
      type: 'POST',
      data: {
        'manufacturerName': name,
        'action':'AddManufacturer',
      },
      success: function(response){
        
      }
    });
  });



$("#submit_model").click(function (event) {

        var hasError = false;
        var modelName = $("#modelName").val();
        var color = $("#color").val();
        var year = $("#year").val();
        var regnum = $("#regnum").val();
        var qty = $("#qty").val();

        if(modelName == "")
        {
          hasError = true;
          $("#modelNameError").addClass('error');
        }

        if(color == '')
        {
          hasError = true;
          $("#colorError").addClass('error');
        }

        if(year == '')
        {
          hasError = true;
          $("#yearError").addClass('error');
        }

        if(regnum == '')
        {
          hasError = true;
          $("#regError").addClass('error');
        }

         if(qty == '')
        {
          hasError = true;
          $("#qtyError").addClass('error');
        }


        if(hasError == true)
        {
          $(".error").show();
          return false;
        }
        else
        {
          $(".error").hide(); 
        }

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var form = $('#model_form')[0];
          // Create an FormData object 
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "Carmodel.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
              var res = JSON.parse(data);
              if(res.status == 'success')
              {
                $("#ajaxerror").show();
               window.location = "viewinventory.php";
              }
              else
              {
                $("#ajaxerror").hide(); 
              }
               
            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });

    });

$("#delete_model").click(function(){

  var modelId =  $(this).attr("data-id");
  alert(modelId); 

  $.ajax({
            type: "POST",
            url: "Carmodel.php",
            data: {
              'modelId' : modelId },
            success: function (data) {
                 var res = JSON.parse(data);
                 if(res.status == 'success')
                 {
                  location.reload();
                }

            },
            error: function (e) {

                console.log("ERROR : ", e);

            }
        });

});
});