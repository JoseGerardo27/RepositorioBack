
    <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Colaboradores</title>
      </head>
      <body>
        <h1 class="bg-primary text-white text-center">Sistema de Colaboradores</h1>

        <div class= "container">
            @yield('contenido')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      </body>
    </html>


{{-- Referenciar --}}

<a href="{{ route('download-pdf') }}" method="downloadPdf" class="btn btn-success btn-sm">Export to PDF</a>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
<th scope="col">ID</th>
<th scope="col">Nombre</th>
<th scope="col">Departamento</th>
       </tr>
    </thead>
        <tbody>
            @foreach($colaboradores as $colaborador)
            <tr>
                <td>{{$colaborador->id}}</td>
                <td>{{$colaborador->nombre}}</td>
                <td>{{$colaborador->departamento}}</td>
                <td>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>

