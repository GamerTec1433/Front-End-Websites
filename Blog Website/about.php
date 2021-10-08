<?php
    include_once('extras/userheader.php');
?>

<section class="intro-page">
    <div class="container d-flex flex-column justify-content-center align-content-center h-100">
        <h1>About</h1>
        <p>HOME > ABOUT</p>
    </div>
</section>

<section class="about p-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-2">
                <img src="imgs/profile.jpg" class="about-img">
            </div>
            <div class="col-md-6 about-content d-flex flex-column justify-content-center">
                <p class="default">Welcome to Readit</p>
                <h3>We give you the best articles you want.</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
        <div class="content my-5">
            <h1>Our Mission</h1>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                language ocean.</p>
        </div>
        <div class="line"></div>
        <div class="content my-5">
            <h1>Our Vision</h1>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, <br>a
                large language ocean. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis vel omnis quod
                nostrum consequatur tenetur aut distinctio eum! Eaque perspiciatis rem quia ut libero repellendus
                nostrum deleniti saepe voluptates consequuntur?</p>
        </div>
        <div class="line"></div>
        <div class="content my-5">
            <h1>Our Value</h1>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                language ocean.</p>
        </div>
        <div class="line"></div>
        <div id="customers" class="my-5">
            <div class="carousel-cell p-4">
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                    live
                    the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
                <div class="d-flex content">
                    <img src="imgs/profile.jpg">
                    <div class="pl-3 d-flex flex-column justify-content-center">
                        <h3>Roger Scott</h3>
                        <p>Marketing Manager</p>
                    </div>
                </div>
            </div>
            <div class="carousel-cell p-4">
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                    live
                    the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
                <div class="d-flex content">
                    <img src="imgs/profile.jpg">
                    <div class="pl-3 d-flex flex-column justify-content-center">
                        <h3>Roger Scott</h3>
                        <p>Marketing Manager</p>
                    </div>
                </div>
            </div>
            <div class="carousel-cell p-4">
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                    live
                    the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
                <div class="d-flex content">
                    <img src="imgs/profile.jpg">
                    <div class="pl-3 d-flex flex-column justify-content-center">
                        <h3>Roger Scott</h3>
                        <p>Marketing Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include_once('extras/userfooter.php');
?>

<script>
    $('#customers').flickity({
        // options
        cellAlign: 'center',
        autoPlay: 1500,
        pauseAutoPlayOnHover: false
    });
</script>