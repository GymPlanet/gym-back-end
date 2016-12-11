<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bd_usuari extends CI_Model {
    
    function insertUsuari($data) {
        $this->db->insert('usuari', $data);
    }
    
    function getUsuariByMail($mail) {
        $query = $this->db->query('SELECT * FROM usuari WHERE email = '.  $this->db->escape($mail) .'');
        $resultat = $query->row();
        return $resultat;
    }
    
    function insertUsuariPrefSetmana($data) {
        $this->db->insert('preferencia_usuari_setmana', $data);
    }
    
    function insertUsuariWeb($data) {
        $this->db->insert('usuari_web', $data);
    }
    
    function ifPassIsCorrectByMail($mail, $pass) {
        $query = $this->db->query('SELECT id FROM usuari_web WHERE email = '.  $this->db->escape($mail) .' AND password = '. $this->db->escape($pass));
        $resultat = $query->row();
        
        if ($resultat) {
            return true;
        }
        else {
            return false;
        }
    }
    
    function updateEsActiuUsuari($mailUsuari, $actiu) {
        $this->db->set('es_actiu', $actiu, FALSE);
        $this->db->where('email', $mailUsuari);
        $this->db->update('usuari_web'); 
    }
    
    function updateDateLastConnectionUsuari($mailUsuari) {
        $this->db->query('UPDATE usuari_web SET data_ultima_connexio = '.$this->db->escape(date("Y-m-d H:i:s")).' WHERE email = '.$this->db->escape($mailUsuari));
    }
     
}
