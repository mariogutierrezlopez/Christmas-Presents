
//Character count for textarea
//src: https://codepen.io/nagyalex/pen/ZEWLyaw


document.addEventListener('DOMContentLoaded', function() {
  // Obtén el textarea y los elementos de recuento
  var textarea = document.getElementById('carta');
  var currentCount = document.getElementById('current');
  var maximumCount = document.getElementById('maximum').textContent.slice(2); // Obtén el límite de caracteres

  currentCount.textContent = textarea.value.length;

  // Agrega un evento de escucha al textarea para contar los caracteres
  textarea.addEventListener('input', function() {
    var currentLength = textarea.value.length;
    
    // Actualiza el recuento actual
    currentCount.textContent = currentLength;
  });

  boton_editar = document.getElementById('boton-editar');
  boton_guardar = document.getElementById('boton-guardar');
  boton_editar.addEventListener('click', function() {
    console.log("Se ha pulsado el boton");
    r1.disabled = false;
    r2.disabled = false;
    r3.disabled = false;
    carta.disabled = false;

    boton_editar.style.display = "none";
    boton_guardar.style.display = "inline-block";
  });

  var form = document.getElementById('regalos-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
  });
  
});