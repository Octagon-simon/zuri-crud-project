<?php

session_start();
$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
if (empty($username) && empty($user_id)) {
    header('Location: login.php');
}

else {}

?>
<!Doctype html>
<html>
<head></head>
<title></title>
<body>
<h1 align="center">MY DASHBOARD</h1>
<div  align="center">
<h2 align="right">Welcome <span style="color:green;"><?php echo $username; ?></span></h2>
<div align="right"> <a href="core/logout.php"><button>Logout</button></a></div>
<a href="courses/add_course.php"><button>Add course</button></a>
<a href="courses/manage_courses.php"><button>Manage courses</button></a>
<a href="courses/view_courses.php"><button>View courses</button></a>

</div>


</body>
</html>