$(document).ready(function () {
    //success message autohide
    setTimeout(function () {
        $("#successMessage").fadeOut('slow')
    }, 2000);

    function countOpenNotification() {
        $.ajax({
            url: "notification",
            type: "GET",
            success: function (response) {
                console.log(response);
                if (response > 0) {
                    var audio = new Audio('/Assets/sounds/notification.mpeg');
                    audio.play();
                    $('#notification').html(response);
                    var allNotification = response + ' ' + 'Notifications';
                    $('#notifications').html(allNotification);
                   
                } else {
                    $('#notification').html('');
                }

            }
        });
    }
    countOpenNotification();

    function allOpenNotification() {
        $.ajax({
            url: "all-notification",
            type: "GET",
            success: function (response) {
                $.each(response, function (key, value) {
                    var url = 'open-notification/'+value.id;
                    var status = 'status :' + ' ' + value.status;
                    var user = value.user.username;
                    $('#notification-list').append(
                        '<div class="dropdown-divider">' + '</div>' +
                        '<a href="#" class="dropdown-item">' +
                        '<i class="fa fa-bell mr-2">' + '</i>' + ' requested membership upadate ' +
                        '<span class="float-right text-muted text-sm">' + 'from ' + user + '</span>' +
                        '</a>'
                    )
                    
                });
            }
        });
    }
    allOpenNotification();

});