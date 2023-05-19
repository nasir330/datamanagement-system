
//search customer form
$('#search').on('keyup', function () {
   var name = $(this).val();
   console.log(name);    
    //post form data          
    $.ajax({
        url: "search",
        type: "GET",       
        data: {'name':name},        
        success: function (data) {
           $('#search-name').html(data);
        }
    });
});
//search customer form
$(document).on('click', 'li', function () {
   var item = $(this).text();
   $('#search').val(item);
   $('#search-name').empty();
});


