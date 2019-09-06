<?php 

namespace App\Controllers;

use App\Models\Sindicalizado;
use App\Controllers\BaseController;
use App\Models\Anexo;
use App\Models\Classe;

use App\Helpers\PensionistaHelper;
use App\Helpers\DependentesHelper;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;

class SindicalizadosController extends BaseController
{

  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }
  public function getAll($request, $response)
  {
    $all =  Sindicalizado::all();
    return $response->getBody()->write($all->toJson());
  }

  public function getById($request, $response, array $args)
  {
    $this->setParams($request, $response, $args);
    
    try {
      $sind = Sindicalizado::where('idSindicalizado', $this->args['idSindicalizado'])->firstOrFail();
      $sind['Pencionista'] = PensionistaHelper::getPensionista($this->args['idSindicalizado']);
      $sind['Dependentes'] = DependentesHelper::getDependentes($this->args['idSindicalizado']);

      return $this->jsonResponse($sind, http_response_code());
    } catch (Exception $e) {
      return $this->jsonResponse($e, 400);
    }
  }

  public function create($request, $response, array $args)
  {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $duplicate = Sindicalizado::where('CPF', $input['CPF'])->first();

    if (!$duplicate) {
      if($request->getAttribute('has_errors')) {
        $code = 400;
        $errors = $request->getAttribute('errors');

        return $this->jsonResponse($errors, $code);
      }
      $input['Categoria'] = $this->makeCategory($input);

      $sindicalizado = Sindicalizado::create($input);
      if(isset($input['Pensionista'])){
        $sindicalizado['Pencionista'] = PensionistaHelper::makePensionista($input, $sindicalizado['idSindicalizado']);
      }
      if(isset($input['Dependentes'])){
        $sindicalizado['Dependentes'] = DependentesHelper::makeDependentes($input, $sindicalizado['idSindicalizado']);
      }

      return $this->jsonResponse($sindicalizado, http_response_code());
    }
    return $this->jsonResponse('duplicated Sindicalizado', 400);
  }

  public function update($request, $response, array $args)
  {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    try {
      $sindicalizado = 
        Sindicalizado::where('idSindicalizado', $this->args['idSindicalizado'])
                      ->firstOrFail()
                      ->update($input);
      if(isset($input['Pensionista'])){
        PensionistaHelper::updatePensionista($input, $this->args['idSindicalizado']);
      }
      if(isset($input['Dependentes'])){
        DependentesHelper::updateDependentes($input, $this->args['idSindicalizado']);
      }
      return $this->jsonResponse($input, http_response_code());
    } catch (\Exception $e) {
      return $this->jsonResponse($e, 400);
    }
  }

  public function upload($request, $response, array $args)
  {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $file = $this->getInputFile();

    $return = '';
    try {
      if(isset($file['document'])){
        $file = $file['document'];
        if($file->getError() === UPLOAD_ERR_OK) {
          $return = $this->moveFile($file, $this->container->get('upload_directory_doc'));
          $input['Documento'] = $return;
        }
      } else if(isset($file['photo'])){
        $file = $file['photo'];
        if($file->getError() === UPLOAD_ERR_OK) {
          $return = $this->moveFile($file, $this->container->get('upload_directory_photo'));
          $input['Foto'] = $return;
        }
      }
      $anexo = Anexo::create($input);
      return $this->jsonResponse($anexo, 200);

    } catch (Exception $e) {
      return $this->jsonResponse($e, 400);
    }

  }

  // private functions

  private function moveFile(UploadedFile $file, $directory) {
    $ext = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $ext);

    if (($ext != 'pdf' && $ext != 'doc') && ($ext != 'jpg' && $ext != 'png') ) {
      throw new Exception("invalid file type");
    }
    $file->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    return $filename;
  }

  private function makeClass($input) {
    $id = $input['Classe_idClasse'];

    try {
      $class = Classe::where('idClasse', $id)->firstOrFail();
      return $class->Descricao;
    } catch (ModelNotFoundException $e) {
      throw new Exception('Not found class');
    }
  }
}
