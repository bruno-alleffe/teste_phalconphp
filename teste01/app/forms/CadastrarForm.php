<?php
namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
// Validation
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class CadastrarForm extends Form
{
    public function initialize()
    {
        /**
         * Titulo
         */
        $titulo = new Text('titulo', [
            "class" => "form-control",
            // "required" => true,
            "placeholder" => "Digite o título"
        ]);

        // form name field validation
        $titulo->addValidator(
            new PresenceOf(['message' => 'O Título é Obrigatório'])
        );

        /**
         * Texto
         */
        $texto = new TextArea('texto', [
            "class" => "form-control tinymce-editor",
            // "required" => true,
            "placeholder" => "Digite o texto"
        ]);

        $texto->addValidators([
            new PresenceOf(['message' => 'O Texto é Obrigatório']),
            new StringLength(['max' => 255, 'message' => 'Texto muito longo. O máximo é 255 caracteres.']),
        ]);




        /**
         * Botão Gravar
         */
        $gravar = new Submit('gravar', [
            "value" => "Gravar",
            "class" => "btn btn-primary",
        ]);


        $this->add($titulo);
        $this->add($texto);
        $this->add($gravar);
    }
}