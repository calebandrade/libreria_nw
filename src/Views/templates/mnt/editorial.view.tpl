<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_editorial" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="editid" value="{{editid}}" />
    <fieldset>
   
    
      <label for="editnom">Nombre</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="editnom" name="editnom" placeholder="Nombre" value="{{editnom}}" />
      {{if error_editnom}}
          {{foreach error_editnom}}
            <div class="error">{{this}}</div>
          {{endfor error_editnom}}
      {{endif error_editnom}}
    </fieldset>
    
    <fieldset>

      <label for="editnum">Numero</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="editnum" name="editnum" placeholder="Numero" value="{{editnum}}" />
      {{if error_editnum}}
          {{foreach error_editnum}}
            <div class="error">{{this}}</div>
          {{endfor error_editnum}}
      {{endif error_editnum}}
    </fieldset>
    <fieldset>

      <label for="editdirec">Direccion</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="editdirec" name="editdirec" placeholder="Direccion" value="{{editdirec}}" />
      {{if error_editdirec}}
          {{foreach error_editdirec}}
            <div class="error">{{this}}</div>
          {{endfor error_editdirec}}
      {{endif error_editdirec}}
    </fieldset>
    
    <fieldset>

      <label for="editest">Estado</label>
      <select name="editest" id="editest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach editestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor editestArr}}
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
      window.location.href = 'index.php?page=mnt_editorials';
    });
  });
</script>