<div class="activeList">
    <?php for ($i = 0; $i < 4; $i++) : ?>
        <div class="col d-flex border-bottom">
            <div class="col-3">
                <img class="rounded" src="<?= base_url('img/rectangle1.png') ?>" width="90%" height="91%">
            </div>
            <div class="col-9">
                <a class="fs-30 fw-bold text-dark text-decoration-none" href="<?= route_to('blog.workDetail', 2) ?>">Designing Dashboards</a>
                <p class="d-flex mt-4 mb-4">
                    <span class="text-date">
                        <span class="text-white fs-5 mx-2 fw-bold">2020</span>
                    </span>
                    <a class="fs-30 text-secondary text-decoration-none fs-5 mx-4" href="#">Dashboard</a>
                </p>
                <p class="w-60">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
            </div>
        </div>
    <?php endfor; ?>
</div>