<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MenuPo/Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon/favicon.ico" rel="icon">
  <link href="assets/img/favicon/apple-touch-icon.ico" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <!-- Template Main CSS File -->
  <link href="assets/css/survey.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->

  <header>
    <br>
  <div class="result">
    <a href="home.php"><button class="result button">Go Back</button></a>
  </div>
  <br>

 

  </header>

  <main class="container-top">
        
        <form action="#" id="survey-form">
        <img src="assets/img/menupo.png" alt="" width="120px" height="50px">
        <h1 id="title" > [Date] Recommendation Survey Form</h1>
        <p class="description"> <i> Please fill out this survey form </i> </p>
            <div class="form-group">
                <fieldset>
                    <div class="form-group">
                        <p> Name(Optional) </p>
                        <!-- <label for="Name" id="name-label"> Name -->
                            <input type="text" id="name" name="name" class="form-control" placeholder=" Enter your name">
                        <!-- </label> -->
                    </div>
                    
                    <div class="form-group">
                        <br/>
                        <label for="job"> Which option best describes your current role in the school? </label> <br>
                            <select name="role" id="dropdown" class="form-control" required>
                                <option disabled selected value> Select current role </option>
                                <option value="student">Parent</option>
                                <option value="job">Student</option>
                                <option value="learner">Canteen Staff</option>
                                <option value="preferNo">Teacher</option>
                            </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <p>In a rate of 1-5, how well is the current canteen menu? </p> <br>
                            <label for="5">
                                <input type="radio" name="rate" value="1" class="input-radio">5
                            </label> <br> 
                            <label for="4">
                                <input type="radio" name="rate" value="2" class="input-radio"> 4
                            </label> <br>
                            <label for="3">
                                <input type="radio" name="rate" value="3" class="input-radio"> 3
                            </label> <br>
                            <label for="2">
                                <input type="radio" name="rate" value="3" class="input-radio"> 2
                            </label> <br>
                            <label for="1">
                                <input type="radio" name="rate" value="3" class="input-radio"> 1
                            </label> <br>
                    </div>
                    <div class="form-group">
                        <p> What menu items you like to have more choices? <span class="clue"> (Check all that apply) </span></p>
                        <div class="form-group">
                            <input type="checkbox" name="choices" id="frontend" class="input-checkbox"> Rice Meals
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="choices" id="back-end-project" class="input-checkbox"> Cooked Foods
                        </div>
                    <div class="form-group">
                        <label> 
                            <input name="prefer" value="choices" type="checkbox" class="input-checkbox" />
                                Snacks
                        </label> <br>
                        <label>
                            <input name="prefer" value="choices" type="checkbox" class="input-checkbox"/>
                            Beverages
                        </label> <br>
                        <label>
                            <input name="prefer" value="choices" type="checkbox" class="input-checkbox"/> Others
                        </label> <br>
                    </div>
                        
                        <div class="form-group">
                            <p>Any food-item or rice meal suggestions? </p>
                            <textarea name="suggestion" id="suggestion" class="input-textarea" placeholder="Enter your comment here..."></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit-button" class="submit-button" > Submit </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </form>
    </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>MenuPo</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Developed by <a href="https://bootstrapmade.com/">TeamName</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="https://kit.fontawesome.com/d00886c359.js" crossorigin="anonymous"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  

</body>

</html>