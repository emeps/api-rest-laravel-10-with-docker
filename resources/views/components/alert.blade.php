<div class="alert alert-danger">
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}}
    @endforeach
@endif

</div>