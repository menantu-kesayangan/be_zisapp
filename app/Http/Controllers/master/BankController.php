<?php

namespace App\Http\Controllers\master;

use DB;
use App\Bank;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class BankController extends Controller
{
    //get Bank
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Bank"; //menampilkan pesan
        $data['data'] = Bank::all(); //mengambil semua data bank
        return $data; //menampilkan hasil dari proses pengambilan data
    }


    //create Bank
    public function create(Request $request) //pendeklarasian fungsi create
    {
        $bank = new Bank;  //inisialisasi atau menciptakan object baru
        $bank->no_rek = $request->no_rek; //menset no_rek yang diambil dari request body
        $bank->nama_bank = $request->nama_bank; //menset nama_bank yang diambil dari request body


        $simpan = $bank->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Bank Berhasil ditambahkan";
            $data['data'] = $bank;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Bank";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update
    public function update(Request $request, $id) ////pendeklarasian fungsi
    {
        $bank = Bank::find($id);

        if ($bank) {
            # code...
            //menset nilai yang baru/update
            $bank->no_rek = $request->no_rek;
            $bank->nama_bank = $request->nama_bank;

            $data['data'] = $bank; //menampilkan data bank
            $update = $bank->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update 
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $bank;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ada)
    }

    //delete bank
    public function delete($id) //deklarasi fungsi delete
    {
        $bank = Bank::find($id); //mengambil data bank berdasarkan id

        if ($bank) { //mengecek data bank apakah ada atau tidak
            # code...
            $delete = $bank->delete(); //menghapus data bank
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $bank;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }

    //cetak seluruh data bank
    public function cetakpdf()
    {
        //menampilkan semua data bank
        $bank = DB::select(
            "SELECT * FROM banks"
        );

        //perintah cetak pdf
        $pdf = PDF::loadview('laporan/laporan_bank', ['bank' => $bank])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
