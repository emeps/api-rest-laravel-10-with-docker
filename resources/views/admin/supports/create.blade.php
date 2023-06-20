<h1>Nova Duvida</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}}
    @endforeach
@endif

<form action="{{route('supports.store')}}" method="POST">
    @csrf()
    <input type="text" placeholder="Assunto" name="subject" value="{{old('subject')}}">
    <textarea name="content" id="" cols="30" rows="10" placeholder="Descrição">{{old('content')}}</textarea>
    <button type="submit">Enviar</button>
</form>