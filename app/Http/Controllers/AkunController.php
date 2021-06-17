<?php

namespace App\Http\Controllers;

use App\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    //get akun
    public function index() //deklarasi fungsi index 
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Akun"; //menampilkan pesan 
        $data['data'] = Akun::all(); //proses pengambilan semuaa data akun di database

        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create Akun
    public function create(Request $request) //deklarasi fungsi create
    {
        $akun = new Akun; //inisialisasi atau menciptakan objek
        $akun->kode_akun = $request->kode_akun; //menset kode_akun yang dibuat yang diambil dari request body
        $akun->akun = $request->akun; //menset akun yang dibuat yang diambil dari request body
        $akun->kode_sub_kat_akun = $request->kode_sub_kat_akun; //menset kode_sub_kat_akun yang dibuat yang diambil dari request body
        $akun->jenis = $request->jenis; //menset jenis yang dibuat yang diambil dari request body
        $akun->status = 1; //menset agar status langsung terisi 

        $simpan = $akun->save(); //menyimpan data akun ke database
        if ($simpan) {  //jika fungsi simpan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Akun Berhasil ditambahkan";
            $data['data'] = $akun;
        } else { //jika fungsi sistem gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Akun";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang di create (berhasil/gagal)
    }

    //update akun
    public function update(Request $request, $id) //deklarasi fungsi update
    {
        $akun = Akun::find($id); //mengambil data sesuai id

        if ($akun) { //jika datanya ada 
            # code...

            //mengambil nilai lama
            $kode_akun = $request->kode_akun;
            $akun = $request->akun;
            $kode_sub_kat_akun = $request->kode_sub_kat_akun;
            $jenis = $request->jenis;
            $status = $request->status;

            //menset nilai yang baru/update
            $akun->kode_akun = $kode_akun;
            $akun->akun = $akun;
            $akun->kode_sub_kat_akun = $kode_sub_kat_akun;
            $akun->jenis = $jenis;
            $akun->status = $status;

            $data['data'] = $akun; //menampilkan data akun
            $update = $akun->update(); //menyimpan fungsi perubahan
            if ($update) { //jika fungsi upadate berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $akun;
            } else { //jika fungsi update gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang diupdate (berhasil/gagal/data tidak ada)
    }


    //delete akun
    public function delete($id) //deklarasi fungsi delete
    {
        $akun = Akun::find($id); //mengambil data sesuai id

        if ($akun) { //jika data akunnya ada
            # code...
            $delete = $akun->delete(); //menghapus data akun sesuai id
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $data;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $daata['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/data tidak ada)
    }
}
