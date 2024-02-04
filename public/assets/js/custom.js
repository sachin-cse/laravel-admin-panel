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
            // $('#img').val(data.image);
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
        // 'image': $('#img')[0].files[0],
    }

    
    var valid = true;

    if(data.name.trim() === ''){
        toastr.error('Please enter your name.');
        valid = false;
    }

    if(data.email.trim() === ''){
        toastr.error('Please enter your email.');
        valid = false;
    }

    if(data.phone.trim() === ''){
        toastr.error('Please enter your phone.');
        valid = false;
    }

    if(data.usertype.trim() === ''){
        toastr.error('Please select usertype.');
        valid = false;
    }


    if(valid){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            }
        });
    
        //    alert(id);
        $.ajax({
            url: '/admin/update-user/' + id,
            method: 'POST',
            data: data,
            enctype: 'multipart/form-data',
            dataType: 'json',
            success: function(response){
                $('#editmodal').modal('hide');
                if (response.success == true){
                    toastr.success(response.message);
                  
                } else {
                    toastr.error(response.message);
                }

                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
    }

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


        var formData = {
            title: $('#title').val(),
            subtitle: $('#subtitle').val(),
            description: $('#description').val(),
        };

        var valid = true;

        if(formData.title.trim() === ''){
            toastr.error('Please enter a title.');
            valid = false;
        }

        if(formData.subtitle.trim() === ''){
            toastr.error('Please enter a subtitle.');
            valid = false;
        }

        if(formData.description.trim() === ''){
            toastr.error('Please enter a description.');
            valid = false;
        }

        if(valid){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
                }
            });


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
        }

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

    var valid = true;

    if(data.title.trim() === ''){
        toastr.error('Please enter a title.');
        valid = false;
    }

    if(data.subtitle.trim() === ''){
        toastr.error('Please enter a subtitle.');
        valid = false;
    }

    if(data.description.trim() === ''){
        toastr.error('Please enter a description.');
        valid = false;
    }

if(valid){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
        }
    });

    //    alert(id);
    $.ajax({
        url: '/admin/update-user/aboutus/' + aboutus_id,
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
}
   

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
    // $('#datatable').DataTable();

    // services
    $('.services').on('click', function(){
        var services_routeUrl = $(this).data('url');
        // alert(services_routeUrl);

        var token = $('input[name="_token"]').attr('value');

        var services_formdata = {
            services_name: $('#services_name').val(),
            services_description: $('#services_description').val(),
            services_title: $('#services_title').val(),
        };

        // alert(services_formdata.services_title);
        

        var valid = true;

        if(services_formdata.services_name.trim() === ''){
            toastr.error('Please enter a service name.');
            valid = false;
        }

        if(services_formdata.services_description.trim() === ''){
            toastr.error('Please enter a service description.');
            valid = false;
        }

        if(services_formdata.services_title.trim() === ''){
            toastr.error('Please enter a service title.');
            valid = false;
        }

        if(valid){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
                }
            });

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
        }

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
            $('#services_title1').val(data.slug);
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
         'services_title': $('#services_title1').val(),
     }

     var valid = true;

     if(services_data.services_name.trim() === ''){
         toastr.error('Please enter a service name.');
         valid = false;
     }

     if(services_data.services_description.trim() === ''){
         toastr.error('Please enter a service description.');
         valid = false;
     }

     if(services_data.services_title.trim() === ''){
        toastr.error('Please enter a service title.');
        valid = false;
     }

     if(valid){
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
     }

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

    //  service image
    $('#addbannerimage').on('submit', function(e){
        e.preventDefault();
        var valid = true;

        var exten = $("#banner_image").val().split('.').pop().toLowerCase();

        // alert(exten);

        if($('#banner_name').val().trim() == ''){
            toastr.error('Please enter banner name');
            valid = false;
        }

        if($('#banner_image').val() == ''){
            toastr.error('Please upload a banner image');
            valid = false;
        } else if(jQuery.inArray(exten, ['jpg', 'jpeg', 'png']) == -1){
            toastr.error('Invalid file extension please upload only jpg,png,jpeg');
            valid = false;
        }

        if(valid){
            var formData = new FormData(this);
            $.ajax({
                url: '/admin/services/banner/store',
                method: 'POST',
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    // alert(data);
                    $('#bannerModal').modal('hide');
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
        }

    });

    // edit service image
    $('.editBanner').on('click', function(e){
        e.preventDefault();

        var routeUrl = $(this).data('route-url');
        var BannerId = $(this).data('user-id');
        // alert(BannerId);
        $('#bannerupdate_id').val(BannerId);

        var token = $('input[name="_token"]').attr('value');
        var base_url = window.location.origin;

        // alert(base_url);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            }
        });

        // var formData = new FormData(this);
        
        $.ajax({
            url: routeUrl,
            method: 'GET',
            success: function(data) {
                // console.log(data);
              if(data.success == true){
                // alert(JSON.stringify(data, null, 2));
                
            $('#banner_name1').val(data.data.banner_name);
            $('#bannerImagePreview').attr('src', base_url + '/upload/' + data.data.banner_image);
            $('#bannerEditModal').modal('show');
              } else {
                console.error('Services Banner not added');
              }
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.error(error);
            }
          });
        
        
    });

    // update the banner image
    $('#updatebannerimage').on('submit', function(e){
        e.preventDefault();

        var bannerupdate_id = $('#bannerupdate_id').val();
        var formData = new FormData(this);

            $.ajax({
                url: '/admin/services/banner/update/' + bannerupdate_id,
                method: 'POST',
                dataType: "json",
                data:formData,
                contentType: false,
                processData: false,
                success: function(response){
                    // alert(data);
                    $('#bannerModal').modal('hide');
                    if (response.success == true){
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }

                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
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

    // delete services banner
    $('.deleteBanner').on('click', function(){
        $('#bannerDeletemodal').modal('show');
        var services_delete_id = $(this).data('user-id');
        $('#servicesbanner_delete_id').val(services_delete_id);
 
     });
 
     $('.servicesBannerdelete').on('click', function(){
 
         var servicesBanner_delete_id = $('#servicesbanner_delete_id').val();
         var token = $('input[name="_token"]').attr('value');
 
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': token
             }
         });
 
         $.ajax({
             url: '/admin/services/banner/delete/' + servicesBanner_delete_id,
             method: 'DELETE',
             dataType: "json",
             success: function(response){
                 $('#bannerDeletemodal').modal('hide');
                 if (response.success == true){
                     toastr.success(response.message);
                 } else {
                     toastr.error(response.message);
                 }

                 setTimeout(function () {
                    window.location.reload();
                }, 2000);
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

    //  CK Editor5
    ClassicEditor
    .create(document.querySelector('#description'))
    .catch(error => {
        console.error(error);
    });

    // send email via ajax
    $('#sendEmail').on('submit', function(e){
        e.preventDefault();

        var valid  = true;

        if($('#title').val().trim() == ''){
            toastr.error('title is required');
            valid = false;
        }

        if($('#email').val().trim() == ''){
            toastr.error('email is required');
            valid = false;
        }

        if($('#description').val().trim() == ''){
            toastr.error('description is required');
            valid = false;
        }

        if(valid){
            $.ajax({
                url: '/admin/services/sendemail',
                method: 'POST',
                dataType: "json",
                data: $(this).serialize(),
                success: function(response){
                    if (response.success == true){
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
   
                    setTimeout(function () {
                       window.location.reload();
                   }, 2000);
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
        }
    });


    // auto complete search
    $('#autoSearch').on('input', function(){
        var APP_URL = window.location.origin;
        var s = $(this).val();
        // alert(s);
    
        if (s.trim() !== '') {
            $.ajax({
                url: APP_URL+'/admin/autocomplete/search',
                method: 'GET',
                data: {s: s},
                success: function(data){
                    var resultsContainer = $('#searchResults');
                    resultsContainer.empty();
    
                    if (data.length > 0) {
                        $.each(data, function(index, result){
                            resultsContainer.append('<li class="result-item">' + result.name + '</li>');
                        });
                    } else {
                        resultsContainer.append('<li class="not-found">Not Found</li>');
                    }
                },
            });
        } else {
            // Handle the case when the search input is blank
            var resultsContainer = $('#searchResults');
            resultsContainer.empty(); // Clear previous results or handle as needed
        }
    });

    $(document).on('click', '#searchResults li', function(){
        var selected = $(this).text();
        $('#autoSearch').val(selected);
        $('#searchResults').empty();
        quickSearch(selected);
    });

    function quickSearch(selected) {
        var APP_URL = window.location.origin;
        window.location.href = APP_URL + '/search?q=' + selected;
    }

    // testimonial search
    $('#testimonial').on('submit', function(e){
        e.preventDefault();

        var valid = true;

        var exten = $("#file").val().split('.').pop().toLowerCase();


        if($('#name').val().trim() == ''){
            toastr.error('name is required');
            valid = false;
        } else if($('#description').val().trim() == ''){
            toastr.error('description is required');
            valid = false;
        } else if($('#file').val().trim() == ''){
            toastr.error('image field is required');
            valid = false;
        } else if(jQuery.inArray(exten, ['jpg', 'jpeg', 'png']) === -1){
            toastr.error('Invalid file extension please upload only jpg,png,jpeg');
            valid = false;
        } else if($('#rating').val() == ''){
            toastr.error('please rate us');
            valid = false;
        }

        if(valid){
            var formData = new FormData(this);

            $.ajax({
                url:'/admin/testimonial/store',
                method: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success == true){
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        toastr.error(response.message);
                    }
                }
            })
        }
    })

    // rating for testimonial
    $('.star').on('click', function(){
        var forval = parseInt($(this).attr('for'));
        // alert(forval);
        $('#rating').val(forval);
        $('#rating2').attr('value', forval);
        $('.star').each(function(index){
            if((index+1)<=forval){
                // alert(1);
                $(this).removeClass('fa-star');
                $(this).addClass('fa-star-o');
            } else {
                $(this).addClass('fa-star');
                $(this).removeClass('fa-star-o');
            }
        })
    });


    // multiple delete
    $('#check_all').on('click', function(e){
        // alert(1);
        if($(this).is(':checked', true)){
            $(".checkbox").prop('checked', true);  
        } else {
            $(".checkbox").prop('checked', false);  
        }
    });

    $('.checkbox').on('click', function(e){
        // alert($('.checkbox').length);
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#check_all').prop('checked',true);
        } else {
            $('#check_all').prop('checked',false);
        }
    });

    // ajax call for multiple delete
    $('.delete-all').on('click', function(e){
        var idsArr = [];

        var data_url = $(this).attr('data-url');

        var token = $('input[name="_token"]').attr('value');
 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $(".checkbox:checked").each(function(){
            idsArr.push($(this).attr('data-id'));
        });

        if(idsArr.length == 0){
            toastr.error('Please select atleast one record to delete');
        } else {
            // alert(1);
            var strids = idsArr.join(',');
            $.ajax({
                url: data_url,
                method: 'DELETE',
                dataType: 'json',
                data: {strids: strids},
                success: function(response){
                    toastr.success(response.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }
    });

    // testimonial edit
    $('.testimonial_editbtn').on('click', function(e){
        e.preventDefault();

        var route_url = $(this).data('route-url');
        var user_id = $(this).data('user-id');

        $('#testimonialupdate_id').attr('value', user_id);

        var base_url = window.location.origin;

        
        var token = $('input[name="_token"]').attr('value');
        // var base_url = window.location.origin;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            }
        });

        $.ajax({
            url: route_url,
            method: 'GET',
            success: function(data){
                if(data){
                    $('#imageView').html('');
                    $('#ratingstar1').html('');
                    $('#name1').val(data.name);
                    $('#imageView').html(`
                        <img src="${base_url}/upload/${data.image}" width="100px" height="100px">`);
                    $('#imageView').append(`
                        <input type="hidden" id="hidden_image" name="hidden_image" value = "${data.image}">`);
                    $('#ratingstar1').append(`<label for="testimonial_title" class="col-form-label">Rating</label><br>`)
                    for(var i = data.rating; i>=1; i--){
                        $('#ratingstar1').append(`<i class="star fa fa-star"></i>`);

                    }
                    $('#description1').val(data.description);
                    // $('#img').val(data.image);
                    $('#testimonialeditmodal').modal('show');
                } else {
                    toastr.error('something went wrong');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

    });

    // update testimonial
    $('.updateTestimonial').on('click', function(e){
        e.preventDefault();

        var testimonialupdate_id = $('#testimonialupdate_id').val();
        // alert(testimonialupdate_id);
        // var formData = new FormData(this);

        // alert($(this).serialize());
       var name = $('#name1').val();
       var description = $('#description1').val();
       var image = $('#file1').val();
       var update_rating = $('#rating2').val();

        var valid = true;

        if($('#name1').val() == ''){
            toastr.error('name field is required');
            valid = false;
        }else if($('#description1').val() == ''){
            toastr.error('description field is required');
            valid = false;
        } 

        if(valid){
            $.ajax({
                url: '/admin/testimonial/update/' + testimonialupdate_id,
                method: 'PUT',
                dataType: "json",
                data:{id:testimonialupdate_id, name:name, description:description, image:image, update_rating:update_rating},
                success: function(response){
                    $('#testimonialeditmodal').modal('hide');
                    if (response.success == true){
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else if(response.error == true) {
                        toastr.error(response.message);
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
        }
    });

    // testimonial delete
    $('.testimonialdeletebtn').on('click', function(){
        $('#testimonialdeletemodal').modal('show');
        var testimonial_delete_id = $(this).data('user-id');
        $('#testimonial_delete_id').val(testimonial_delete_id);
 
    });
    
    // testimonial update
    $('.testimonialdelete').on('click', function(){
 
         var testimonial_delete_id = $('#testimonial_delete_id').val();
         var token = $('input[name="_token"]').attr('value');
 
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': token
             }
         });
 
         $.ajax({
             url: '/admin/testimonial/delete/' + testimonial_delete_id,
             method: 'DELETE',
             dataType: "json",
             success: function(response){
                 $('#testimonialdeletemodal').modal('hide');
                 if (response.success == true){
                     toastr.success(response.message);
                 } else {
                     toastr.error(response.message);
                 }

                 setTimeout(function () {
                    window.location.reload();
                }, 2000);
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