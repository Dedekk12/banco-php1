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
    "cpfCliente" => "00000000000",
    "saldo" => 0
];

$contas[] = $conta;


function cadastrarCliente(&$clientes, string $nome, string $cpf, string $telefone): void {
    
    //global $clientes; //Alternativa para acesso de variáveis fora do escopo da função

    $verificador = false;
                while ($verificador == false)
                 {
                   $cpf = readline("informe seu cpf : \n");
                    if(strlen($cpf) == 11){
                        print "o cpf informado : $cpf é válido \n ";
                        $verificador = true;
                    }else {
                        print "O Cpf informado é inválido tente novamente . \n"; 
                    }
                }

    $cliente = [
        "nome" => $nome,
        "cpf"  => $cpf, //11 digitos
        "telefone" => $telefone //10 digitos
    ];
    
    $clientes[] = $cliente;
    
}

function cadastrarConta(&$contas, $cpfCliente): string {
    
    $conta = [
        "numeroConta" => uniqid(),
        "cpfCliente" => $cpfCliente,
        "saldo" => 0
    ];
    
    $contas[] = $conta;

    return $conta['numeroConta'];
}


function depositar(&$contas , $numero_conta , $valor)
{

    foreach ($contas as &$conta)    
     {
        if ($conta['numeroConta'] == $numero_conta) {
            $conta['saldo'] += $valor;

            print "recebeu  R$ {$valor}  na sua conta {$numero_conta}";
            break;
        }else {
            
            print "Conta {$numero_conta} não encontrada \n";

        }
        

    }

};


function sacar(&$contas , $numero_conta, $valor)
{


    foreach ($contas  as &$conta) 
    {
        if ($conta['numeroConta'] == $numero_conta) {
            $conta['saldo'] += $valor;
            break;
        }else {
            print "Conta {$numero_conta} não encontrada \n";
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
                sleep(5);
                system('clear');

                $cpf = "";
                $nomeS = readline("informe seu nome : \n");
                
                while ($verificador == false)
                 {
                   $telefone = readline("informe seu telefone : \n");
                    if(strlen($telefone) == 10){
                        print "o telefone informado : $telefone é válido \n ";
                        $verificador = true;
                    }else {
                        print "O telefone informado é inválido tente novamente . \n"; 
                    }
                }

                cadastrarCliente($contas, $nomeS , $cpf , $telefone);
                break 1;
            case '2':
                sleep(5);
                system('clear');

                $cpf = "";
                
                $verificador = false;
                while ($verificador == false)
                 {
                   $cpf = readline("informe seu cpf : \n");
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
               
               while ($verificador == false) 
                { 
                               
                    $cp = readline("informe o cpf da conta : . \n");
                    foreach ($contas as &$conta) {
                        if ($conta['cpf'] == $cp)
                            {                                               
                                print "cpf informado existente";
                                $verificador = true;
                            }
                    }
               } 
                
                consultarSaldo($contas , $cp );
                   break 1; 

            case '4':
                 #  depositar();
                     break 1;  
                                              
            case '5':
                  #sacar();
                   break 1;   

            case '6':
                
                break 2; 
 
            default:
                # code...
                break ;
        }
    } while ($escolha != '6');

}



menu();

cadastrarCliente($clientes, "Jefferson", "06800044455", "(45)99999999999");
$numeroConta = cadastrarConta($contas, "06800044455");

consultarSaldo($contas, $numeroConta);
#print_r($contas);

