<?php if(isset($_SESSION['loggedIn'])) { header("Location: /home"); }?>


    <div class="landing d-flex flex-column justify-content-center align-items-center">
      <h1 class="text-dark text-center landing-title">Marketplace 4989</h1>
      <form id="login-form">
        <h2 class="text-dark mb-4 text-center">Sign In</h2>
        <div class="form-group text-center">
          <div class="icon-input">
            <i class="fa fa-user"></i>
            <input type="text" name="username" id="username" placeholder="Username">
          </div>
        </div>
        <div class="form-group text-center">
          <div class="icon-input">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password">
          </div>
        </div>
        <div class='alert alert-danger sign-in-error error' role='alert'></div>
        <img src="/img/loading.gif" alt="" height="30px" class="loading mx-auto">
        <button type="submit" class="btn btn-primary mx-auto d-block btn-sign-in" name="sign-in" disabled>Sign In</button>
      </form>
      <div id="sign-up" class="text-center mt-3">
        <p class="mb-2"><a href="/sign-up">Sign Up</a></p>
        <p><a href="/home">Continue as Guest</a></p>
      </div>
    </div>
