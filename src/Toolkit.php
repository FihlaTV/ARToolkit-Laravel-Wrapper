<?php

namespace JapSeyz\Ar;

use JapSeyz\Ar\ToolkitQueue;

class Toolkit
{
    /* Paths */
    protected $basepath;
    /* Commands */
    private $trainingCommand;

    public function __construct()
    {
        $this->basepath = storage_path('app/ARToolkit/');

        /* Prepare Training Command */
        $this->trainingCommand = 'genTexData -level=' . config('artoolkit.level') .
            ' -leveli=' . config('artoolkit.leveli') .
            ' -max_dpi=' . config('artoolkit.max_dpi') .
            ' -min_dpi=' . config('artoolkit.min_dpi') .
            ' -dpi=' . config('artoolkit.default_dpi');

        // Check for ARToolkit bin in PATH
        $binHaystack = shell_exec('genTexData 2>&1');
        $binNeedle = 'Error: no input file specified';

        if (strpos($binHaystack, $binNeedle) === false) {
            abort('The ARToolkit bin was not found in the PATH variable');
        }


        // Make sure ARToolkit Directories exist
        if (!@mkdir($this->basepath, 0777, true) && !is_dir($this->basepath)) {
            abort('Cannot find or create ARToolkit directory');
        }
    }

    public function queue($path)
    {
        dispatch(new ToolkitQueue($path));
    }

    public function add($path)
    {
        return $this->train($path);
    }

    private function train($path)
    {
        // Validate extension
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if ($ext !== 'jpg' && $ext !== 'jpeg') {
            return false;
        }

        shell_exec($this->trainingCommand . ' ' . $path);

        return true;
    }
}
