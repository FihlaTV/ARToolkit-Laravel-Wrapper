<?php

namespace JapSeyz\Ar;

use JapSeyz\Ar\ToolkitQueue;

class Toolkit
{
    /* Paths */
    protected $basepath;

    public function __construct()
    {
        $this->basepath = storage_path('app/ARToolkit/');

        $binHaystack = shell_exec('genTexData 2>&1');
        $binNeedle = 'Error: no input file specified';

        /* Make sure ARToolkit is in the PATH */
        if (strpos($binHaystack, $binNeedle) === false) {
            abort('The ARToolkit bin was not found in the PATH variable');
        }

        /*Make sure ARToolkit Directories exist*/
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
        return $this->learn($path);
    }

    private function learn($path)
    {
        // Validate extension
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if ($ext !== 'jpg' && $ext !== 'jpeg') {
            abort('The image must be a jpg or jpeg image');
        }

        shell_exec($this->trainingCommand . ' ' . $path);

        return true;
    }
}
