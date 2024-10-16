<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;
use App\Models\Produtos;
use App\Models\User;
use App\Models\Recargas;
use Hash;
use Auth;
class LivCard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){

        $usuario = User::where('id', Auth::user()->id)->with('transacoes')->first();
        return view('livcard.home',[
            'usuario' => $usuario,
        ]);

    }

        
    public function produtos(){
        $produtos = Produtos::all();

        return view('livcard.produtos', [
            'produtos' => $produtos, 
        ]);
    }


    
    public function transacoes(){
        $transacoes = Transacoes::where('id_user', Auth::user()->id)
        ->with('user')
        ->with('produto')
        ->get();
        $total_transacoes = Transacoes::where('id_user', Auth::user()->id)->sum('valor');
        return view('livcard.transacoes', [
            'transacoes' => $transacoes, 
            'total_transacoes' => $total_transacoes,
        ]);
    }

    
    
    public function credito(){
    
        return view('livcard.credito');
    }

    public function Adicionarcredito(Request $request){


      
    //Criar Usuário no Asaas
        function criaUsuario($nome, $email, $phone, $cpf){
         
            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/customers', [
              'body' => json_encode([
                'name' => $nome,
                'email' => $email,
                'phone' => $phone,
                'cpfCnpj' => $cpf
              ]),
              'headers' => [
                'accept' => 'application/json',
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTA2ODU6OiRhYWNoXzg3ZDVkNTI5LTM5MGYtNDUxNi04N2Q1LWQxOTQ3NjI4ZDcwMw==',
                'content-type' => 'application/json',
              ],
            ]);
         
            return $response->getBody()->getContents();  
        }
        
         $response_criacao_usuario = criaUsuario(Auth::user()->name, Auth::user()->email, $request->celular, $request->input('cpf'));
         $response_data = json_decode($response_criacao_usuario);
     
         $customer_id = $response_data->id;
      
        //Função de passar o cartão  
        function criaCobranca(
            $customer_id, 
            $valor, 
            $vencimento, 
            $descricao, 
            $titular_cartao, 
            $numero_cartao, 
            $vencimento_cartao, 
            $ccv, 
            $nome_titular,
            $cpf_titular, 
            $cep, 
            $email, 
            $endereco, 
            $telefone
        ) {
            // Separar mês e ano do vencimento do cartão
            $vencimento_cartao_array = explode('/', $vencimento_cartao);
            $expiryMonth = $vencimento_cartao_array[0];
            $expiryYear = $vencimento_cartao_array[1];
        
            // Criar um cliente Guzzle
            $client = new \GuzzleHttp\Client();
            
            // Montar o corpo da requisição com as variáveis
            $body = [
                "billingType" => "CREDIT_CARD",
                "customer" => $customer_id,
                "value" => $valor,
                "dueDate" => $vencimento,
                "description" => $descricao,
                "remoteIp" => $_SERVER['REMOTE_ADDR'],  // IP dinâmico do servidor remoto
                "creditCard" => [
                    "holderName" => $titular_cartao,
                    "number" => $numero_cartao,
                    "expiryMonth" => $expiryMonth,
                    "expiryYear" => $expiryYear,
                    "ccv" => $ccv
                ],
                "creditCardHolderInfo" => [
                    "name" => $nome_titular,
                    "cpfCnpj" => $cpf_titular,
                    "postalCode" => $cep,
                    "email" => $email,
                    "addressNumber" => $endereco,
                    "phone" => $telefone
                ]
            ];
            // Enviar a requisição php
            $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/payments/', [
                'json' => $body,
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTA2ODU6OiRhYWNoXzg3ZDVkNTI5LTM5MGYtNDUxNi04N2Q1LWQxOTQ3NjI4ZDcwMw==',
                    'content-type' => 'application/json',
                ],
            ]);
        
            $recarga = new Recargas();
            $recarga->id_user = Auth::user()->id;
            $recarga->valor = $valor;
            $recarga->save();

            $user = User::where('id', Auth::user()->id)->first();
            $saldo = $user->saldo;
            $user->saldo = $saldo + $valor;
            $user->save();

            echo 'wde';
            echo $response->getBody();
        }
        

        //Criar Cobrança no Cartão
        $credito = $request->input('credito');
        $cpf_titular = $request->input('cpf');
        $celular = $request->input('celular');
        $billingType = $request->input('billingType');
        if ($billingType === 'cartao') {
            $titular_cartao = $request->input('titular_cartao');
            $numero_cartao = $request->input('numero_cartao');
            $mes_vencimento = $request->input('mes_vencimento');
            $ano_vencimento = $request->input('ano_vencimento');
            $ccv = $request->input('ccv');
            $cep = $request->input('cep');
            $endereco = $request->input('endereco');
            $vencimento_cartao = $mes_vencimento . '/' . $ano_vencimento;
    
            // Chamando a função criaCobranca com os parâmetros apropriados
            return criaCobranca(
                $customer_id,         // customer_id
                $credito,                 // valor
                now()->addDays(5),        // vencimento (exemplo: vencimento em 5 dias)
                'Descrição da compra',    // descrição
                $titular_cartao,          // titular_cartao
                $numero_cartao,           // numero_cartao
                $vencimento_cartao,       // vencimento_cartao
                $ccv,                     // ccv
                Auth::user()->name,       // nome_titular (por exemplo, nome do usuário logado)
                $cpf_titular,             // cpf_titular
                $cep,                     // cep
                Auth::user()->email,      // email (pode usar o email do usuário logado)
                $endereco,                // endereco
                $celular                  // telefone
            );
        } else {
           
                $client = new \GuzzleHttp\Client();
                $cincodias = now()->addDays(5);
                $credito = $request->input('credito');
                 
                $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/payments', [
                    'body' => json_encode([
                        'billingType' => 'PIX',
                        'customer' => $customer_id,
                        'value' => $credito,
                        'dueDate' => $cincodias
                    ]),
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTA2ODU6OiRhYWNoXzg3ZDVkNTI5LTM5MGYtNDUxNi04N2Q1LWQxOTQ3NjI4ZDcwMw==',
                    'content-type' => 'application/json',
                ],
                ]);

                return $response->getBody();
        }
       

         return criaCobranca($customer_id, $request->credito, $vencimento, $descricao, Auth::user()->name);
    }
}
