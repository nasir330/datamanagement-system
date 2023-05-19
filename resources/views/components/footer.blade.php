
 
</div>

<!-- bootstrap cdn JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- FontAwsome JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"
    integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<!-- Bootstrap JS -->
<script src="{{asset('Assets/js/jquery.min.js')}}"></script>
<script src="{{asset('Assets/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('Assets/js/notification.js')}}"></script>
<!-- google chart JS -->
<script src="{{asset('Assets/js/googlePieChart.js')}}"></script>
<script src="{{asset('Assets/js/barChart.js')}}"></script>
<!-- AdminLTE JS -->
<script src="{{asset('Assets/js/adminlte.js')}}"></script>
<!-- serch js -->
<script src="{{asset('Assets/js/search.js')}}"></script>
<script>
   $(document).ready(function() {
    $('#myTable').DataTable();
    //get auth system session expire time
    var halfSec = 5*1000;
    var system_exp = $('#sysExp').val();
    var refresh_time = system_exp*1000;
    var refresh_at = refresh_time+halfSec;
   
    if($.trim(system_exp) === ''){
        var halfSec = 5*1000;
        var system_exp = 180;
        var refresh_time = system_exp*1000;
        var refresh_at = refresh_time+halfSec;
        
        //console.log('expire time is :'+refresh_at+' original time:'+refresh_time+' add time 5 sec :'+halfSec );
        setTimeout(function() {
                location.reload();
            }, refresh_at);
    }else{
        //console.log('expire time is :'+refresh_at+' original time:'+refresh_time+' add time 5 sec :'+halfSec );
        setTimeout(function() {
            location.reload();
        }, refresh_at);
    }   
});

</script>

</body>

</html>