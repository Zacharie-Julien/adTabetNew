<?php
class Utilisateur
{
  private $db;
  private $insert;
  private $connect;
  private $select;
  private $delete;

  private $selectById;
  private $update;
  private $updateMDP;


  public function __construct($db)
  {
    $this->db = $db;
    $this->insert = $this->db->prepare("insert into utilisateur(email, mdp, nom, prenom, idRole) values (:email, :mdp, :nom, :prenom, :role)");
    $this->select = $db->prepare("select u.id, email, idRole, nom, prenom, r.libelle as libellerole from utilisateur u, role r where u.idRole = r.id order by nom");
    $this->connect = $this->db->prepare("select email, idRole, mdp from utilisateur where email=:email");
    $this->selectById = $db->prepare("select id, email, nom, prenom, idRole from utilisateur where id=:id");
    $this->update = $db->prepare("update utilisateur set nom=:nom, prenom=:prenom, email=:email, idRole=:role where id=:id");
    $this->updateMDP = $db->prepare("update utilisateur set mdp=:mdp where id=:id");
    $this->delete = $db->prepare("DELETE FROM utilisateur WHERE id=:id");
  }
  public function insert($email, $mdp, $role, $nom, $prenom)
  {
    $r = true;
    $this->insert->execute(array(
      ':email' => $email,
      ':mdp' => $mdp,
      ':role' => $role,
      ':nom' => $nom,
      ':prenom' => $prenom
    ));
    if ($this->insert->errorCode() != 0) {
      print_r($this->insert->errorInfo());
      $r = false;
    }
    return $r;
  }
  public function select()
  {
    $this->select->execute();
    if ($this->select->errorCode() != 0) {
      print_r($this->select->errorInfo());
    }
    return $this->select->fetchAll();
  }
  public function connect($email)
  {
    $unUtilisateur = $this->connect->execute(array(':email' => $email));
    if ($this->connect->errorCode() != 0) {
      print_r($this->connect->errorInfo());
    }
    return $this->connect->fetch();
  }
  public function selectById($id)
  {
    $this->selectById->execute(array(':id' => $id));
    if ($this->selectById->errorCode() != 0) {
      print_r($this->selectById->errorInfo());
    }
    return $this->selectById->fetch();
  }
  public function update($id, $role, $nom, $prenom, $email)
  {
    $r = true;
    $this->update->execute(array(
      ':id' => $id,
      ':role' => $role,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':email' => $email
    ));
    if ($this->update->errorCode() != 0) {
      print_r($this->update->errorInfo());
      $r = false;
    }
    return $r;
  }
  public function updateMDP($id, $nouveauMdp)
  {
    $r = true;
    $this->updateMDP->execute(array(':id' => $id, ':mdp' => $nouveauMdp));
    if ($this->updateMDP->errorCode() != 0) {
      print_r($this->updateMDP->errorInfo());
      $r = false;
    }

    return $r;
  }

  public function delete($id)
  {
    $r = true;
    $this->delete->execute(array(':id' => $id));
    if ($this->delete->errorCode() != 0) {
      print_r($this->delete->errorInfo());
      $r = false;
    }

    return $r;
  }
}
