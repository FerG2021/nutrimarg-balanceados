$(document).ready(function() {    
    // alert('hola');
    $('[data-toggle="tooltip"]').tooltip()
    var budgetTable = $('table.display').DataTable({
        "destroy": true,        
        "ordering": false,
        "info":     false,  
        lengthChange: false,
        dom: 'Bfrtip',      
        "columDefs":[{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-Editar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
        }],        
        buttons: [
            {
                "extend": "excelHtml5",
                "text": "<i class='far fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel", 
                "className": "btn btn-success"
            },
            {
                "extend": "pdfHtml5",
                "text": "<i class='far fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF", 
                "className": "btn btn-danger"
            }
            
            // 'copy', 'excel', 'pdf'
            
        ],
        // buttons:{
        //     dom:{
        //         button:{
        //             className: 'btn'
        //         }
        //     },
        //     buttons:{
        //         extend: 'excel',
        //         text: 'Exportar a Excel',
        //         className: 'btn btn-success',
        //         excelStyle:{
        //             template: 'header_blue'
        //         }
        //     }
        // },
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 de 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",            
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },               
    }); 

    budgetTable.buttons().container()
        .appendTo( 'table.display .col-md-6:eq(0)' );

    // var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    // var toastList = toastElList.map(function (toastEl) {
    // return new bootstrap.Toast(toastEl, option)
    // })

    $('.toast').toast('show');

    
    
    
    
    // Asigna el valor del total del presupuesto en un input
    
    var total = budgetTable.column( 3 ).data().sum();
    console.log(total);    
    document.getElementById("totalBudget3").value = total;
    
    var totalInput = budgetTable.column( 3 ).data().sum();
    console.log(totalInput);
    document.getElementById("totalBudgetInput3").value = totalInput;


    
    var totalSale = budgetTable.column( 6 ).data().sum();
    console.log("precio total de venta "+totalSale);    
    document.getElementById("totalBudget6").value = totalSale;
        
    var totalInputSale = budgetTable.column( 6 ).data().sum();
    console.log(totalInputSale);
    document.getElementById("totalBudgetInput6").value = totalInputSale;
    
    
    

    

    
    // // Asignar el valor del total de la compra en un input
    // var totalSale = budgetTable.column( 6 ).data().sum();
    // console.log("precio total de venta "+totalSale);    
    // document.getElementById("totalBudget6").value = totalSale;

    // var totalInputSale = budgetTable.column( 6 ).data().sum();
    // console.log(totalInputSale);
    // document.getElementById("totalBudgetInput6").value = totalInputSale;

    
    


    // // Asigna el valor del total de la compra en un input
    // var totalBuy = budgetTable.column( 3 ).data().sum();
    // console.log(totalBuy);    
    // document.getElementById("totalBuy").value = totalBuy;

    // var totalBuyInput = budgetTable.column( 3 ).data().sum();
    // console.log(totalBuyInput);
    // document.getElementById("totalBuyInput").value = totalBuyInput;
   
    document.getElementById('modalAddProduct').reset();

    // Cargar select a partir de otro select para tipo de cliente
    recargarLista();

    $('#tipeBuyer').change(function(){
        recargarLista();
    });

    
} ); 

var toastTrigger = document.getElementById('liveToastBtn')
var toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
toastTrigger.addEventListener('click', function () {
    var toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
})
}


$("#menu-toggle").click(function(e){
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
})

// SCRIPT PARA MOSTRAR LOS ALERTAS
$('.alert').slideDown();
setTimeout(function(){$('.alert').slideUp();}, 10000);
// 


// SCRIPT PARA MOSTRAR EL TOOTTIP
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
// 

//AGREGAR PRODUCTO DE LA LISTA
function selectProduct(pricesale) {    
    var pricesale = $('#nameSelectForm>option:selected').attr("data-pricesale");    
    console.log(pricesale);   

    let pricesalebudget = document.getElementById("pricesaleForm");
    pricesalebudget.setAttribute("value", pricesale);
    console.log(pricesalebudget.value);
}

//TOMAR EL ID DE PRODUCTO AGREGADO A LA VENTA
function selectProductBuy(id) {    
    var id = $('#nameProduct>option:selected').attr('data-id');
    console.log(id);

    let idproduct = document.getElementById("idProduct");
    idproduct.setAttribute("value", id);
    console.log(idproduct.value);
}

// CAMBIAR SELECT SEGUN EL TIPO DE PRODUCTO
function selectTypeBuyer(){
    var typeBuyer = document.getElementById("tipeBuyer").value;
    console.log(typeBuyer);    
}

function recargarLista(){
    $.ajax({
        type:"POST",
        url:"datos.php",
        data:"user=" + $('#tipeBuyer').val(),
        success:function(r){
            $('#selectListaNombres').html(r);
        }
    });
}

// Seleccionar id del cliente
function selectIdClient(){
    var idClient = document.getElementById("nameBuyer").value;    
    console.log(idClient);    

    let idClientInput = document.getElementById("idClient");
    idClientInput.setAttribute("value", idClient);
    console.log(idClientInput.value);

    var name = $('#nameBuyer>option:selected').attr('data-name');
    console.log(name);

    let nameClientInput = document.getElementById("nameClient");
    nameClientInput.setAttribute("value", name);
    console.log(nameClientInput.value);    

}

// seleccionar el id del cliente - firma comercial
function selectIdClientFC(){
    var idClient = document.getElementById("nameBuyer").value;    
    console.log(idClient);

    let idClientInput = document.getElementById("idClient");
    idClientInput.setAttribute("value", idClient);
    console.log(idClientInput.value);

    var name = $('#nameBuyer>option:selected').attr('data-name');
    console.log(name);

    let nameClientInput = document.getElementById("nameClient");
    nameClientInput.setAttribute("value", name);
    console.log(nameClientInput.value);

}

function selectProductSale(){
    // precio de venta
    var pricesale = $('#nameProduct>option:selected').attr('data-pricesale');
    console.log(pricesale);
    var pricesaleinput = document.getElementById("pricesale");
    pricesaleinput.setAttribute("value", pricesale);
    console.log(pricesaleinput.value);

    // tipo de venta
    var tipesale = $('#nameProduct>option:selected').attr('data-tipesale');
    console.log(tipesale);
    var tipesaleinput = document.getElementById("tipesaleinput");
    tipesaleinput.setAttribute("value", tipesale);

    var formsale = document.getElementById("typesalebag");

    // id del producto en la tabla de productos
    var idproduct = $('#nameProduct>option:selected').attr('data-id');
    var idproductinput = document.getElementById("idProduct");
    idproductinput.setAttribute("value", idproduct);
    console.log("id" + idproductinput.value);

    // cantidad de kilos por bolsa
    var kgbag = $('#nameProduct>option:selected').attr('data-kgbag');
    var kgbaginput = document.getElementById("kgbag");
    kgbaginput.setAttribute("value", kgbag);

    // precio por kilo
    var pricekg = $('#nameProduct>option:selected').attr('data-pricekg');
    var pricekginput = document.getElementById("pricekg");
    pricekginput.setAttribute("value", pricekg);

    if (tipesale == 0) {
        console.log('venta por unidad');
        console.log(formsale);
        // formsale.disabled = true;   
        var select = document.getElementById("typesalebag");
        select.setAttribute("value", 4);
        console.log("typesalebag" + select.value);

    } else {
        console.log('venta por bolsa');
        console.log(formsale);
        formsale.disabled = false;
    }
}

// seleccionar el tipo de venta (Por unidad o por bolsa)
function selectTipeSale(){
    // var tipesale = $('#tipesale>option:selected').attr('data-tipesale');
    var tipesale = document.getElementById("tipesale").value;
    console.log(tipesale);
}

function selecttypeproduct(){
    var typeproduct = $('#tipesale>option:selected').value;
    console.log(typeproduct);
}

