<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <!-- Header Section -->
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle p-3 mb-3">
                            <i class="fas fa-microscope text-success" style="font-size: 2rem;"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-2">Hasil Diagnosa Penyakit</h2>
                        <p class="text-muted">Analisis selesai berdasarkan gejala yang Anda pilih</p>
                    </div>

                    <!-- Main Result Card -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-gradient text-white position-relative overflow-hidden"
                             style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%); border-radius: 0.5rem 0.5rem 0 0;">
                            <div class="position-absolute top-0 end-0 opacity-10">
                                <i class="fas fa-bug" style="font-size: 4rem; transform: rotate(-15deg);"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Diagnosa Utama</h5>
                                    <small class="opacity-90">Kemungkinan tertinggi berdasarkan analisis</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-virus text-danger"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0 fw-bold text-danger">{{ $terbaik['nama'] }}</h4>
                                            <small class="text-muted">Penyakit yang terdeteksi</small>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Berdasarkan gejala yang dipilih, ini adalah kemungkinan terbesar penyebab masalah pada tanaman Anda.
                                    </p>
                                </div>
                                {{-- <div class="col-md-4 text-md-end">
                                    <div class="position-relative d-inline-block">
                                        <div class="circular-progress" data-percentage="{{ $terbaik['skor'] * 100 }}">
                                            <svg class="circular-chart" viewBox="0 0 36 36" width="120" height="120">
                                                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                      fill="none" stroke="#eee" stroke-width="2"/>
                                                <path class="circle" stroke-dasharray="{{ $terbaik['skor'] * 100 }}, 100" 
                                                      d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                      fill="none" stroke="#dc3545" stroke-width="2.5" stroke-linecap="round"/>
                                                <text x="18" y="20.35" class="percentage" text-anchor="middle" 
                                                      fill="#dc3545" font-size="6" font-weight="bold">{{ number_format($terbaik['skor'] * 100, 1) }}%</text>
                                            </svg>
                                        </div>
                                        <div class="text-center mt-2">
                                            <small class="text-muted fw-semibold">Tingkat Kepercayaan</small>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Results -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light border-0">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-list-ul text-primary me-2"></i>
                                <h5 class="mb-0 fw-bold">Kemungkinan Alternatif Lainnya</h5>
                            </div>
                            <small class="text-muted">Urutan berdasarkan tingkat kemiripan gejala</small>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-4 py-3" style="width: 60px;">Rank</th>
                                            <th class="px-4 py-3">Penyakit</th>
                                            <th class="px-4 py-3" style="width: 120px;">Skor</th>
                                            {{-- <th class="px-4 py-3" style="width: 150px;">Tingkat</th>
                                            <th class="px-4 py-3" style="width: 120px;">Kemungkinan</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasil as $row)
                                            <tr class="{{ $loop->first ? 'table-danger bg-opacity-10' : '' }}">
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        @if($loop->first)
                                                            <span class="badge bg-danger rounded-pill">{{ $loop->iteration }}</span>
                                                        @elseif($loop->iteration <= 3)
                                                            <span class="badge bg-warning rounded-pill">{{ $loop->iteration }}</span>
                                                        @else
                                                            <span class="badge bg-secondary rounded-pill">{{ $loop->iteration }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        @if($loop->first)
                                                            <i class="fas fa-crown text-danger me-2"></i>
                                                        @else
                                                            <i class="fas fa-bug text-muted me-2"></i>
                                                        @endif
                                                        <div>
                                                            <div class="fw-semibold {{ $loop->first ? 'text-danger' : '' }}">
                                                                {{ $row['nama'] }}
                                                            </div>
                                                            @if($loop->first)
                                                                <small class="text-danger">Diagnosa Utama</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <span class="fw-bold {{ $loop->first ? 'text-danger' : '' }}">
                                                        {{ number_format($row['skor'], 3) }}
                                                    </span>
                                                </td>
                                                {{-- <td class="px-4 py-3">
                                                    <div class="progress" style="height: 8px;">
                                                        @php
                                                            $percentage = $row['skor'] * 100;
                                                            $colorClass = $percentage >= 70 ? 'bg-danger' : ($percentage >= 50 ? 'bg-warning' : 'bg-secondary');
                                                        @endphp
                                                        <div class="progress-bar {{ $colorClass }}" 
                                                             style="width: {{ $percentage }}%"></div>
                                                    </div> --}}
                                                </td>
                                                {{-- <td class="px-4 py-3">
                                                    @php
                                                        $percentage = $row['skor'] * 100;
                                                        if($percentage >= 70) {
                                                            $label = 'Tinggi';
                                                            $badgeClass = 'bg-danger';
                                                        } elseif($percentage >= 50) {
                                                            $label = 'Sedang';
                                                            $badgeClass = 'bg-warning';
                                                        } elseif($percentage >= 30) {
                                                            $label = 'Rendah';
                                                            $badgeClass = 'bg-info';
                                                        } else {
                                                            $label = 'Sangat Rendah';
                                                            $badgeClass = 'bg-secondary';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $label }}</span>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-redo-alt text-primary mb-3" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold">Diagnosa Ulang</h6>
                                    <p class="text-muted small mb-3">Lakukan diagnosa baru dengan gejala yang berbeda</p>
                                    <a href="{{ route('petani.input.gejala.penyakit') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i>Diagnosa Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-download text-success mb-3" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold">Simpan Hasil</h6>
                                    <p class="text-muted small mb-3">Download hasil diagnosa dalam format PDF</p>
                                    <button class="btn btn-outline-success btn-sm" onclick="window.print()">
                                        <i class="fas fa-file-pdf me-1"></i>Download PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-home text-info mb-3" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold">Kembali</h6>
                                    <p class="text-muted small mb-3">Kembali ke dashboard utama</p>
                                    <a href="{{ route('dashboard.petani') }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-arrow-left me-1"></i>Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="text-center">
                        <div class="alert alert-light border-0 shadow-sm">
                            <div class="d-flex align-items-center justify-content-center text-muted">
                                <i class="fas fa-lightbulb me-2 text-warning"></i>
                                <small>
                                    <strong>Tips:</strong> Untuk hasil yang lebih akurat, konsultasikan dengan ahli pertanian atau lakukan pemeriksaan laboratorium.
                                </small>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

    <style>
        .circular-chart {
            transform: rotate(-90deg);
        }

        .circle-bg {
            fill: none;
            stroke: #eee;
            stroke-width: 2;
        }

        .circle {
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            animation: progress 1s ease-in-out forwards;
        }

        @keyframes progress {
            0% {
                stroke-dasharray: 0 100;
            }
        }

        .percentage {
            fill: #dc3545;
            font-family: sans-serif;
            font-size: 0.5em;
            text-anchor: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,.02);
        }

        .progress {
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .progress-bar {
            border-radius: 10px;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,.1) !important;
        }

        .badge {
            font-size: 0.75rem;
        }

        @media (max-width: 768px) {
            .circular-progress svg {
                width: 80px;
                height: 80px;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
        }

        @media print {
            .btn, .alert:last-child {
                display: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate circular progress
            const circles = document.querySelectorAll('.circle');
            circles.forEach(circle => {
                const percentage = circle.closest('.circular-progress').dataset.percentage;
                circle.style.strokeDasharray = `${percentage}, 100`;
            });

            // Add fade-in animation for table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-app>