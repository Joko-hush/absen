<section id="dosier" class="latar">
    <div class="container">

        <div class="card card-success mt-3">
            <div class="card-header">
                <h5>Log aktifitas user</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table bordered" id="myTable">
                        <thead>
                            <tr>

                                <th>Waktu</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($log as $l) : ?>
                                <tr>
                                    <td><?= date('d-m-y, h:i:s', $l['created_at']); ?></td>
                                    <td><?= $l['action']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>