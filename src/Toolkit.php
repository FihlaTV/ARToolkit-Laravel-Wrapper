<?php

namespace JapSeyz\Ar;

class Toolkit
{
    /* Paths */
    protected $basepath;
    protected $trainingpath;
    protected $binpath;

    /* Commands */
    private $trainingCommand;

    /* CLI Errors */
    private $missingResolutionError = 'Enter resolution to use';

    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        $this->basepath = storage_path('app/ARToolkit/');
        $this->trainingpath = $this->basepath . 'marker_training/';

        /* Prepare Training Command */
        $this->trainingCommand = 'genTexData -level=' . config('artoolkit.level') .
            ' -leveli=' . config('artoolkit.leveli') .
            ' -max_dpi=' . config('artoolkit.max_dpi') .
            ' -min_dpi=' . config('artoolkit.min_dpi');

        // Check for ARToolkit bin in PATH
        $binHaystack = shell_exec('genTexData');
        $binNeedle = 'Error: no input file specified';

        if (strpos($binHaystack, $binNeedle) === false) {
            abort('The ARToolkit bin was not found in the PATH variable');
        }


        // Make sure ARToolkit Directories exist
        if (!@mkdir($this->trainingpath, 0777, true) && !is_dir($this->trainingpath)) {
            abort('Cannot find or create marker-training directory');
        }
    }

    public function retrain()
    {
        $files = array_diff(scandir($this->trainingpath), ['..', '.', '.DS_Store']);

        foreach ($files as $file) {
            $this->train($this->trainingpath . $file);
        }

        return 'Training Complete';
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

        $output = shell_exec($this->trainingCommand . ' ' . $path);
        if (strpos($output, $this->missingResolutionError) !== false) {
            shell_exec(config('artoolkit.default_dpi'));
        }

        return true;
    }
}
