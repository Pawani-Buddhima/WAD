<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6"></script>

    <title>TechLevel.</title>

  </head>
  <body class="bg_color" >
    <?php include './common/header.php'; ?>
    <div class="container bg-white mt-5 rounded pb-5  pr-">
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE TUTOR</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Tutor</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
          <thead class="bg-dark">
              <tr>
                <th class="text-white text-center fw-normal">Tutor ID</th>
                <th class="text-white text-center fw-normal">Name</th>
                <th class="text-white text-center fw-normal">Telephone Number</th>
                <th class="text-white text-center fw-normal">Timestamp</th>
                <th class="text-white text-center fw-normal">Action</th>
              </tr>
          </thead>
          <tbody class="bg-white tbl_container" id="classTableBody">
              
          </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Tutors</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" placeholder="">
              </div>
              <div class="mb-3">
                <label for="telephone" class="form-label">Telephone Number</label>
                <input type="text" class="form-control" id="telephone" placeholder="" oninput="tel_validation()">
                <small id="tel_status"></small>
              </div>
              <div class="mb-3">
                <label for="passs" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" placeholder="" oninput="passValidation()">
                <small id="pass_status"></small>
              </div>
              <div class="mb-3">
                <label for="cpass" class="form-label">Confirm - Password</label>
                <input type="password" class="form-control" id="cpass" placeholder="" oninput="cpassValidation()">
                <small id="cpass_status"></small>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="save_Data()">Submit</button>
            </div>
          </div>
        </div>
    </div>
      
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Tutor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editFullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="editFullName" placeholder="" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editTelephone" class="form-label">Telephone Number</label>
                        <input type="text" class="form-control" id="editTelephone" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="editPass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPass" placeholder="" oninput="passValidationFun()">
                        <small id="editPass_status"></small>
                    </div>
                    <div class="mb-3">
                        <label for="editCpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="editCpass" placeholder="" oninput="cpassValidationFun()">
                        <small id="editCpass_status"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="update_Data()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="arrageClassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Arrange Class</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class=" p-3 rounded" style="background-color: #F1F1F1;">
                <h5>Arrange Class</h5>
                <hr/>
                <div class="row">
                  <div class="col">
                      <div class="mb-3">
                        <label for="classId" class="form-label">Class ID</label>
                        <select class="form-select" id="classId">
                          <option value="">Select Class Id</option>
                        </select>
                        <input type="hidden" id="tutor_id" />
                      </div>
                  </div>
                  <div class="col">
                   
                    <button class="btn btn-dark mt-4" onclick="save_class()">Save</button>
                  </div>
                </div>
              </div>
              <div class="mt-2">
                    <table class="table mt-2" >
                      <thead class="bg-dark">
                          <tr>
                            <th class="text-white text-center fw-normal">Class ID</th>
                            <th class="text-white text-center fw-normal">Subject</th>
                            <th class="text-white text-center fw-normal">Grade</th>
                            <th class="text-white text-center fw-normal">Class Type</th>
                          </tr>
                      </thead>
                      <tbody class="bg-white" id="tutor_class">
                          
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    
      
     <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php include './common/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
       function tel_validation() {
          const telephoneInput = document.getElementById('telephone');
          const telephoneStatus = document.getElementById('tel_status');
          const telephoneValue = telephoneInput.value;

          // Simple telephone number validation
          const validPattern = /^\d{3}\d{3}\d{4}$/;

          if (validPattern.test(telephoneValue)) {
            telephoneStatus.textContent = 'Valid telephone number.';
            telephoneStatus.style.color = 'green';
          } else {
            telephoneStatus.textContent = 'Invalid telephone number. Please enter in the format 0XXXXXXXXX.';
            telephoneStatus.style.color = 'red';
          }
        }

        function passValidationFun() {
            const passField = document.getElementById("editPass");
            const passStatus = document.getElementById("editPass_status");

            if (passField.value.length < 8) {
                passStatus.innerText = "Password must be at least 8 characters long";
                passStatus.style.color = 'red';
            } else {
                passStatus.innerText = "Strong Password";
                passStatus.style.color = 'green';
            }
        }

        function cpassValidationFun() {
            const passField = document.getElementById("editPass");
            const cpassField = document.getElementById("editCpass");
            const cpassStatus = document.getElementById("editCpass_status");

            if (passField.value !== cpassField.value) {
                cpassStatus.innerText = "Passwords do not match";
                passStatus.style.color = 'red';
            } else {
                cpassStatus.innerText = "Passwords are matched.";
                passStatus.style.color = 'green';
            }
        }


        function confirmDelete() {
          Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
             fun_delete_tutor();
            }
          });
        }

        function passValidation() {
          const passwordInput = document.getElementById('pass');
          const passwordStatus = document.getElementById('pass_status');
          const passwordValue = passwordInput.value;

          // Password validation rules
          const minLength = 8;
          const containsUppercase = /[A-Z]/.test(passwordValue);
          const containsLowercase = /[a-z]/.test(passwordValue);
          const containsDigit = /[0-9]/.test(passwordValue);

          if (passwordValue.length < minLength || !containsUppercase || !containsLowercase || !containsDigit) {
            passwordStatus.textContent = 'Password must be at least 8 characters long and contain an uppercase letter, a lowercase letter, and a digit.';
            passwordStatus.style.color = 'red';
          } else {
            passwordStatus.textContent = 'Password is valid.';
            passwordStatus.style.color = 'green';
          }
        }

        function cpassValidation() {
          const passwordInput = document.getElementById('pass');
          const confirmPasswordInput = document.getElementById('cpass');
          const confirmPasswordStatus = document.getElementById('cpass_status');
          const confirmPasswordValue = confirmPasswordInput.value;

          if (passwordInput.value !== confirmPasswordValue) {
            confirmPasswordStatus.textContent = 'Passwords do not match.';
            confirmPasswordStatus.style.color = 'red';
          } else {
            confirmPasswordStatus.textContent = 'Passwords match.';
            confirmPasswordStatus.style.color = 'green';
          }
        }

        function save_Data() {

              const fullName = document.getElementById('fullName').value;
              const telephone = document.getElementById('telephone').value;
              const pass = document.getElementById('pass').value;
              const cpass = document.getElementById('cpass').value;

              if (pass !== cpass) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Passwords do not match',
                      text: 'Please make sure the passwords match.',
                  });
                  return;
              }

              const data = {
                  status: 'add_tutor',
                  name: fullName,
                  tel_no: telephone,             
                  pass: pass              
              };

              $.ajax({
                  type: 'POST',
                  url: './action/tutor.php',
                  data: data,
                  dataType: 'json',
                  success: function(response) {
                      if (response.status === 'success') {
                          Swal.fire({
                              icon: 'success',
                              title: 'Tutor Added',
                              text: response.message,
                          }).then((result) => {
                              if (result.isConfirmed) {

                                  document.getElementById('fullName').value = '';
                                  document.getElementById('telephone').value = '';
                                  document.getElementById('pass').value = '';
                                  document.getElementById('cpass').value = '';
                                  loadTutorData();
                                  $('#addModal').modal('hide');

                              }
                          });
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: response.message,
                          });
                      }
                  },
                  error: function() {
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'An error occurred while adding the tutor.',
                      });
                  }
              });
        }

     
        loadClassIds();
        function loadClassIds() {
            $.ajax({
                type: 'POST',
                url: './action/class.php',
                data: { status: 'list_Class' },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const classes = response.classes;
                        const classSelect = document.getElementById('classId');
                        classSelect.innerHTML = '<option value="">Select Class Id</option>'; // Clear and set default option

                        classes.forEach(function(clazz) {
                            const option = document.createElement('option');
                            option.value = clazz.class_id;
                            option.textContent = `${clazz.grade} - ${clazz.subject_name} - ${clazz.class_type}`;
                            classSelect.appendChild(option);
                        });
                    } else {
                        console.log('Error loading class IDs');
                    }
                },
                error: function() {
                    console.log('An error occurred during data loading');
                }
            });
        }

        loadTutorData();
        function loadTutorData() {
            $.ajax({
                type: 'POST',
                url: './action/tutor.php', 
                data: { status: 'list_tutors' },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const tutors = response.tutors;
                        const tableBody = document.getElementById('classTableBody');
                        tableBody.innerHTML = ''; 

                        tutors.forEach(function(tutor) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td class="text-center">${tutor.tutor_id}</td>
                                <td class="text-center">${tutor.name}</td>
                                <td class="text-center">${tutor.tel_no}</td>
                                <td class="text-center">${tutor.time_stamp}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger" onclick="confirmDeleteTutor(${tutor.tutor_id})">Delete</button>
                                    <button class="btn btn-success" onclick="editTutor(${tutor.tutor_id})">Edit</button>
                                    <button class="btn btn-primary" onclick="arrangeClass(${tutor.tutor_id})">Arrage</button>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        console.log('Error loading tutor data');
                    }
                },
                error: function() {
                    console.log('An error occurred during data loading');
                }
            });
        }

        function confirmDeleteTutor(id) {
            Swal.fire({
                icon: 'question',
                title: 'Delete Tutor',
                text: 'Are you sure you want to delete this tutor?',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    $.ajax({
                        type: 'POST',
                        url: './action/tutor.php', 
                        data: { status: 'delete_tutor', tutor_id: id },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Tutor Deleted',
                                    text: response.message,
                                }).then(() => {
                                    loadTutorData(); 
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while deleting the tutor.',
                            });
                        }
                    });
                }
            });
        }

        function editTutor(id) {
            $.ajax({
                type: 'POST',
                url: './action/tutor.php', 
                data: { status: 'fetch_Tutor', tutor_id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const tutorData = response.tutorData;
                        document.getElementById('editFullName').value = tutorData.name;
                        document.getElementById('editTelephone').value = tutorData.tel_no;

                        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                        editModal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while fetching tutor data.',
                    });
                }
            });
        }

        function arrangeClass(id){
          document.getElementById("tutor_id").value = id;
          get_all_class_for_tutor(id);
          $('#arrageClassModal').modal('show');
        }

        function get_all_class_for_tutor(tutorid) {
            var data = {
                status: 'tutor_class_list',
                tutor_id: tutorid
            };

            $.ajax({
                type: 'POST',
                url: './action/class.php', 
                data: data,
                dataType: 'json', 
                success: function(response) {
                  var tableBody = $("#tutor_class");
                      tableBody.empty();
                    if (response.classes && response.classes.length > 0) {
                          var classData = response.classes;
                          

                          classData.forEach(function (classItem) {
                              var newRow = $("<tr>");

                              newRow.append($("<td class='text-center'>").text(classItem.class_id));
                              newRow.append($("<td class='text-center'>").text(classItem.subject_name));
                              newRow.append($("<td class='text-center'>").text(classItem.grade));
                              newRow.append($("<td class='text-center'>").text(classItem.class_type));


                              tableBody.append(newRow);
                          });
                    } else {
                        console.log('No classes found for the tutor.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred while fetching class data.');
                }
            });
        }


        function save_class() {
          var tutor_id = document.getElementById("tutor_id").value; 
          var class_id = document.getElementById("classId").value; 

          var data = {
              status: 'allocate_tutor',
              tutor_id: tutor_id,
              class_id: class_id
          };

          $.ajax({
              type: 'POST',
              url: './action/class.php', 
              data: data,
              success: function(response) {
                console.log(response);
                if(parseInt(response) == 2){
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ops!',
                      text: 'Already tutor has allocated to class',
                  });
                }else{
                  Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Tutor allocated to the class.',
                  });
                  get_all_class_for_tutor(tutor_id);
                }
              },
              error: function(xhr, status, error) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'An error occurred while saving data.',
                  });
              }
          });
      }

      function update_Data(){
        $.ajax({
            type: "POST",
            url: "./action/tutor.php", 
            data: {
                status: "update_tutor",
                tel_no: document.getElementById('editTelephone').value,
                pass: document.getElementById('editPass').value
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                          $('#editModal').modal('hide');
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating the tutor.',
                    confirmButtonText: 'OK'
                });
            }
        });
      }

    </script>
  </body>
</html>