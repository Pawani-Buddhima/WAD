<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <title>TechLevel.</title>

  </head>
  <body class="bg_color" >
    <div class="container" >
        <div class="row row-cols-1 row-cols-md-3 g-4 " style="margin-top: 7%;">
            <div class="col">
            
            </div>
            <div class="col">
                <div class="card">
                    <center>
                        <img src="./img/man.png" class="card-img-top pt-5" alt="..." style="width: 40%;">
                    </center>
                    <div class="card-body">
                        <div class="mb-3 pt-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="">
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" placeholder="">
                        </div>
                        <div class="mb-3 pt-1">
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark text-uppercase" onclick="submit()">Submit</button>
                            </div>
                            <br/>
                            <hr/>
                            <center>
                                <h6 style="cursor: pointer;" onclick="window.location.href='std_reg.php'">Student Registration</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
            
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function submit() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('pass').value;

            const data = {
                status: 'reg_login',
                username: username,
                password: password
            };

            $.ajax({
                type: 'POST',
                url: './action/user_action.php', 
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Welcome!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =  response.userType+"_dashboard.php?i="+response.id;
                                setCookie("username", response.id, 7);
                            }

                            
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during login.',
                    });
                }
            });
        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>