 <!-- Map Column -->
            <div class="col-md-1">
           <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
           <div style="overflow:hidden;height:400px;width:100%;"><div id="gmap_canvas" style="height:100%;width:400px;">
           </div>
           <script type="text/javascript">
            function init_map(){var myOptions = {zoom:19,center:new google.maps.LatLng(6.491144065749442,124.85594889087679),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(6.491144065749442, 124.85594889087679)});infowindow = new google.maps.InfoWindow({content:"<b>Green Valley College Foundation, Inc.</b><br/>Km. 2, Bo. 2, General Santos Drive<br/>9506  Philippines" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
</div>
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-8">
                <h3>Contact Details</h3>
                <p>
                    Sto.Nino National High School
                <br>Sto.Nino Cagayan, Philippines<br>
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone">P</abbr>: (012) 345-6789</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">Email</abbr>: <a href="mailto:name@example.com">snhs@gmail.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
                <ul class="list-unstyled list-inline list-social-icons">
                   
                </ul>
            </div>

 