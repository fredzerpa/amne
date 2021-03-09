<!-- Start Displayed Data Section -->
<article class="container">
  <article class="wrapper" id="data-display">
    <h1 class="display-data-title" id="title">Barcos</h1>
    <hr />
    <form>
      <div class="form-group">
        <label class="form-input-title">Codigo de Identificacion</label>
        <input
          type="text"
          id="id-code"
          name="id-code"
          class="form-control md-size"
          readonly
          placeholder="Codigo de Identificacion"
        />
      </div>
      <div class="form-group">
        <label class="form-input-title">Titular del Barco</label>
        <input
          type="text"
          id="boat-owner"
          name="boat-owner"
          class="form-control md-size"
          placeholder="Nombre del Titular"
          required
        />
      </div>
      <div class="wrapper">
        <div class="form-group sm-size">
          <label class="form-input-title">Nombre</label>
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            placeholder="Nombre"
            required
          />
        </div>
        <div class="form-group sm-size">
          <label class="form-input-title">Cantidad de Tripulantes</label>
          <input
            type="number"
            id="num-emp"
            name="num-emp"
            class="form-control"
            placeholder="# Tripulantes"
            required
          />
        </div>
      </div>
      <div class="form-group">
        <label class="form-input-title">Capacidad</label>
        <input
          class="form-control"
          name="load-capacity"
          id="load-capacity"
          placeholder="Capacidad de Carga (Kg)"
          rows="5"
        />
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