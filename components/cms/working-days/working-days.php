<!-- Start Displayed Data Section -->
<article class="container">
  <article class="wrapper" id="data-display">
    <h1 class="display-data-title" id="title">Jornadas</h1>
    <hr />
    <form>
      <div class="wrapper">
        <div class="form-group md-size">
          <label class="form-input-title">Codigo Identificacion</label>
          <input
            type="text"
            id="id-code"
            name="id-code"
            class="form-control"
            readonly
            placeholder="Codigo de Identificacion"
          />
        </div>
        <div class="form-group sm-size">
          <label class="form-input-title">Clima</label>
          <input
            type="text"
            id="weather"
            name="weather"
            class="form-control"
            readonly
            placeholder="Soleado"
            value=""
          />
        </div>
      </div>
      <div class="form-group">
        <label class="form-input-title">Fecha</label>
        <input
          type="date"
          id="date"
          name="date"
          class="form-control md-size"
          placeholder="Codigo de Identificacion"
          required
        />
      </div>
      <div class="wrapper">
        <div class="form-group sm-size">
          <label class="form-input-title">Hora de Inicio</label>
          <input
            type="time"
            id="open-time"
            name="open-time"
            class="form-control"
            required
          />
        </div>
        <div class="form-group sm-size">
          <label class="form-input-title">Hora de Cierre</label>
          <input
            type="time"
            id="closing-time"
            name="closing-time"
            class="form-control"
          />
        </div>
      </div>
      <div class="form-group">
        <label class="form-input-title">Precio (Kg)</label>
        <input
          type="number"
          class="form-control sm-size"
          name="prod-price"
          id="prod-price"
          placeholder="Precio por Kg"
          rows="5"
        /> $
      </div>
      <div class="form-group submit-button-container">
        <input type="submit" value="Eliminar Registro"
        class="form-button" />
        <input type="submit" value="Editar" class="form-button" />
      </div>
    </form>
  </article>
</article>
<!-- End Displayed Data Section -->