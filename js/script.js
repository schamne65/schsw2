function fetchInsumoName(element, url,insumoNumber) {
    var insumoId = element.value;
    if (insumoId) {
        var xhr1 = new XMLHttpRequest();
        xhr1.open('POST','../productos/funciones/nombre.php', true);
        xhr1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr1.onreadystatechange = function() {
            if (xhr1.readyState == 4 && xhr1.status == 200)   
                var insumoElementId = 'insumo_nombre_' + insumoNumber;
            var insumoElement = document.getElementById(insumoElementId);
            if (insumoElement) {
                insumoElement.value = xhr1.responseText;
            } else {
                console.warn('Element with ID ' + insumoElementId + ' not found.');
            }
        }
    };
    xhr1.send('insumo_id=' + encodeURIComponent(insumoId));
}


function submitForm2(event, actionUrl) {
    event.preventDefault();
    var form1 = event.target;
    var formData1 = new FormData(form1);
    var xhr1 = new XMLHttpRequest();
    xhr1.open('POST', actionUrl, true);
    xhr1.onload = function () {
        if (xhr1.status === 200) {
            console.log('Form submitted successfully.');
            // Do something with the response if needed
        } else {
            console.error('Form submission failed.');
        }
    };
    xhr1.send(formData1);
    return false;
}


$(".abrir").click(function(){
    $(this).next(".desplegable").toggleClass("abierto");
});
$(".desplegable-menu").click(function(){
    $("#celular").toggleClass("abierto");
    console.log("hola")
})

$(document).ready(function(){
    let contador = 0
    $('.icon-plus').click(function(){
       
        contador++; 
       let insumoNecesarioId = 'insumo_nombre_' + contador;
        let insumoId = 'insumo_id_' + contador;
        let insumoCantidadUsadaId = 'insumo_cantidad_usada_' + contador;

        let input = `
        <label for="${insumoId}">Insumos id:</label>
        <input type="text" id="${insumoId}" name="${insumoId}" required oninput="fetchInsumoName(this, '../productos/funciones/nombre.php', ${contador})">
        <label for="${insumoNecesarioId}">Insumo Nombre:</label>
                    <input type="text" id="${insumoNecesarioId}" name="${insumoNecesarioId}" readonly>
        <br><br>
        <label for="${insumoCantidadUsadaId}">Cantidad necesaria</label>
        <input type="text" id="${insumoCantidadUsadaId}" name="${insumoCantidadUsadaId}" required>
        <br><br>
`;

        // Agregar el conjunto de inputs al contenedor
        $('#inputContainer').append(input);
        console.log("hola");
       


    });
});


$(document).ready(function(){
        function enviarFormulario(form) {
            var formData = $(form).serialize(); // Serializar los datos del formulario

            $.ajax({
                type: "POST",
                url: $(form).attr("action"), // Obtener la URL del atributo action del formulario
                data: formData,
                success: function(response){
                    alert(response); // Mostrar el resultado
                    location.reload(); // Recargar la página
                },
                error: function(){
                    alert("Error al enviar el formulario.");
                }
            });

            return false; // Evitar que el formulario se envíe de forma tradicional
        }

        $(document).ready(function(){
            $("form").submit(function(event){
                event.preventDefault();
                enviarFormulario(this); // Llamar a la función para enviar el formulario actual
            });
        });
    });


    
    function fetchProductName(element, url) {
        var productId = element.value;
        if (productId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('producto_nombre').value = xhr.responseText;
                }
            };
            xhr.send('producto_id=' + productId);
        }
    }
    
    function submitForm(event, actionUrl) {
        event.preventDefault();
        var form = event.target;
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', actionUrl, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Form submitted successfully.');
                // Do something with the response if needed
            } else {
                console.error('Form submission failed.');
            }
        };
        xhr.send(formData);
        return false;
    }


