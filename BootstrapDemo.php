<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrao Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
    echo 'Hello World';
    ?>
<ul class="nav nav-underline ms-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main-tab-pane" type="button" role="tab" aria-controls="main-tab-pane" aria-selected="true">Main</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bev-tab" data-bs-toggle="tab" data-bs-target="#bev-tab-pane" type="button" role="tab" aria-controls="bev-tab-pane" aria-selected="false">Beverages</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active ms-5" id="main-tab-pane" role="tabpanel" aria-labelledby="main-tab" tabindex="0">
            <div class="mb-5 mt-3 fs-4">Choose Dishes</div>
            <div class="card" style="width: 18rem;">
                <img src="https://thevocket.com/app/uploads/2023/09/vocket-poster-nasi-kandaq-fest-header.jpg" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title text-center">Nasi Kandar</h5>
                  <p class="card-text text-center">RM 9.00</p>
                  <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-primary">Add</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade ms-5" id="bev-tab-pane" role="tabpanel" aria-labelledby="bev-tab" tabindex="0">
            <div class="mb-5 mt-3 fs-4">Choose Dishes</div>
            <div class="card" style="width: 18rem;">
                <img src="https://daganghalal.blob.core.windows.net/43521/Product/teh-o-ais-1717666740607.jpg" class="card-img-top" alt="">
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>