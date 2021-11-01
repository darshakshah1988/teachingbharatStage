<?php
declare(strict_types=1);

namespace UserManager\Controller;

use UserManager\Controller\AppController;

/**
 * UserDocuments Controller
 *
 * @method \UserManager\Model\Entity\UserDocument[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserDocumentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->UserDocuments->find();
        $options['order'] = ['UserDocuments.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $userDocuments = $this->paginate($query);
        $this->set(compact('userDocuments'));
    }

    /**
     * View method
     *
     * @param string|null $id User Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userDocument = $this->UserDocuments->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('userDocument'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id User Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $userDocument = $this->UserDocuments->get($id, [
                'contain' => [],
            ]);
        }else{
            $userDocument = $this->UserDocuments->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $userDocument = $this->UserDocuments->patchEntity($userDocument, $this->request->getData());
            $userDocument->user_id = $this->request->getQuery('user_id');
            if ($this->UserDocuments->save($userDocument)) {
                $response['message'] = __('The document has been saved.');
                $response['status'] = true;


                $tbl = "<tr class='doc-row-". $userDocument->id ."'><td class='srn'></td>";
                $tbl .= "<td> " .(\Cake\Core\Configure::read('constants.DOCUMENT_TYPE')[$userDocument->document_type_id] ?? ""). " </td>";
                $tbl .= "<td>";
                $tbl .= "<a href='" .\Cake\Routing\Router::url(['controller' => 'UserDocuments', 'action' => 'download', $userDocument->id]) . "' target='_blank'> Download </a>";
                $tbl .= " | ";
                $tbl .= "<a href='" .\Cake\Routing\Router::url(['controller' => 'UserDocuments', 'action' => 'delete', $userDocument->id]) . "' class='udocDelete'> Delete </a>";
                $tbl .= "</td>";
                $tbl .= "</tr>";
                $response['table'] = $tbl;
            }else{
                $response['message'] = __('Oops, Something Went Wrong.');
                $response['status'] = false;
                $ajErr = [];
                foreach($userDocument->getErrors() as $errors){
                    foreach($errors as $ferr){
                        $ajErr[] =  $ferr;
                    }
                }
                $response['errors'] = "<ul> <li>" . implode("</li><li>", $ajErr) . " </li></ul>";
            }
        }
        $this->set([
            'status' => $response['status'] ?? '',
            'code' => isset($response['status']) ? 200 : 422,
            'message' => $response['message'] ?? "",
            'errors' => $response['errors'] ?? "",
            'userDocument' => $userDocument,
            'uidata' => $response['table'] ?? "",
         ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code', 'message', 'errors', 'userDocument', 'uidata']);
    }

    /**
     * download method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function download($id)
    { 

        $userDocument = $this->UserDocuments->find()->contain(['Users'])
                        ->where(['UserDocuments.id'=>$id])->FirstOrFail();
        $nominate_file_path = WWW_ROOT .'img/'. $userDocument->document_file_path."/".$userDocument->document_file;
        if (!empty($userDocument->document_file_path) && !empty($userDocument->document_file) && file_exists("img/".$userDocument->document_file_path . $userDocument->document_file)) {
            $ext = pathinfo($userDocument->document_file, PATHINFO_EXTENSION);
            //echo $ext;die;
            $uname = strtolower(str_replace(" ","_",\Cake\Core\Configure::read('constants.DOCUMENT_TYPE')[$userDocument->document_type_id] ?? ""));
            return $response = $this->response->withFile(
                $nominate_file_path,
                    ['download' => true, 'name' => $uname.".".$ext]
                );

        }else{
            $this->Flash->error(__('This file is not available.'));
            $this->redirect($this->referer());
        }
    }

  
    /**
     * Delete method
     *
     * @param string|null $id User Document id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userDocument = $this->UserDocuments->get($id);
        if ($this->UserDocuments->delete($userDocument)) {
             $result = ['status' => true, 'message' => __('The document has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The document could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $userDocument,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
