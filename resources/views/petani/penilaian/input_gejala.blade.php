<x-app>
    <div class="page-content">
        <div class="card shadow-sm mx-auto mt-4" style="max-width: 600px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Input Gejala Tanaman</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('petani.input.gejala.store') }}">
                    @csrf

                    @foreach ($kriterias as $kriteria)
                        <div class="mb-4">
                            <label class="fw-bold mb-2">{{ $kriteria->nama }}</label>
                            <div class="row">
                                @foreach ($kriteria->subKriterias as $sub)
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="sub_kriteria[{{ $kriteria->id }}]"
                                                   value="{{ $sub->id }}"
                                                   id="sub_{{ $sub->id }}">
                                            <label class="form-check-label" for="sub_{{ $sub->id }}">
                                                {{ $sub->nama }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Kirim Gejala</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
