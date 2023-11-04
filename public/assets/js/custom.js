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

    // abouts page
    $('.abouts_editbtn').on('click', function(){
        
        var about_usrouteUrl = $(this).data('route-url');
        var abouts_userId = $(this).data('user-id');
        $('#aboutsupdate_id').val(abouts_userId);

        $.ajax({
            url: about_usrouteUrl,
            method: 'GET',
            success: function(data) {
                // alert(JSON.stringify(data, null, 2));
              if(data){
                // alert(JSON.stringify(data, null, 2));
            $('#title1').val(data.title);
            $('#subtitle1').val(data.subtitle);
            $('#description1').val(data.description);
            $('#aboutuseditmodal').modal('show');
              } else {
                console.error('User not found');
              }
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.error(error);
            }
          });

        // $('#aboutuseditmodal').modal('show');
    });

    // update aboutus
    $('.aboutsupdatebtn').on('click', function(e) {
        // e.preventDefault();
       var aboutus_id = $('#aboutsupdate_id').val();

       var token = $('input[name="_token"]').attr('value');

       var data = {
        'title': $('#title1').val(),
        'subtitle': $('#subtitle1').val(),
        'description': $('#description1').val(),
    }


       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
        }
    });

    //    alert(id);
    $.ajax({
        url: '/update-user/aboutus/' + aboutus_id,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(response){
            $('#aboutuseditmodal').modal('hide');
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

    // delete aboutus
    $('.aboutusdeletebtn').on('click', function(){
        $('#aboutusdeletemodal').modal('show');
        var aboutus_delete_id = $(this).data('user-id');
        $('#aboutus_delete_id').val(aboutus_delete_id);
 
     });
 
     $('.aboutusdelete').on('click', function(){
 
         var aboutus_user_id = $('#aboutus_delete_id').val();
         var token = $('input[name="_token"]').attr('value');
 
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': token
             }
         });
 
         $.ajax({
             url: '/delete/aboutus/' + aboutus_user_id,
             method: 'DELETE',
             dataType: "json",
             success: function(response){
                 $('#aboutusdeletemodal').modal('hide');
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

    //  data table
    $('#datatable').DataTable();

    // services
    $('.services').on('click', function(){
        var services_routeUrl = $(this).data('url');
        // alert(services_routeUrl);

        var token = $('input[name="_token"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            }
        });

        var services_formdata = {
            services_name: $('#services_name').val(),
            services_description: $('#services_description').val(),
        };

        $.ajax({
            url: services_routeUrl,
            method: 'POST',
            data:services_formdata,
            success: function(response){
                // alert(JSON.stringify(services_formdata, null, 2));
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

    $('.services_edit').on('click', function(){

        var routeUrl = $(this).data('route-url');
        var userId = $(this).data('user-id');
        $('#servicesupdate_id').val(userId);


        var token = $('input[name="_token"]').attr('value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            }
        });


        $.ajax({
            url: routeUrl,
            method: 'GET',
            success: function(data) {
                // alert(data);
              if(data){
                // alert(JSON.stringify(data, null, 2));
            $('#services_name1').val(data.services_name);
            $('#services_description1').val(data.services_description);
            $('#serviceseditModal').modal('show');
              } else {
                console.error('Services not added');
              }
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.error(error);
            }
          });
    });

    $('.update_services').on('click', function(){
        var services_id = $('#servicesupdate_id').val();

        // alert(services_id);

        var token = $('input[name="_token"]').attr('value');
 
        var services_data = {
         'services_name': $('#services_name1').val(),
         'services_description': $('#services_description1').val(),
     }
 
 
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
         }
     });
 
     //    alert(id);
     $.ajax({
         url: '/admin/services/update/' + services_id,
         method: 'POST',
         data: services_data,
         dataType: 'json',
         success: function(response){
             $('#serviceseditModal').modal('hide');
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

    $('.servicesdeletebtn').on('click', function(){
        $('#servicesdeletemodal').modal('show');
        var services_delete_id = $(this).data('user-id');
        $('#services_delete_id').val(services_delete_id);
 
     });
 
     $('.servicesdelete').on('click', function(){
 
         var services_delete_id = $('#services_delete_id').val();
         var token = $('input[name="_token"]').attr('value');
 
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': token
             }
         });
 
         $.ajax({
             url: '/admin/services/delete/' + services_delete_id,
             method: 'DELETE',
             dataType: "json",
             success: function(response){
                 $('#servicesdeletemodal').modal('hide');
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
});