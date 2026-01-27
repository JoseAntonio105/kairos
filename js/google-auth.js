window.addEventListener("load", () => {
  google.accounts.id.initialize({
    client_id: window.GOOGLE_CLIENT_ID,
    callback: handleGoogleCredential
  });

  google.accounts.id.renderButton(
    document.getElementById("g_id_signin"),
    { theme: "outline", size: "large", text: "signup_with" }
  );
});

async function handleGoogleCredential(response) {
  const formData = new FormData();
  formData.append("credential", response.credential);

  const r = await fetch("config/google_verify.php", { method: "POST", body: formData });
  const data = await r.json();

  if (!data.ok) return alert("No se pudo validar Google.");

  document.getElementById("username").value = data.username;
  document.getElementById("email").value = data.email;
}
