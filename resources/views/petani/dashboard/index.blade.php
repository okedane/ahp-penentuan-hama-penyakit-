<x-app>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h1 class="mb-sm-0 font-size-18">PETANI</h1>

                    </div>
                </div>
            </div> --}}
            <!-- end page title -->

            <div class="row"> <!-- pastikan row memiliki tinggi penuh -->
                <div class="d-flex justify-content-center align-items-center">
                    <!-- card -->
                    <div style="width: 100%; max-width: 300px;">
                                <img src="{{ asset('assets/images/sumenep.jpg') }}" class="card-img mt-5" alt="Petani"
                                    style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        <h1 class="mb-sm-0 font-size-18 text-center logo-txt mt-3">PETANI SUMENEP</h1>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->


        </div>
        <!-- container-fluid -->
    </div>
</x-app>
