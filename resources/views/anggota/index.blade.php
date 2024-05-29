@extends('layouts.master')
@section('anggota', 'active')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Anggota</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjam as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->telepon }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Anggota Yang Pernah Meminjam Buku</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah Peminjaman</th>
                            <th>Total Buku Dipinjam</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamList as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_peminjam }}</td>
                                <td>{{ $item->total_pinjaman }}</td>
                                <td>{{ $item->total_buku_dipinjam }}</td>
                                <td><button class="btn btn-primary btn-detail btn-sm" data-id="{{ $item->peminjam_id }}">Detail</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-xl" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Peminjaman</h5>
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
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-detail').on('click', function() {
        var peminjamId = $(this).data('id');

        $.ajax({
            url: '/peminjaman/' + peminjamId + '/detail',
            method: 'GET',
            success: function(data) {
                var modalContent = '';

                data.forEach(function(peminjaman) {
                    modalContent += '<p>Tanggal Pinjam: ' + peminjaman.tanggal_pinjam + '</p>';
                    modalContent += '<p>Tanggal Kembali: ' + peminjaman.tanggal_kembali + '</p>';
                    modalContent += '<p>Tanggal Pengembalian: ' + (peminjaman.tanggal_pengembalian ? peminjaman.tanggal_pengembalian : 'Belum dikembalikan') + '</p>';
                    modalContent += '<h6>Data Buku Yang Dipinjam</h6>';
                    modalContent += `
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>`;

                    peminjaman.items.forEach(function(item) {
                        modalContent += `
                            <tr>
                                <td>` + item.buku.judul + `</td>
                                <td>` + item.jumlah + `</td>
                            </tr>`;
                    });

                    modalContent += `
                            </tbody>
                        </table><hr>`;
                });

                $('#modalContent').html(modalContent);
                $('#detailModal').modal('show');
            }
        });
    });
});
</script>
