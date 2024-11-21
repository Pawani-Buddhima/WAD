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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE STUDENTS</h3>
        <hr/>
        <div class="text-end">
          <!-- <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Student</button> -->
          <button class="btn btn-outline-dark" onclick="window.location.href='tutor_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
        <thead class="bg-dark">
            <tr>
                <th class="text-white fw-normal">ID</th>
                <th class="text-white fw-normal">Name</th>
                <th class="text-white fw-normal">Address</th>
                <th class="text-white fw-normal">Telephone Number</th>
                <th class="text-white fw-normal">Date of Birth</th>
                <th class="text-white fw-normal">Created At</th>
                <th class="text-white text-center fw-normal">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white" id="std_table">
           
        </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Student</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <input type="text" class="form-control" id="tel_no" placeholder="Enter telephone number">
                </div>
                <div class="form-group pt-3">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success">Submit</button>
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

        
       function getCookie(name) {
            var nameEQ = name + "=";
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1, cookie.length);
                }
                if (cookie.indexOf(nameEQ) === 0) {
                    return cookie.substring(nameEQ.length, cookie.length);
                }
            }
            return null;
       }
       var tutor_id = getCookie("username"); 

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
              // Perform delete operation here
              Swal.fire(
                'Deleted!',
                'Your data has been deleted.',
                'success'
              );
            }
          });
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
                // Perform delete operation here
                Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                );
                }
            });
        }

        load_tb(tutor_id);
        function load_tb(tutor_id){
          $.ajax({
              type: 'POST',
              url: './action/class_reg.php', 
              data: {
                  status: 'getStudentListForTutor',
                  tutor_id: tutor_id
              },
              dataType: 'json',
              success: function(response) {
                console.log(response);
                if (response.status === 'success') {
                      var studentList = response.studentList;
                      var tableBody = $('#std_table');
                      console.log(studentList);
                      tableBody.empty(); 
                      for (var i = 0; i < studentList.length; i++) {
                          var student = studentList[i];
                          var newRow = $('<tr>');
                          newRow.append($("<td>").text(student.student_id));
                          newRow.append($("<td>").text(student.Name));
                          newRow.append($("<td>").text(student.Address));
                          newRow.append($("<td>").text(student.TelephoneNumber));
                          newRow.append($("<td>").text(student.DateOfBirth));
                          newRow.append($("<td>").text(student.registration_date));
                          
                          var actionCell = $("<td class='text-center'>");
                          if (student.status === 'pending') {
                              actionCell.append("<button class='btn btn-danger' onclick='rejectDelete(" + student.registration_id + ")'>Reject</button>&nbsp;");
                              actionCell.append("<button class='btn btn-primary' onclick='acceptDelete(" + student.registration_id + ")'>Accept</button>");
                          } else {
                              actionCell.append("<button class='btn btn-dark text-uppercase' disabled>"+(student.status)+"</button>"); 
                          }

                          newRow.append(actionCell);

                          tableBody.append(newRow);
                      }
                  } else {
                      console.log(response.message); 
                  }
              },
              error: function(xhr, status, error) {
                  console.log(error);
                  console.log('An error occurred while fetching student list.');
              }
          });
        }

        function rejectDelete(registration_id) {
            Swal.fire({
                title: 'Reject Student Registration',
                text: 'Are you sure you want to reject this student registration?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Reject'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateRegistrationStatus(registration_id, 'reject');
                }
            });
        }

        function acceptDelete(registration_id) {
            Swal.fire({
                title: 'Accept Student Registration',
                text: 'Are you sure you want to accept this student registration?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Accept'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateRegistrationStatus(registration_id, 'accept');
                }
            });
        }

        function updateRegistrationStatus(registration_id, action) {
            $.ajax({
                type: 'POST',
                url: './action/class_reg.php', 
                data: {
                    status: 'studentRegRejectOrAccept',
                    registration_id: registration_id,
                    action: action
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Student registration status updated successfully.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                          load_tb(tutor_id);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update student registration status.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating student registration status.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }


    </script>
  </body>
</html>