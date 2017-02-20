
$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

$(function () {
    $(".abc #w1").change(function () {
        $("form").submit();
    });
});
// $("#datepicker").datepicker( {
//format: "mm-yyyy",
// startView: "months", 
// minViewMode: "months"
//});

$(function () {

  $('input[id=holidays-starting_date]').change(function () {
     var start = $('input[id=holidays-starting_date]').val();
    $('input[id=holidays-ending_date]').change(function () {
      var  end = $('input[id=holidays-ending_date]').val();
       var startDay = new Date(start);
                  var endDay = new Date(end);
        var millisecondsPerDay = 1000 * 60 * 60 * 24;

                  var millisBetween = endDay.getTime() - startDay.getTime();
                  var days = millisBetween / millisecondsPerDay;
                 // alert( Math.floor(days));
                 // alert(days);
                  //var allowed-days = Math.floor(days);
                  $("#holidays-allowed_holiday").val(days);
    });
   
    });
   
    //start = $('#holidays-starting_date').val();

    //var diff = new Date(end - start);

// get days
   // var days = diff / 1000 / 60 / 60 / 24;
//alert(days);

});