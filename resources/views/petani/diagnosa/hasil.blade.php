<x-app>
    <div class="page-content">
        <div class="container">
            <h4>Hasil Diagnosa</h4>

            <div class="alert alert-success">
                <strong>{{ $terbaik['nama'] }}</strong> adalah kemungkinan hama yang menyerang tanaman Anda.
                <br>Skor: <strong>{{ number_format($terbaik['skor'], 3) }}</strong>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th> <!-- Tambahkan kolom No -->
                        <th>Alternatif Hama</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasil as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Nomor urut -->
                            <td>{{ $row['nama'] }}</td>
                            <td>{{ number_format($row['skor'], 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <a href="{{ route('dashboard.petani') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</x-app>
