<?php
namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
// Validation
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class EditarForm extends Form
{
    public function initialize($entity = null, $options = [])
    {   

        if (isset($options["edit"])) {
            $id = new Hidden('id', [
                "required" => true,
            ]);

            $this->add($id);
        }
        /**
         * Titulo
         */
        $titulo = new Text('titulo', [
            "class" => "form-control",
            // "required" => true,
            "placeholder" => "Digite Um Novo Título"
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
            "placeholder" => "Digite Um Novo Texto"
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