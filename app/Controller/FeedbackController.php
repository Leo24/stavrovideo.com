<?php
        App::uses('AppController', 'Controller');

        class FeedbackController extends AppController {
                public $uses = array('ContactUsInfo');


                public function admin_contactinfo_index() {
                        $this->layout = 'admin';
                        $this->set('contacts',  $this->ContactUsInfo->find('all'));
                }


                function admin_set_contact_info()
                {

                        $this->layout = "admin";

                        if (isset($this->data['ContactUsInfo']['mobile_phone_number']) && isset($this->data['ContactUsInfo']['mobile_phone_number'])) {
                                $CurrentContactUsInfo = $this->ContactUsInfo->find('all');
                                $this->ContactUsInfo->delete($CurrentContactUsInfo[0]['ContactUsInfo']['id']);
                                $this->ContactUsInfo->set('additional_text', $this->data['ContactUsInfo']['additional_text']);
                                $this->ContactUsInfo->set('mobile_phone_number', $this->data['ContactUsInfo']['mobile_phone_number']);
                                $this->ContactUsInfo->set('landline_phone_number', $this->data['ContactUsInfo']['landline_phone_number']);
                                $this->ContactUsInfo->set('email', $this->data['ContactUsInfo']['email']);
                                $this->ContactUsInfo->save();

                                $result = true;
                        } else {
                                $result = false;


                        }
                        $this->set('result',  $result);

                        $this->redirect(array('controller'=>'feedback', 'action'=>'contactinfo_index', 'admin'=>true));

                }

        }
