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
                        <h3 class="pt-4">Student Registration</h3>
                    </center>
                    <div class="card-body">
                         <div class="form-group pt-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name">
                        </div>
                        <div class="form-group pt-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter address">
                        </div>
                        <div class="form-group pt-3">
                            <label for="tel_no">Telephone Number</label>
                            <input type="text" class="form-control" id="tel_no" placeholder="Enter telephone number" oninput="tel_num_valid()">
                            <small id="valid_tel"></small>
                        </div>
                        <div class="form-group pt-3">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth">
                        </div>
                        <!-- <div class="form-group pt-3">
                          <label for="grade">Grade</label>
                          <select class="form-select" id="grade" >
                            <option value="">Select Grade...</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                          </select>
                        </div> -->
                        <!-- <div class="form-group pt-3">
                          <label for="tutor">Tutor</label>
                           <select class="form-select" id="tutor" >
                            <option value="">Select Tutor...</option>
                            <option value="1">1</option>
                          </select>
                        </div> -->
                        <!-- <div class="form-group pt-3">
                          <label for="Subject">Subject</label>
                          <select class="form-select" id="Subject" >
                            <option value="">Select Subject...</option>
                            <option value="1">1</option>
                          </select>
                        </div> -->
                        <div class="form-group pt-3">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" id="pass" oninput="pass_validate()">
                            <small id="pass_validate_status"></small>
                        </div>
                        <div class="form-group pt-3">
                            <label for="cpass">Confirm - Password</label>
                            <input type="password" class="form-control" id="cpass" oninput="pass_matching()">
                            <small id="pass_matching_status"></small>
                        </div>
                        <div class="mb-3 pt-4">
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark text-uppercase" onclick="submit()">Submit</button>
                            </div>
                            <br/>
                            <hr/>
                            <center>
                                <h6 style="cursor: pointer;" onclick="window.location.href='index.php'">Login Page</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
            
            </div>
        </div>
    </div>
    <br/><br/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function tel_num_valid() {
          var telInput = document.getElementById('tel_no');
          var validTelMessage = document.getElementById('valid_tel');
          var telPattern = /^\d{10}$/; // Change this pattern based on your validation criteria

          if (telPattern.test(telInput.value)) {
              validTelMessage.textContent = ''; // Clear any previous validation message
              telInput.classList.remove('is-invalid'); // Remove any error styling
              telInput.classList.add('is-valid'); // Apply valid styling
          } else {
              validTelMessage.textContent = 'Please enter a valid 10-digit telephone number.';
              telInput.classList.remove('is-valid'); // Remove valid styling
              telInput.classList.add('is-invalid'); // Apply error styling
          }
        }

        function submit() {
            const name = document.getElementById('name').value;
            const address = document.getElementById('address').value;
            const telephoneNumber = document.getElementById('tel_no').value;
            const dateOfBirth = document.getElementById('date_of_birth').value;
            const grade = "0";
            const tutor = "0";
            const subject = "0";
            const pass = document.getElementById('pass').value;

            const data = {
                status: 'reg_std',
                name: name,
                address: address,
                telephoneNumber: telephoneNumber,
                dateOfBirth: dateOfBirth,
                grade: grade,
                tutor: tutor,
                subject: subject,
                pass: pass
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
                            title: 'Registration Successful',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                        window.location.href = "./index.php";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during registration.',
                    });
                }
            });
        }

        function pass_validate() {
          const passInput = document.getElementById('pass');
          const passValidationStatus = document.getElementById('pass_validate_status');

          const password = passInput.value;
          const isValid = password.length >= 8; // Add your validation criteria here

          if (isValid) {
              passValidationStatus.textContent = 'Password is valid.';
              passValidationStatus.classList.add('text-success');
              passValidationStatus.classList.remove('text-danger');
          } else {
              passValidationStatus.textContent = 'Password must be at least 8 characters.';
              passValidationStatus.classList.add('text-danger');
              passValidationStatus.classList.remove('text-success');
          }
        }

        function pass_matching() {
            const passInput = document.getElementById('pass');
            const cpassInput = document.getElementById('cpass');
            const passMatchingStatus = document.getElementById('pass_matching_status');

            const password = passInput.value;
            const confirmPass = cpassInput.value;

            if (password === confirmPass) {
                passMatchingStatus.textContent = 'Passwords match.';
                passMatchingStatus.classList.add('text-success');
                passMatchingStatus.classList.remove('text-danger');
            } else {
                passMatchingStatus.textContent = 'Passwords do not match.';
                passMatchingStatus.classList.add('text-danger');
                passMatchingStatus.classList.remove('text-success');
            }
        }


    </script>
  </body>
</html>