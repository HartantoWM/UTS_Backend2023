<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Kantor;

class KantorController extends Controller
{
    // Method untuk menampilkan seluruh data pegawai
    public function index()
    {
        // menggunakan elquent untuk mengambil semua data siswa pada model kantor
        $kantor = Kantor::all();

        // jika terdapat kode yang kosong maka akan di kirimkan kode 200
        if ($kantor->isEmpty()) {
            $data = ["massage" => "Data is Empty"];

            return response()->json($data, 200);
        }

        //membuat data response 
        $data = [
            "massage" => "Get all Resources",
            "data" => $kantor
        ];

        // mengirim data json dan kode 200
        return response()->json($data, 200);
    }

    // menambahkan data karyaawan baru
    public function strore(Request $request)
    {
        // Request Validation
        $request->validate([
            "name" => "required",
            "gender" => "required",
            "phone" => "required",
            "alamat" => "required",
            "email" => "required",
        ]);

        // data yang ditambahkan 
        $input = [
            'name' => $request->nama,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
            'alamat'=> $request->alamat,
            'email'=> $request->email
        ];

        // menggunakan elequent create untuk menambahkan data karyawan yang baru
        $kantor = Kantor::create($input);

        // membuat data response
        $data = [
            "message" => "Karyawan is created successfully",
            "data" => $kantor
        ];

        // mengirim data json dan kode 201
        return response()->json($data, 201);
    }


    public function update(Request $request, $id)
    {
        // menggunakan elequent find untuk mencari data karyawan berdasarkan id 
        $kantor = Kantor::find($id);

        // jika data tidak yang di cari tidak di temukan maka kirim kode 404
        if (!$kantor) {
            $data = [
                "message" => "Resource not found",
            ];

            // Mengirimkan data dan kode 404
            return response()->json($data, 404);

        }

        // Menggunakan elquent update untuk mengubah data karyawan dan akan menampikan kembali menggunakan elquent all
        $kantor->update([
            "name" => $request->nama ?? $kantor->nama,
            "gender" => $request->gender ?? $request->gender,
            "phone" => $request->phone ?? $request->phone,
            "alamat" => $request->alamat ?? $request->alamat,
            "email" => $request->email ?? $request->email,
        ]);

        // Membuat data response
        $data = [
            "message" => "karyawan is update success",
            "data" => $kantor,
        ];

        // mengirim data json dan code 200
        return response()->json($data, 200);
    }

    // method function untuk menghapus data pegawai 
    public function delete($id)
    {
        // menggunakan elquend find untuk mencari data pegawai berdasarkan id 
        $kantor = Kantor::factory($id);
        // jika data pegawai tidak di temukan
        if (!$kantor){
            // membuat response data 
            $data = [
                "message" => "request not found",
            ];
            // mengirim data dan mengirim kode 404
            return response()->json($data, 404);
        }

        // jika data karyawan telah di temukan maka hapus dari data pegawai
        $kantor->delete();
        $data = [
            "message"=> "karyawan is deleted",
            "datadeleted"=> $kantor,
        ];

        // mengirim data dan kode 200
        return response()->json($data, 200);
    }

    public function search(String $name)
    {
        $kantor = Kantor::where('name', 'like', "%($name)")->get();

        if (!$kantor) {
            $data = [
                "message"=> "Data Kantor not found",
                "data"=> [],
            ];
            return response()->json($data, 404);
        }else {
            $data = [
                "message"=> "Get data kantor by name",
                "data"=> $kantor,
            ];

            return response()->json($data, 200);
        }
    }

    // function untuk melihat data karyawan yang masih active
    public function active()
    {
        $kantor = Kantor::where('status', 'active')->get();

        if (!$kantor) {
            $data = [
                "message" => "Data karyawan not found",
                "data" => []
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                "message" => "Get data karyawan by status active",
                "data" => $kantor
            ];

            return response()->json($data, 200);
        }
    }


    // function untuk melihat data karyawan yang sudah tidak active
    public function inactive()
    {
        $kantor = Kantor::where('status', 'inactive')->get();

        if (!$kantor) {
            $data = [
                "message" => "Data employees not found",
                "data" => []
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                "message" => "Get data karyawan by status inactive",
                "data" => $kantor
            ];

            return response()->json($data, 200);
        }
    }

    // function yang menampilkan data karyawan yang sudah diberhentikan 

    public function terminated()
    {
        $kantor = Kantor::where('status', 'terminated')->get();

        if (!$kantor) {
            $data = [
                "message" => "Data employees not found",
                "data" => []
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                "message" => "Get data employees by status terminated",
                "data" => $kantor
            ];

            return response()->json($data, 200);
        }
    }
}