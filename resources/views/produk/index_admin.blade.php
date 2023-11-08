@extends('layouts.app')
@section('css')
@endsection
@section('content')



    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <!-- Notifikasi menggunakan flash session data -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h1>List Produk UMKM {{$data->name}}</h1><br>
                        <a href="{{ route('produk.create',$data->id) }}" class="btn btn-md btn-success mb-3 float-right"><i class="material-icons">add</i>Tambah Data</a>

                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Harga (Rp)</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->produks as $produk)
                                <tr>
                                    <td>{{ $produk->name }}</td>
                                    <td>{{ $produk->kode }}</td>
                                    <td>{{ $produk->harga }}</td>

                                    <td>
                                        <img src="{{url('/img_produks/').'/'.$produk->id_file_photo_1}}"  width="200" height="160">
                                        <br>
                                        <br>
                                        <img src="{{url('/img_produks/').'/'.$produk->id_file_photo_2}}"  width="200" height="160">
                                        <br>
                                        <br>
                                        <img src="{{url('/img_produks/').'/'.$produk->id_file_photo_3}}"  width="200" height="160">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('produk.delete', $produk->id) }}" method="POST">
                                            <a href="{{ route('produk.edit', $produk->id) }}"
                                                class="btn btn-sm btn-primary"><i class="material-icons">mode_edit</i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="9">Data produk tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('script')
<script>

</script>
@endsection
