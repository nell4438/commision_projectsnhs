<?php
  // $query="SELECT count(IMAGES) as 'counts'  FROM `tblpromopro` pr , `tblproduct` p  
  // WHERE pr.`PROID`=p.`PROID` and `PROBANNER`=1";
  // $mydb->setQuery($query);
  // $cur = $mydb->loadResultList(); 
  // foreach ($cur as $result) {
  // $maxrow = $result->counts; 
  // }
 
?>
 


 
     <header id="myCarousel" class="carousel slide">
      
        <div class="carousel-inner">
            <div class="item active">
            <div class="fill">  
                    <img src="<?php echo web_root ;?>img/crop.jpeg"   /> 
              </div>
                <div class="carousel-caption">
                    <!-- <h2>K12 Now Ready</h2> -->
                </div>
            </div>
            <div class="item">
            <div class="fill">  
                    <img src="<?php echo web_root ;?>img/banner1.jpeg"   /> 
              </div>
                <div class="carousel-caption">
                    <!-- <h2>K12 Now Ready</h2> -->
                </div>
            </div>
            <div class="item">
            <div class="fill">  
                    <img src="<?php echo web_root ;?>img/banner3.jpeg"   /> 
              </div>
                <div class="carousel-caption">
                    <!-- <h2>K12 Now Ready</h2> -->
                </div>
            </div>
           
        </div>

         <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

</header>
 
 

    <!-- Script to Activate the Carousel -->
