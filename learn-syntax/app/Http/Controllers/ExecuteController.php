<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\Process\Process;

class ExecuteController extends Controller
{
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'language' => 'required|string|in:php,javascript,html,c,c++,python',
        ]);

        $code = $validated['code'];
        $language = $validated['language'];

        $output = "";

        switch ($language) {
            case 'php':
                $output = $this->executePHP($code);
                break;
            case 'javascript':
                $output = $this->executeJavaScript($code);
                break;
            case 'html':
                $output = $this->executeHTML($code);
                break;
            case 'c':
                $output = $this->executeCEmscripten($code);
                break;
            case 'c++':
                $output = $this->executeCPPEmscripten($code);
                break;
            case 'python':
                $output = $this->executePython($code);
                break;
            default:
                $output = "Execution of {$language} is not supported.";
                break;
        }

        return response()->json(['output' => $output]);
    }

    private function executePHP($code)
    {
        ob_start();
        try {
            eval($code);
            return ob_get_clean();
        } catch (\Throwable $e) {
            return "PHP Error: " . $e->getMessage();
        }
    }

    private function executeJavaScript($code)
    {
        try {
            
            $escapedCode = escapeshellarg($code);

            
            $command = "node -e $escapedCode 2>&1";
            $result = @shell_exec($command);

            
            return $result ?: "No output from JavaScript.";
        } catch (\Throwable $e) {
            
            return "JavaScript Execution Error: " . $e->getMessage();
        }
    }

    private function executeHTML($code)
    {
        $sanitizedCode = strip_tags($code, '<h1><p><div><span><b><i><a>');
        $dynamicValue = "Dynamic Content";
        $processedCode = str_replace("{{ dynamic }}", $dynamicValue, $sanitizedCode);
        return strip_tags($processedCode);
    }

    private function executeCEmscripten($code)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'CCode');
        file_put_contents($tempFile . '.c', $code);

        // Use Emscripten to compile C code to WebAssembly
        $process = new Process(['emcc', $tempFile . '.c', '-o', $tempFile . '.html']);
        $process->run();

        if (!$process->isSuccessful()) {
            return "C Compilation Error: " . $process->getErrorOutput();
        }

        return file_get_contents($tempFile . '.html');
    }

    private function executeCPPEmscripten($code)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'CPPCode');
        file_put_contents($tempFile . '.cpp', $code);

        // Use Emscripten to compile C++ code to WebAssembly
        $process = new Process(['em++', $tempFile . '.cpp', '-o', $tempFile . '.html']);
        $process->run();

        if (!$process->isSuccessful()) {
            return "C++ Compilation Error: " . $process->getErrorOutput();
        }

        return file_get_contents($tempFile . '.html');
    }

    private function executePython($code)
    {
        try {
            $output = shell_exec("python -c \"" . addslashes($code) . "\" 2>&1");
            return $output ?: "No output from Python.";
        } catch (\Throwable $e) {
            return "Python Error: " . $e->getMessage();
        }
    }
}
