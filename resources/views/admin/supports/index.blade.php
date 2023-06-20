<h1>Listagem dos Suportes</h1>

<a href="{{route('supports.create')}}" target="_blank" rel="noopener noreferrer">Criar Duvida</a>
<table>
    <thead>
        <th>Assunto</th>
        <th>Status</th>
        <th>Descrição</th>
        <th>Aberto</th>
        <th>Atualizado</th>
        <th>Ações</th>
    </thead>
    <tbody>
        @foreach ($supports as $support)
            <tr>
                <td>{{ $support['subject'] }}</td>
                <td>{{ $support['status'] }}</td>
                <td>{{ $support['content'] }}</td>
                <td>{{ $support['created_at'] }}</td>
                <td>{{ $support['updated_at'] }}</td>
                <td>
                    <a href="{{route('supports.show', $support['id'])}}" target="_blank" rel="noopener noreferrer">Ver</a>
                    <a href="{{route('supports.edit', $support['id'])}}" target="_blank" rel="noopener noreferrer">Editar</a>
                    <form action="{{route('supports.destroy', $support['id'])}}" method="POST">
                        @csrf()
                        @method('DELETE')
                        <button type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
