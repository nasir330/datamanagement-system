//function for converting form data into json
function jsonConversion(targetForm) {
    var itemData = $(targetForm).serializeArray();
    var formObject = {};
    for (var i = 0; i < itemData.length; i++) {
        formObject[itemData[i].name] = itemData[i].value;
    }
    var json_conversion = JSON.stringify(formObject);

    return json_conversion;
}

//search HuAlarm
$('#searchType').on('keyup', function (e) {
    e.preventDefault();
    var jsonObject = jsonConversion('#huAlarm');    
    $('#huAlarmSearchResult').empty();   
    //post form data          
    $.ajax({
        url: "/huAlarm-search-type",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: jsonObject,
        dataType: "json",
        contentType: "application/json",
        success: function (response) {
            console.log(response);
            if (response.length > 0) {
                $.each(response, function (index, value) {
                    var lineBreak = '<br/>';
                    var id = value.id;
                    var oIName = value.oIName;                   
                    var nType = value.nType;
                    var objIden = value.objIden;
                    var aSource = value.aSource;
                    var aName = value.aName;
                    var type = value.type;
                    var sev = value.sev;
                    var status = value.status;
                    var clrOper = value.clrOper;
                    var locInfor = value.locInfor;
                    var addText = value.addText;
                   
                    $('#huAlarmSearchResult').append(
                        '<tr>'+
                            '<td>'+id+'</td>'+
                            '<td>'+oIName+'</td>'+
                            '<td>'+nType+'</td>'+
                            '<td>'+'domain'+'</td>'+
                            '<td>'+objIden+'</td>'+
                            '<td>'+aSource+'</td>'+
                            '<td>'+aName+'</td>'+
                            '<td>'+type+'</td>'+
                            '<td>'+sev+'</td>'+
                            '<td>'+status+'</td>'+
                            '<td>'+clrOper+'</td>'+
                            '<td>'+locInfor+'</td>'+
                            '<td>'+addText+'</td>'+
                            '<td>'+
                            ' <a style="font-size:18px; margin:2px; text-decoration:none;" '+
                            'href="/edit-huAlarm/' + id + '">'+
                            '<i class="fa-solid fa-edit text-primary"></i>'+
                            '</a>'+
                            ' <a style="font-size:18px; margin:2px; text-decoration:none;" '+
                            'href="/delete-huAlarm/' + id + '">'+
                            '<i class="fa-solid fa-trash text-danger"></i>'+
                            '</a>'+                           
                            '</td>'+
                        '</tr>'
                    );                    
                });
            } else {
                $('#customer-info').append(
                    '<span class="text-danger">' + 'Customer not found' + '</span>'
                );
            }           
        }
    });
});
