<!DOCTYPE html>
<html>
<head>
    <title>Informasi Posyandu Bina Muda</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 40px; background-color: #f8f9fa;">

    <div style="background-color: #4CAF50; color: white; padding: 15px; border-radius: 8px;">
        <h1 style="margin: 0;">{{ $nama_posyandu }}</h1>
        <p style="margin: 5px 0;">Alamat: {{ $alamat }}</p>
        <p style="margin: 5px 0;">Kontak Kader: {{ $kontak }}</p>
    </div>

    <hr style="margin: 30px 0;">

    <h2>📅 Jadwal Kegiatan Posyandu</h2>

    @if (count($jadwal_posyandu) > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; background-color: white; border-collapse: collapse;">
            <tr style="background-color: #28a745; color: white;">
                <th>Tanggal</th>
                <th>Tema</th>
                <th>Keterangan</th>
            </tr>

            @foreach ($jadwal_posyandu as $jadwal)
            <tr>
                <td>{{ $jadwal['tanggal'] }}</td>
                <td>{{ $jadwal['tema'] }}</td>
                <td>{{ $jadwal['keterangan'] }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p style="color: red;">Belum ada jadwal posyandu yang tersedia.</p>
    @endif

</body>
</html>
