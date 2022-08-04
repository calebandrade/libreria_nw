<section class="depth-1">
  <h1>Trabajar con Funciones</h1>
</section>
<section class="WWList">
  <table >
    <thead>
      <tr>
      <th>Código</th>
      <th>Descripción</th>
      <th>Estado</th>
      <th>Tipo</th>
      <th>
        <a href="index.php?page=mnt_funcion&mode=INS">Nuevo</a>
      </th>
      </tr>
    </thead>
    <tbody>
      {{foreach Funciones}}
      <tr>
        <td>{{fncod}}</td>
        <td>
          <a href="index.php?page=mnt_funcion&mode=DSO&id={{fncod}}">{{fndsc}}</a>
        </td>
        <td>{{fnest}}</td>
        <td><a href="index.php?page=mnt_funcion&mode=DSO&id={{fncod}}">{{fntyp}}</a></td>
        <td>
          <a href="index.php?page=mnt_funcion&mode=UPD&id={{fncod}}">Editar</a>
          &nbsp;
          <a href="index.php?page=mnt_funcion&mode=DEL&id={{fncod}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Funciones}}
    </tbody>
  </table>
</section>
