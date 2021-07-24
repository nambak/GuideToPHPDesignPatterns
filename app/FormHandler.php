<?php declare(strict_types = 1);

namespace App;

use App\Labeled;
use App\Post;
use App\Invalid;

class FormHandler 
{
    static public function build(Post $post): array
    {
        return [
            new Labeled('First name', $post->get('fname')),
            new Labeled('Last Name', $post->get('lname')),
            new Labeled('Email', $post->get('email'))
        ];
    }

    static public function validate(Array $form, Post $post): bool
    {
        $valid = true;

        // first name required.
        if (!strlen($post->get('fname'))) {
            $form[0] = new Invalid($form[0]);
            $valid = false;
        }
        
        // last name required.
        if (!strlen($post->get('lanme'))) {
            $form[1] = new Invalid($form[1]);
            $valid = false;
        }

        // email has to look real
        if (!preg_match('~\w+@(\w+\.)+\w+~', $post->get('email'))) {
            $form[2] = new Invalid($form[2]);
            $valida = false;
        }

        return $valid;
    }
}