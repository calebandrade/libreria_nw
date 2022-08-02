<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_usuario" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="usercod" value="{{usercod}}" />
   
    <fieldset>

      <label for="useremail">Correo:</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="useremail" name="useremail" placeholder="Correo" value="{{useremail}}" />
      {{if error_useremail}}
        {{foreach error_useremail}}
          <div class="error">{{this}}</div>
        {{endfor error_useremail}}
      {{endif error_useremail}}
    </fieldset>

     <fieldset>

      <label for="username">Nombre de Usuario:</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="username" name="username" placeholder="Nombre de Usuario" value="{{username}}" />
      {{if error_username}}
        {{foreach error_username}}
          <div class="error">{{this}}</div>
        {{endfor error_username}}
      {{endif error_username}}
    </fieldset>

     <fieldset>

      <label for="userpswd">Contraseña:</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="userpswd" name="userpswd" placeholder="Contraseña" value="{{userpswd}}" />
      {{if error_userpswd}}
        {{foreach error_userpswd}}
          <div class="error">{{this}}</div>
        {{endfor error_userpswd}}
      {{endif error_userpswd}}
    </fieldset>

    <fieldset>
      <label for="userpswdest">Contraseña Estado</label>
      <select name="userpswdest" id="userpswdest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach userpswdestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor userpswdestArr}}
      </select>
    </fieldset>

    <fieldset>

      <label for="userpswdexp">Expiracion Contraseña:</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="userpswdexp" name="userpswdexp" placeholder="2022-07-02" value="{{userpswdexp}}" />
      {{if error_userpswdexp}}
        {{foreach error_userpswdexp}}
          <div class="error">{{this}}</div>
        {{endfor error_userpswdexp}}
      {{endif error_userpswdexp}}
    </fieldset>

     
   
     <fieldset>
      <label for="userest">Estado</label>
      <select name="userest" id="userest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach userestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor userestArr}}
      </select>
    </fieldset>
  
      <fieldset>

      <label for="useractcod">Codigo usuario:</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="useractcod" name="useractcod" placeholder="59ca06888d06123f79f99d028a773" value="{{useractcod}}" />
      {{if error_useractcod}}
        {{foreach error_useractcod}}
          <div class="error">{{this}}</div>
        {{endfor error_useractcod}}
      {{endif error_useractcod}}
    </fieldset>
    
    
     <fieldset>
      <label for="usertipo">Tipo</label>
      <select name="usertipo" id="usertipo" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach usertipoArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor usertipoArr}}
      </select>
    </fieldset>


  <fieldset>
    <fieldset>
      {{if showBtn}}
        <button type="submit" name="btnEnviar">{{btnEnviarText}}</button>
        &nbsp;
      {{endif showBtn}}
      <button name="btnCancelar" id="btnCancelar">Cancelar</button>
    </fieldset>
  </form>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnCancelar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=mnt_usuarios2';
    });
  });
</script>