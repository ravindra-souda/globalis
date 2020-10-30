<?php

class Continent
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var array
     */
    private $heights = [];

    /**
     * @var int
     */
    private $safeSpots = 0;

    public function __construct(int $width = null, string $heights = null)
    {
        $this->width = $width;
        if ($heights !== null) {
            $this->heights = explode(' ', $heights);
        }
    }

    /**
     * @return bool
     */
    private function setWidth(): bool
    {
        $width = $this->width;
        // Interactive mode, get width from user instead of constructor
        if ($width === null) {
            echo "Largeur du continent (1 <= n <= 100000): ";
            $handle = STDIN;
            $width = trim(fgets($handle));
        }

        // fgets issued an error or typed value is not an integer
        if (!$width || $width < 1 || $width > 100000 || !ctype_digit((string) $width)) {
            return false;
        }

        $this->width = intval($width);
        return true;
    }

    /**
     * @return bool
     */
    private function setHeights(): bool
    {
        $heights = $this->heights;
        // Interactive mode, get heights from user instead of constructor
        if (empty($heights)) {
            echo "Altitude du continent (0 <= h <= 100000): ";
            $handle = STDIN;
            $heights = trim(fgets($handle));
            // fgets issued an error
            if ($heights === false) {
                return false;
            }
            $heights = explode(' ', $heights);
        }

        // Continent width and array of heights mismatch
        if ($this->width !== count($heights)) {
            return false;
        }

        $this->heights = $heights;
        return true;
    }

    /**
     * @return bool
     */
    private function calculateSafeSpots(): bool
    {
        $max = 0;
        foreach ($this->heights as $height) {
            if (!is_numeric($height) || (!ctype_digit($height))) {
                return false;
            }
            $height = intval($height);
            if ($height < 0 || $height > 100000) {
                return false;
            }
            if ($height < $max) {
                $this->safeSpots++;
            } else {
                $max = $height;
            }
        }
        return true;
    }

    /**
     * @return int
     */
    public function getSafeSpots(): int
    {
        return $this->safeSpots;
    }

    /**
     * Entry point of application
     * @return bool
     */
    public function runSimulation(): bool
    {
        if (!$this->setWidth() || !$this->setHeights() || !$this->calculateSafeSpots()) {
            return false;
        }
        return true;
    }
}
