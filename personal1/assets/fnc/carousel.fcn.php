<?php
  function rdrCarouselControls($id = ""){
?>
    <!--HTML--><!-- Left and right controls -->
    <a class="left carousel-control" href="#Carousel<?php echo $id; ?>" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#Carousel<?php echo $id; ?>" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
<?php
  }
?>
