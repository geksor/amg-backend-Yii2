<?php

namespace common\behavior;

class RankGalleryImage
{
    public $name;
    public $description;
    public $id;
    public $rank;
    public $rating;
    public $voteCount;
    /**
     * @var RankGalleryBehavior
     */
    protected $rankGalleryBehavior;

    /**
     * @param RankGalleryBehavior $rankGalleryBehavior
     * @param array           $props
     */
    function __construct(RankGalleryBehavior $rankGalleryBehavior, array $props)
    {

        $this->rankGalleryBehavior = $rankGalleryBehavior;

        $this->name = isset($props['name']) ? $props['name'] : '';
        $this->description = isset($props['description']) ? $props['description'] : '';
        $this->id = isset($props['id']) ? $props['id'] : '';
        $this->rank = isset($props['rank']) ? $props['rank'] : '';
        $this->rating = isset($props['rating']) ? $props['rating'] : '';
        $this->voteCount = isset($props['voteCount']) ? $props['voteCount'] : '';
    }

    /**
     * @param string $version
     *
     * @return string
     */
    public function getUrl($version)
    {
        return $this->rankGalleryBehavior->getUrl($this->id, $version);
    }
}