<section class="depth-1">
<h1>Trabajar con Categorias</h1>
</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th><a href="index.php?page=mnt-categoria&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach categorias}}
      <tr>

        <td>{{catid}}</td>
        <td>{{catnom}}</td>
        <td>{{catest}}</td>
     
        <td>
          <a href="index.php?page=mnt-categoria&mode=UPD&id={{catid}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=mnt-categoria&mode=DEL&id={{catid}}">Eliminar</a>
        </td>
      </tr>
      {{endfor categorias}}
    </tbody>
  </table>
</section>