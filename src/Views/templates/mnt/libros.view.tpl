<h1>Trabajar con Libros</h1>
<section>

</section>
<section>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Editorial</th>
        <th>Precio</th>
        <th>Estado</th>
        <th><a href="index.php?page=Mnt-Libro&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Libros}}
      <tr>
        <td>{{libId}}</td>
        <td> <a href="index.php?page=Mnt-Libro&mode=DSP&id={{libId}}">{{libDsc}}</a></td>
        <td>{{catid}}</td>
        <td>{{editid}}</td>
        <td>{{libprice}}</td>
        <td>{{libest}}</td>
        <td>
          <a href="index.php?page=Mnt-Libro&mode=UPD&id={{libId}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Libro&mode=DEL&id={{libId}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Libros}}
    </tbody>
  </table>
</section>




