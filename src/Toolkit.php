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

        $this->trainingCommand = 'genTexData -level=' . config('artoolkit.level') .
            ' -leveli=' . config('artoolkit.leveli') .
            ' -max_dpi=' . config('artoolkit.max_dpi') .
            ' -min_dpi=' . config('artoolkit.min_dpi');

        /* Make sure ARToolkit is in the PATH */
        if (strpos($binHaystack, $binNeedle) === false) {
            \Log::error('The ARToolkit bin was not found in the PATH variable');
            abort(501, 'The ARToolkit bin was not found in the PATH variable');
        }

        /*Make sure ARToolkit Directories exist*/
        if (!@mkdir($this->basepath, 0777, true) && !is_dir($this->basepath)) {
            \Log::error('Cannot find or create ARToolkit directory');
            abort(501, 'Cannot find or create ARToolkit directory');
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
            \Log::error('The image must be a jpg or jpeg image');
            abort(501, 'The image must be a jpg or jpeg image');
        }

        $output = shell_exec($this->trainingCommand . ' ' . $path);
        $error = 'does not contain embedded resolution data, and no resolution specified on command-line.';

        /* Make sure ARToolkit is in the PATH */
        if (strpos($output, $error) === false) {
            $this->trainingCommand .= ' -dpi=' . config('artoolkit.default_dpi');
            shell_exec($this->trainingCommand . ' ' . $path);
        }

        return true;
    }
}
