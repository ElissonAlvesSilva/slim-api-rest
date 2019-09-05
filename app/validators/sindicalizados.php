<?php
use Respect\Validation\Validator as v;

$sindicalizado = array(
  // required params
  'CEP' => v::notBlank(),             
  'Cidade' => v::notBlank(),          
  'Estado' => v::notBlank(),          
  'Logradouro' => v::notBlank(),      
  'Bairro' => v::notBlank(),          
  'Nome' => v::notBlank(),            
  'Matricula' => v::notBlank(),       
  'Data_Nascimento' => v::notBlank()->date(), 
  'Status' => v::notBlank()->intVal(),          
  'Status_Sint' => v::notBlank()->intVal(),     
  'Categoria' => v::notBlank(),       
  'Forma_Pagamento' => v::notBlank()->intVal(), 
  'Classe_idClasse' => v::notBlank()->intVal(),
  'Data_Cadastro' => v::notBlank()->date(),   
  'Mae' => v::notBlank(),
  // not required params             
  'CPF' =>  v::optional(v::cpf()),             
  'RG' => v::optional(v::stringType()),              
  'Orgao' => v::optional(v::stringType()),           
  'Data_Expedicao' => v::optional(v::date()),  
  'Naturalidade' => v::optional(v::stringType()),    
  'Nacionalidade' => v::optional(v::stringType()),   
  'Pai' => v::optional(v::stringType()),             
  'Email' => v::optional(v::email()),           
  'Celular' => v::optional(v::stringType()),         
  'Telefone' => v::optional(v::stringType()),        
  'Data_Admissao' => v::optional(v::date()),   
  'Lotacao' => v::optional(v::stringType()),         
  'Local' => v::optional(v::intType()),           
);
