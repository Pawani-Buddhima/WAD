<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"><span class="fw-bolder text-danger" style="font-size: 30px;">Tech</span><span class="fw-bolder text-warning" style="font-size: 30px;">Level</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="contactUs.html">Contact Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"  data-bs-toggle="modal" data-bs-target="#termModal" >Terms</a>
            </li>
        </ul>
        <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="Terms" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                 
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center">Terms and Conditions - TechLevel</h1>
                    <hr/>
                    <br/>
                    <h2>Introduction</h2>
                    <p>Welcome to our Education System. These terms and conditions outline the rules and regulations for the use of our educational services.</p>

                    <h2>Use of Educational Materials</h2>
                    <p>Our educational materials, including but not limited to lessons, study guides, quizzes, and assignments, are provided for educational purposes only.</p>
                    <p>You may access and use these materials for personal and non-commercial purposes. Redistribution, modification, or unauthorized use of our educational materials is strictly prohibited.</p>

                    <h2>User Responsibilities</h2>
                    <p>By using our Education System, you agree to:</p>
                    <ul>
                      <li>Use the educational materials responsibly and for educational purposes only.</li>
                      <li>Respect the intellectual property rights of the educational materials and not reproduce, distribute, or modify them without proper authorization.</li>
                      <li>Act in accordance with applicable laws and regulations while using our Education System.</li>
                      <li>Respect the rights and privacy of other users.</li>
                      <li>Not engage in any disruptive or harmful activities that may interfere with the functioning of our Education System.</li>
                    </ul>

                    <h2>Disclaimer of Warranty</h2>
                    <p>While we strive to provide accurate and up-to-date educational materials, we do not guarantee the completeness, accuracy, or reliability of the information provided.</p>
                    <p>Our educational materials are provided "as is," without any warranties, expressed or implied, including but not limited to the implied warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>

                    <h2>Limitation of Liability</h2>
                    <p>In no event shall we be liable for any damages, including but not limited to direct, indirect, incidental, consequential, or punitive damages arising out of your use or inability to use our Education System or the educational materials.</p>

                    <h2>Termination</h2>
                    <p>We reserve the right to terminate or suspend access to our Education System, including the availability of any educational materials, at any time and without prior notice.</p>

                    <h2>Changes to Terms and Conditions</h2>
                    <p>We may revise these terms and conditions at any time without prior notice. By continuing to use our Education System after any modifications, you agree to be bound by the updated terms and conditions.</p>

                    <h2>Governing Law & Jurisdiction</h2>
                    <p>These terms and conditions will be governed by and construed in accordance with the laws of [Your Country], and any disputes relating to these terms and conditions will be subject to the exclusive jurisdiction of the courts of [Your Country].</p>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        <form class="d-flex">
          
            <button class="btn btn-outline-success" type="button" onclick="logout_action()">Logout</button>
        </form>
        </div>
    </div>
</nav>
<script>
  function logout_action() {
      var confirmLogout = confirm('Are you sure you want to log out?');

      if (confirmLogout) {
          window.location.href = 'index.php';
      }
  }
</script>