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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE class</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Class</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
        <thead class="bg-dark">
            <tr>
              <th class="text-white text-center fw-normal">Class ID</th>
              <th class="text-white text-center fw-normal">Grade</th>
              <th class="text-white text-center fw-normal">Subject </th>
              <th class="text-white text-center fw-normal">Class Type</th>
              <th class="text-white text-center fw-normal">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white" id="class_tbl_body">
           
        </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Class</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group pt-3">
                <label for="grade">Grade</label>
                <select class="form-control" id="grade" >
                  <option value="">Select Grade...</option>
                  <option value="12">Grade 12</option>
                  <option value="13">Grade 13</option>
                </select>
              </div>
              <div class="form-group pt-3">
                <label for="subjectId">Subject ID</label>
                <select class="form-control " id="subjectId" >
                  <option value="">Select Subject...</option>
                 
                </select>
              </div>
              <div class="form-group pt-3">
                <label for="classType">Class Type</label>
                <select  class="form-control" id="classType" >
                  <option value="">Select Class Type...</option>
                  <option value="Theory">Theory</option>
                  <option value="Practical">Practical</option>
                </select>
              </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="save_data()">Submit</button>
            </div>
          </div>
        </div>
    </div>
      
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Subject</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group pt-3">
                <label for="grade">Grade</label>
                <input type="text" class="form-control" id="editGrade" disabled />
                <input type="hidden" class="form-control" id="editClassId"  />
              </div>
              <div class="form-group pt-3">
                <label for="subjectId">Subject ID</label>
                <input type="text" class="form-control" id="editSubject" disabled />
              </div>
              <div class="form-group pt-3">
                <label for="classType">Class Type</label>
                <select  class="form-control" id="editClassType" >
                  <option value="">Select Class Type...</option>
                  <option value="Theory">Theory</option>
                  <option value="Practical">Practical</option>
                </select>
              </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="edit_action_class()">Edit</button>
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
      function save_data() {
            const grade = document.getElementById('grade').value;
            const subjectId = document.getElementById('subjectId').value;
            const classType = document.getElementById('classType').value;

            const data = {
                status: 'add_Class',
                grade: grade,
                subject_id: subjectId,
                class_type: classType
            };

            $.ajax({
                type: 'POST',
                url: './action/class.php', 
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Class Added',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('grade').value = '';
                                document.getElementById('subjectId').value = '';
                                document.getElementById('classType').value = '';
                                
                                $('#addModal').modal('hide');
                                loadClassData();
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
                        text: 'An error occurred while adding the class.',
                    });
                }
            });
      }

      loadSubjects();
      function loadSubjects() {
        $.ajax({
            type: 'POST',
            url: './action/subject.php',
            data: { status: 'list_subject' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const subjects = response.subjects;
                    const subjectSelect = document.getElementById('subjectId');

                    subjects.forEach(function(subject) {
                        const option = document.createElement('option');
                        option.value = subject.id; 
                        option.textContent = subject.name; 
                        subjectSelect.appendChild(option);
                    });
                } else {
                    console.log('Error loading subjects');
                }
            },
            error: function() {
                console.log('An error occurred during data loading');
            }
        });
    }

    function loadClassData() {
        $.ajax({
            type: 'POST',
            url: './action/class.php', 
            data: { status: 'list_Class' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const classTableBody = document.getElementById('class_tbl_body');
                    classTableBody.innerHTML = ''; 

                    const classes = response.classes;

                    classes.forEach(function(clazz, index) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class='text-center'>${index + 1}</td>
                            <td class='text-center'>Grade ${clazz.grade}</td>
                            <td class='text-center'>${clazz.subject_name}</td>
                            <td class='text-center'>${clazz.class_type}</td>
                            <td class="text-center">
                                <button class="btn btn-danger" onclick="confirmDelete(${clazz.class_id})">Delete</button>
                                <button class="btn btn-success" onclick="editClass(${clazz.class_id})">Edit</button>
                            </td>
                        `;
                        classTableBody.appendChild(row);
                    });
                } else {
                    console.log('Error loading class data');
                }
            },
            error: function() {
                console.log('An error occurred during data loading');
            }
        });
    }

    $(document).ready(function() {
        loadClassData();
    });

    function confirmDelete(id) {
        Swal.fire({
            icon: 'warning',
            title: 'Confirm Deletion',
            text: 'Are you sure you want to delete this class?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteClass(id); 
            }
        });
    }

    function deleteClass(id) {
        $.ajax({
            type: 'POST',
            url: './action/class.php', 
            data: { status: 'delete_Class', class_id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Class Deleted',
                        text: response.message,
                    }).then(() => {
                        loadClassData(); 
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
                    text: 'An error occurred while deleting the class.',
                });
            }
        });
    }

    function editClass(classId) {
          $.ajax({
              type: 'POST',
              url: './action/class.php', 
              data: { 
                status: 'fetch_Class', 
                class_id: classId 
              },
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'success') {
                      const classData = response.classData;
                      
                      document.getElementById('editGrade').value = classData.grade;
                      document.getElementById('editSubject').value = classData.subject_name;
                      document.getElementById('editClassType').value = classData.class_type;
                      document.getElementById('editClassId').value = classData.class_id;
                      
                      $('#editModal').modal('show');
                  } else {
                      console.log('Error fetching class data');
                  }
              },
              error: function() {
                  console.log('An error occurred during data fetching');
              }
          });
      }

      function edit_action_class() {
            Swal.fire({
                icon: 'question',
                title: 'Edit Class Type',
                text: 'Are you sure you want to edit the class type?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var classId = document.getElementById('editClassId').value;
                    var newClassType =  document.getElementById('editClassType').value;

                    $.ajax({
                        type: 'POST',
                        url: './action/class.php', 
                        data: { 
                          status: 'update_Class', 
                          class_id: classId, 
                          new_class_type: newClassType 
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Class Type Updated',
                                    text: response.message,
                                }).then(() => {
                                    loadClassData(); 
                                    $('#editModal').modal('hide');
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
                                text: 'An error occurred while updating the class type.',
                            });
                        }
                    });
                }
            });
      }


    </script>
  </body>
</html>