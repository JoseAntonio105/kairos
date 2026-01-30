window.addEventListener("load", () => {
  if (!window.google || !google.accounts || !google.accounts.id) {
    console.error("Google GIS no cargó (gsi/client).");
    return;
  }

  const clientId = window.GOOGLE_CLIENT_ID;
  if (!clientId) {
    console.error("Falta window.GOOGLE_CLIENT_ID");
    return;
  }

  google.accounts.id.initialize({
    client_id: clientId,
    callback: handleGoogleCredential
  });

  const container = document.getElementById("g_id_signin");
  if (container) {
    google.accounts.id.renderButton(container, {
      theme: "outline",
      size: "large",
      text: "signup_with"
    });
  } else {
    console.error("No existe #g_id_signin en el HTML.");
  }
});

async function handleGoogleCredential(response) {
  try {
    const formData = new FormData();
    formData.append("credential", response.credential);

    const r = await fetch("config/google_verify.php", {
      method: "POST",
      body: formData
    });

    const text = await r.text();

    let data;
    try {
      data = JSON.parse(text);
    } catch (e) {
      console.error("Respuesta NO es JSON:", text);
      alert("No se pudo validar Google (respuesta inválida).");
      return;
    }

    if (!r.ok || !data.ok) {
      console.error("Google verify fallo:", r.status, data);
      alert("No se pudo validar Google.");
      return;
    }

    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("email");
    const nombreInput = document.getElementById("nombre");
    const apellidosInput = document.getElementById("apellidos");
    const passInput = document.getElementById("password");
    const flagGoogle = document.getElementById("registro_google");

    if (usernameInput) usernameInput.value = data.username || "";
    if (emailInput) emailInput.value = data.email || "";

    if (nombreInput) nombreInput.value = data.nombre || "";
    if (apellidosInput) apellidosInput.value = data.apellidos || "";

    if (flagGoogle) flagGoogle.value = "1";

    if (passInput) {
      passInput.required = false;
      passInput.value = "";
      const group = passInput.closest(".frame-input-group");
      if (group) group.style.display = "none";
    }
  } catch (err) {
    console.error(err);
    alert("No se pudo validar Google (error de red).");
  }
}
