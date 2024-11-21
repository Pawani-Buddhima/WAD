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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Register For Classes</h3>
        <hr/>
        <div class="text-start p-3">
            <h5>Filter Classes</h5>
            <div class="row text-start ">
                <div class="col">
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select class="form-select" id="grade" >
                          <option value="">Select Grade...</option>
                          <option value="12">Grade 12</option>
                          <option value="13">Grade 13</option>
                        </select>
                     </div>
                </div>
                <div class="col">
                    
                    <div class="form-group">
                <label for="classType">Class Type</label>
                <select  class="form-select" id="classType" >
                  <option value="">Select Class Type...</option>
                  <option value="Theory">Theory</option>
                  <option value="Practical">Practical</option>
                </select>
              </div>
                </div>
            </div>
            <div class="pt-3 text-end">
                <button class="btn btn-danger" onclick="clear_all()">Clear</button>
                <button class="btn btn-success" onclick="search_Class()">Filter</button>
                <button class="btn btn-outline-dark" onclick="window.location.href='std_dashboard.php'">Back</button>
            </div>
        </div>
        </table>
    </div>
      
     <div class="container bg-white mt-5 rounded pb-5  pr-">
        <div class="row row-cols-1 row-cols-md-4 g-4 class_container">

            
           
        
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
        var student_id = getCookie("username"); 
        

        function apply_for_class_next(class_id) {
            var data = {
                status: 'when_class_id_give_get_avaible_tutor_list',
                class_id: class_id
            };

            $.ajax({
                type: 'POST',
                url: './action/class.php',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.available_tutors && response.available_tutors.length > 0) {
                        var tutorList = response.available_tutors;

                        var dropdownOptions = {};
                        for (var i = 0; i < tutorList.length; i++) {
                            dropdownOptions[tutorList[i].id] = tutorList[i].name;
                        }

                        Swal.fire({
                            title: 'Select a Tutor',
                            input: 'select',
                            inputOptions: dropdownOptions,
                            inputPlaceholder: 'Select a tutor',
                            showCancelButton: true,
                            confirmButtonText: 'Submit',
                            cancelButtonText: 'Cancel',
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'You must select a tutor!'
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                var selectedTutorId = result.value;
                                
                                apply_for_class(selectedTutorId);

                            }
                        });
                    } else {
                        console.log('No available tutors found for the class.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred while fetching available tutor data.');
                }
            });
        }


        function apply_for_class(class_id) {
            
            var formData = new FormData();
            formData.append('status', 'registerForClass');
            formData.append('student_id', student_id); 
            formData.append('class_id', class_id);
            
            $.ajax({
                url: './action/class_reg.php', 
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful!',
                            text: 'Your registration request is  sent to the tutor.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }else if(response.status === "warning"){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Registration Failed',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                     else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: 'There was an error while registering for the class.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'An error occurred on the server.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }


        function search_Class(){
          var grade = document.getElementById("grade").value;
          var classType = document.getElementById("classType").value;

          $.ajax({
              type: 'POST',
              url: './action/class.php', 
              data: {
                  status: 'searchClass',
                  grade: grade,
                  classType: classType
              },
              dataType: 'json',
              success: function(data) {
            
                const classContainer = $('.class_container'); 
                var classCard = ``;
                  for (var i = 0; i < data.length; i++) {
                      var classInfo = data[i];
                      classCard += `
                          <div class="col">
                              <div class="card" style="background-color: #EDEBD9;">
                                  <div class="card-body">
                                      <h4 class="card-title">${classInfo.subject_name}</h4>
                                      <ul>
                                          <li>Class Type : ${classInfo.class_type}</li>
                                          <li>Grade : ${classInfo.grade}</li>
                                      </ul>
                                  </div>
                                  <div class="card-footer text-end">
                                      <button class="btn btn-outline-dark" onclick="apply_for_class_next(${classInfo.class_id})">Study -></button>
                                  </div>
                              </div>
                          </div>
                      `;
                    }
                    classContainer.html(classCard);
                    
              },
              error: function() {
                  console.error('Error searching for classes');
              }
          });
        }

        function clear_all(){
          allData();
        }

        allData();
        function allData(){
            $.ajax({
                url: './action/class.php', 
                type: 'post', 
                data:{
                  status : "list_Class"
                },
                dataType: 'json',
                success: function(data) {
                    const classContainer = $('.class_container'); 
                    console.log(data);
                    var card = ``;
                    for (const classInfo of data.classes) {
                      card += `
                        <div class="col">
                            <div class="card" style="background-color: #EDEBD9;">
                                <div class="card-body">
                                    <h4 class="card-title">${classInfo.subject_name}</h4>
                                    <ul>
                                        <li>Class Type : ${classInfo.class_type}</li>
                                        <li>Grade : ${classInfo.grade}</li>
                                    </ul>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-outline-dark" onclick="apply_for_class_next(${classInfo.class_id})">Next -></button>
                                </div>
                            </div>
                        </div>
                        `;

                      }
                      classContainer.html(card);
                },
                error: function() {
                    console.error('Error fetching class data');
                }
            });
        }

       

    </script>
  </body>
</html>