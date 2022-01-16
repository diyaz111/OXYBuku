<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use DB;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\StorePostRequest;
use RealRashid\SweetAlert\Facades\Alert;


class BukuController extends Controller
{
    public function __construct() {
        $this->middleware('is.admin:1')->except(['index', 'show']);
    }    
    
    public function index()
    {
        $buku=Buku::all();
        $authors = User::where('role', '0')->get();
        return view('bukus.index', compact('buku', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = User::where('role', '0')->get();
        return view('bukus.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $cover = NULL;

        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        }

        try {
            Buku::create(array_merge($request->validated(), [
                'cover' => $cover
            ]));
            alert()->success('Berhasil.','Data telah ditambahkan!');
        } catch(\Exception $e) {
            alert()->error($e->getMessage());
        }

        return redirect()->route('bukus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return view('bukus.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        return view('bukus.edit', compact('buku'));
    }
    
    public function update(StorePostRequest $request, Buku $buku)
    {
        $cover = NULL;
        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        }

        $buku->update([
            'judul' => $request->get('judul'),
            'penulis' => $request->get('penulis'),
            'deskripsi' => $request->get('deskripsi'),
            'cover' => $cover
            ]);

        alert()->success('Berhasil.','Data telah diubah!');

        return redirect()->route('bukus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('bukus.index');
    }
}
