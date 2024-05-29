@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
    <div class="row">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Peminjaman Buku</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamanList as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->peminjam->nama }}</td>
                                    <td>{{ $item->tanggal_pinjam }}</td>
                                    <td>{{ $item->tanggal_kembali }}</td>
                                    <td>{{ $item->tanggal_pengembalian ?? '-' }}</td>
                                    <td>
                                        @if ($item->tanggal_pengembalian != null)
                                            <span class="badge bg-success">Sudah Dikembalikan</span>
                                        @else
                                            <span class="badge bg-danger">Belum Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-detail"
                                            data-id="{{ $item->id }}">Detail</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Buku Sedang Dipinjam</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Nama Peminjaman</th>
                            <th>Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukuDipinjam as $item)
                            @php
                                // Parse tanggal jika $someDate adalah string
                                if (is_string($item->tanggal_kembali)) {
                                    $tanggal_kembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul_buku }}</td>
                                <td>{{ $item->nama_peminjam }}</td>
                                <td>{{ $tanggal_kembali->format('d - M - Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Denda Keterlambatan</h4>
                <small class="text-danger">Denda perbuku dan perhari sebesar Rp. 5000</small>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah Hari Keterlambatan</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($denda as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul_buku }}</td>
                                <td>{{ $item->nama_peminjam }}</td>
                                <td>{{ $item->telat_pengembalian_hari }} Hari</td>
                                <td>{{ number_format($item->total_denda, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade modal-xl" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Peminjaman / Daftar Buku Yang Di Pinjam</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Detail peminjaman akan dimuat di sini -->
                    <div id="modalContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.btn-detail').on('click', function() {
                    var peminjamanId = $(this).data('id');

                    $.ajax({
                        url: '/peminjaman/' + peminjamanId + '/detailJson',
                        method: 'GET',
                        success: function(data) {
                            var modalContent = ``;
                            modalContent+= `
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                            data.items.forEach(function(item) {
                                modalContent += `
                                <tr>
                                    <td>` + item.buku.judul + `</td>
                                    <td>` + item.jumlah + `</td>
                                </tr>`;
                            });

                            modalContent += `
                                </tbody>
                            </table>`;

                            $('#modalContent').html(modalContent);
                            $('#detailModal').modal('show');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
