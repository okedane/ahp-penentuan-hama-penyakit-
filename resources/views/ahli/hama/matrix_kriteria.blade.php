<x-app>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Matriks Perbandingan Kriteria</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Kriteria</a></li>
                                <li class="breadcrumb-item active">Matriks</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('kriteria.matriks.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Matriks Perbandingan Kriteria</h4>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary btn-sm">← Kembali</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered text-end align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kriteria</th>
                                        @foreach ($kriterias as $col)
                                            <th>{{ $col->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $i => $row)
                                        <tr>
                                            <th class="text-start">{{ $row->kode }}</th>
                                            @foreach ($kriterias as $j => $col)
                                                <td>
                                                    @if ($row->id === $col->id)
                                                        <input type="text" class="form-control text-end bg-light"
                                                            value="1" disabled>
                                                    @elseif ($i < $j)
                                                        {{-- Input manual --}}
                                                        <input type="number" step="0.0001" min="0.0001" required
                                                            name="matriks[{{ $row->id }}][{{ $col->id }}]"
                                                            class="form-control text-end"
                                                            value="{{ old("matriks.$row->id.$col->id", $matriks[$row->id][$col->id] ?? '') }}">
                                                    @else
                                                        {{-- Ambil nilai kebalikan dari database --}}
                                                        <input type="text" class="form-control text-end bg-light"
                                                            value="{{ $matriks[$row->id][$col->id] ?? '-' }}" disabled>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-success mt-2 btn-sm">
                                <i class="mdi mdi-content-save me-1"></i> Simpan Matriks
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>
