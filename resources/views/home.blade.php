<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="/home" style="color: black"><h1>Data Mahasiswa</h1></a>

        <!-- Form Pencarian -->
        <form action="{{ route('mahasiswa.search') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tabel Data Mahasiswa -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Gender</th>
                    <th>Usia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswas as $mahasiswa)
                    <tr>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->nim }}</td>
                        <td>{{ $mahasiswa->alamat }}</td>
                        <td>{{ $mahasiswa->tanggal_lahir }}</td>
                        <td>{{ $mahasiswa->gender }}</td>
                        <td>{{ $mahasiswa->usia }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Informasi Jumlah Data Mahasiswa -->
        <p>Total Data Mahasiswa: {{ $totalMahasiswa }}</p>

        <!-- Statistik Jumlah Mahasiswa Berdasarkan Gender -->
        {{-- <div class="card">
            <div class="card-header">
                Statistik Gender Mahasiswa
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Laki-laki: {{ $statistikGender['L'] }}</li>
                <li class="list-group-item">Perempuan: {{ $statistikGender['P'] }}</li>
            </ul>
        </div> --}}

        <div class="card-body">
            <canvas id="genderChart" width="300" height="300"></canvas>
        </div>
        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Mendapatkan data statistik gender dari server
        var statistikGender = @json($statistikGender);
    
        // Mendapatkan elemen canvas untuk menampilkan diagram lingkaran
        var ctx = document.getElementById('genderChart').getContext('2d');
    
        // Membuat instance diagram lingkaran
        var genderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [statistikGender['L'], statistikGender['P']],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Statistik Gender Mahasiswa'
                },
                maintainAspectRatio: false, // Menonaktifkan aspek rasio
                responsive: false, // Menonaktifkan responsif
            }
        });
    </script>
    
</body>
</html>
