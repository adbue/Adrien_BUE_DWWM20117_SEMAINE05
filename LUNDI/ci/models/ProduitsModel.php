<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class ProduitsModel extends CI_Model
{
    public function liste()
    {
        $request = $this->db->query("SELECT * FROM produits");
        $aProduits = $request->result();

        return $aProduits;
    }

    public function categorie()
    {
        $request = $this->db->query("SELECT * FROM categories ORDER BY cat_nom ASC");
        $aCategories = $request->result();

        return $aCategories;
    }

    public function listeDetail($id)
    {
        $produit = $this->db->query("SELECT * FROM produits WHERE pro_id= ?", $id);
        $aView["produit"] = $produit->row();

        return $aView;

    }

    // *** INSERT ***

    public function add($data)
    {
        return $this->db->insert('produits', $data);
    }
}