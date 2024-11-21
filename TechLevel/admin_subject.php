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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE SUBJECTS</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal" >Add Subject</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
        <thead class="bg-dark">
            <tr>
              <th class="text-white text-center fw-normal">Subject ID</th>
              <th class="text-white text-center fw-normal">Name</th>
              <th class="text-white text-center fw-normal">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white table_container">
           
        </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Subject</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="fullName" class="form-label">Subject Name</label>
                <input type="text" class="form-control" id="subjectName" placeholder="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="add_subject()">Submit</button>
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

        function confirmDelete(id) {
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
                fun_delete_sub(id);              
            }
          });
        }

        function fun_delete_sub(subjectID) {
            $.ajax({
                type: 'POST',
                url: './action/subject.php', 
                data: { status: 'delete_subject', subject_id: subjectID },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Subject Deleted',
                            text: response.message,
                        }).then(() => {
                          listSubject();
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
                        text: 'An error occurred while deleting the subject.',
                    });
                }
            });
        }

        function add_subject() {
          const subjectName = document.getElementById('subjectName').value;

          const data = {
              status: 'add_subject',
              subject_name: subjectName
          };

          $.ajax({
              type: 'POST',
              url: './action/subject.php', 
              data: data,
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'success') {
                      Swal.fire({
                          icon: 'success',
                          title: 'Subject Added',
                          text: response.message,
                      }).then((result) => {
                          if (result.isConfirmed) {
                            document.getElementById('subjectName').value = "";
                            $('#addModal').modal('hide');
                            listSubject();
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
                      text: 'An error occurred while adding the subject.',
                  });
              }
          });
      }

      function edit_get_id(id) {
          Swal.fire({
              icon: 'question',
              title: 'Edit Subject',
              text: 'Do you want to edit this subject?',
              showCancelButton: true,
              confirmButtonText: 'Edit',
              cancelButtonText: 'Cancel'
          }).then((result) => {
              if (result.isConfirmed) {
                  showEditInput(id);
              }
          });
      }

      function showEditInput(subjectID) {
          Swal.fire({
              input: 'text',
              inputLabel: 'Edit Subject Name',
              inputValue: '', 
              showCancelButton: true,
              confirmButtonText: 'Save',
              cancelButtonText: 'Cancel',
              inputValidator: (value) => {
                  if (!value) {
                      return 'Subject name cannot be empty';
                  }
                  updateSubject(subjectID, value);
              }
          });
      }

      function updateSubject(subjectID, newName) {
          $.ajax({
              type: 'POST',
              url: './action/subject.php', 
              data: { 
                status: 'update_subject', 
                subject_id: subjectID, 
                new_subject_name: newName 
              },
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'success') {
                      Swal.fire({
                          icon: 'success',
                          title: 'Subject Updated',
                          text: response.message,
                      }).then(() => {
                          location.reload();
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
                      text: 'An error occurred while updating the subject.',
                  });
              }
          });
      }


      listSubject();
      function listSubject(){
          $.ajax({
              type: 'POST',
              url: './action/subject.php', 
              data: {
                status : 'list_subject'
              },
              dataType: 'json',
              success: function(response) {
                  console.log(response);
                  if (response.status === 'success') {
                      const subjects = response.subjects;
                      const tableBody = $('.table_container');

                      // Populate table rows with subjects data
                      var row = ``;
                      subjects.forEach(function(subject) {
                          row += `
                          <tr>
                              <td class='text-center'>${subject.id}</td>
                              <td class='text-center'>${subject.name}</td>
                              <td class="text-center">
                                  <button class="btn btn-danger" onclick="confirmDelete(${subject.id})">Delete</button>
                                  <button class="btn btn-success" onclick="edit_get_id(${subject.id})">Edit</button>
                              </td>
                          </tr>`;
                      });
                      tableBody.html(row);
                  } else {
                      console.log('Error loading subjects');
                  }
              },
              error: function() {
                  console.log('An error occurred during data loading');
              }
          });
      }


    </script>
  </body>
</html>