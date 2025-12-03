// Código para inicializar Darkmode.js
function addDarkmodeWidget() {
  const options = {
    // Estas opciones personalizan cómo se ve y dónde aparece el widget
    bottom: '64px', // Distancia desde abajo
    right: 'unset', // O 'unset' si no quieres ajustarla
    left: '32px', // Distancia desde la izquierda
    time: '0.5s', // Tiempo de transición
    mixColor: '#fff', // Color mezclado (generalmente blanco o negro)
    backgroundColor: '#f8f3ee', // Fondo del body
    buttonColorDark: '#100f2c', // Color del botón en modo oscuro
    buttonColorLight: '#fff', // Color del botón en modo claro
    saveInCookies: true, // Recuerda la preferencia
    label: '🌓', // Etiqueta del botón
    autoMatchOsTheme: true // Sincronizar con el tema del OS
  };

  const darkmode = new Darkmode(options);
  darkmode.showWidget();
}

// Llama a la función al cargar la página
window.addEventListener('load', addDarkmodeWidget);