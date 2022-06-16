<?php
namespace Models;

class Recentie {

    public int $id;
    public int $bedrijfsId;
    public int $userId;
    public string $title;
    public string $beschrijving;
    public int $rating;
    public ReactieDTO $reactie;
  
}

?>