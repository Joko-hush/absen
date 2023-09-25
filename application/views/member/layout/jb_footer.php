<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
        <div class="toast-header bg-primary text-white">
            <i class="fas fa-circle-exclamation mr-3 text-warning"></i>
            <strong class="me-auto">Pengajuan ijin absensi</strong>
            <!-- <small>11 mins ago</small> -->
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php if ($judul == 'home') : ?>
                <a href="<?= base_url('absensi/ijin'); ?>" class="text-dark">
                    <?= $ijin; ?> ket absen
                </a>
            <?php else : ?>
                <a href="<?= base_url('leader/ijin'); ?>" class="text-dark">
                    <?= $ijin; ?> ket absen
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- ======= Footer ======= -->
<!-- <footer id="footer">
    <div class="container">
        <div class="copyright">
            <strong><span>SIPERS RS. DUSTIRA</span></strong>
        </div>
    </div>
</footer>End Footer -->
<?php if ($title != 'DOEL SI PETIR') {
    $display = 'block';
} else {
    $display = 'none';
}

?>
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div class="row">
    <div class="back-arrow col" style="display: <?= $display; ?>;">
        <a type="button" onclick="history.back();" class="btn btn-warning">
            <i class="fas fa-chevron-circle-left"></i> Kembali
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Vendor JS Files -->
<script src="<?= base_url('assets') ?>/vendor/purecounter/purecounter.js"></script>
<script src="<?= base_url('assets') ?>/vendor/aos/aos.js"></script>
<script src="<?= base_url('assets') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url('assets') ?>/fontawesome/js/fontawesome.min.js"></script>
<script src="<?= base_url('assets') ?>/js/adminlte.min.js"></script>
<script src="<?= base_url('vendor/AdminLTE-3.1.0') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('vendor/AdminLTE-3.1.0') ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('vendor/AdminLTE-3.1.0') ?>/dist/js/adminlte.min.js"></script>


<!-- Template Main JS File -->
<script src="<?= base_url('assets') ?>/js/main.js"></script>
<script src="<?= base_url('assets') ?>/js/typed.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/webcamjs/webcam.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/app.js"></script>
<script src="<?= base_url('assets/js/script.js'); ?>"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script>
    window.onload = (event) => {
        const toastTrigger = document.getElementById('ijin').value;
        const toastLiveExample = document.getElementById('liveToast')

        if (toastTrigger > 0) {
            const toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
        }
    };
</script>
<script>
    window.onload = (event) => {
        const toastTrigger = $('#ijin').val();
        const toastLiveExample = document.getElementById('liveToast')

        if (toastTrigger > 0) {
            const toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
        }
    };
</script>

<script>
    $(function() {
        $("#dates").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1945:2022",
            altFormat: "yyyy-mm-dd"
        });
    });
</script>
<?php
$name = $staff['name'];

if ($judul == "Pengisian Data Personil") {
    $type = "Silahkan Lengkapi Data dengan benar";
} else {
    $type = 'Selamat datang' . ' ' . $name;
}

?>

<script>
    const typed = new Typed('#typed', {
        /**
         * @property {array} strings strings to be typed
         * @property {string} stringsElement ID of element containing string children
         */
        strings: [
            "<?= $type; ?>"
        ],
        stringsElement: null,

        /**
         * @property {number} typeSpeed type speed in milliseconds
         */
        typeSpeed: 50,

        /**
         * @property {number} startDelay time before typing starts in milliseconds
         */
        startDelay: 0,

        /**
         * @property {number} backSpeed backspacing speed in milliseconds
         */
        backSpeed: 40,

        /**
         * @property {boolean} smartBackspace only backspace what doesn't match the previous string
         */
        smartBackspace: true,

        /**
         * @property {boolean} shuffle shuffle the strings
         */
        shuffle: false,

        /**
         * @property {number} backDelay time before backspacing in milliseconds
         */
        backDelay: 700,

        /**
         * @property {boolean} fadeOut Fade out instead of backspace
         * @property {string} fadeOutClass css class for fade animation
         * @property {boolean} fadeOutDelay Fade out delay in milliseconds
         */
        fadeOut: false,
        fadeOutClass: 'typed-fade-out',
        fadeOutDelay: 500,

        /**
         * @property {boolean} loop loop strings
         * @property {number} loopCount amount of loops
         */
        loop: false,
        loopCount: Infinity,

        /**
         * @property {boolean} showCursor show cursor
         * @property {string} cursorChar character for cursor
         * @property {boolean} autoInsertCss insert CSS for cursor and fadeOut into HTML <head>
         */
        showCursor: true,
        cursorChar: '',
        autoInsertCss: true,

        /**
         * @property {string} attr attribute for typing
         * Ex: input placeholder, value, or just HTML text
         */
        attr: null,

        /**
         * @property {boolean} bindInputFocusEvents bind to focus and blur if el is text input
         */
        bindInputFocusEvents: false,

        /**
         * @property {string} contentType 'html' or 'null' for plaintext
         */
        contentType: 'html',

        /**
         * Before it begins typing
         * @param {Typed} self
         */
        onBegin: (self) => {},

        /**
         * All typing is complete
         * @param {Typed} self
         */
        onComplete: (self) => {},

        /**
         * Before each string is typed
         * @param {number} arrayPos
         * @param {Typed} self
         */
        preStringTyped: (arrayPos, self) => {},

        /**
         * After each string is typed
         * @param {number} arrayPos
         * @param {Typed} self
         */
        onStringTyped: (arrayPos, self) => {},

        /**
         * During looping, after last string is typed
         * @param {Typed} self
         */
        onLastStringBackspaced: (self) => {},

        /**
         * Typing has been stopped
         * @param {number} arrayPos
         * @param {Typed} self
         */
        onTypingPaused: (arrayPos, self) => {},

        /**
         * Typing has been started after being stopped
         * @param {number} arrayPos
         * @param {Typed} self
         */
        onTypingResumed: (arrayPos, self) => {},

        /**
         * After reset
         * @param {Typed} self
         */
        onReset: (self) => {},

        /**
         * After stop
         * @param {number} arrayPos
         * @param {Typed} self
         */
        onStop: (arrayPos, self) => {},

        /**
         * After start
         * @param {number} arrayPos
         * @param {Typed} self
         */
        onStart: (arrayPos, self) => {},

        /**
         * After destroy
         * @param {Typed} self
         */
        onDestroy: (self) => {}
    });
</script>

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('./service-worker.js')
                .then(() => {
                    console.log('[ Hey there! ] Service Worker Registered');
                });
        });
    }
</script>
<script>
    function check(a) {
        $('#satuan').val($(a).find(':selected').data('satuan'));
        $('#volume2').val($(a).find(':selected').data('volume'));

    }

    function checkvolume(a) {
        if ($(a).val() > $('#volume2').val()) {
            alert("tidak boleh lebih besar dari satuan yang tertulis di kontrak");
        }
    }
</script>
<?php if ($judul == 'Absen') { ?>
    <script src="<?= base_url(); ?>/assets/js/absen.js?v=1.0"></script>
<?php } ?>

<script>
    const body = document.getElementById('body');
    const ct = document.getElementById('card_title');
    ct.addEventListener('load', function() {
        if (ct) {
            body.style.backgroundColor = '#ccc';
        }
    })
</script>


</body>

</html>