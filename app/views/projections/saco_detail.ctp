<?php //saco_details.ctp ?>

<div id="carousel-wrapper">
    <div id="carousel-content">
	  <div class="slide">
	    Slide one
	  </div>
        <div class="slide">
	    Slide two
        </div>
	    
        <div class="slide">
	    Slide three
        </div>
    </div>
</div>
	  <script type="text/javascript">
	      new Carousel('carousel-wrapper', 
			$$('#carousel-content .slide'), 
			$$('a.carousel-control', 'a.carousel-jumper')
		  );
	 </script>
	 
<a href="javascript:" class="carousel-jumper" rel="slide-1">Jump to slide 1</a>

<a href="javascript:" class="carousel-control" rel="prev">Previous slide</a>

