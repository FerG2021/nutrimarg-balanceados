<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--ruta absoluta hacia la carpeta public para CSS-->
    <link rel="stylesheet" href="{{ url('static/css/pdf.css?v='.time()) }}">

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/b5b44e16f8.js" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body class="pdf">        
    <div class="header"> 
      <div class="title-header">
        <h3>NUTRIMARG BALANCEADOS - COMPROBANTE DE COMPRA AL PROVEEDOR</h3>
        {{-- <h4>Colón y Taboada - Qumilí - Santiago del Estero</h4>
        <h4>CUIT:  20-33703862-0 - Teléfono: 3843-675770</h4> --}}
      </div>    
      <div class="details-budget">  
        <div class="document">
          <div class="x-container">
            <label for="" class="x">X</label>
          </div>
          <div class="legend">
            <label for="">Documento no válido como factura</label>
          </div>
        </div>      
        <div class="info">
          <div class="title">
            <label for="">Datos</label>
          </div>
          <div class="name-client">
            <label for="">Proveedor:</label>
            <label for="">{{$buy->nameProvider}}</label>
          </div>
          <div class="id-budget">
            <label for="">Número:</label>
            <label for="">{{$buy->id}}</label>
          </div>
          <div class="date">
            <label for="">Fecha:</label>
            <label for="">{{$buy->date}}</label>
          </div>
          <div class="name-seller">
            <label for="">Comprador:</label>
            <label for="">{{$buy->nameSeller}}</label>
          </div>
        </div>
      </div>
    </div>

    
   

    <div class="detail-table">
      <table class="table-striped text-center" >
        <thead>
          <tr>
            <th scope="col">Cantidad</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio de compra</th>
            <th scope="col">Subtotal</th>          
          </tr>
        </thead>
        <tbody>
            @foreach ($buyproducts as $buyproduct)
            <tr>
                <td>{{ $buyproduct->cantProduct }}</td>
                <td>{{ $buyproduct->name }}</td>
                <td>{{ $buyproduct->priceProductBuy }}</td>
                <td>{{ $buyproduct->subtotal }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">TOTAL</th>
          <th scope="col">{{$buy->totalPrice}}</th> 
        </tfoot>
      </table>
    </div>

      {{-- <label for="priceTotalBudget">{{$budget->totalPrice}}</label> --}}
</body>
</html>

