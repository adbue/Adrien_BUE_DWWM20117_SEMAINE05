<?php

// application/controllers/Produits.php
date_default_timezone_set("Europe/Paris");

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
    {

    }

    public function inscription()
    {
        $this->load->view("header");
        $this->load->view("inscription");
        $this->load->view("footer");
    }

    public function connexion()
    {
        $this->load->view("header");
        $this->load->view("connexion", $data);
        $this->load->view("footer");
    }

    public function connexion_valide()
    {
        if ($this->input->post()) 
        {
            $data = $this->input->post(); // Tableau de l'ensemble de nos données récoltés sur la page

            $this->form_validation->set_rules('us_login', 'Login','required|valid_Email', array("required" => "Veuillez renseigner un %s.", "valid_Email" => "Le %s doit obligatoirement être une adresse mail."));
            $this->form_validation->set_rules('us_pass', 'Pass','required');

            if($this->form_validation->run()) 
            {

                // SI les informations contenues dans notre formulaire sont en adéquation avec 
                // avec nos règles

                $us_login = $data["Login"];
                $us_pass = $data["Pass"];

                // Function LoginValid()
                $this->load->model('UsersModels');
                if ($this->UsersModels->loginValid($us_login, $us_pass)) 
                {
                    $session_data = array(
                        'us_login' => $us_login,
                        'us_nom'   => $us_pass
                    );
                    $this->session->set_userdata($session_data);
                }
                else
                {
                    $this->session->set_flashdata("error", "Votre identifiant et votre mot de passe sont incorrects");
                }

            }else
            {
                // Échec ! Envoi vers la page connexion.php
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
                
                $this->connexion();
            }
        }
    }

    public function deconnexion()
    {
        unset($_SESSION["prenom"]);
        unset ($_SESSION["nom"]);
        unset ($_SESSION["role"]);

        if (ini_get("session.use_cookies")) 
        {
            setcookie(session_name(), '', time()-1, null, false, true);
        }

        session_destroy();

        redirect(produits/index);
    }
}