<section class="depth-1">
<h1>Trabajar con Editoriales</h1>
</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Numero</th>
        <th>Direccion</th>
        <th>Estado</th>
        <th><a href="index.php?page=Mnt-Editorial&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Editorials}}
      <tr>
         <td>{{editid}}</td>
        <td>{{editnom}}</td>
        <td>{{editnum}}</td>
        <td>{{editdirec}}</td>
        <td>{{editest}}</td>
     
        <td>
          <a href="index.php?page=Mnt-Editorial&mode=UPD&id={{editid}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Editorial&mode=DEL&id={{editid}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Editorials}}
    </tbody>
  </table>
</section>