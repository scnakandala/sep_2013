<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Implementation of the Hungarian Algorithm for matrix of jobs and
 * potential assignees
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Based on implementation described at <http://www.public.iastate.edu/~ddoty/HungarianAlgorithm.html>.
 * Version 1.0 released 17 july 2013
 */
require_once 'config.php';
require_once ROOT_DIR . '/classes/Location.php';

/**
 * HungarianAlgorithm class
 */
class HungarianAlgorithm {

    /**
     * Variable to store the matrix
     * @var int[][]
     */
    var $costs;

    /**
     * The constructor
     * 
     * @param int[][] $c matrix of jobs and assignees
     */
    public function __construct($c) {
        $this->costs = $c;
    }

    /**
     * Public function to find the assignments
     *  
     * @return int[] $agentsTasks the task for each agent.
     * @throws Exception
     */
    public function findAssignments() {
        if (!isset($this->costs)) {
            throw new Exception("Null Argument Exception");
        }

        $h = count($this->costs);
        $w = count($this->costs[0]);

        for ($i = 0; $i < $h; $i++) {
            $min = PHP_INT_MAX;
            for ($j = 0; $j < $w; $j++) {
                $min = min($min, $this->costs[$i][$j]);
            }
            for ($j = 0; $j < $w; $j++) {
                $this->costs[$i][$j] -= $min;
            }
        }

        $masks = array_fill(0, $h, array_fill(0, $w, 0));
        $rowsCovered = array_fill(0, $h, 0);
        $colsCovered = array_fill(0, $w, 0);

        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($this->costs[$i][$j] == 0 && $rowsCovered[$i] == 0 && $colsCovered[$j] == 0
                ) {
                    $masks[$i][$j] = 1;
                    $rowsCovered[$i] = 1;
                    $colsCovered[$j] = 1;
                }
            }
        }

        $this->clearCovers($rowsCovered, $colsCovered, $w, $h);
        
        $path = new Location($w, $h);
        $pathStart = new Location(0, 0);
        $step = 1;
        while ($step != -1) {
            switch ($step) {
                case 1:
                    $step = $this->runStep1($masks, $colsCovered, $w, $h);

                    break;
                case 2:
                    $step = $this->runStep2($masks, $rowsCovered, $colsCovered, $w, $h, $pathStart
                    );
                    break;
                case 3:
                    $step = $this->runStep3($masks, $rowsCovered, $colsCovered, $w, $h, $path, $pathStart
                    );
                    break;
                case 4:
                    $step = $this->runStep4($rowsCovered, $colsCovered, $w, $h
                    );
                    break;
            }
        }
        $agentsTasks = array();
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($masks[$i][$j] == 1) {
                    $agentsTasks[$i] = $j;
                    break;
                }
            }
        }
        return $agentsTasks;
    }

    /**
     * Function to runStep1
     * 
     * @param int[][] $masks        masks
     * @param int[]   &$colsCovered columns covered
     * @param int     $w            width
     * @param int     $h            height
     * 
     * @return int
     */
    private function runStep1($masks, &$colsCovered, $w, $h) {
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($masks[$i][$j] == 1)
                    $colsCovered[$j] = 1;
            }
        }
        $colsCoveredCount = 0;
        for ($j = 0; $j < $w; $j++) {
            if ($colsCovered[$j] == 1)
                $colsCoveredCount++;
        }
        if ($colsCoveredCount == $h)
            return -1;
        else
            return 2;
    }

    /**
     * Function to runStep2
     * 
     * @param int[][]   $masks
     * @param boolean[] &$rowsCovered
     * @param boolean[] &$colsCovered
     * @param int       $w
     * @param int       $h
     * @param Location  &$pathStart
     * 
     * @return int
     */
    private function runStep2(&$masks, &$rowsCovered, &$colsCovered, $w, $h, &$pathStart
    ) {
        while (true) {
            $loc = $this->findZero($rowsCovered, $colsCovered, $w, $h);
            if ($loc->row == -1) {
                return 4;
            } else {
                $masks[$loc->row][$loc->column] = 2;
                $starCol = $this->findStarInRow($masks, $w, $loc->row);
                if ($starCol != -1) {
                    $rowsCovered[$loc->row] = 1;
                    $colsCovered[$starCol] = 0;
                } else {
                    $pathStart = $loc;
                    return 3;
                }
            }
        }
    }

    /**
     * Function to runStep3
     * 
     * @param int[]      $masks
     * @param boolean[]  $rowsCovered
     * @param boolean[]  $colsCovered
     * @param int        $w
     * @param int        $h
     * @param Location[] $path
     * @param Location   $pathStart
     * 
     * @return int
     */
    private function runStep3(&$masks, &$rowsCovered, &$colsCovered, $w, $h, &$path, $pathStart
    ) {
        $pathIndex = 0;
        $path = array($pathStart);
        while (true) {
            $row = $this->findStarInColumn($masks, $h, $path[$pathIndex]->column);
            if ($row == -1)
                break;
            $pathIndex++;
            $path[$pathIndex] = new Location($row, $path[$pathIndex - 1]->column);
            $col = $this->findPrimeInRow($masks, $w, $path[$pathIndex]->row);
            $pathIndex++;
            $path[$pathIndex] = new Location($path[$pathIndex - 1]->row, $col);
        }
        $this->convertPath($masks, $path, $pathIndex + 1);
        $this->clearCovers($rowsCovered, $colsCovered, $w, $h);
        $this->clearPrimes($masks, $w, $h);
        return 1;
    }

    /**
     * Function to runStep4
     * 
     * @param boolean[] $rowsCovered
     * @param boolean[] $colsCovered
     * @param int       $w
     * @param int       $h
     * 
     * @return int
     */
    private function runStep4($rowsCovered, $colsCovered, $w, $h) {
        $minValue = $this->findMinimum($rowsCovered, $colsCovered, $w, $h);
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($rowsCovered[$i] == 1) {
                    $this->costs[$i][$j] += $minValue;
                }
                if ($colsCovered[$j] == 0) {
                    $this->costs[$i][$j] -= $minValue;
                }
            }
        }
        return 2;
    }

    /**
     * Function to find convert path
     * 
     * @param int[][]    &$masks
     * @param Location[] $path
     * @param int        $pathLength
     * 
     * @return void
     */
    private function convertPath(&$masks, $path, $pathLength) {
        for ($i = 0; $i < $pathLength; $i++) {
            if ($masks[$path[$i]->row][$path[$i]->column] == 1)
                $masks[$path[$i]->row][$path[$i]->column] = 0;
            else if ($masks[$path[$i]->row][$path[$i]->column] == 2)
                $masks[$path[$i]->row][$path[$i]->column] = 1;
        }
    }

    /**
     * Function to find zero
     * 
     * @param boolean[] $rowsCovered
     * @param boolean[] $colsCovered
     * @param int       $w
     * @param int       $h
     * 
     * @return Location
     */
    private function findZero($rowsCovered, $colsCovered, $w, $h) {
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($this->costs[$i][$j] == 0 && $rowsCovered[$i] == 0 && $colsCovered[$j] == 0)
                    return new Location($i, $j);
            }
        }
        return new Location(-1, -1);
    }

    /**
     * Function to find minimum
     * 
     * @param boolean[] $rowsCovered
     * @param boolean[] $colsCovered
     * @param int       $w
     * @param int       $h
     * 
     * @return int
     */
    private function findMinimum($rowsCovered, $colsCovered, $w, $h) {
        $minValue = PHP_INT_MAX;
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($rowsCovered[$i] == 0 && $colsCovered[$j] == 0)
                    $minValue = min($minValue, $this->costs[$i][$j]);
            }
        }
        return $minValue;
    }

    /**
     * Function find star in row
     * 
     * @param int[][] $masks
     * @param int     $w
     * @param int     $row
     * 
     * @return int
     */
    private function findStarInRow($masks, $w, $row) {
        for ($j = 0; $j < $w; $j++) {
            if ($masks[$row][$j] == 1)
                return $j;
        }
        return -1;
    }

    /**
     * Function to find star in column
     * 
     * @param int[][] $masks
     * @param int     $h
     * @param int     $col
     * 
     * @return int
     */
    private function findStarInColumn($masks, $h, $col) {
        for ($i = 0; $i < $h; $i++) {
            if ($masks[$i][$col] == 1)
                return $i;
        }
        return -1;
    }

    /**
     * Function to find prime in row
     * 
     * @param int[][] $masks
     * @param int     $w
     * @param int     $row
     * 
     * @return int
     */
    private function findPrimeInRow($masks, $w, $row) {
        for ($j = 0; $j < $w; $j++) {
            if ($masks[$row][$j] == 2)
                return $j;
        }
        return -1;
    }

    /**
     * Function to clear the covers
     * 
     * @param boolean[] &$rowsCovered
     * @param boolean[] &$colsCovered
     * @param int       $w
     * @param int       $h
     * 
     * @return void
     */
    private function clearCovers(&$rowsCovered, &$colsCovered, $w, $h) {
        for ($i = 0; $i < $h; $i++)
            $rowsCovered[$i] = 0;
        for ($j = 0; $j < $w; $j++)
            $colsCovered[$j] = 0;
    }

    /**
     * Function to clear the primes
     * 
     * @param int &$masks
     * @param int $w
     * @param int $h
     * 
     * @return void 
     */
    private function clearPrimes(&$masks, $w, $h) {
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if ($masks[$i][$j] == 2)
                    $masks[$i][$j] = 0;
            }
        }
    }

}

?>