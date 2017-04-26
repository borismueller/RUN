
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
  <div class="slider-container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">

        <div class="item active">
          <img src="/images/animal.jpeg" alt="Red-Handed Tamarin" width="460" height="345" class="image">
          <div class="carousel-caption">
            <h3>Red-Handed Tamarin</h3>
            <p>Strange animal</p>
          </div>
        </div>

        <div class="item">
          <img src="/images/cat.jpeg" alt="Cat" width="460" height="345" class="image">
          <div class="carousel-caption">
            <h3>Cat</h3>
            <p>12345</p>
          </div>
        </div>

        <div class="item">
          <img src="/images/landscape_1.jpeg" alt="Landscape 2" width="460" height="345" class="image">
          <div class="carousel-caption">
            <h3>Landscape 2</h3>
            <p>1234</p>
          </div>
        </div>

        <div class="item">
          <img src="/images/landscape_2.jpeg" alt="Landscape 1" width="460" height="345" class="image">
          <div class="carousel-caption">
            <h3>Landscape 1</h3>
            <p>123</p>
          </div>
        </div>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
