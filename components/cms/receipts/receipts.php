<!-- Start Displayed Data Section -->
<article class="container">
  <article class="wrapper" id="data-display">
    <h1 class="display-data-title" id="title">Facturas</h1>
    <hr />
    <form>
      <div class="wrapper">
        <div class="form-group md-size">
          <label class="form-input-title">Fecha</label>
          <input
            type="date"
            id="date"
            name="date"
            class="form-control"
            placeholder="Codigo de Identificacion"
            required
          />
        </div>
        <div class="form-group sm-size">
          <label class="form-input-title">Hora de Inicio</label>
          <input
            type="time"
            id="time"
            name="time"
            class="form-control"
            required
          />
        </div>
      </div>
      <div class="form-group">
        <label class="form-input-title">Cajero</label>
        <input
          type="text"
          id="emp-name"
          name="emp-name"
          class="form-control md-size"
          placeholder="Nombre del Cajero"
          required
        />
      </div>
      <div class="form-group">
        <label class="form-input-title">Mercancia Recibida</label>
        <input
          type="number"
          id="commodity"
          name="commodity"
          class="form-control md-size"
          placeholder="Monto de Mercancia Recibida"
          required
        /> $
      </div>
      <div class="form-group">
        <label class="form-input-title">Gastos Operativos</label>
        <input
          type="number"
          id="expenses"
          name="expenses"
          class="form-control md-size"
          placeholder="Gastos Operativos"
          required
        /> $
      </div>
      <div class="form-group submit-button-container">
        <input
          type="submit"
          value="Eliminar Registro"
          class="form-button"
        />
        <input type="submit" value="Editar" class="form-button" />
      </div>
    </form>
    
  </article>
</article>
<!-- End Displayed Data Section -->