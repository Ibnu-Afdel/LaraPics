<x-layout>
    @section('title','Create')
    @section('heading', 'Create')

    <form action="{{ route('admin.store')}}" method="POST"  >
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name">

    <button>Create</button>
</form>
</x-layout>