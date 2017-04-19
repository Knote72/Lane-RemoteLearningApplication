<!-- The header includes body tag and nav... include on all pages and begin page with <div class= "container-fluid">-->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>LCC CIT Lab Student Home</title>

  <link rel="stylesheet" type="text/css" href="./Styles/main.css">
  <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<div class="title">
  <div class="container text-center">
    <h1>Lane Community College CIT Lab</h1>
  </div>
</div>

<body style='margin-bottom: 50px;'>
<!--Nav Bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
	<div class="navbar-header">
	  <a class="navbar-brand" href="#">CIT Lab</a>
	</div>
	<div class="collapse navbar-collapse" id="navbar">
	  <ul class="nav navbar-nav">
		<li><a href="?action=home">Home</a></li>

		<li><a href="?action=schedule">Schedule</a></li>
	<?php
    $role = $_SESSION['role'];
    if ($role == 'student') {
        echo "<li><a href='?action=ask'>Questions</a></li>";
    } elseif ($role == 'tutor') {
        echo "<li><a href='?action=edit_schedule'>Edit My Schedule</a></li>";
    }
    ?>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="?action=logout"><span ></span>Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <p style="font-size: 24px; font-family: 'Cinzel', serif; font-weight:bold;">Question Accepted!</p>
      </div>

      <div class="modal-body row">
        <div id="modalBody">

          <h1 id="tutorName"></h1>
          <p>Meet me at hangouts.google.com!</p>

				</div>
      </div>

      <div class="modal-footer">
				<div id="modalButtons">
					<button id="resolveQuestion" type="button" class="btn btn-success" data-dismiss="modal">Resolved</button>
			  </div>
      </div>
    </div>

  </div>
</div>

<script>
    $(document).ready(function() {
      CheckAcceptedQuestions();
      setInterval(function() {
        CheckAcceptedQuestions();
      }, 30000);
    });

    function CheckAcceptedQuestions() {
      $.post('/CIT-Project/', { action:'check_accepted' }, function(ret) {
          var data = JSON.parse(ret);
          if (data != null) {
            $('#myModal').modal('show');
            $('#tutorName').empty();
            $('#tutorName').append = data.tutorFName;
          }

    });
  }
</script>
