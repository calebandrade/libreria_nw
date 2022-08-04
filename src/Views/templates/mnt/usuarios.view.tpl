<section class="depth-1">
<h1>Trabajar con Usuarios</h1>
</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>UserEmail</th>
        <th>UserName</th>
        <th>Estado</th>
        <th>Tipo</th>
        <th><a href="index.php?page=Mnt-Usuario&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Usuarios}}
      <tr>
        <td>{{usercod}}</td>
        <td> <a href="index.php?page=Mnt-Usuario&mode=DSP&id={{usercod}}">{{useremail}}</a></td>
        <td>{{username}}</td>
        <td>{{userest}}</td>
        <td>{{usertipo}}</td>
        <td>
          <a href="index.php?page=Mnt-Usuario&mode=UPD&id={{usercod}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Usuario&mode=DEL&id={{usercod}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Usuarios}}
    </tbody>
  </table>
</section>