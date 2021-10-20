<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
<title> Shuttle: Travel along! </title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
.detail
{
	height:500px;
}

#pholder {
	max-height: 100px;
	max-width: 100px;
}

.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}

.wrapper {
	text-align: center;
}

#info {

}

#footer {
  background-color: #e3f2fd;
   height: 50px;
    font-family: 'Verdana', sans-serif;
    padding: 20px;
}
</style>
</head>
<body style="background-color: powderblue;">
<!--header-->
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <div class= "navbar-header">
        <button type= "button" class="navbar-toggle" data-toggle= "collapse" data-target= "#bs-shuttle-navbar-collapse-1">
          <span class= "sr-only"> Toggle navigation </span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
         </button>
      <a class="navbar-brand" href="#"> Shuttle </a> 
    </div>
  <div class= "collapse navbar-collapse navbar-right" id="bs-shuttle-navbar-collapse-1">
    <ul class= "nav navbar-nav">
       <ul class= "nav navbar-nav">
      <li> <a href="./user.php"> Home </a> </li>
	<li> <a href="./about.html"> About </a> </li>
      <li> <a href="./homepage_shuttle.php"> Logout </a> </li>
      
    </ul>
    </ul>
    </div>  
  </div>
</nav>
<!--end of navbar-->
<!--generic info-->
<div class= "container-fluid">
 <div class= "col-md-4" >
  <div class= "panel panel-info" id="info" >
      <div class= "panel-heading">
        <h4 class= "panel-title" align="center"> Your Information </h4>
      </div> 

<?php 

//$_SESSION['logged_user']=1;
//session_start();
$server="localhost";
$username="root";
$password="";
$db="safar";
$t= $_SESSION['logged_user'];
$conn = new mysqli($server,$username,$password,$db);
if($conn->connect_error){
    die("Connection failed".mysqli_connect_error());
}
  $result= $conn->query ("SELECT * FROM customer where cid = '$t'");
  $row = $result->fetch_assoc();
  $result1= $conn->query ("SELECT * FROM ride_details where cid = '$t' ORDER BY rid DESC LIMIT 1");
  $row1 = $result1->fetch_assoc();
  $result2= $conn->query ("SELECT * FROM shuttle_details,ride_details where cid = '$t' AND shuttle_details.dname=ride_details.dname");
  $row2 = $result2->fetch_assoc();

  //echo mysqli_num_rows($result1);
  /*if (mysqli_num_rows($result)>0)
  {
    $count= mysqli_num_rows($result);
  }
 while($row = $res1->fetch_assoc()) 
{*/

  $n = $row['name'];
  $e = $row['email'];
  $a = $row['amount'];
  $s = $row1['source'];
  $d = $row1['destination'];
  $t = $row1['ride_time'];
  $k = $row2['vacancy'];
  $v = $row2['sid'];
  $v = $GLOBALS['v'];
  $s = $GLOBALS['s'];
  $d = $GLOBALS['d'];


?>
 
 
<div class= "panel panel-body detail">
      <img id="pholder" class= "center" src="./images/placeholder.png">
      <br>
      <br>
      <table class = "table">
      <tr>
         <td align="center">Name: <?php echo "$n"; ?></td>
      </tr>
      
      <tr>
         <td align="center">E-mail: <?php echo "$e"; ?></td>
      </tr>
            <tr>
         <td align="center">Amount: <?php echo "$a";?></td>
      </tr>
      <tr>
         <td align="center">Latest Trip: <?php echo " $s to $d  ";?></td>
      </tr>
      <tr>
         <td align="center">Date and Time: <?php echo "$t";?> minute(s)</td>
      </tr>
      <tr>
         <td align="center">Vacancy in the shuttle: <?php echo "$k";?></td>
      </tr>
   </table>
   <br>
   <br>
   <div class= "wrapper">
   <button name="wait" type="submit" class="btn btn-success" value="wait">Waiting</button>
   <button onclick="location.href='http://localhost/shuttle/user.php'" type="button" class="btn btn-success" value="exit">
     Exit</button>
   </div>
      </div>
    </div>
</div>

<?php


if (isset($_POST['wait']))
{
  $t=$_SESSION['logged_user'];
  $server="localhost";
$username="root";
$password="";
$db="safar";
$conn = new mysqli($server,$username,$password,$db);
if($conn->connect_error){
    die("Connection failed".mysqli_connect_error());
}
else {

  $v=$GLOBALS['v'];
  $sql3="update shuttle_details set stud_wait=stud_wait+'1' where shuttle_details.sid='$v'";
  $result3=mysqli_query($conn,$sql3);
  $row3 = mysqli_fetch_assoc($result3);
  if (mysqli_num_rows($result3)>0)
    {
       $_SESSION['logged_user']= $row3['sid'];
       echo 'Success';
    } 
  else 
    {
        echo 'Fail'; 
    }   
  unset ($_POST['wait']);
}

}

?>


<!-- end of generic info-->
<div class="col-md-8">
  <div class="panel panel-success">
    <div class="panel-heading" align="center"><b>GPS Tracking</b></div>
    <div class="panel-body log">
<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script>
var myCenter=new google.maps.LatLng(12.971058, 79.163709);
var x=new google.maps.LatLng(12.971231, 79.161992);
var x1=new google.maps.LatLng(12.970852, 79.159525);
var x2=new google.maps.LatLng(12.973252, 79.164251);
var x4=new google.maps.LatLng(12.969523, 79.156000);
var x3=new google.maps.LatLng(12.969667, 79.155161);
/*var p1,p2;
var source=<?php echo json_encode(GLOBALS['s']);?>;
var dest=<?php echo json_encode(GLOBALS['d']);?>;*/
var marker1, marker2;

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:17,
  mapTypeId:google.maps.MapTypeId.SATELLITE
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

/*if(source=="SJT"){
  p1:myCenter;
}
else if(source=="LADIES HOSTEL"){
  p1:x;
}
else if(source=="TT"){
  p1:x1;
}
else if(source=="MENS HOSTEL"){
  p1:x2;
}
else if(source=="MAIN BUILDING"){
  p1:x3;
}
else if(source=="GDN"){
  p1:x4;
}

if(dest=="SJT"){
  p2:myCenter;
}
else if(dest=="LADIES HOSTEL"){
  p2:x;
}
else if(dest=="TT"){
  p2:x1;
}
else if(dest=="MENS HOSTEL"){
  p2:x2;
}
else if(dest=="MAIN BUILDING"){
  p2:x3;
}
else if(dest=="GDN"){
  p2:x4;
}
*/
var pinImage = new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/009900/");
var pinImage1 = new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/0099FF/");
var marker1=new google.maps.Marker({
  position:myCenter,
  icon:pinImage,
  animation:google.maps.Animation.BOUNCE
  });
var marker2=new google.maps.Marker({
  position:x1,
  icon:pinImage1,
  animation:google.maps.Animation.BOUNCE
  });


marker1.setMap(map);
marker2.setMap(map);

/*var myTrip=[x,x1,x2,x4,x3];
var flightPath=new google.maps.Polyline({
  path:myTrip,
  strokeColor:"#FF0000",
  strokeOpacity:0.8,
  strokeWeight:4
  });
*/
flightPath.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap" style="width:1024px;height:720px;"></div>
</body>
</html>



<!--<div id="googleMap" style="width:1024px;height:720px;"></div>

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  var latlon = position.coords.latitude + "," + position.coords.longitude;

  var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=400x300&sensor=false&key=YOUR_:KEY";

  document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
}
</script>

</html>
-->



