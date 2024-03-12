@if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @php $campo = explode(" ", $error); @endphp
                    @section($campo[2])
                        @error($campo[2])
                        <div class="alert alert-danger">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="Close"></button>
                        </div>
                        @enderror
                    @stop
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="Close"></button>
        </div>
@endif

@if(Session::has('mensaje'))
    <div class="alert alert-{{Session::get('css')}} alert-dismissible fade show" role="alert">
        {{Session::get('mensaje')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
