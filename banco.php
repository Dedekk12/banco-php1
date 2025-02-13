<?php 

$clientes = [];
$contas   = [];

//Cliente que sempre existe
$cliente = [
    "nome" => "John Doe",
    "cpf"  => "00000000000", //11 digitos
    "telefone" => "(45)9999999999" //10 digitos
];

$clientes[] = $cliente;


$conta = [
    "numeroConta" => uniqid(),
    "cpf" => "00000000000",
    "saldo" => 0
];

$contas[] = $conta;




function cadastrarCliente(&$clientes, string $nome, string $cpf, string $telefone): void {
    
    //global $clientes; //Alternativa para acesso de variáveis fora do escopo da função



    $cliente = [
        "nome" => $nome,
        "cpf"  => $cpf, //11 digitos
        "telefone" => $telefone //10 digitos
    ];
    
    $clientes[] = $cliente;
    
}

function cadastrarConta(&$contas, $cpf): string {
    
    $conta = [
        "numeroConta" => uniqid(),
        "cpf" => $cpf,
        "saldo" => 0
    ];
    
    $contas[] = $conta;

    return $conta['cpf'];
    return $conta['saldo'];
}


function depositar(&$contas , $cpf_conta , $valor)
 { 

    foreach ($contas as &$conta)    
     {
        if ($conta["cpf"] == $cpf_conta) {
            $conta['saldo'] += $valor;

            print "recebeu  R$ {$valor}  na sua conta {$cpf_conta}";
            break;
        }else {
            
            print "Conta {$cpf_conta} não encontrada \n";

        }
        

    }

};


function sacar(&$contas , $cpf_conta, $valor)
{


    foreach ($contas  as &$conta) 
    {
        if ($conta['cpf'] == $cpf_conta) {
            $conta['saldo'] -= $valor;
            print "{$conta['cpf']} recebeu R$ $valor ";
            break;
        }

    }


}


function consultarSaldo(&$contas, $cpfConta)
{

    foreach ( $contas as &$conta) 
    {
        
        if ($conta['cpf'] == $cpfConta)
        {
         
         print "Saldo da conta {$cpfConta} é de {$conta['saldo']} ";
         
        }

    }

}

function menu()
{
    global $contas ;
    $verificador = false;
    $inicio = <<<TEXTO

        __________________________________________________________
        | ↓ BANCO  ↓                                               |
        |                                                          |
        |→[1] CADASTRAR CLIENTE  ←         →[5] SACAR            ← |
        |→[2] CADASTRAR CONTA    ←         →[6] FECHAR           ← |
        |→[3] CONSULTAR SALDO    ←                                 |
        |→[4] DEPOSITA           ←                                 |
        |                                                          |
        ──────────────────────────────────────────────────────────

    TEXTO;
 
    do {
        print "{$inicio}";
        $escolha = readline(" Selecione uma opção para continuar : \n ");
        switch ($escolha) {
            case '1':
                sleep(3);
                system('clear');


                $cpf = "";
                $nomeS = readline("informe seu nome : \n");
                $verificador = false;
                while ($verificador == false)
                 {
                   $telefone = readline("informe seu telefone (10 digitos): \n");
                    if(strlen($telefone) == 10){
                        print "o telefone informado : $telefone é válido \n ";
                        $verificador = true;
                    }else {
                        print "O telefone informado é inválido tente novamente . \n"; 
                    }
                }
                $verificador = false;
                while ($verificador == false)
                 {
                   $cpf = readline("informe seu cpf (11 digitos) : \n");
                    if(strlen($cpf) == 11){
                        print "o cpf informado : $cpf é válido \n ";
                        $verificador = true;
                    }else {
                        print "O Cpf informado é inválido tente novamente . \n"; 
                    }
                }

                cadastrarCliente($contas, $nomeS , $cpf , $telefone);
                break 1;
            case '2':
                sleep(3);
                system('clear');

                $cpf = "";
                
                $verificador = false;
                while ($verificador == false)
                 {
                   $cpf = (int)readline("informe seu cpf (11 digitos): \n");
                    if(strlen($cpf) == 11){
                        print "o cpf informado : $cpf é válido \n ";
                        $verificador = true;
                    }else {
                        print "O Cpf informado é inválido tente novamente . \n"; 
                    }
                }


                cadastrarConta($contas, $cpf);
                break 1;
            case '3':
               sleep(3); 
               system('clear');
                $cpf1 = 0;
               $verificador = false;
               while ($verificador == false) 
                { 
                               
                    $cpf1 = (int)readline("informe o cpf da conta (11 digitos):  \n");
                    foreach ($contas as &$conta) {
                        if ($conta['cpf'] == $cpf1)
                            {                                               
                                print "cpf informado existente \n";
                                $verificador = true;
                                break;
                            }
                    }
               } 
                
                consultarSaldo($contas , $cpf1 );
                   break 1; 

            case '4':
                sleep(3);
                system('clear');
                $cpf1 = 0;
               $verificador = false;
               while ($verificador == false) 
                { 
                               
                    $cpf1 = (int)readline("informe o cpf da conta (11 digitos):  \n");
                    foreach ($contas as &$conta) {
                        if ($conta['cpf'] == $cpf1)
                            {                                               
                                print "cpf informado existente \n";
                                $verificador = true;
                                break;
                            }
                    }
               } 

               $verificador2 = false;
               while ($verificador2 == false) 
               { 
                              
                   $valor = (int)readline("informe o para depositar na conta:  \n");
                    if ($valor < 0 ) {
                        print "Valor informado Inválido, informe um valor Real \n";
                    }else {
                        print "Valor informado válido \n";
                        $verificador2 = true;
                        depositar($contas , $cpf1 , $valor);
                    }
                 
               }
                    
                     break 1;  
                                              
            case '5':
                $cpf1 = 0;
                $verificador = false;
                while ($verificador == false) 
                 { 
                                
                     $cpf1 = (int)readline("informe o cpf da conta (11 digitos):  \n");
                     foreach ($contas as &$conta) {
                         if ($conta['cpf'] == $cpf1)
                             {                                               
                                 print "cpf informado existente \n";
                                 $verificador = true;
                                 break;
                             }
                     }
                } 
                $verificador2 = false;
                while ($verificador2 == false) 
                { 
                               
                    $valor = (int)readline("informe o valor para sacar da conta:  \n");
                     if ($valor < 0 ) {
                         print "Valor informado Inválido, informe um valor Real \n";
                     }else {
                         print "Valor informado válido \n";
                         $verificador2 = true;
                         sacar($contas, $cpf1 , $valor);
                     }
                  
                }

                   break 1;   


            case '6':
                $verificador and $verificador2 = true;
                  
                   break 1;
 
        }
    } while ($escolha != '6');

}



menu();

#cadastrarCliente($clientes, "Jefferson", "06800044455", "(45)99999999999");
#$numeroConta = cadastrarConta($contas, "06800044455");

#consultarSaldo($contas, $numeroConta);
#print_r($contas);