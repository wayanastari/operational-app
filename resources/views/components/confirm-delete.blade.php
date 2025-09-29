@props(['id', 'route'])

<form id="delete-form-{{ $id }}" action="{{ $route }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>