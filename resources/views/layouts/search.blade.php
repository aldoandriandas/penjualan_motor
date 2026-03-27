<form action="{{ route('motors.search') }}" method="GET">
    <input type="text" name="search" placeholder="Cari motor..."
        class="border px-4 py-2 rounded">

    <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded">
        Search
    </button>
</form>