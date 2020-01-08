$(function(){


  // ##########################################################
  // ##################### USER RELATED #######################
  // ##########################################################

  // sign in
    $('.btn-sign-in').on('click', function(e) {
      e.preventDefault();
      $('.sign-in-error').hide();
      var username = $('#username').val();
      var password = $('#password').val();

      if (username && password) {
        $(this).removeClass("d-block").hide();
        $('.loading').show().addClass("d-block");

        $.ajax({
          url: '/inc/functions/users/auth.php',
          type: 'POST',
          data: {
            username: username,
            password: password,
          }
        })
        .done(function(data) {
          if (data.success) {
            window.location.replace("/home");
          } else {
            if (data.error == "IP blocked") {
              while(1) {
                alert("Bill Murray Detected.");
              }
            } else {
              $('.sign-in-error').html("Invalid username/password combination").show();
              $('.btn-sign-in').addClass("d-block").show();
              $('.loading').removeClass("d-block").hide();
            }
          }
        })
      }
    });

    // sign up
    $('.btn-sign-up').on('click', function(e) {
      e.preventDefault();
      $('.sign-up-error').hide();
      var username = $('#username').val();
      var password = $('#password').val();
      var verify_password = $('#verify-password').val();
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var email = $('#email').val();
      var role = $('#role').val();

      if (username && password && verify_password && firstname && lastname && email && role && validateUsername(username)) {
        if (password === verify_password) {
          $('.btn-sign-up, .btn-cancel').hide();
          $('.loading').addClass("d-block");
          $.ajax({
            url: '/inc/functions/users/add.php',
            type: 'POST',
            data: {
              username: username,
              password: password,
              firstname: firstname,
              lastname: lastname,
              email: email,
            }
          })
          .done(function(data) {
            if (data.success) {
              window.location.replace("/home");
            } else {
              $('.sign-up-error').html(data.error).show();
              $('.btn-sign-up, .btn-cancel').show();
              $('.loading').removeClass("d-block");
            }
          })
        } else {
          $('.sign-up-error').html("Passwords do not match.").show();
        }
      } else {
        if(!(username && password && verify_password && firstname && lastname && email && role)) {
          $('.sign-up-error').html("You must complete all fields.").show();
        } else {
          $('.sign-up-error').html("Invalid username<br/>No spaces or special characters are allowed.<br/>Must be between 4 to 15 characters long.").show();
        }

      }
    })

    // validate username
    function validateUsername(username) {
      var allowed = "^[a-zA-Z0-9]{4,15}$";
      var pattern = new RegExp(allowed);
      return pattern.test(username);
    }

    // update profile
    $('#edit-profile-form').on('submit', function(e) {
      e.preventDefault();
      $('.edit-profile-error').hide();
      var email = $('#email').val();

      $('.btn-edit-profile, .btn-reset').hide();
      $('.loading-edit-profile').show();

      $.ajax({
        url: '/inc/functions/users/editProfile.php',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
      })
      .done(function(data) {
        if (data.success) {
          window.location.reload();
          // console.log(data);
        } else {
          $('.edit-profile-error').html(data.error).show();
          $('.btn-edit-profile, .btn-reset').show();
          $('.loading-edit-profile').hide();
        }
      })

    });

    // change password
    $('.btn-edit-password').click(function() {
      $('.edit-password-error').hide();
      var password = $('#password').val();
      var verify = $('#verify_password').val();
      if (password === verify) {
        $('.btn-edit-password, .btn-cancel').hide();
        $('.loading-edit-password').show();

        $.ajax({
          url: '/inc/functions/users/editPassword.php',
          type: 'POST',
          data: {
            password: password
          }
        })
        .done(function(data) {
          if (data.success) {
            window.location.reload();
          }
        })
      } else {
        $('.edit-password-error').html("Passwords do not match.").show();
      }
    });


    // delete user
    $('.btn-delete-user').click(function() {
      var id = $('#user-id').val();
      $.ajax({
        url: '/inc/functions/users/delete.php',
        type: 'POST',
        data: {
          id: id
        }
      })
      .done(function(data) {
        if(data.success) {
          // console.log(data.id);
          window.location.replace("/");
        } else {
          console.log(data.error);
        }
      });

    });


    // ##########################################################
    // ##################### POST RELATED #######################
    // ##########################################################

    // Upload post
    $('#add-post-form').on('submit', function(e) {
      e.preventDefault();
      $('.error').hide();
      var title = $('#title').val();
      var category = $('#category').val();
      var city = $('#city').val();
      var state = $('#state').val();
      var price = $('#price').val();
      var content = $('#content').val();
      var author = $('#author').val();

      if(title && category && city && state && price && content) {
        // $('.btn-add-post, .btn-cancel').hide();
        // $('.loading').show();
        $.ajax({
          url: '/inc/functions/posts/add.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
        })
        .done(function(data) {
          if(data.success) {
            window.location.replace("/post/"+data.id);
            // console.log(data);
          } else {
            console.log(data);
            $('.error').html(data.error).show();
            $('.btn-add-post, .btn-cancel').show();
            $('.loading').hide();
          }
        })
      } else {
        $('.error').html('Please complete all fields.').show();
      }
    });


    // Edit post
    $('#edit-post-form').on('submit', function(e) {
      e.preventDefault();
      $('.error').hide();
      var title = $('#title').val();
      var category = $('#category').val();
      var state = $('#state').val();
      var city = $('#city').val();
      var price = $('#price').val();
      var content = $('#content').val();
      var post_id = $('#post_id').val();

      if(title && category && city && state && price && content) {
        $('.btn-edit-post, .btn-cancel').hide();
        $('.loading').show();
        $.ajax({
          url: '/inc/functions/posts/edit.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
        })
        .done(function(data) {
          // console.log(data);
          if(data.success) {
            window.history.go(-1);
            // window.location.replace("/post/"+post_id);
            // console.log(data);
          } else {
            console.log(data);
            $('.error').html(data.error).show();
            $('.btn-edit-post, .btn-cancel').show();
            $('.loading').hide();
          }
        })
      } else {
        $('.error').html('Please complete all fields.').show();
      }
    });

    // search post
    $('.btn-search').click(function() {
      var q = $('.search-query').val();
      q = q.replace(/\s\s+/g, '+');
      q = q.replace(" ","+");
      window.location.replace("/search/"+q);
    });

    // delete post
    $('.btn-delete-post').click(function() {
      var id = $(this).attr("data-id");
      var location = $(this).attr("data-location");
      $.ajax({
        url: '/inc/functions/posts/delete.php',
        type: 'POST',
        data: {
          id: id,
          location: location
        }
      })
      .done(function(data) {
        if(data.success) {
          window.location.replace(data.location);
        } else {
          alert(data.error);
        }
      });

    });

    // vote for post
    $('.btn-rating').click(function() {
      var vote = this.id;
      var author = $('#author').html();
      $.ajax({
        url: '/inc/functions/posts/like.php',
        type: 'POST',
        data: {
          vote: vote,
          author: author,
        }
      })
      .done(function(data) {
        if(data.success) {
          window.location.reload();
        }
      })

    });

    // bookmark the post
    $('.btn-bookmark').click(function() {
      var post_id = $(this).attr("data-id");
      $.ajax({
        url: '/inc/functions/bookmarks/add.php',
        type: 'POST',
        data: {
          post_id: post_id,
        }
      })
      .done(function(data) {
        if(data.success) {
          window.location.reload();
        }
      })

    });



    // ##########################################################
    // ################### COMMENT RELATED ######################
    // ##########################################################

    // add comment
    $('.btn-add-comment').click(function(){
      $('.loading').show();
      $('.btn-add-comment').hide();
      var username = $('#username').html();
      var post_id = $('#post_id').val();
      var comment = $('#comment').val();

      $.ajax({
        url: '/inc/functions/comments/add.php',
        type: 'POST',
        data: {
          username: username,
          post_id: post_id,
          comment: comment
        }
      })
      .done(function(data) {
        if (data.success) {
          window.location.reload();
        } else {
          console.log(data.error);
        }
      })

    });

    // delete comment
    $('.btn-delete-comment').click(function() {
      var id = $(this).attr("data-id");
      $.ajax({
        url: '/inc/functions/comments/delete.php',
        type: 'POST',
        data: {
          id: id,
        }
      })
      .done(function(data) {
        if(data.success) {
          window.location.reload();
        } else {
          alert(data.error);
        }
      });

    });



});
