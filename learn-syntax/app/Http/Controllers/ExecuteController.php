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
            // Define a custom alert in the JavaScript code
            $customAlertDefinition = <<<JS
global.alert = (message) => {
    console.log( message);
};
JS;

            // Prepend the custom alert definition to the user's code
            $codeWithAlert = $customAlertDefinition . "\n" . $code;

            // Create a temporary file to store the JavaScript code
            $tempFile = tempnam(sys_get_temp_dir(), 'js_');
            file_put_contents($tempFile, $codeWithAlert);

            // Execute the code using Node.js
            $command = "node $tempFile 2>&1"; // Execute the temporary file
            $result = shell_exec($command);

            // Clean up the temporary file
            unlink($tempFile);

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
        $tempCFile = $tempFile . '.c';
        $outputFile = $tempFile . '.html';

        file_put_contents($tempCFile, $code);

        try {
            $process = new Process(['emcc', $tempCFile, '-o', $outputFile]);
            $process->run();

            if (!$process->isSuccessful()) {
                return "C Compilation Error: " . $process->getErrorOutput();
            }

            if (file_exists($outputFile)) {
                return file_get_contents($outputFile);
            } else {
                return "C Compilation completed, but no output generated.";
            }
        } catch (\Exception $e) {
            return "C Compilation Error: " . $e->getMessage();
        } finally {
            // Cleanup temporary files
            @unlink($tempCFile);
            @unlink($outputFile);
        }
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
