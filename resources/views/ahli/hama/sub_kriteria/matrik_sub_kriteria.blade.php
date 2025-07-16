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

            <form action="{{ route('matriks.post', $id) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered text-end align-middle">
                        <thead class="text-center">
                            <tr>
                                <th>Sub Kriteria</th>
                                @foreach ($subKriteria as $col)
                                    <th>{{ $col->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subKriteria as $i => $row)
                                <tr>
                                    <th class="text-start">{{ $row->nama }}</th>
                                    @foreach ($subKriteria as $j => $col)
                                        <td>
                                            @if ($row->id == $col->id)
                                                <input type="text" class="form-control text-end bg-light"
                                                    value="1" disabled>
                                            @elseif ($i < $j)
                                                <input type="number" step="0.0001" min="0.0001" required
                                                    name="matriks[{{ $row->id }}][{{ $col->id }}]"
                                                    class="form-control text-end"
                                                    value="{{ $matriks[$row->id][$col->id] ?? '' }}">
                                            @else
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
                    <button type="submit" class="btn btn-success btn-sm mt-2">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Matriks
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app>

{{-- 

 
        
        
        --}}
