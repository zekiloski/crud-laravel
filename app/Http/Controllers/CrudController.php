<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    //Consulta para mostrar tabla desde la bd
    public function index(){
        //variable mas conex DB , consulta select
        $datos=DB::select("select * from producto");
        return view("welcome")->with("datos",$datos);
    }

    //Recepcionar e Insertar un nuevo producto en bd
    public function create(Request $request){
       
        try {
            $sql=DB::insert("insert into producto(id_producto,nombre,precio,cantidad)values(?,?,?,?)",[$request->txtcodigo,
            $request->txtnombre,
            $request->txtprecio,
            $request->txtcantidad   
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto","Producto registrado correctamente!!");
        } else {
            return back()->with("incorrecto","Error al Registra!!");
        }
        
    }


    //Recepcionar y modificar producto en bd
    public function update(Request $request){
        try {
            $sql=DB::update("update producto set nombre=?, precio=?, cantidad=? where id_producto=?",[$request->txtnombre,
            $request->txtprecio,
            $request->txtcantidad,
            $request->txtcodigo
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto","Producto modificado correctamente!!");
        } else {
            return back()->with("incorrecto","Error al Modificar!!");
        }
    }

    public function delete($id){
        try {
            $sql=DB::delete("delete from producto where id_producto=$id");

        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto","Producto eliminado correctamente!!");
        } else {
            return back()->with("incorrecto","Error al Eliminar!!");
        }
    }

    
}
