<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/dosier/') . $personil['image']; ?>" class="img-fluid rounded-start" alt="Personil Picture" id="personil_picture">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $personil['name']; ?></h5>
                            <p class="card-text"><?= $personil['pangkat']; ?></p>
                            <p class="card-text"><?= $jbtn; ?></p>
                            <p class="card-text"><?= $unit; ?></p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="data_absen">
                <div class="card-header">
                    <h5>Data Absen</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Status Absen</th>
                                    <th>Ket</th>
                                    <th>Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= substr($absen['TIME_IN'], 10, 9); ?></td>
                                    <td><?= substr($absen['TIME_OUT'], 10, 9); ?></td>
                                    <td><?= $sa; ?></td>
                                    <td><?= $st; ?></td>
                                    <td><?= $absen['INFO']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card" id="data_gambar">
                <div class="card-header">
                    <h5>Foto Saat Absen</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body text-center flex">
                    <div class="row">
                        <div class="col">
                            <figure>
                                <img class="img img-thumbnail rounded img-" src="<?= base_url('assets/img/absen/') . $absen['PICTURE_IN']; ?>" alt="foto" id="gambar_masuk">
                                <figcaption>Foto Saat Masuk</figcaption>
                            </figure>
                        </div>
                        <div class="col">
                            <figure>
                                <img class="img img-thumbnail rounded img-" src="<?= base_url('assets/img/absen/') . $absen['PICTURE_OUT']; ?>" alt="foto" id="gambar_keluar">
                                <figcaption>Foto Saat Pulang</figcaption>
                            </figure>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card" id="data_lokasi">
                <div class="card-header">
                    <h5>Lokasi</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div id='mapin' style='width: 312px; height: 312px;' class="rounded shadow mx-auto"></div>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <div id='mapout' style='width: 312px; height: 312px;' class="rounded shadow mx-auto"></div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    mapboxgl.accessToken = "<?= $tokenmapbox; ?>";
    const mapout = new mapboxgl.Map({
        container: 'mapout', // container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [<?= $long_out; ?>, <?= $lat_out; ?>], // starting position [lng, lat]
        zoom: 15 // starting zoom
    });
    // marker
    const geojson1 = {
        type: 'FeatureCollection',
        features: [{
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [<?= $long_out; ?>, <?= $lat_out; ?>]
                },
                properties: {
                    title: 'Lokasi pulang',
                    description: '<?= $personil['name']; ?>'
                }
            }


        ]
    };
    for (const feature of geojson1.features) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(mapout);
    }
    mapboxgl.accessToken = "<?= $tokenmapbox; ?>";
    const mapin = new mapboxgl.Map({
        container: 'mapin', // container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [<?= $long_in; ?>, <?= $lat_in; ?>], // starting position [lng, lat]
        zoom: 15 // starting zoom
    });

    const geojson2 = {
        type: 'FeatureCollection',
        features: [

            {
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [<?= $long_in; ?>, <?= $lat_in; ?>]
                },
                properties: {
                    title: 'Lokasi masuk',
                    description: '<?= $personil['name']; ?>'
                }
            }


        ]
    };

    for (const feature of geojson2.features) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'markerin';

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(mapin);
    }
</script>