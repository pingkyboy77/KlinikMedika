@extends('admin.layouts.app')
@section('content')
    {{-- style --}}
    <style>
        thead td p {
            font-weight: bold;

        }
    </style>
    {{-- end stly --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">KEMAJUAN PROGRESS PERLOMBAAN</h5>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form id="filterForm" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="filterMonth" class="form-label">Bulan</label>
                                <select id="filterMonth" class="form-select">
                                    <option value="all">Semua Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterYear" class="form-label">Tahun</label>
                                <select id="filterYear" class="form-select">
                                    <option value="all">Semua Tahun</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterProgress" class="form-label">Progress Lomba</label>
                                <select id="filterProgress" class="form-select">
                                    <option value="all">Semua Progress</option>
                                    <option value="Juara 1">Juara 1</option>
                                    <option value="Juara 2">Juara 2</option>
                                    <option value="Juara 3">Juara 3</option>
                                    <option value="Semi Final">Semi Final</option>
                                    <option value="Tidak Juara">Tidak Juara</option>
                                    <option value="Belum Ada Hasil">Belum Ada Hasil</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button" id="applyFilters" class="btn btn-primary me-2">Filter</button>
                                <a href="#" id="printResults" class="btn btn-secondary">Export PDF</a>
                            </div>
                        </div>
                    </form>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="myTable" class="table table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <td style="width:5%">
                                        <p class="mb-0">No.</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama User Pengajuan</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Ketua Kelompok</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Dosen Pembimbing</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Tingkatan Lomba</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Identitas Number Ketua</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Nama Lomba</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Penyelenggara</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Kategori</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">File Proposal</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Status Pembimbing</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Hasil Perlombaan</p>
                                    </td>
                                    <td>
                                        <p class="mb-0">Action</p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lomba->isNotEmpty())
                                    @foreach ($lomba as $item)
                                        <tr class="lomba-row"
                                            data-month="{{ \Carbon\Carbon::parse($item->tanggal)->month }}"
                                            data-year="{{ \Carbon\Carbon::parse($item->tanggal)->year }}"
                                            data-progress="{{ $item->progress_Lomba ?? 'Belum Ada Hasil' }}">
                                            <td style="width:5%">
                                                <p class="mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->stored_by }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_ketua }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->namadosen }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tingkatan_lomba }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->identitas_number_ketua }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_lomba }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->penyelenggara }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->kategori }}</p>
                                            </td>
                                            <td>
                                                <a href="/{{ $item->file_proposal_pengajuan }}"
                                                    download="{{ substr($item->file_proposal_pengajuan, 23) }}">{{ substr($item->file_proposal_pengajuan, 23) }}</a>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->status }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->progress_Lomba ?? 'Belum Ada Hasil' }}</p>
                                            </td>
                                            <td class="d-flex">
                                                <button type="button" onclick="openModal('{{ $item->id }}')"
                                                    class="d-flex align-items-center btn btn-success btn-rounded waves-effect waves-light gap-2">
                                                    <i class="bx bx-trophy text-white fw-bold"></i>UPDATE HASIL
                                                    LOMBA</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Updating Results -->
    <form action="" method="POST" id="updateHasilForm">
        @csrf
        <div class="modal fade progress" tabindex="-1" role="dialog" aria-labelledby="modal_kategori" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_kategori">UPDATE HASIL PERLOMBAAN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi formulir modal -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>HASIL PERLOMBAAN</h5>
                                <select class="form-select" name="progress_lomba" required>
                                    <option selected disabled> Select Hasil </option>
                                    <option value="Juara 1">Juara 1</option>
                                    <option value="Juara 2">Juara 2</option>
                                    <option value="Juara 3">Juara 3</option>
                                    <option value="Semi Final">Semi Final</option>
                                    <option value="Tidak Juara">Tidak Juara</option>
                                </select>
                                @error('progress_lomba')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Tambahkan input lainnya di sini -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                    class="bx bx-x me-1 align-middle"></i> Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="bx bx-check me-1 align-middle"></i>
                                Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>






    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Memuat jsPDF dari node_modules -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyFiltersBtn = document.getElementById('applyFilters');
            const printResultsBtn = document.getElementById('printResults');

            // Event listener untuk tombol Filter
            applyFiltersBtn.addEventListener('click', function() {
                applyFilters();
            });

            // Event listener untuk tombol Export PDF
            printResultsBtn.addEventListener('click', function() {
                exportToPDF();
            });


            function applyFilters() {
                // Ambil nilai filter dari dropdown atau input
                const selectedMonth = document.getElementById('filterMonth').value;
                const selectedYear = document.getElementById('filterYear').value;
                const selectedProgress = document.getElementById('filterProgress').value;

                // Semua baris data lomba
                const lombaRows = document.querySelectorAll('.lomba-row');

                // Saring data berdasarkan filter
                lombaRows.forEach(row => {
                    const rowMonth = row.getAttribute('data-month');
                    const rowYear = row.getAttribute('data-year');
                    const rowProgress = row.getAttribute('data-progress');

                    // Sembunyikan atau tampilkan baris berdasarkan filter
                    if ((selectedMonth === 'all' || rowMonth == selectedMonth) &&
                        (selectedYear === 'all' || rowYear == selectedYear) &&
                        (selectedProgress === 'all' || rowProgress == selectedProgress)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Fungsi untuk mengekspor ke PDF
            function exportToPDF() {
                const selectedMonth = document.getElementById('filterMonth').value;
                const selectedYear = document.getElementById('filterYear').value;
                const selectedProgress = document.getElementById('filterProgress').value;

                // Redirect ke rute PDF dengan parameter filter
                let url =
                    "{{ route('export.pdf.filter', ['month' => ':month', 'year' => ':year', 'progress' => ':progress']) }}";
                url = url.replace(':month', selectedMonth)
                    .replace(':year', selectedYear)
                    .replace(':progress', selectedProgress);

                window.location.href = url;
            }
        });
    </script>

    <script>
        function openModal(itemId) {
            var form = document.getElementById('updateHasilForm');
            var baseUrl = '{{ route('admin.update.hasil', ['id' => 'ID_PLACEHOLDER']) }}';
            form.action = baseUrl.replace('ID_PLACEHOLDER', itemId);
            var modal = new bootstrap.Modal(document.querySelector('.modal.progress'));
            modal.show();
        }
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var form = this.parentElement;
                    var url = form.getAttribute('action');

                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#myTable');
            if (dataTableExists) {
                $('#myTable').DataTable().destroy();
            }

            setTimeout(() => {

                $('#myTable').DataTable({
                    scrollCollapse: true,
                    responsive: true,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [12]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
    </script>
@endsection
