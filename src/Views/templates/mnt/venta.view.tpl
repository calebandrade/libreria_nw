 
<h1>{{mode_desc}}</h1>
<style>
    .modal-contenido{
  background-color:rgb(139, 138, 141);
  width:400px;
  padding: 10px 20px;
  margin: 20% auto;
  position: relative;
}
.modal{
  background-color: rgba(0,0,0,.8);
  position:fixed;
  top:0;
  right:0;
  bottom:0;
  left:0;
  opacity:0;
  pointer-events:none;
  transition: all 1s;
}
#miModal:target{
  opacity:1;
  pointer-events:auto;
}
</style>
<section>
  <form action="index.php?page=mnt_venta" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="Ventaid" value="{{Ventaid}}" />
   
    <fieldset>
      <label for="fechaventa">Fecha</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="fechaventa" name="fechaventa" placeholder="Fecha" value="{{fechaventa}}" />
      {{if error_fechaventa}}
          {{foreach error_fechaventa}}
            <div class="error">{{this}}</div>
          {{endfor error_fechaventa}}
      {{endif error_fechaventa}}
    </fieldset>

     <fieldset>
      <label for="libroVendido">Codigo Libro</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="libroVendido" name="libroVendido" placeholder="id Libro" value="{{libroVendido}}" />
      {{if error_libroVendido}}
          {{foreach error_libroVendido}}
            <div class="error">{{this}}</div>
          {{endfor error_libroVendido}}
      {{endif error_libroVendido}}
    </fieldset>

     <fieldset>
      <label for="monto">Monto</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="monto" name="monto" placeholder="monto" value="{{monto}}" />
      {{if error_monto}}
          {{foreach error_monto}}
            <div class="error">{{this}}</div>
          {{endfor error_monto}}
      {{endif error_monto}}
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
      window.location.href = 'index.php?page=mnt_ventas';
    });
  });
</script>