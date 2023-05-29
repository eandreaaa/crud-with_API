<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // mengambil data dr input search
        $search = $request->search;

        // memanggil libraries BaseApi methodnya index dgn mengirim parameter1 berupa path data dr API nya, 
            // parameter2 data utk mengisi search_nama APInya
            // pake new krn : BAseApi bentunya class
        $data = (new BaseApi)->index('/api/students', ['search_nama' => $search]); // ngirim request ke BaseAPI

        // ambil response json
        $students = $data->json();
        // dd($students);

        // kirim hasil pengambilan data ke blade index
        // ambil property data dari response json
        return view('index')->with(['students' => $students['data']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];

        $proses = (new BaseApi)->store('/api/students/tambah-data', $data);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil menambah data ke StudentsAPi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // proses ambil data api ke route REST API 
        $data = (new BaseApi)->edit('/api/students/'.$id);
        if ($data->failed()) {
            // kalau gagal proses $data, ambil deskripsi error dr json
            $errors = $data->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            $student = $data->json('data');
            return view('edit')->with(['student' => $student]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // data yg akan dikirim ($request ke REST API)
        $payload = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];

        // panggil method update dr BaseAPI, kirim endpoint
        $proses = (new BaseApi)->update('/api/students/update/'.$id, $payload);
        if ($proses->failed()) {
            // dd($proses);
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            return redirect('/')->with('success', 'Berhasil edit data');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = (new BaseApi)->delete('/api/students/delete/'.$id);

        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            return redirect('/')->with('success', 'Berhasil memindahkan ke sampah');
        }
    }

    public function trash()
    {
        $data = (new BaseApi)->trash('/api/students/show/trash/');

        $sampah = $data->json();

        return view('trash')->with(['trash' => $sampah['data']]);
    }

    public function permanent($id)
    {
        $permanen = (new BaseApi)->permanent('/api/students/trash/delete/permanent/'.$id);

        if ($permanen->failed()) {
            $errors = $permanen->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        }
    }

    public function restore($id)
    {
        $restore = (new BaseApi)->restore('/api/students/trash/restore/'.$id);

        if ($restore->failed()) {
            $errors = $restore->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            return redirect('/')->with('success', 'Berhasil restore data');
        }
    }
        
}
