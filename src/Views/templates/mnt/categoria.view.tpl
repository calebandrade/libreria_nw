<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_categoria" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="catid" value="{{catid}}" />
    <fieldset>
   
    
      <label for="catnom">Nombre</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="catnom" name="catnom" placeholder="Nombre" value="{{catnom}}" />
      {{if error_catnom}}
          {{foreach error_catnom}}
            <div class="error">{{this}}</div>
          {{endfor error_catnom}}
      {{endif error_catnom}}
    </fieldset>
    <fieldset>


      <label for="catest">Estado</label>
      <select name="catest" id="catest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach catestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor catestArr}}
      </select>
    </fieldset>
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
      window.location.href = 'index.php?page=mnt_categorias';
    });
  });
</script>