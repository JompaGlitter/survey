<?php

namespace Idun\Survey;

/**
 * Controller for the Survey service
 *
 */
class SurveyController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    
    
    
    /**
     * View all surveys
     *
     * @return void
     */
    public function viewAllAction()
    {
        $this->theme->setTitle('Alla undersökningsformulär');
        
        $this->db->select()
                 ->from('survey')
                 ->execute();
        
        $all = $this->db->fetchAll();
        
        $this->views->add('survey/list', [
            'surveys' => $all,
        ]);
    
    }
    
    /**
     * View all surveys
     *
     * @return void
     */
    public function viewSingleAction($id = null)
    {
        $this->theme->setTitle('Detaljer för undersökningsformulär');
        
        $this->db->select()
                 ->from('survey')
                 ->where("id = $id")
                 ->execute();
        
        $survey = $this->db->fetchAll();
        
        $this->views->add('survey/view', [
            'title' => "Detaljer för undersökningsformulär",
            'surveys' => $survey,
        ]);
    
    }
    
    
    /**
     * Show form to edit survey
     *
     *
     */
    public function addViewAction()
    {
        $this->theme->setTitle('Skapa nytt undersökningsformulär');
        $this->theme->addStylesheet('css/form.css');
        
        
        $this->views->add('survey/add', [
            'title' => "Skapa nytt undersökningsformulär",
            'name'          => null,
            'text'          => null,
            'scale'         => null,
            'paramleft'     => null,
            'paramright'    => null,
        ]);
    }
    
    
    /**
     * Create new survey
     *
     * @return void
     */
    public function addAction()
    {
        $isPosted = $this->request->getPost('doCreate');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        
        $survey = [
            'name'          => strip_tags($this->request->getPost('name')),
            'text'          => strip_tags($this->request->getPost('text')),
            'scale'         => strip_tags($this->request->getPost('scale')),
            'paramleft'     => strip_tags($this->request->getPost('paramleft')),
            'paramright'    => strip_tags($this->request->getPost('paramright')),
            'created'       => $now,
        ];
        
        $this->db->insert('survey', $survey);
        $this->db->execute();
        
        $this->response->redirect($this->request->getPost('redirect'));
        
    }
    
    
    /**
     * Show form to edit survey
     *
     *
     */
    public function editViewAction($id)
    {
        $this->theme->setTitle('Redigera formulär');
        $this->theme->addStylesheet('css/form.css');
        
        $this->db->select()
                 ->from('survey')
                 ->where("id = $id")
                 ->execute();
        
        $survey = $this->db->fetchOne();
        
        $this->views->add('survey/edit', [
            'title' => "Redigera formulär",
            'survey' => $survey,
            'id' => $id,
        ]);
    }
    
    
    /**
     * Edit a survey
     *
     *
     */
    public function editAction($id)
    {
        $isPosted = $this->request->getPost('doEdit');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        
        $survey = [
            'name'          => strip_tags($this->request->getPost('name')),
            'text'          => strip_tags($this->request->getPost('text')),
            'scale'         => strip_tags($this->request->getPost('scale')),
            'paramleft'     => strip_tags($this->request->getPost('paramleft')),
            'paramright'    => strip_tags($this->request->getPost('paramright')),
        ];
        
        $this->db->update('survey', $survey, "id = $id");
        $this->db->execute();
        
        $this->response->redirect($this->request->getPost('redirect'));
    }
    
    
    /**
     * Delete a survey
     *
     *
     */
    public function deleteSingleAction($id)
    {
        $isPosted = $this->request->getPost('doDeleteOne');
        
        if (!$isPosted) {
            $this->response->redirect($this->url->create('survey.php'));
        }
        
        $this->db->delete('survey', "id = $id");
        $this->db->execute();
        
        $this->response->redirect($this->url->create('survey.php'));
    }
    
    
    /**
     * Delete all surveys
     *
     *
     */
    public function deleteAllAction()
    {
        $isPosted = $this->request->getPost('doDeleteAll');
        
        if (!$isPosted) {
            $this->response->redirect($this->url->create('survey.php'));
        }
        
        $this->db->delete('survey');
        $this->db->execute();
        
        $this->response->redirect($this->url->create('survey.php'));
    }
    
    
    /**
     * Create a survey from info in database
     *
     * @return void
     */
    public function surveyFormAction($id = null)
    {
        $this->theme->setTitle('Undersökningsformulär');
        
        $this->db->select()
                 ->from('survey')
                 ->where("id = $id")
                 ->execute();
        
        $survey = $this->db->fetchAll();
        
        $this->views->add('survey/survey', [
            'surveys' => $survey,
        ]);
        
    }
    
    
    /**
     * Restore/setup survey database and insert a test survey
     *
     *
     */
    public function setupSurveysAction()
    {
        $this->db->dropTableIfExists('survey')
                 ->execute();
        
        $this->db->createTable(
                        'survey',
                        [
                            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                            'name' => ['varchar(80)'],
                            'text' => ['text'],
                            'scale' => ['integer', 'not null'],
                            'paramleft' => ['varchar(80)'],
                            'paramright' => ['varchar(80)'],
                            'created' => ['datetime'],
                        ])
                 ->execute();
        
        
        $this->db->insert(
            'survey',
            ['name', 'text', 'scale', 'paramleft', 'paramright','created']
        );
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        
        $this->db->execute([
            "Test-survey",
            "Detta är en test-survey för att visa att survey-tjänsten fungerar. Hur skulle du bedömma tjänsten?",
            5,
            "Sjukt dålig!",
            "Sjukt bra!",
            $now
        ]);
        
        $this->response->redirect($this->url->create('survey.php'));
        /*
        'name' => "Test-survey",
        'text' => "Detta är en test-survey för att visa att survey-tjänsten fungerar. Hur skulle du bedömma tjänsten?",
        'scale' => 5,
        'paramleft' => "Sjukt dålig",
        'paramright' => "Sjukt bra",
        'created' => $now,
        */
    
    }
    
    
}