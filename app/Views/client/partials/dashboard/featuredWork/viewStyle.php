<div class="activeStyle">
    <?php for ($i = 0; $i < 4; $i++) : ?>
        <?php if ($i % 2 !== 0) : ?>
            <div class="col-12 d-flex border-bottom mt-4">
                <div class="col-9 d-flex justify-content-end">
                    <div class="col-8">
                        <a class="fs-30 fw-bold text-dark text-decoration-none" href="<?= route_to('blog.workDetail', 2) ?>">36 Days of Malayalam type</a>
                        <p class="d-flex mt-4 mb-4">
                            <span class="text-date">
                                <span class="text-date text-white fs-5 mx-2 fw-bold">2018</span>
                            </span>
                            <a class="fs-30 text-secondary text-decoration-none fs-5 mx-4" href="#">Illustration</a>
                        </p>
                        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrudamet.</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center mb-3">
                    <img class="rounded" src="<?= base_url('img/rectangle2.png') ?>" width="90%" height="91%">
                </div>
            </div>
        <?php else : ?>
            <div class="col-12 d-flex border-bottom mt-4">
                <div class="col-3">
                    <img class="rounded" src="<?= base_url('img/rectangle1.png') ?>" width="90%" height="91%">
                </div>
                <div class="col-6">
                    <a class="fs-30 fw-bold text-dark text-decoration-none" href="<?= route_to('blog.workDetail', 2) ?>">36 Days of Malayalam type</a>
                    <p class="d-flex mt-4 mb-4">
                        <span class="text-date">
                            <span class="text-white fs-5 mx-2 fw-bold">2018</span>
                        </span>
                        <a class="fs-30 text-secondary text-decoration-none fs-5 mx-4" href="#">Illustration</a>
                    </p>
                    <p class="w-60">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                </div>
            </div>
        <?php endif; ?>
    <?php endfor; ?>
</div>