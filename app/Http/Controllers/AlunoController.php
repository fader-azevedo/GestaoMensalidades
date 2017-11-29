<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Contacto;
use App\Def_Mensalidade;
use App\Inscricao;
use App\Mensalidade;
use FontLib\EOT\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AlunoController extends Controller{

    private $mensalidadeController;
    private $alunoController;
    private $aluno;
    public function __construct(MensalidadeController $mensalidadeController){
        $this->mensalidadeController = $mensalidadeController;
        $this->aluno = new Aluno();
    }

    public function index(){
        $anos = Def_Mensalidade::query()->pluck('ano');
        $listaAluno = Inscricao::query()->join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()->select('alunos.*')->where('estado','=','inscrito')->get();
        return view('aluno.listar',compact('listaAluno','anos'));
    }

    public function criarFoto($nome, $apelido,$codigo){
        $pasta = public_path().'\img\alunos\foto_'.$codigo.'.jpg';
        $fonte = public_path().'\fonts\Roboto-Bold.ttf';
        $char1 = substr($nome,0,1);
        $char2 = substr($apelido,0,1);

        $imagem = imagecreate( 250, 250 );
        imagecolorallocate( $imagem, 171, 255, 253 );
        $text_colour = imagecolorallocate( $imagem, 66, 74, 93);

        imagettftext($imagem,90,0,40,170,$text_colour,$fonte,$char1.$char2);

        imagejpeg($imagem,$pasta,100);
        imagedestroy( $imagem );
    }

    public function salvarPreInscricao(){
//        $nome = $_POST['nome'];
//        $apelido = $_POST['apelido'];
//        $codigo = $_POST['codigo'];

//        $this->criarFoto($nome, $apelido, $codigo);
        $this->criarFoto('Rosa', 'Macuvele', '2017005');
    }
}
