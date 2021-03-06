@extends('layouts.app')

@section("styles")
    <link rel="stylesheet" href="{{ asset('libs/adminLTE/plugins/icheck/skins/square/green.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/adminLTE/plugins/toogle/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/lolibox/css/Lobibox.min.css') }}">
@endsection

@section('content')
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Crear Comision</h3>
        </div>
        <div class="box-body">
            {{--
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Por favor, corriga los siguientes errores:</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif--}}

            <form id="crearComision" action="{{ url("crear_comision") }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label>Nombre Comision <span class="text-red text-bold">*</span></label>
                            <input type="text" class="form-control" placeholder="Ingrese un nombre" id="nombre"
                                   name="nombre" value="{{old("nombre")}}">
                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" id="crear" name="crear" class="btn btn-primary">
                            Crear Comision
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Listado Comisiones</h3>
        </div>
        <div class="box-body table-responsive">
            <table id="listadoComisiones"
                   class="table table-striped table-bordered table-condensed table-hover dataTable text-center">
                <thead class="text-bold">
                <tr>
                    <th>Nombre de Comisión</th>
                    <th>Permanente</th>
                    <th>Integrantes</th>
                    <th>Estado</th>
                    <th>Fecha Creacion</th>
                    <th>Fecha Ultimo Acceso</th>
                </tr>
                </thead>

                <tbody id="cuerpoTabla">
                @foreach($comisiones as $comision)
                    <tr>
                        <td>{{ $comision->nombre }}</td>
                        <td>
                            @if($comision->permanente == 1)
                                <i class="fa fa-check text-success text-bold" aria-hidden="true"></i>
                            @endif
                        </td>

                        @php $contador = 0 @endphp

                        @foreach($cargos as $cargo)
                            @if($cargo->comision_id == $comision->id && $cargo->activo == 1)
                                @php $contador++ @endphp
                            @endif
                        @endforeach
                        <td>
                            {{ $contador }}
                        </td>
                        <td>
                            @if($comision->permanente == 0)
                                @if($comision->activa == 1)
                                    <input type="checkbox" name="estado" class="toogle"
                                           data-size="mini" onchange="cambiar_estado_comision({{ $comision->id }})"
                                           checked></i>
                                @else
                                    <input type="checkbox" name="estado" class="toogle"
                                           data-size="mini" onchange="cambiar_estado_comision({{ $comision->id }})"></i>
                                @endif
                            @endif
                        </td>
                        @if($comision->created_at)
                            <td>{{ date_format($comision->created_at,"d/m/Y h:i:s") }}</td>
                        @endif
                        @if($comision->updated_at)
                            <td>{{ date_format($comision->updated_at,"d/m/Y h:i:s") }}</td>
                        @endif

                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>

@endsection

@section("js")
    <script src="{{ asset('libs/utils/utils.js') }}"></script>
    <script src="{{ asset('libs/adminLTE/plugins/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('libs/adminLTE/plugins/toogle/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('libs/lolibox/js/lobibox.min.js') }}"></script>
@endsection

@section("scripts")
    <script type="text/javascript">

        $(function () {
            $('.toogle').bootstrapToggle({
                on: 'Activa',
                off: 'Inactiva',
                onstyle: 'success',
                offstyle: 'danger'
            });
        });

        function cambiar_estado_comision(id) {
            $.ajax({
                //se envia un token, como medida de seguridad ante posibles ataques
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ route("actualizar_comision") }}",
                data: {"id": id},
                success: function (response) {
                    notificacion(response.mensaje.titulo, response.mensaje.contenido, response.mensaje.tipo);
                }
            });
        }


    </script>

@endsection

@section("lobibox")

    @if(Session::has('success'))
        <script>
            notificacion("Exito", "{{ Session::get('success') }}", "success");
        </script>
    @endif

@endsection