$(document).ready(function () {
    $('.editbtn').on('click', function() {
        // $('#editmodal').modal('show');
        // var userId = $(this).attr('data-id');

        var routeUrl = $(this).data('route-url');
        var userId = $(this).data('user-id');
        $('#update_id').val(userId);

        // $('#delete_id').val(userId);

        // alert(userId);

        $.ajax({
            url: routeUrl,
            method: 'GET',
            success: function(data) {
                // alert(data);
              if(data){
                // alert(JSON.stringify(data, null, 2));
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
            $('#usertype').val(data.usertype);
            $('#editmodal').modal('show');
              } else {
                console.error('User not found');
              }
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.error(error);
            }
          });
    });

    // toastr alert

    toastr.options = {
        positionClass: 'toast-bottom-right',
        timeOut:2000, 
    };


    // update user profile
    $('.updatebtn').on('click', function(e) {
        // e.preventDefault();
       var id = $('#update_id').val();

       var token = $('input[name="_token"]').attr('value');

       var data = {
        'name': $('#name').val(),
        'email': $('#email').val(),
        'phone': $('#phone').val(),
        'usertype': $('#usertype').val(),
    }


       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
        }
    });

    //    alert(id);
    $.ajax({
        url: '/update-user/' + id,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(response){
            $('#editmodal').modal('hide');
            if (response.success == true){
                toastr.success(response.message);
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            } else {
                toastr.error(response.message);
            }
        },

        error: function(xhr, status, error) {
            if (xhr.status == 419) {
                // Handle the 419 (CSRF token mismatch) error here
                toastr.error('CSRF token mismatch. Please refresh the page and try again.');
            } else {
                // Handle other errors
                toastr.error('An error occurred: ' + error);
            }
        }
    });

    });

    // delete user
    $('.deletebtn').on('click', function(){
       $('#deletemodal').modal('show');
       var delete_id = $(this).data('user-id');
       $('#delete_id').val(delete_id);

    });

    $('.deleteuser').on('click', function(){

        var user_id = $('#delete_id').val();
        var token = $('input[name="_token"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            url: '/delete-user/' + user_id,
            method: 'DELETE',
            dataType: "json",
            success: function(response){
                $('#deletemodal').modal('hide');
                if (response.success == true){
                    toastr.success(response.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message);
                }
            },

            error: function(xhr, status, error) {
                if (xhr.status == 419) {
                    // Handle the 419 (CSRF token mismatch) error here
                    toastr.error('CSRF token mismatch. Please refresh the page and try again.');
                } else {
                    // Handle other errors
                    toastr.error('An error occurred: ' + error);
                }
            }
        });

    });


    // save aboutus data
    $('.about').on('click', function(){
        // alert('hare Krishna and hare rama');
        var routeUrl = $(this).data('url');

        // alert(routeUrl);

        var token = $('input[name="_token"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            }
        });

        var formData = {
            title: $('#title').val(),
            subtitle: $('#subtitle').val(),
            description: $('#description').val(),
        };

        $.ajax({
            url: routeUrl,
            method: 'POST',
            data:formData,
            success: function(response){
                if(response.success == true){
                    toastr.success(response.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message);
                }
            },

            error: function(xhr, status, error) {
                if (xhr.status == 419) {
                    // Handle the 419 (CSRF token mismatch) error here
                    toastr.error('CSRF token mismatch. Please refresh the page and try again.');
                } else {
                    // Handle other errors
                    toastr.error('An error occurred: ' + error);
                }
            }

        });

    });




});