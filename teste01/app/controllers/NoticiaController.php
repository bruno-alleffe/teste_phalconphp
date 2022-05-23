<?php


use App\Forms\CadastrarForm;
use App\Forms\EditarForm;

class NoticiaController extends ControllerBase
{   
    
    private $mensagemDeErro = '';
    public $noticia;

    public function listaAction()
    {

        $this->view->pick("noticia/listar");
        $this->view->noticias = Noticia::find();
        
    }

    public function cadastrarAction()
    {
       
        $this->view->pick("noticia/cadastrar");
        $this->view->form = new CadastrarForm();

    }

    public function editarAction($id = null)
    {   

        
        // Check  id not empty
        if (!empty($id) AND $id != null)
        {

            if ($this->request->isPost()) {
                
                $noticia = Noticia::findFirst([
                    'conditions' => 'id = :1:',
                    'bind' => [
                        '1' => $id
                    ]
                ]);

                $form = new EditarForm();
                $form->bind($_POST, $noticia);

                $this->view->noticia = $noticia;
                $this->view->form = new EditarForm($noticia, [
                    "edit" => true
                ]);

            } else {
                // Fetch User Article
                $noticia = Noticia::findFirst([
                    'conditions' => 'id = :1:',
                    'bind' => [
                        '1' => $id
                    ]
                ]);

                
                if (!$noticia) {
                    $this->flashSession->error('Notícia não encontrada');
                    return $this->response->redirect('noticias');
                }

                // Send Noticia Data in Noticia Form
                $this->view->noticia = $noticia;
                // $this->view->form = new EditarForm();;

                $this->view->form = new EditarForm($noticia, [
                    "edit" => true
                ]);
            }
        } else {
            return $this->response->redirect('noticias');
        }
    }

    public function salvarAction()
    {
        $form = new CadastrarForm();
        $this->noticia = new Noticia();

        // check request
        if (!$this->request->isPost()) {
            return $this->response->redirect('noticias/cadastrar');
        }

        
        $form->bind($_POST, $this->noticia);
        
        // check form validation
        if (!$form->isValid()) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'cadastrar',
                ]);
                return;
            }
        }
        
        $DateAndTime = date('Y-m-d h:i:s a', time());
        
        $this->noticia->setDataCadastro($DateAndTime);
        $this->noticia->setDataUltimaAtualizacao($DateAndTime);
       
        
        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if (!$this->noticia->save()) {
            foreach ($this->noticia->getMessages() as $m) {
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'cadastrar',
                ]);
                return;
            }
        }


        $this->flashSession->success('Noticia cadastrada com sucesso!');
        return $this->response->redirect('noticias/cadastrar');

        $this->view->disable();
    }

    public function atualizarAction()
    {
    
        // check request
        if (!$this->request->isPost()) {
            return $this->response->redirect('noticias');
        }

        $id = $this->request->getPost("id", "int");

        $noticia = Noticia::findFirst([
            'conditions' => 'id = :1:',
            'bind' => [
                '1' => $id
            ]
        ]);

        if (!$noticia) {
            $this->flashSession->error('Noticia não encontrada!');
            return $this->response->redirect('noticias');
        }
      
        $form = new EditarForm();
        if (!$form->isValid($this->request->getPost(), $noticia)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
                return $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'editar',
                    'params'     => [$id],
                ]);
            }
        }
        
      
        $DateAndTime = date('Y-m-d h:i:s a', time());
    
        $noticia->setDataUltimaAtualizacao($DateAndTime);

        
        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if (!$noticia->save($_POST)) {
            foreach ($noticia->getMessages() as $m) {
                $this->flashSession->error($m);
                return $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'editar',
                ]);
            }
        }


        $this->flashSession->success('Noticia atualizada com sucesso!');
        return $this->response->redirect('noticias');

        $this->view->disable();
    }

     public function excluirAction($id)
     {
        if ($id > 0 AND !empty($id))
        {
            // Check Agin User Article is Valid
            $noticia = Noticia::findFirst([
                'conditions' => 'id = :1:',
                'bind' => [
                    '1' => $id
                ]
            ]);

            if (!$noticia) {
                $this->flashSession->error('Noticia Não Encontrada');
                return $this->response->redirect('noticias');
            }    

            if (!$noticia->delete()) {
                foreach ($noticia->getMessages() as $msg) {
                    $this->flashSession->error((string) $msg);
                }
                return $this->response->redirect("noticias");
            } else {
                $this->flashSession->success("Noticia Deletada!");
                return $this->response->redirect("noticias");
            }

        } else {
            $this->flashSession->error("ID de Noticia Invalido.");
            return $this->response->redirect("noticias");
        }

        # View Page Disable
        $this->view->disable();
    }
     

}