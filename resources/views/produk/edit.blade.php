@extends('layouts.app')
@section('css')
<style>
    .form-group {
        padding-top: 12px !important;
        padding-bottom: 12px !important;
    }
</style>

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
                        <h1>Edit UMKM</h1>
                            <form action="{{ route('umkm.update',['id'=>$data->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Nama UMKM</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ $data->name }}" required>

                                    <!-- error message untuk title -->
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat UMKM</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" value="{{ $data->alamat }}" required>

                                    <!-- error message untuk title -->
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="provinsi_id">Propinsi</label>
                                    <select v-model="selectedPropinsiId" name="provinsi_id" id="provinsi_id"  class="form-control" required>

                                        @foreach ($datasProvinsi as $item)
                                            <option value="{{$item->id}}" @if($data->provinsi_id == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kota_id">Kota</label>
                                    <select name="kota_id" id="kota_id" class="form-control" required>
                                        <option >--Pilih Kota--</option>
                                        @foreach ($datasKota as $item)
                                            <option value="{{$item->id}}" @if($data->kota_id==$item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_pemilik">Nama Pemilik</label>
                                    <input type="text" id="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror"
                                        name="nama_pemilik" value="{{ $data->nama_pemilik }}" required>

                                    <!-- error message untuk title -->
                                    @error('nama_pemilik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="personal_kontak">Personal Kontak</label>
                                    <input type="text" id="personal_kontak" class="form-control @error('personal_kontak') is-invalid @enderror"
                                        name="personal_kontak" value="{{ $data->personal_kontak }}" required>

                                    <!-- error message untuk title -->
                                    @error('personal_kontak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea
                                        name="deskripsi" id="deskripsi"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        rows="5"
                                        required>{{ $data->deskripsi }}</textarea>

                                    <!-- error message untuk content -->
                                    @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_file_photo_1">File Gambar 1</label>
                                    <img src="{{url('/img_produks/').'/'.$data->id_file_photo_1}}"  width="200" height="160">
                                    <br>
                                    <input type="file" name="id_file_photo_1" id="id_file_photo_1">
                                </div>
                                <div class="form-group">
                                    <label for="id_file_photo_2">File Gambar 2</label>
                                    <img src="{{url('/img_produks/').'/'.$data->id_file_photo_2}}"  width="200" height="160">
                                    <br>
                                    <input type="file" name="id_file_photo_2" id="id_file_photo_2">
                                </div>
                                <div class="form-group">
                                    <label for="id_file_photo_3">File Gambar 3</label>
                                    <img src="{{url('/img_produks/').'/'.$data->id_file_photo_3}}"  width="200" height="160">
                                    <br>
                                    <input type="file" name="id_file_photo_3" id="id_file_photo_3">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                                <a href="{{ route('umkm.index-admin') }}" class="btn btn-md btn-secondary">kembali</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('script')
<script>
var app = new Vue({
  el: '#app',
  data:{
    selectedPropinsiId : "{{$data->provinsi_id}}",
  },
  methods:{
    onChangeProvinsi:function(event){
       console.log(event.target.value);
    }
  },
  mounted(){
    $(document).ready(function() {
        $('#provinsi_id').select2();

        $('#kota_id').select2();
        $('#provinsi_id').val("{{$data->provinsi_id}}");
        $(document).delegate('#provinsi_id',"change",function(){

            let provinsiId = $(this).val();
            $('#kota_id').empty();
            $('#kota_id').val('');
            let params = new FormData();
            params.append('provinsi_id', provinsiId);
            axios.post('{{route("umkm.get-kota")}}',params, {
                    headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    optionsSelect = [];
                    if(response.data.response_code == 200 || response.data.response_code == '200'){

                        $('#kota_id').append('<option value="">--Pilih Kota--</option>');

                        for (var i = 0; i < response.data.data.length; i++) {
                            let optionSelect = {
                                id: response.data.data[i].id,
                                text: response.data.data[i].name
                            };
                            optionsSelect.push(optionSelect);

                            $('#kota_id').append('<option value="'+response.data.data[i].id+'">'+ response.data.data[i].name +'</option>')
                        }



                    }

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
        });
    });

  },


});

</script>
@endsection
