<?php
namespace App\UserStories\RendreDisponibleUnMedia;

use Symfony\Component\Validator\Constraints as Assert;

class RendreDisponibleUnMediaRequete{
    #[Assert\NotBlank(
        message: "Veuillez renseignez le numéro du média à rendre disponible"
    )]
    public ?int $id;

    /**
     * @param int|null $id
     */
    public function __construct(?int $id){
        $this->id = $id;
    }
}