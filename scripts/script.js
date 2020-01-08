$(function() {

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

  $(document).ready(function() {
    $('#login-form').animate({
      opacity: 1
    }, 800);
    $('#sign-up').animate({
      opacity: 1
    }, 800);
    $('.landing-title').css({"animation": "fadeDown 1.5s forwards ease-in-out"});
  })

  // mobile navbar behavior
  var vpWidth = $(window).width();
  if (vpWidth < 992) {
    $('.navbar-toggler').click(function() {
      $('.dropdown-menu').show();
    });
  } else {
    // navbar dropdown
    $('.dropdown').hover(function(){
      $('.dropdown-menu').stop(true, true).slideDown("fast");
    }, function() {
      $('.dropdown-menu').stop(true, true).slideUp("slow");
    });
  }

  // Sign-in button disable
  if($('#login-form').length > 0) {
    $('input').keyup(function() {
      if ($('#username').val().length === 0 || $('#password').val().length === 0) {
        $('.btn-sign-in').attr("disabled", true);
      } else {
        $('.btn-sign-in').attr("disabled", false);
      }
    });
  }

  // update profile button disable
  if($('#edit-profile-form').length > 0) {
    var email = $('#email').val();
    $('#edit-profile-form input').keyup(function() {
      if ($('#email').val() === email || $('#email').val().length ===0) {
        $('.btn-edit-profile, .btn-reset').attr("disabled", true);
      } else {
        $('.btn-edit-profile, .btn-reset').attr("disabled", false);
      }
    })
    $('#profile-picture').change(function() {
      $('.btn-edit-profile, .btn-reset').attr("disabled", false);
    })
  }

  // change password button disable
  if($('#edit-password-form').length > 0) {
    $('#edit-password-form input').keyup(function() {
      if ($('#password').val().length === 0 || $('#verify_password').val().length === 0) {
        $('.btn-edit-password, .btn-cancel').attr("disabled", true);
      } else {
        $('.btn-edit-password, .btn-cancel').attr("disabled", false);
      }
    })
  }

  // comment submit disable
  if($('#comment-form').length > 0){
    $('#comment').keyup(function() {
      if($(this).val().length === 0) {
        $('.btn-add-comment').attr("disabled", true);
      } else {
        $('.btn-add-comment').attr("disabled", false);
      }
    })
  }

  // search button disable
  if($('.search-query').length > 0) {
    $('.search-query').keyup(function() {
      if($(this).val().length === 0){
        $('.btn-search').attr("disabled", true);
      } else {
        $('.btn-search').attr("disabled", false);
      }
    });
  }

  // for IE sticky sidebar
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");
  if (msie > 0 || !!navigator.userAgent.match(/Trident\/7\./)) {
    if ($('.sticky-top').length) {
      var sidebarPosition = $('.sticky-top').offset().top;
      $(window).on('scroll', function() {
        if ($(window).scrollTop() >= sidebarPosition) {
          $('.sticky-top').addClass("position-fixed").css({"top": 0});
        } else {
          $('.sticky-top').removeClass("position-fixed");
        }
      })
    }
  }

  // delete confirmations (pass data-id to modal)
  $('.delete-modal-toggle').click(function() {
    var id = $(this).attr("data-id");
    $('.modal-footer .btn-danger').attr("data-id", id);
    // $('#modal-id').val(id);
  });

  // sync sidebar and header searchbar
  $('.search-query').keyup(function(e) {
    $('.search-query').val($(this).val());
  })

  // profile preview
  function previewProfile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
          $('#profile-preview').attr('src', "/img/no-image-available.jpg");
        }
    }
    $("#profile-picture").change(function(){
        previewProfile(this);
    });

    $('.btn-reset').click(function() {
      $('#profile-preview').attr('src', "/img/no-image-available.jpg");
      $('.btn-edit-profile, .btn-reset').attr("disabled", true);
      $('#profile-picture').val("");
    })

  // post picture preview
  // var src = $('.post-preview').attr('src');
  var imageId;
  function previewPost(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#post-preview'+imageId).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
          $('#post-preview'+imageId).attr('src', "/img/no-image-available.jpg");
        }
    }
    $(document).on('change', '.post-image', function() {
      imageId = this.id;
      imageId = imageId.slice(-1);
      previewPost(this);
    })

    // add more images
    var postImage = $('.post-preview').length;
    var postImageId = postImage;
    if (postImage >= 5) {
      $('.btn-add-image').addClass("d-none");
    }
    $('.btn-add-image').click(function() {
      if(postImage < 5) {
        postImage++;
        postImageId++;
        $('.image-upload').append("\
          <div class='form-group'>\
            <div class='image-wrapper' style='height: 200px;'>\
              <img src='/img/no-image-available.jpg' alt='' class='img-fluid post-preview' id='post-preview"+postImageId+"'>\
            </div>\
            <p class='text-center'><i class='fa fa-trash delete-post-image' style='cursor:pointer;'></i></p>\
            <input type='file' name='file[]' id='post-image"+postImageId+"' class='form-control post-image'>\
          </div>");
          if (postImage >= 5) {
            $('.btn-add-image').addClass("d-none");
          }
      }
    });

    //delete old post image
    $(document).on('click', '.delete-post-image', function() {
      $(this).closest('.form-group').remove();
      postImage--;

      if (postImage < 5) {
        $('.btn-add-image').removeClass("d-none");
      }
    });

    // post images slide
    if($('.slides').length > 0) {
      // set up wrapper width and height
      var imageHeight, slideHeight = 0;
      var wrapperWidth = $('.image-wrapper.post').width();
      $('.slides').css({"max-width": wrapperWidth});

      for(var i=1; i<= $('.slides').length; i++) {
        imageHeight = $('#slide'+i).height();
        slideHeight = ((imageHeight > slideHeight)? imageHeight:slideHeight);
      }
      $('.image-wrapper.post').height(slideHeight);

      if ($('.slides').length > 1) {
        // embed thumbnails
        for (var i = 1; i <= $('.slides').length; i++) {
          $('.thumbnails').append($('#slide'+i).clone().attr("id", "thumbnail"+i).removeClass("slides img-fluid").addClass("thumbnail mx-1"));
        }
        $('.slides:not(#slide1)').hide();
        $('#thumbnail1').addClass("active");

        $('.thumbnail').hover(function() {
          var slideId = this.id;
          // console.log(slideId);
          var slideNum = parseInt(slideId.slice(-1));
          $('.slides').hide();
          $('.thumbnail').removeClass("active");
          $('#slide'+slideNum).show();
          $('#thumbnail'+slideNum).addClass("active");
        });
      }
    }

    // post content textarea text limit
    if($('#content').length > 0 ){
      $('#content').on('keyup change paste input keydown',function(){
        var length = $(this).val().length;
        $('.content-limit').html(length);
      });
    };



});
