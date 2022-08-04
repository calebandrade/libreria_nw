<section>

    <h1>{{libDsc}}</h1>
    <img src="public/imgs/{{libimg}}" alt="{{libDsc}}" height="500" width="300">
    &nbsp;
    <h3>L {{libprice}}</h3>
    <form action="index.php?page=mnt_carrito" method="POST">
        <input type="hidden" name="id" id="id" value="{{libId}}" />
        <button name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
    </form>
</section>