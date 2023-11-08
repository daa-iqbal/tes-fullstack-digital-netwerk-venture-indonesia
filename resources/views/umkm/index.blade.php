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
                        <h1>List UMKM</h1>

                        <div class="form-group">
                            <div class="form-line">
                                <p>
                                    <b> Search </b>
                                </p>
                                <input  type="text" @input="handleSearchFieldDatatable" id="search-field-datatable" class="form-control" placeholder="keyword">
                            </div>

                        </div>

                        <table class="table table-bordered mt-1" id="list-datatable">
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
<script>
    function datatable(){
        var url = "{{route('umkm.datatable')}}";
        var table = $('#list-datatable').DataTable({
            "dom" : "Bfrtip",
            "responsive"        : true,
            "buttons"           : [
                                    //"copy", "csv", "excel", "pdf", "print"
                                ],
            "autoWidth"       :       true,
            "scrollX"         :       true,
            "scrollCollapse"  :       true,
            "bFilter"         :      false,
            "bAutoWidth"      :      false,
            // ordering: false,
            "columnDefs": [
                            { "orderable": false, "targets": 7 },
                            { "orderable": false, "targets": 8 },





                            {
                                    "targets": '_all',
                                    "defaultContent": "---"
                            },
                        ],
            "order": [[ 0, "desc" ]],

            "processing": true,
            "serverSide": true,
            "ordering": true,

            "ajax": url,
            "columns": [
                    {

                        data: 'name',


                    },
                    {

                        data: 'alamat',


                    },
                    {

                        data: 'kota.name',


                    },
                    {

                        data: 'provinsi.name',


                    },
                    {

                        data: 'personal_kontak',


                    },
                    {

                        data: 'deskripsi',


                    },
                    {

                        data: 'nama_pemilik',


                    },
                    {
                        data: null,
                        searchable: false,
                        render: function(data){
                            let publicDirectoryImages = "{{url('/img_umkms/')}}";
                            let imagesElement = '<img src="'+publicDirectoryImages+'/'+data.id_file_photo_1+'"  width="200" height="160">'+
                                '<br>'+
                                '<br>'+
                                '<img src="'+publicDirectoryImages+'/'+data.id_file_photo_2+'"  width="200" height="160">'+
                                '<br>'+
                                '<br>'+
                                '<img src="'+publicDirectoryImages+'/'+data.id_file_photo_3+'"  width="200" height="160">';


                            return imagesElement;
                        }

                    },
                    {
                        data: null,
                        searchable: false,
                        render: function(data){
                            let aksi =  '';
                            let linkProduks = "{{route('produk.index-admin', ':id')}}";
                                linkProduks = linkProduks.replace(':id', data.id);

                                aksi +='<a href="'+linkProduks+'" class="btn btn-sm btn-primary" style="background-color:#708090; border-color: #708090;color:white;"><i class="material-icons">view_module</i></a>';
                            return aksi;
                        }

                    },

                ]
        });

        return table;
    }
</script>
<script>
    function reloadDatatable(url){
        let table =$('#list-datatable').DataTable().ajax.url(url).load();

        return table;
    }
    new Vue({
        el: '#app',
        data : {
            selectedCategories : [],
            keywordSearch : '',

        },
        methods : {
            handleSearchFieldDatatable(event){
                console.log(event.target.value);
                let keywordSearch = event.target.value;
                let linkDatatable = "{{route('umkm.datatable')}}";
                linkDatatable += "?";
                if(keywordSearch){
                    linkDatatable += '&'+'keyword_search='+keywordSearch;
                }

                reloadDatatable(linkDatatable);
            },





        },
        mounted(){
            datatable();

            $(document).delegate( "#search-field-datatable", "input", function() {





            });

        },
    });


  </script>
@endsection
