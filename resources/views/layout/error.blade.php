@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </div>
@endif