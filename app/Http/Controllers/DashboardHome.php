<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;
use App\Models\Produtos;
use App\Models\User;
use App\Models\Recargas;
use Hash;
class DashboardHome extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){
        $transacoes = Transacoes::where('id', '>', 0)
        ->with('user')
        ->with('produto')
        ->get();
        $users = User::all();
        $users_credit = User::where('saldo', '>', 1)->get();
        $totalSaldo = User::sum('saldo');

        return view('dashboard.home', [
            'users' => $users, 
            'users_credit' => $users_credit,
            'transacoes' => $transacoes,
            'totalSaldo' => $totalSaldo,
        ]);
    }

    
    public function produtos(){
        $produtos = Produtos::all();

        return view('dashboard.produtos', [
            'produtos' => $produtos, 
        ]);
    }

    public function usuarios(){
        $usuarios = User::all();

        return view('dashboard.usuarios', [
            'usuarios' => $usuarios, 
        ]);
    }

    public function transacoes(){
        $transacoes = Transacoes::where('id', '>', 0)
        ->with('user')
        ->with('produto')
        ->get();
     
        return view('dashboard.form-transacao', [
            'transacoes' => $transacoes, 
        ]);
    }


    public function formTransacao(){
  
        $users = User::all();
        $produtos = Produtos::all();  
          
        return view('dashboard.transacoes', [
            'users' => $users, 
            'produtos' => $produtos,

        ]);
    }

    public function formTransacaoCredito(){
  
        $users = User::all();
          
        return view('dashboard.transacoes-credito', [
            'users' => $users, 

        ]);
    }

    
    public function formProduto(){
  
        
          
        return view('dashboard.form-produto', [
           

        ]);
    }

    public function cadProduto(Request $request){
  
        $produto = new Produtos();
        $produto->nome = $request->nome;
        $produto->valor = $request->valor;
        $produto->quantidade_hora = $request->quantidade_hora;
        if(isset($request->file)){
            $photoname = $request->file->getClientOriginalName();
            $produto->foto = $photoname;
            $image = $request->file('file');
            $destinationPath = public_path('fotos-produtos/');
            $image->move($destinationPath, $photoname);
           }

        $produto->save();
        return redirect()->route('produtos');
    }
    public function cadTransacao(Request $request){
       
        $usuario = User::where('id', $request->usuario)->first();
        $produto = Produtos::where('id', $request->produto)->first();
        $total = $produto->valor * $request->quantidade;
        $saldo = $usuario->saldo;
        $usuario->saldo = $saldo - $total;
        $usuario->save(); 
        $transacao = new Transacoes();
        $transacao->id_user = $usuario->id;
        $transacao->id_produto = $request->produto;
        $transacao->quantidade = $request->quantidade;
        $transacao->valor = $total;
        $transacao->save();
        return redirect()->route('transacoes'); 
    }

    
    public function cadTransacaoCredito(Request $request){
       
        $usuario = User::where('id', $request->usuario)->first();
        $usuario->saldo += $request->valor;
        $usuario->save(); 
        $recarga = new Recargas();
        $recarga->id_user = $usuario->id;
        $recarga->valor =  $request->valor;
        $recarga->save();

  ;
        return redirect()->route('home'); 
    }


    public function infoUsuario($id){
        $usuario = User::where('id', $id)->with('transacoes')->first();
        return view('dashboard.info-usuario',[
            'usuario' => $usuario,
        ]);
    }

    public function formUsuario(){
  
          
        return view('dashboard.form-usuarios');
    }

    public function cadUsuario(Request $request){
       
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->saldo = 0;
        $user->power = 0;
        $user->password = Hash::make($request->senha);
        $user->save();
        return redirect()->route('usuarios'); 
    }

}
