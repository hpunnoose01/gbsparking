
    <div class="landing d-flex flex-column justify-content-center align-items-center">
            <div class="jumbotron jumbotron-fluid m-0 p-2">
              <div class="container">
                <h1 class="display-4">New User</h1>
                <p class="lead">Please fill out the sign up form below.</p>
                <hr class="my-4">

                <form method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="Enter Username" name="username">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" aria-describedby="password" placeholder="Enter Password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="verify-password">Verify password</label>
                    <input type="password" class="form-control" id="verify-password" aria-describedby="verify-password" placeholder="Enter Again" name="verify-password">
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" aria-describedby="firstname" placeholder="Enter First Name" name="firstname">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" aria-describedby="lastname" placeholder="Enter Last Name" name="lastname">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter E-mail" name="email">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="role" aria-describedby="role" name="role" value="subscriber" hidden>
                  </div>


                  <div class='alert alert-danger sign-up-error error' role='alert'>
                  </div>

                  <img src="/img/loading.gif" alt="" height="30px" class="loading mx-auto">
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sign-up">Sign Up</button>
                    <button type="button" class="btn btn-secondary ml-3 btn-cancel" name="cancel" onclick="window.history.go(-1);">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
