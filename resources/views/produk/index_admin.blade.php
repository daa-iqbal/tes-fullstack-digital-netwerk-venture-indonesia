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
                        <a href="{{ route('umkm.create') }}" class="btn btn-md btn-success mb-3 float-right"><i class="material-icons">add</i>Tambah Data</a>

                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">Personal Kontak</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Nama Pemilik</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->kota ? $data->kota->name : ''  }}</td>
                                    <td>{{ $data->provinsi ? $data->provinsi->name : '' }}</td>
                                    <td>{{ $data->personal_kontak }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>{{ $data->nama_pemilik }}</td>
                                    <td>
                                        <img src="{{url('/img_produks/').'/'.$data->id_file_photo_1}}"  width="200" height="160">
                                        <br>
                                        <br>
                                        <img src="{{url('/img_produks/').'/'.$data->id_file_photo_2}}"  width="200" height="160">
                                        <br>
                                        <br>
                                        <img src="{{url('/img_produks/').'/'.$data->id_file_photo_3}}"  width="200" height="160">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('umkm.delete', $data->id) }}" method="POST">
                                            <a href="{{ route('umkm.edit', $data->id) }}"
                                                class="btn btn-sm btn-primary"><i class="material-icons">mode_edit</i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="9">Data post  tersedia</td>
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
