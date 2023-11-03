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

class UmkmController extends Controller
{
    public function __construct(Request $request)
    {
        $this->route      ='umkm.';
        $this->view       ='umkm.';

        $this->sidebar    ='';
    }

    public function indexAdmin(Request $request){
        $datas = Umkm::with(['produk'=>function($query) use($request){
            $query->whereNull('deleted_at');
        }])->get();
        return view($this->view.'index',['datas' => $datas]);
    }
    public function create(Request $request){
        return view($this->view.'create',[]);
    }


    public function edit(Request $request, $id){

        $data = Umkm::with([])->whereNull('deleted_at')->where('id',$id)->first();


        return view($this->view.'edit',['data'=>$data]);
    }
    public function index(Request $request, $umkmId){
        $datas = Umkm::with(['produk'=>function($query) use($request){
            $query->whereNull('deleted_at');
        }])->get();
        return view($this->view.'index',['datas' => $datas]);
    }
    public function datatable(Request $request,$umkmId){

        $datas = Umkm::with(['produks'])->whereNull('deleted_at');

        if($request->keyword_search){
            $datas = $datas->where(function($query) use ($request){
                $query->whereRaw('LOWER(name) LIKE ?',['%'.strtolower($request->keyword_search).'%'])
                ->orWhereHas('kota',function($queryChild) use($request){
                    $queryChild->orwhere('LOWER(name) LIKE ?',['%'.strtolower($request->keyword_search).'%']);
                })->orWhereHas('provinsi',function($queryChild) use($request){
                    $queryChild->orwhere('LOWER(name) LIKE ?',['%'.strtolower($request->keyword_search).'%']);
                });


            });

        }

        $datas = $datas->get();

        return DataTables::of($datas)->toJson();
    }

    public function update(Request $request,$id){
        $this->validate($request, [

            'name'                  => 'required',
            'alamat'                => 'required',
            'provinsi_id'           => 'required',
            'kota_id'              => 'required',
            'deskripsi'             => 'required',
            'nama_pemilik'          => 'required',
            'personal_kontak'       => 'required',
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
                'name'                  => $request->name,
                'alamat'                => $request->alamat,
                'provinsi_id'           => $request->provinsi_id,
                'kota_id'               => $request->kota_id,
                'deskripsi'             => $request->deskripsi,
                'nama_pemilik'          => $request->nama_pemilik,
                'personal_kontak'       => $request->personal_kontak,
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


            $update = Umkm::with([])->where('id',$id)->update($arrUpdate);


           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Gagal Edit UMKM']);
            // something went wrong
        }

        return redirect()->route($this->route.'index_admin',)->with('success', 'Edit UMKM berhasil!');

    }
    public function store(Request $request){

        $this->validate($request, [

            'name'                  => 'required',
            'alamat'                => 'required',
            'provinsi_id'           => 'required',
            'kota_id'              => 'required',
            'deskripsi'             => 'required',
            'nama_pemilik'          => 'required',
            'personal_kontak'       => 'required',
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
                'name'                  => $request->name,
                'alamat'                => $request->alamat,
                'provinsi_id'           => $request->provinsi_id,
                'kota_id'               => $request->kota_id,
                'deskripsi'             => $request->deskripsi,
                'nama_pemilik'          => $request->nama_pemilik,
                'personal_kontak'       => $request->personal_kontak,
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


            $create = Umkm::create($arrUpdate);


           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Gagal Input UMKM']);
            // something went wrong
        }

        return redirect()->route($this->route.'index_admin')
        ->with('success', '1 UMKM Berhasil Ditambahkan!');

    }
    public function delete(Request $request, $id){
        $dateTime = new DateTime();
        DB::beginTransaction();


        try {
            $umkm = Umkm::with(['produks'])->where('id',$id)->first();
            $umkm->produks()->update([
                'deleted_at' => $dateTime->format('Y-m-d H:i:s'),
                'deleted_by_id' => Auth::id(),
            ]);
            $umkm->deleted_at = $dateTime->format('Y-m-d H:i:s');
            $umkm->deleted_by_id= Auth::id();
            $umkm->save();





           DB::commit();

        //     // all good
        } catch (QueryException $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Gagal Menghapus UMKM']);
            // something went wrong
        }

        return back()->with('success', 'Berhasil Menghapus UMKM!');

    }
    public function detail(Request $request, $id){

}
