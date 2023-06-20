<h1>Nova Duvida</h1>
<x-alert/>
<form action="{{route('supports.store')}}" method="POST">
    @csrf()
    @include('admin.supports.partials.forms')
</form>