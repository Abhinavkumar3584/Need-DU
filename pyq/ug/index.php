<?php 
include_once 'config.php';

if (isset($_POST['ugyear_id'])) {
  $query = "SELECT ugdrive_link FROM ugyear WHERE id=".$_POST['ugyear_id'];
  $result = $db->query($query);

  if ($result->num_rows > 0 ) {
    $row = $result->fetch_assoc();
    $ugdrive_link = $row['ugdrive_link'];

    if (strpos($ugdrive_link, 'drive.google.com') !== false) {
      // Redirect to the Google Drive link
      header("Location: $ugdrive_link");
      exit;
    }
  }
  
  // If no Google Drive link is found, display an error message
  echo "No data found". "<br>". "Updated Soon.";
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Dynamic Dependent Select Box using jQuery, Ajax and PHP</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
.logo {
	padding: 0px;
	text-align: center;
  
}

.logo a {
	color: #fff;
	font-size: 450%;
	font-weight: 900;
	font-family: 'Roboto Slab', serif;
	text-transform: uppercase;
	text-decoration: none;
	text-shadow: 1px 1px 1px #000;
	/* border: 1px dotted #fff; */
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px; 
	padding: 0 20px;
  
}

.logo a:hover {
	background: url("../images/input-bg.png") repeat;
}

.fade-animation {
  -webkit-animation: fade-me 5s; /* Safari 4+ */
  -moz-animation:    fade-me 5s; /* Fx 5+ */
  -o-animation:      fade-me 5s; /* Opera 12+ */
  animation:         fade-me 5s; /* IE 10+ */
}

.pop-in {
	-webkit-animation: pop-in 2.5s;
	-moz-animation: pop-in 2.5s;
	-ms-animation: pop-in 2.5s;
	animation: pop-in 2.5s;
	-o-animation: pop-in 2.5s;
}


@-webkit-keyframes fade-me {
  0%   { opacity: 0.2;  }
  50%   { opaciy: 0.5; }
  100% { opacity: 1; }
}
@-moz-keyframes fade-me {
  0%   { opacity: 0.2; }
  50%   { opaciy: 0.5; }
  100% { opacity: 1; }
}
@-o-keyframes fade-me {
  0%   { opacity: 0.2; }
  50%   { opaciy: 0.5; }
  100% { opacity: 1; }
}
@keyframes fade-me {
  0%   { opacity: 0.2; }
  50%   { opaciy: 0.5; }
  100% { opacity: 1; }
}

@-webkit-keyframes pop-in {
0% { opacity: 0; -webkit-transform: scale(0.2); }
100% { opacity: 1; -webkit-transform: scale(1); }
}
@-moz-keyframes pop-in {
0% { opacity: 0; -moz-transform: scale(0.2); }
100% { opacity: 1; -moz-transform: scale(1); }
}
@keyframes pop-in {
0% { opacity: 0; transform: scale(0.2); }
100% { opacity: 1; transform: scale(1); }
}



      </style>
</head>
<body>
<nav>
  <div class="navlogo">
    <img src="/SLP/pyq/ug/weblogo.png" alt="">
    <a href="#">Need DU</a>
  </div>
  <ul class="links">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</nav>

    <!-- pyq header -->
<div class="logo pop-in">
    <a href=""><span style="color:#000000;">PREVIOUS </span><span  style="color:#000;" >YEAR</span> <span  style="color:#000;" >QUESTION</span> </a>
  </div>

  <div class="hr" >
    <hr>
  </div>

<!-- ug college form table -->
<?php
  include_once 'config.php';
  $query = "SELECT * FROM ugcollege Order by college_name";
  $result = $db->query($query);
?>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
    <form method="post" action="index.php">
      <legend>Select your Under Graduate College</legend>
        <div class="form-group">
          <label for="email">College</label>
          <select name="ugcollege" id="ugcollege" class="form-control" onchange="FetchUGCOURSE(this.value)"  required>
            <option value="">Select College</option>
          <?php
            if ($result->num_rows > 0 ) {
               while ($row = $result->fetch_assoc()) {
                echo '<option value='.$row['id'].'>'.$row['college_name'].'</option>';
               }
            }
          ?> 
          </select>
        </div>
        <div class="form-group">
          <label for="pwd">Course</label>
          <select name="ugcourse" id="ugcourse" class="form-control" onchange="FetchSEMESTER(this.value)"  required>
            <option>Select Course</option>
          </select>
        </div>

        <div class="form-group">
          <label for="pwd">Semester</label>
          <select name="ugsemester" id="ugsemester" class="form-control" onchange="FetchYEAR(this.value)"  required>
            <option>Select Semester</option>
          </select>
        </div>

        <div class="form-group">
    <label for="pwd">Year</label>
    <select name="ugyear_id" id="ugyear_id" class="form-control">
      <option value="">Select Year</option>
      <?php 
        $query = "SELECT * FROM ugyear";
        $result = $db->query($query);
        if ($result->num_rows > 0 ) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value='.$row['id'].'>'.$row['year_no'].'</option>';
          }
        }
      ?>
    </select>
    <div>
    <button type="submit"   >Download</button>
  <a href="/slp/pyq/pg/index.php" class="btn" style="margin-left: 140px; "  >PG PYQs</a>
    </div>
 
      </form>
      
  </div>
  <div class="col-md-6">
      <img src="/SLP/27.png" alt="Image" >
    </div>
  </div>
</div>




<script type="text/javascript">
  function FetchUGCOURSE(id){
    $('#ugcourse').html('');
    $('#ugsemester').html('<option>Select ugsemester</option>');
    $.ajax({
      type:'post',
      url: 'ajaxdata.php',
      data : { ugcourse_id : id},
      success : function(data){
         $('#ugcourse').html(data);
      }

    })
  }
  function FetchSEMESTER(id) {
    $('#ugsemester').html('');
    $('#year').html('<option>Select year</option>');
    $.ajax({
      type: 'post',
      url: 'ajaxdata.php',
      data: { semester_id: id },
      success: function (data) {
        $('#ugsemester').html(data);
      }
    })
  }

  function FetchYEAR(id) {
    $('#year').html('');
    $.ajax({
      type: 'post',
      url: 'ajaxdata.php',
      data: { year_id: id },
      success: function (data) {
        $('#year').html(data);
      }
    })
  }
  
</script>

<footer>
  <div class="footer-wrapper">
    <div class="footer-links">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="footer-contact">
      <h3>Contact Us</h3>
      <ul>
        <li><i class="fas fa-phone"></i> +91 7500024959</li>
        <li><i class="fas fa-envelope"></i> dustudent008@gmail.com</li>
        <li><i class="fas fa-map-marker-alt"></i> cic cluster innovation centre,DU</li>
      </ul>
    </div>
    <div class="footer-social">
      <h3>Follow Us</h3>
      <ul>
      <a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-linkedin"></a>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2023 Need DU. All rights reserved.</p>
  </div>
</footer>

</body>
</html>