<div class="activeGrid">
    <div class="row border-bottom">
        <?php for ($i = 0; $i < 4; $i++) : ?>
            <div class="col-4 d-flex justify-content-center">
                <div class="card border-0 text-center card-body">
                    <img class="rounded" src="<?= base_url('img/rectangle1.png') ?>" width="90%" height="91%">
                    <div class="d-flex justify-content-center">
                        <p class="d-flex mt-2 mb-2">
                            <span class="text-date">
                                <span class="text-white fs-5 mx-2 fw-bold">2020</span>
                            </span>
                            <a class="fs-30 text-secondary text-decoration-none fs-5 mx-4" href="#">Dashboard</a>
                        </p>
                    </div>
                    <a class="fs-24 fw-bold text-dark text-decoration-none" href="<?= route_to('blog.workDetail', 2) ?>">Designing Dashboards</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>