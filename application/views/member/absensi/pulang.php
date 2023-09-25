<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="card card-primary">
            <div class="card-header">
                <h3>Absensi</h3>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <div class="form-group">
                        <div class="video-box">
                            <span class="latitude d-none" id="latitude"></span>
                            <div class="webcam-capture mx-auto">
                                <div></div><video autoplay="autoplay"></video>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?= $this->input->post('lokasi'); ?>

                    <div class="row mb-2 text-center mx-auto">
                        <div class="col">
                            <button class="btn rounded-pill btn-success btn-lg btn-block" onClick="captureimagepl(0)" id="btn_pulang"><i class="fas fa-camera"></i> Absen pulang</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section><!-- End Hero -->
<script>
    window.addEventListener("load", () => {

        $("#btn_masuk").css("display", "none");
        $("#btn_pulang").css("display", "none");

    });
    setTimeout(function() {
        $("#btn_masuk").css("display", "block");
    }, 4000);
    setTimeout(function() {
        $("#btn_pulang").css("display", "block");
    }, 4000);
</script>