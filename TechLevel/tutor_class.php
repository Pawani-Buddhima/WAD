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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">View classes</h3>
        <hr/>
        <div class="text-end">
          
          <button class="btn btn-outline-dark" onclick="window.location.href='tutor_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
          <thead class="bg-dark">
              <tr>
                <th class="text-white text-center fw-normal">Class ID</th>
                <th class="text-white text-center fw-normal">Subject </th>
                <th class="text-white text-center fw-normal">Grade</th>
                <th class="text-white text-center fw-normal">Class Type</th>
                <th class="text-white text-center fw-normal">Status</th>
                <th class="text-white text-center fw-normal">Action</th>
              </tr>
          </thead>
          <tbody class="bg-white" id="tutor_class">
            
          </tbody>
        </table>
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

        get_all_class_for_tutor(tutor_id);
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
                  console.log(response);
                  
                    if (response.classes && response.classes.length > 0) {
                          var classData = response.classes;
                          var tableBody = $("#tutor_class");
                              tableBody.empty();

                          classData.forEach(function (classItem) {
                              var newRow = $("<tr>");

                              newRow.append($("<td class='text-center'>").text(classItem.class_id));
                              newRow.append($("<td class='text-center'>").text(classItem.name));
                              newRow.append($("<td class='text-center'>").text(classItem.grade));
                              newRow.append($("<td class='text-center'>").text(classItem.class_type));
                              newRow.append($("<td class='text-center'>").text(classItem.status === 'class_end' ? 'Class Ended' : 'Class Running'));
                              newRow.append($("<td class='text-center'>").html('<a class="btn btn-primary" onclick="class_end('+classItem.subject_name+')">Status Change</a>'));
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

        function class_end(class_id) {
          
          $.ajax({
              type: 'POST',
              url: './action/class.php', 
              data: {
                  status: 'statusChangeClass',
                  class_id: class_id,
              },
              dataType: 'json',
              success: function(response) {
                  console.log(response);
                  
                  if (response.status === 'success') {
                      Swal.fire({
                          icon: 'success',
                          title: 'Class Status Changed',
                          text: 'The status has been successfully changed.',
                          confirmButtonText: 'OK'
                      }).then((result) => {
                        get_all_class_for_tutor(tutor_id);
                      });
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'Failed to change the class status. Please try again.',
                          confirmButtonText: 'OK'
                      });
                  }
              },
              error: function(xhr, status, error) {
                  console.log(error);
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'An error occurred while trying to end the class.',
                      confirmButtonText: 'OK'
                  });
              }
          });
      }

    </script>
  </body>
</html>