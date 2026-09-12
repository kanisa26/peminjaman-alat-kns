<!DOCTYPE html>
<html>
<head>
    <title>Test Delete</title>
</head>
<body>

    <h3>Uji Policy Hapus Peminjaman</h3>

    <form method="POST" action="{{ route('koreksi.peminjaman.hapus', 1) }}">
        @csrf
        @method('DELETE')

        <button type="submit">
            TEST DELETE PEMINJAMAN ID 1
        </button>
    </form>

</body>
</html>