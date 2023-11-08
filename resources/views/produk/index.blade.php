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
                        <div class="form-group">
                            <div class="form-line">
                                <p>
                                    <b> Search </b>
                                </p>
                                <input  type="text" @input="handleSearchFieldDatatable" id="search-field-datatable" class="form-control" placeholder="keyword">
                            </div>

                        </div>


                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Harga(Rp)</th>
                                    <th scope="col">Gambar</th>

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
        var url = "{{route('produk.datatable', ['umkmId'=>$data->id])}}";
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

                            { "orderable": false, "targets": 3 },





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

                        data: 'kode',


                    },
                    {

                        data: 'harga',


                    },

                    {
                        data: null,
                        searchable: false,
                        render: function(data){
                            let publicDirectoryImages = "{{url('/img_produks/')}}";
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
                let linkDatatable = "{{route('produk.datatable',['umkmId'=>$data->id])}}";
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
