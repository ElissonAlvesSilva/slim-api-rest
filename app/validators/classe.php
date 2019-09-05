<?php 

use Respect\Validation\Validator as v;

$classe = array(
  'Descricao' => v::notBlank(),
);