<!-- Start Displayed Data Section -->
<article class="container">
  <article class="wrapper" id="data-display">
    <h1 class="display-data-title" id="title">Usuario</h1>
    <hr />
    <form>
      <div class="form-group">
        <label class="form-input-title">Cedula</label>
        <input
          type="text"
          id="cedula"
          name="cedula"
          class="form-control md-size"
          required
          placeholder="Numero de Cedula"
        />
      </div>
      <div class="wrapper">
        <div class="form-group sm-size">
          <label class="form-input-title">Nombre</label>
          <input
            type="text"
            maxlength="50"
            id="firstnames"
            name="firstnames"
            class="form-control"
            placeholder="Nombre"
          />
        </div>
        <div class="form-group sm-size">
          <label class="form-input-title">Apellidos</label>
          <input
            type="text"
            maxlength="50"
            id="lastnames"
            name="lastnames"
            class="form-control"
            placeholder="Apellidos"
          />
        </div>
      </div>
      <div class="form-group">
        <label class="form-input-title">Telefono</label>
        <input
          type="tel"
          maxlength="13"
          id="phone"
          name="phone"
          class="form-control md-size"
          placeholder="Codigo de Identificacion"
        />
      </div>
      <div class="form-group">
        <label class="form-input-title">Direccion de Habitacion</label>
        <textarea
          class="form-control"
          name="address"
          id="address"
          placeholder="Direccion de Habitacion"
          rows="2"
          maxlength="255"
        ></textarea>
      </div>
      <div class="wrapper">
        <div class="form-group sm-size">
          <label class="form-input-title">Clave</label>
          <input
            type="password"
            maxlength="32"
            id="firstnames"
            name="firstnames"
            class="form-control"
            placeholder="Clave"
          />
        </div>
        <div class="form-group sm-size">
          <label class="form-input-title">Repita Clave</label>
          <input
            type="password"
            maxlength="32"
            id="lastnames"
            name="lastnames"
            class="form-control"
            placeholder="Repita Clave"
          />
        </div>
      </div>
      <div class="form-group submit-button-container">
        <input type="reset" value="Limpiar Datos" class="form-button" />
        <input type="submit" value="Editar" class="form-button" />
      </div>
    </form>
  </article>
</article>
<!-- End Displayed Data Section -->