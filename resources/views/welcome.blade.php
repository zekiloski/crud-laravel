<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/223fe885fc.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-center p-3">Crud en Laravel</h1>

    {{-- Mostrar mensaje --}}
    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif
    {{--Fin Mostrar mensaje --}}

    <script>
      var res=function(){
        var not=confirm("¿Estas seguro de eliminar?");
        return not;
      }
    </script>

    {{-- Modal agregar nuevo Registro --}}
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Nuevo Producto</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
              <form action="{{route("crud.create")}}" method="POST"> 
                @csrf 
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Codigo</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcodigo" readonly>
                  
                </div>
               
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre">
                  
                </div>
               
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Precio</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecio">
                  
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcantidad">
                  
                </div>
                

                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerra</button>
                   <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    {{--Fin Modal agregar nuevo Registro --}}

    <div class="table-responsive p-5">

      {{-- Boton Agregar Nuevo Producto --}}
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Nuevo Poducto</button>
      {{-- Fin Boton Agregar Nuevo Producto --}}

        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">CODIGO</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">PRECIO</th>
                <th scope="col">CANTIDAD</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
                {{--Recorrer tabla con un for each trae los datos de welcome  --}}
                @foreach ($datos as $item)
                <tr>
                  <th>{{$item->id_producto}}</th>
                  <td>{{$item->nombre}}</td>
                  <td><b>$</b>{{$item->precio}}</td>
                  <td>{{$item->cantidad}}</td>
                  <td>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id_producto}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>

                    <a href="{{route("crud.delete",$item->id_producto)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                  </td>

                 
  
                <!-- Modal Modificar Producto -->
               <div class="modal fade" id="modalEditar{{$item->id_producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Datos del Producto</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                      <div class="modal-body">
                        <form action="{{route("crud.update")}}" method="POST">
                          @csrf

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcodigo" value="{{$item->id_producto}}" readonly>
                            
                          </div>
                         
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre" value="{{$item->nombre}}">
                            
                          </div>
                         
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Precio</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecio" value="{{$item->precio}}">
                            
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcantidad" value="{{$item->cantidad}}">
                            
                          </div>
                          

                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerra</button>
                             <button type="submit" class="btn btn-primary">Modificar</button>
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
              </div>
                </tr>    
                @endforeach
             
             
            </tbody>
          </table>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    
</body>
</html>