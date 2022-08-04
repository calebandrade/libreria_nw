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
                    <img src="public/imgs/{{libimg}}" alt="{{libDsc}}" class="w-100"
                        width="200" height="300" style="position: center;">
                    <div class="card-body">
                        <a href="index.php?page=Mnt-libroClient&mode=DSP&id={{libId}}" class="text-reset">
                            <h3 class="card-title mb-3" style="font-size: 14px">{{libDsc}}</h3>
                        </a>
                        <p style="text-color: gray">{{libautor}}</p>
                        <h5 class="mb-3">L {{libprice}}</h5>
                        <form action="index.php?page=mnt_carrito" method="POST">
                            <input type="hidden" name="id" id="id" value="{{libId}}" />
                            <button name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{endfor Libros}}
    </div>
</section>