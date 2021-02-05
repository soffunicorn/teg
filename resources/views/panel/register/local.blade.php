@extends('app')
@section('panelTitle', 'Registro de Locales')
@section('panelContent')

    <div class="row justify-content-center">
        <div class="form-register  col-6">
            <form method="POST" action="{{url('/locales')}}" class="card-body card">
                @csrf
                <label for="Número de Local">Número de local</label>

                <input type="text" name="n_local" id="n_local" required class="form-control mb-3"
                       placeholder="EJ: L-149">
                @if($states->count() !== 0)
                    <label for="Número de Local">Estado del local</label>
                    <select name="status" id="status" class="form-control">
                        <option selected> --Seleccionar --</option>
                        @foreach($states as $state)
                            <option value="{{$state->slug}}">{{$state->state}}</option>
                        @endforeach
                    </select>
                @endif
                <button type="submit" class="btn uniform-bg"> Crear</button>
            </form>
        </div>


@endsection
