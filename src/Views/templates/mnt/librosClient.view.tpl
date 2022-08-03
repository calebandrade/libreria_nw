<section>
    <div class="text-center container py-5">
        <h2 class="mt-4 mb-5"><strong>Libros</strong></h2>
    </div>

    <div class="row">
        {{foreach Libros}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card" style="margin: 2rem;">
                <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                    data-mdb-ripple-color="light">
                    <img src="public/imgs/joey-huang-XBh4DOGqMfc-unsplash.jpg" alt="{{libDsc}}" class="w-100"
                        width="200" height="300">
                    <div class="card-body">
                        <a href="index.php?page=Mnt-libroClient&mode=DSP&id={{libId}}" class="text-reset">
                            <h4 class="card-title mb-3">{{libDsc}}</h4>
                        </a>
                        <h5 class="mb-3">L {{libprice}}</h5>
                        <button class="btn btn-whte shadow-sm rounded-pill"><i class="fal fa-shoping-cart"></i> Add to
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
        {{endfor Libros}}
    </div>
</section>