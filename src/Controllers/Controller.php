<?php


abstract class Controller
{

    protected function render(string $file)
    {
        $ext = empty($data) ? 'html' : 'php';

        ob_start();
        require_once ROOT . '/Views/' . basename(get_class($this), 'Controller') . '/' . $file . '.' . $ext;

        if ($_SERVER['REQUEST_URI'] !== '/dev') {
            $content = ob_get_clean();

            ob_start();
            require_once ROOT . '/Views/template.phtml';
        }

        echo sanitize_output(ob_get_clean());
    }
}

function sanitize_output($buffer)
{
    // function by Rakesh Sankar

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array('>', '<', '\\1', '');
    return preg_replace($search, $replace, $buffer);
}