<?php
class MediasManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Media $media) {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO media(link, type, publication_id) VALUES("'.$media->get_link().'", "'.$media->get_type().'","'.$media->get_publication_id().'")');
      
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Media $media)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM media WHERE id = "'.$media->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet media.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, link, type FROM media WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Media($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les medias.
    $medias = [];

    $q = $this->_db->query('SELECT id, link, type FROM media ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $medias[] = new Media($donnees);
    }

    return $medias;
  }
    
    public function img(Media $media, $data) {
        
        try {
    
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['userfile']['error']) ||
                is_array($_FILES['userfile']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['userfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // You should also check filesize here. 
            if ($_FILES['userfile']['size'] > 2000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['userfile']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $uploadfile = sprintf('../public/uploads/%s.%s',
                    sha1_file($_FILES['userfile']['tmp_name']),
                    $ext
                );
            if (!move_uploaded_file(
                $_FILES['userfile']['tmp_name'], $uploadfile
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            echo 'File is uploaded successfully.';
            $media->set_img_url($uploadfile);
            $this->update($media);

        } catch (RuntimeException $e) {

            echo $e->getMessage();

        }
    }

  public function update(Media $media)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE media SET link = "'.$media->get_link().'", type = "'.$media->get_type().'" WHERE id = "'.$media->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}