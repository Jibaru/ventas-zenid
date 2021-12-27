(function () {
  const chkFactura = document.getElementById("chk-factura");
  const btnValidarRuc = document.getElementById("btn-validar-ruc");
  const inputComprobante = document.getElementById("comprobante");
  const nombreEmpresa = document.getElementById("nombre-empresa");
  const btnGenerar = document.getElementById("btn-generar-venta");
  btnValidarRuc.style.display = "none";

  function activarBoton(e) {
    if (chkFactura.checked) {
      btnValidarRuc.style.display = "block";
      btnGenerar.disabled = true;
      inputComprobante.placeholder = "Nº RUC";
    } else {
      btnValidarRuc.style.display = "none";
      btnGenerar.disabled = false;
      inputComprobante.placeholder = "Nº DNI";
    }
    inputComprobante.value = null;
    nombreEmpresa.textContent = "";
    nombreEmpresa.style.display = "none";
  }

  document
    .querySelectorAll("input[name='tipo-comprobante']")
    .forEach((input) => {
      input.addEventListener("change", activarBoton);
    });

  inputComprobante.addEventListener("input", function (e) {
    if (chkFactura.checked) {
      btnGenerar.disabled = true;
    }
  });

  btnValidarRuc.addEventListener("click", function (e) {
    this.disabled = true;
    this.textContent = "Validando...";
    const formData = new FormData();
    formData.append("ruc", inputComprobante.value);

    fetch("PostValidarRuc.php", {
      method: "POST",
      body: formData,
    })
      .then((resp) => {
        return resp.json();
      })
      .then((resp) => {
        this.disabled = false;
        this.textContent = "Validar RUC";

        if (resp.ok) {
          nombreEmpresa.textContent = resp["empresa"];
          nombreEmpresa.style.display = "block";
          nombreEmpresa.classList.remove("alert-danger");
          nombreEmpresa.classList.add("alert-success");
          btnGenerar.disabled = false;
        } else {
          nombreEmpresa.textContent = resp["mensaje"];
          nombreEmpresa.style.display = "block";
          nombreEmpresa.classList.add("alert-danger");
          nombreEmpresa.classList.remove("alert-success");
        }
      });
  });
})();
