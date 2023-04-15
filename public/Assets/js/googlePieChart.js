google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(function(){
    laod_data();
});

//chart creating function
function drawChart(drawChart) {
    let jsonData = drawChart;
    var data = google.visualization.arrayToDataTable([]);  
    data.addColumn({ type: 'string', label: 'number'});         
    data.addColumn({ type: 'number', label: 'alarm'});         

    $.each(jsonData, function(key,value){
        //console.log(value);
        let name = value.username;
        let hualarm = value.hualarm_count
        data.addRows([
            [name, hualarm]
        ]);

    });
    var options = {        
        pieHole: 0.4,
        backgroundColor: "transparent",
    exportEnabled: false,
    animationEnabled: true,	
        legend:'bottom',
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
}

  // load dynamic data for charts    
function laod_data() {
      //function for converting form data into json
      function jsonConversion(targetForm)
    {
        var itemData = $(targetForm).serializeArray();    
            var formObject = {};
            for (var i=0; i< itemData.length; i++){
                formObject[itemData[i].name] = itemData[i].value;
            }
            var json_conversion = JSON.stringify(formObject);
            //console.log(json_conversion);
            return json_conversion;
    } 
    //user search form submit   
    $('#searchUserbtn').on('click', function(e)
    {       
        e.preventDefault();        
        var jsonObject = jsonConversion('#userSearchForm');        
                 
     //post form data          
        $.ajax({
            url: "/dashboard-search-user",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:jsonObject,
            dataType: "json",
            contentType: "application/json",
            success: function(response){                                            
                drawChart(response);                
            }
           
        });
    });

     //search by date form submit   
     $('#searchDatebtn').on('click', function(e)
     {      
         e.preventDefault();        
         var jsonObject = jsonConversion('#dateSearchForm');        
                  
      //post form data          
         $.ajax({
             url: "/dashboard-search-byDate",
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:jsonObject,
             dataType: "json",
             contentType: "application/json",
             success: function(response){               
                 drawChart(response);
                 
             }
            
         });
     });
//get all users into chart on dashboard
    $.ajax({
        url: "dashboard-data",
        type: "GET",                
        success: function(response) {          
           drawChart(response);
        }
    });
}