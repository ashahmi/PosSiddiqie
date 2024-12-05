<?php include('includes/header.html'); ?>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main-tab-pane" type="button" role="tab" aria-controls="main-tab-pane" aria-selected="true">
                Main
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bev-tab" data-bs-toggle="tab" data-bs-target="#bev-tab-pane" type="button" role="tab" aria-controls="bev-tab-pane" aria-selected="false">
                Beverages
            </button>
        </li>
    </ul>
    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="main-tab-pane" role="tabpanel" aria-labelledby="main-tab">
            <div class="mb-3 fs-4">Choose Dishes</div>
            <a href="index.php" class="text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <div class="card" style="width: 18rem;">
                    <img src="https://thevocket.com/app/uploads/2023/09/vocket-poster-nasi-kandaq-fest-header.jpg" class="card-img-top" alt="Nasi Kandar">
                    <div class="card-body">
                        <h5 class="card-title text-center">Nasi Kandar</h5>
                        <p class="card-text text-center">RM 9.00</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="tab-pane fade" id="bev-tab-pane" role="tabpanel" aria-labelledby="bev-tab">
            <div class="mb-3 fs-4">Choose Dishes</div>
            <div class="card" style="width: 18rem;">
                <img src="https://daganghalal.blob.core.windows.net/43521/Product/teh-o-ais-1717666740607.jpg" class="card-img-top" alt="Teh O Ais">
                <div class="card-body">
                    <h5 class="card-title text-center">Teh O Ais</h5>
                    <p class="card-text text-center">RM 2.00</p>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ini cart.
        </div>
    </div>
</div> 

<?php include('includes/footer.html'); ?>