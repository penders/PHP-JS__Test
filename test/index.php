<?php 

require '/inc/connection.php';
require '/inc/functions.php';
 require '/inc/head.php';
require '/inc/nav.php';
// require '/admin.php';

    ?>


<body>


        <!-- MESSAGE IF LOGGED IN-->
        
        
    <?php if (isset($_SESSION['success'])) {
		
		$msg->success('You are logged in');
        $msg->display();
		unset($_SESSION['success']);
	}
	?>
	
	
	
	<h1>My First Google Map</h1>

<center><div id="googleMap" style="width:80%;height:400px;"></div></center>

<script>
function myMap() {
  var myCenter = new google.maps.LatLng(56.9101002,24.0973982);
  var mapCanvas = document.getElementById("googleMap");
  var mapOptions = {center: myCenter, zoom: 16};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}

//  AIzaSyAB3bjTY07gal9QPHXWMfHnkj5fqNtioY8

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB3bjTY07gal9QPHXWMfHnkj5fqNtioY8&callback=myMap"></script>
	
	
	
	
	
	
	
	
	
	
	
	
    <div class="wrapper">
      <p>Lorem ipsum dolor sit amet, <a href="">consectetur</a> adipisicing elit. Est <a href="">explicabo</a> unde natus necessitatibus esse obcaecati distinctio, aut itaque, qui vitae!</p>
      <p>Aspernatur sapiente quae sint <a href="">soluta</a> modi, atque praesentium laborum pariatur earum <a href="">quaerat</a> cupiditate consequuntur facilis ullam dignissimos, aperiam quam veniam.</p>
      <p>Cum ipsam quod, incidunt sit ex <a href="">tempore</a> placeat maxime <a href="">corrupti</a> possimus <a href="">veritatis</a> ipsum fugit recusandae est doloremque? Hic, <a href="">quibusdam</a>, nulla.</p>
      <p>Esse quibusdam, ad, ducimus cupiditate <a href="">nulla</a>, quae magni odit <a href="">totam</a> ut consequatur eveniet sunt quam provident sapiente dicta neque quod.</p>
      <p>Aliquam <a href="">dicta</a> sequi culpa fugiat <a href="">consequuntur</a> pariatur optio ad minima, maxime <a href="">odio</a>, distinctio magni impedit tempore enim repellendus <a href="">repudiandae</a> quas!</p>
    </div>
	    <div class="wrapper">
      <p>Lorem ipsum dolor sit amet, <a href="">consectetur</a> adipisicing elit. Est <a href="">explicabo</a> unde natus necessitatibus esse obcaecati distinctio, aut itaque, qui vitae!</p>
      <p>Aspernatur sapiente quae sint <a href="">soluta</a> modi, atque praesentium laborum pariatur earum <a href="">quaerat</a> cupiditate consequuntur facilis ullam dignissimos, aperiam quam veniam.</p>
      <p>Cum ipsam quod, incidunt sit ex <a href="">tempore</a> placeat maxime <a href="">corrupti</a> possimus <a href="">veritatis</a> ipsum fugit recusandae est doloremque? Hic, <a href="">quibusdam</a>, nulla.</p>
      <p>Esse quibusdam, ad, ducimus cupiditate <a href="">nulla</a>, quae magni odit <a href="">totam</a> ut consequatur eveniet sunt quam provident sapiente dicta neque quod.</p>
      <p>Aliquam <a href="">dicta</a> sequi culpa fugiat <a href="">consequuntur</a> pariatur optio ad minima, maxime <a href="">odio</a>, distinctio magni impedit tempore enim repellendus <a href="">repudiandae</a> quas!</p>
    </div>
        
</body>
</html>
