<div class="container">
    <div class="row">
        <h2>Libros</h2>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="product-box position-relative">
                <div class="icons position absolute">
                    <a href="#" class="text-decoration-none text-dark" id=""><i class="fas fa-heart"></i></a>
                    <a href="#" class="text-decoration-none text-dark" id=""><i class="fas fa-eye"></i></a>
                </div>
                {{foreach Libros}}
                <a href="index.php?page=Mnt-LibroClient&mode=DSP&id={{libId}}"><img src="../../../../public/imgs/joey-huang-XBh4DOGqMfc-unsplash.jpg" alt="Foto 1" class="img-fluid"></a>
                <div class="cart-btn">
                    <button class="btn btn-whte shadow-sm rounded-pill"><i class="fal fa-shoping-cart"></i> Add to Cart</button>
                </div>
                <div>
                    <div class="product-info">
                        <div class="product-name">
                            {{libDsc}}
                        </div>
                        <div class="product-price">
                            L <span>{{libprice}}</span>
                        </div>
                    </div>
                </div>
                {{endfor Libros}}
            </div>
        </div>
    </div>
</div>