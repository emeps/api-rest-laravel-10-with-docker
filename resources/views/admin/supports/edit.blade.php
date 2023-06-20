<h1>Duvida - {{$support->id}}</h1>

<form action="{{route('supports.update', $support->id)}}" method="POST">
    @csrf()
    @method('PUT')
    <input type="text" placeholder="Assunto" name="subject" value="{{$support->subject}}">
    <textarea name="content" id="" cols="30" rows="10" placeholder="Descrição">{{$support->content}}</textarea>
    <button type="submit">Enviar</button>
</form>