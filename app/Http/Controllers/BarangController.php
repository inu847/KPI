<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.index');
    }

    public function create()
    {
        return view('barang.create');
    }

    // public function store()
    // {
    //     POST TO FIREBASE
    // }

    public function edit()
    {
        return view('barang.edit');
    }

    // public function update($id)
    // {
    //     POST TO FIREBASE
    // }

    // public function delete($id)
    // {
    //     DELETE IN FIREBASE
    // }
}
