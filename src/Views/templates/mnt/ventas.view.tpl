<section class="depth-1">
<h1>Trabajar con Ventas</h1>
</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Fecha</th>
        <th>Libro</th>
        <th>Monto</th>
        <th><a href="index.php?page=mnt-venta&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Ventas}}
      <tr>
        <td><a href="index.php?page=mnt-venta&mode=DSP&id={{Ventaid}}">{{Ventaid}}</a></td>
        <td>{{fechaventa}}</td>
        <td>{{libroVendido}}</td>
        <td>{{monto}}</td>
        <td>
          <a href="index.php?page=mnt-venta&mode=UPD&id={{Ventaid}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=mnt-venta&mode=DEL&id={{Ventaid}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Ventas}}
    </tbody>
  </table>
</section>