<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;
use stdClass;
use DateTime;
use DateInterval;
use Validator;
use App\Models\Umkm;
use App\Models\Produk;
use App\Models\Provinsi;
use App\Models\Kota;
use Auth;
use DataTables;
use Illuminate\Database\QueryException;

class ProdukController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->route      ='produk.';
        $this->view       ='produk.';

        $this->sidebar    ='';
    }

    public function indexAdmin(Request $request, $umkmId){
        $data = Umkm::with(['produks'=>function($query) use($request){
            $query->whereNull('deleted_at');
        }])->where('id',$umkmId)->first();
        return view($this->view.'index_admin',['data' => $data]);
    }
    public function create(Request $request,$umkmId){
        $data = Umkm::with([])->where('id',$umkmId)->first();

        return view($this->view.'create',['data' => $data]);
    }


    public function edit(Request $request, $id){

        $data = Produk::with(
            [
                'umkm'
            ])->whereNull('deleted_at')->where('id',$id)->first();


        return view($this->view.'edit',['data'=>$data]);
    }
    public function index(Request $request, $umkmId){
        $data = Umkm::with(['produks'=>function($query) use($request){
            $query->whereNull('deleted_at');
        }])->where('id',$umkmId)->first();
        return view($this->view.'index',['data' => $data]);
    }
    public function datatable(Request $request,$umkmId){
        $umkm = Umkm::with([])->where('id',$umkmId)->first();
        $datas = Produk::with(['umkm'])->whereNull('deleted_at')->where('umkm_id',$umkmId);

        if($request->keyword_search){
            $datas = $datas->where(function($query) use ($request){
                $query->whereRaw('LOWER(name) LIKE ?',['%'.strtolower($request->keyword_search).'%'])
                ->orwhereRaw('LOWER(kode) LIKE ?',['%'.strtolower($request->keyword_search).'%']);

            });

        }

        $datas = $datas->get();

        return DataTables::of($datas)->toJson();
    }

    public function update(Request $request,$id){
        $this->validate($request, [

            'kode'                   => 'required',
            'name'                   => 'required',
            'harga'                  => 'required',
            'umkm_id'                => 'required',
            'id_file_photo_1'        => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'id_file_photo_2'        => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'id_file_photo_3'        => 'file|image|mimes:jpeg,png,jpg|max:2048'



        ]);

        $dateTime = new DateTime();
        DB::beginTransaction();




        try {

            $imgFile1 = $request->file('id_file_photo_1');
            $imgFile2 = $request->file('id_file_photo_2');
            $imgFile3 = $request->file('id_file_photo_3');
            $arrUpdate = [
                'kode'                   => $request->kode,
                'name'                   => $request->name,
                'harga'                  => $request->harga,
                'updated_by_id'          => Auth::id(),
            ];
            if($imgFile1){
                $namaFile = time()."_".$imgFile1->getClientOriginalName();
                $dirUpload = 'img_produks';
                $imgFile1->move($dirUpload,$namaFile);
                $arrUpdate['id_file_photo_1'] = $namaFile;
            }
            if($imgFile2){
                $namaFile = time()."_".$imgFile2->getClientOriginalName();
                $dirUpload = 'img_produks';
                $imgFile2->move($dirUpload,$namaFile);
                $arrUpdate['id_file_photo_2'] = $namaFile;
            }
            if($imgFile3){
                $namaFile = time()."_".$imgFile3->getClientOriginalName();
                $dirUpload = 'img_produks';
                $imgFile3->move($dirUpload,$namaFile);
                $arrUpdate['id_file_photo_3'] = $namaFile;
            }


            $update = Produk::with([])->where('id',$id)->update($arrUpdate);


           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Gagal Edit Produk']);
            // something went wrong
        }

        return redirect()->route($this->route.'index-admin',['umkmId'=>$request->umkm_id])->with('success', 'Edit Produk berhasil!');

    }
    public function store(Request $request){

        $this->validate($request, [

            'kode'                   => 'required',
            'name'                   => 'required',
            'harga'                  => 'required',
            'umkm_id'                => 'required',
            'id_file_photo_1'        => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'id_file_photo_2'        => 'required||image|mimes:jpeg,png,jpg|max:2048',
            'id_file_photo_3'        => 'required|image|mimes:jpeg,png,jpg|max:2048'



        ]);

        $dateTime = new DateTime();
        DB::beginTransaction();




        try {

            $imgFile1 = $request->file('id_file_photo_1');
            $imgFile2 = $request->file('id_file_photo_2');
            $imgFile3 = $request->file('id_file_photo_3');
            $arrUpdate = [
                'kode'                   => $request->kode,
                'name'                   => $request->name,
                'harga'                  => $request->harga,
                'umkm_id'                => $request->umkm_id,
                'created_by_id'          => Auth::id(),
            ];
            if($imgFile1){
                $namaFile = time()."_".$imgFile1->getClientOriginalName();
                $dirUpload = 'img_produks';
                $imgFile1->move($dirUpload,$namaFile);
                $arrUpdate['id_file_photo_1'] = $namaFile;
            }
            if($imgFile2){
                $namaFile = time()."_".$imgFile2->getClientOriginalName();
                $dirUpload = 'img_produks';
                $imgFile2->move($dirUpload,$namaFile);
                $arrUpdate['id_file_photo_2'] = $namaFile;
            }
            if($imgFile3){
                $namaFile = time()."_".$imgFile3->getClientOriginalName();
                $dirUpload = 'img_produks';
                $imgFile3->move($dirUpload,$namaFile);
                $arrUpdate['id_file_photo_3'] = $namaFile;
            }


            $create = Produk::create($arrUpdate);


           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Gagal Input Produk']);
            // something went wrong
        }

        return redirect()->route($this->route.'index-admin',['umkmId'=>$request->umkm_id])
        ->with('success', '1 Produk Berhasil Ditambahkan!');

    }
    public function delete(Request $request, $id){
        $dateTime = new DateTime();
        DB::beginTransaction();


        try {
            $produk = Produk::with(['umkm'])->where('id',$id)->first();

            $produk->deleted_at = $dateTime->format('Y-m-d H:i:s');
            $produk->deleted_by_id= Auth::id();
            $produk->save();





           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Gagal Menghapus Produk']);
            // something went wrong
        }

        return back()->with('success', 'Berhasil Menghapus Produk!');

    }
    public function detail(Request $request, $id){

    }
}
