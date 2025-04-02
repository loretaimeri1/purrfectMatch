<?php include "inc/header.php";?>
  <!-- Home -->

  <div class="home">
  
  <section id="categories-home">
    <div class="d-flex justify-content-center">
          <?php
            use Class\Specie;
            $specie = new Specie();
            $species = $specie->find_all();
                foreach ($species as $specie) {
                  echo "<div class='card me-5' style='width: 14rem;'>";
                    echo "<div class='card-body d-flex justify-content-center'>";
                      echo "<a href='pets.php?speciesFilter={$specie->getId()}' class='btn btn-success p-3'>Find a {$specie->getName()} <i class='fa-solid fa-{$specie->getName()}'></i></a>";
                    echo "</div>";
                  echo "</div>";
                }
            ?>
    </div>
  </section>
  
  <section class="container mt-5">
    <section class="row">
      <div id="carousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div>
          <div class="carousel-inner ">
                <div class="carousel-item active">
                  <div class="card">
                    <img src="images/image1.jpg" class="d-block  img-fluid" alt="">
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center m-auto ">
                      <div class="card-text card-primary  text-center align-items-center ">
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod in pellentesque massa placerat duis ultricies lacus sed turpis.</p>
                        <a class="btn btn-outline-light text-black fw-bold text-center p-2" href="#">See more...</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="card">
                    <img src="images/image3.jpg" class="d-block img-fluid" alt="">
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center m-auto ">
                      <div class="card-text card-primary  text-center align-items-center ">
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod in pellentesque massa placerat duis ultricies lacus sed turpis.</p>
                        <a class="btn btn-outline-light text-black fw-bold text-center p-2" href="#">See more...</a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          <button class="carousel-control-prev me-auto" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next ms-auto" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
      </div>
    </section>
  </section>


   <!-- About us-->
   <section id="info">
    <div class="container">
      <div class="row">
        <div class="col align-self-center p-3 ">
          <h1 class="display-5 fw-bold ">Pets make you happy</h1>
          <p>
          Porttitor leo a diam sollicitudin tempor id eu. Amet consectetur adipiscing elit pellentesque habitant morbi tristique. Aliquam nulla facilisi cras fermentum odio eu feugiat pretium nibh. Maecenas sed enim ut sem viverra aliquet eget. Pellentesque sit amet porttitor eget dolor morbi. Urna nec tincidunt praesent semper. Porta non pulvinar neque laoreet suspendisse interdum consectetur libero id. Ultrices dui sapien eget mi proin sed libero enim. Diam volutpat commodo sed egestas egestas fringilla phasellus. Ridiculus mus mauris vitae ultricies leo integer. Diam sit amet nisl suscipit adipiscing bibendum. Nisl nisi scelerisque eu ultrices vitae auctor. Egestas maecenas pharetra convallis posuere morbi leo. Neque vitae tempus quam pellentesque. In arcu cursus euismod quis viverra nibh cras pulvinar. Eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim.          </p>
          <a class="btn btn-outline-dark text-black" href="#">See more...</a>
        </div>
        <div class="col align-self-center p-3 order-1">
          <h1 class="display-5 fw-bold">Make pets happy by adopting</h1>
          <p>
          Egestas tellus rutrum tellus pellentesque eu tincidunt. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Diam maecenas sed enim ut sem. Ultrices vitae auctor eu augue ut. Sit amet justo donec enim diam vulputate. Neque viverra justo nec ultrices dui sapien eget mi. Quis viverra nibh cras pulvinar. Quisque non tellus orci ac auctor. Quam adipiscing vitae proin sagittis. Vel risus commodo viverra maecenas accumsan lacus vel facilisis. Porta non pulvinar neque laoreet suspendisse interdum consectetur libero id. Orci porta non pulvinar neque laoreet suspendisse interdum consectetur. Nibh mauris cursus mattis molestie a iaculis. Bibendum ut tristique et egestas quis ipsum. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae. Mollis aliquam ut porttitor leo a diam sollicitudin. Eget velit aliquet sagittis id.          </p>
          <a class="btn btn-outline-dark text-black" href="#">See more...</a>
        </div>
      </div>
      <div class="row">
        <div class="col text-center p-3 ">
         <img src="images/image4.jpg" class="w-75 rounded-circle">
        </div>
        <div class="col text-center p-3 order-0">
         <img src="images/image5.jpg" class="w-75 rounded-circle">
        </div>
        <div class="col text-center p-3 order-0">
         <img src="images/image6.jpg" class="w-75 rounded-circle">
        </div>
      </div>
    </div>
  </section>

</div>


<?php include "inc/footer.php";?>