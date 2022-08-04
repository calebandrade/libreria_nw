<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_libro" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="libId" value="{{libId}}" />
  
    <fieldset>
      <label for="libDsc">Descripción</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="libDsc" name="libDsc" placeholder="Descripción" value="{{libDsc}}" />
      {{if error_libDsc}}
          {{foreach error_libDsc}}
            <div class="error">{{this}}</div>
          {{endfor error_libDsc}}
      {{endif error_libDsc}}
    </fieldset>
  
    <fieldset>
      <label for="catid">Categoria</label>
      <select name="catid" id="catid" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach catidArr}}
          <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor catidArr}}
      </select>
    </fieldset>

     <fieldset>
      <label for="editid">Editorial</label>
      <select name="editid" id="editid" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach editidArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor editidArr}}
      </select>
    </fieldset>

    <fieldset>
      <label for="libprice">Precio</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="libprice" name="libprice" placeholder="Precio" value="{{libprice}}" />
      {{if error_libprice}}
          {{foreach error_libprice}}
            <div class="error">{{this}}</div>
          {{endfor error_libprice}}
      {{endif error_libprice}}
    </fieldset>

    <fieldset>
      <label for="libCodInt">Codigo de Barras</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="libCodInt" name="libCodInt" placeholder="Código de Barra" value="{{libCodInt}}" />
      {{if error_libCodInt}}
          {{foreach error_libCodInt}}
            <div class="error">{{this}}</div>
          {{endfor error_libCodInt}}
      {{endif error_libCodInt}}
    </fieldset>

    <fieldset>
      <label for="libimg">Imagen</label>
      <input {{if readonly}}readonly{{endif readonly}} type="file" id="libimg" name="libimg" placeholder="Imagen" value="{{libimg}}" />
      {{if error_libimg}}
          {{foreach error_libimg}}
            <div class="error">{{this}}</div>
          {{endfor error_libimg}}
      {{endif error_libimg}}
    </fieldset>

    <fieldset>
      <label for="libautor">Autor</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="libautor" name="libautor" placeholder="Autor" value="{{libautor}}" />
      {{if error_libautor}}
          {{foreach error_libautor}}
            <div class="error">{{this}}</div>
          {{endfor error_libautor}}
      {{endif error_libautor}}
    </fieldset>

    <fieldset>
      <label for="libest">Estado</label>
      <select name="libest" id="libest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach libestArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor libestArr}}
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
      window.location.href = 'index.php?page=mnt_libros';
    });
  });
</script>
