<h1>Carrito</h1>
<section>
        <fieldset>
            <table>
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Codigo</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{foreach carrito}}
                    <tr>
                        <td>{{Nombre}}</td>
                        <td>{{Codigo}}</td>
                        <td>{{Precio}}</td>
                        <td>
                            <form action="index.php?page=mnt_carrito" method="POST">
                                <input type="hidden" name="id" id="id" value="{{ID}}"/> 
                               <button name="btnAccion" value="Eliminar" type="submit">Eliminar</button>
                             </form>
                        </td>
                        
                    </tr>
                    {{endfor carrito}}
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td>{{total}}</td>
                </tbody>
            </table>
        </fieldset>
</section>
<section>
    <form action="index.php?page=checkout_checkout" method="post">
        <button type="submit">Proceder al pago</button>
    </form>
</section>
<hr/>
<a href="index.php?page=mnt_librosClient">Regresar a Libros</a>

    