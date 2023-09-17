var sessionTimeout = 5 * 60 * 1000; // 5 minutos en milisegundos
var lastActivityTime = new Date().getTime();

function resetSessionTimeout() {
    lastActivityTime = new Date().getTime();
}

function checkSessionTimeout() {
    var currentTime = new Date().getTime();
    if (currentTime - lastActivityTime > sessionTimeout) {
        // Si ha pasado demasiado tiempo de inactividad, redirige a una página de cierre de sesión o realiza otras acciones necesarias
        window.location.href = 'php/exit.php';
    } else {        
        setTimeout(checkSessionTimeout, 1000);
    }
}

document.addEventListener('mousemove', resetSessionTimeout);
document.addEventListener('keydown', resetSessionTimeout);
document.addEventListener('click', resetSessionTimeout);

setTimeout(checkSessionTimeout, 1000);