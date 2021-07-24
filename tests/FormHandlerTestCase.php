<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Labeled;
use App\FormHandler;
use App\Post;

final class FormHandlerTestCase extends TestCase
{
    public function testBuild(): void
    {
        $this->assertInstanceOf('Array', $form = FormHandler::build(new Post));
        $this->assertEquals(3, count($form));
        $this->assertInstanceOf(Labeled::class, $form[1]);
        $this->assertStringMatchesFormat('~email~i', $form[2]->paint());
    }

    public function testValidateMissingName(): void
    {
        $post = new Post;
        $post->set('fname', 'Jason');
        $post->set('email', 'jsweat_php@yahoo.com');
        $form = FormHandler::build($post);
        
        $this->assertFalse(FormHandler::validate($form, $post));
        $this->assertStringNotMatchesFormat('/invalid/i', $form[0]->paint());
        $this->assertStringMatchesFormat('/invalid/i', $form[1]->paint());
        $this->assertStringNotMatchesFormat('/invalid/i', $form[2]->paint());
    }
    
    public function testValidateBadEmail(): void
    {
        $post = new Post;
        $post->set('fname', 'Jason');
        $post->set('lname', 'Sweat');
        $post->set('email',  'jsweat_php AT yahoo DOT com');
        $form = FormHandler::build($post);

        $this->assertStringNotMatchesFormat('/invalid/i', $form[0]->paint());
        $this->assertStringNotMatchesFormat('/invalid/i', $form[1]->paint());
        $this->assertStringMatchesFormat('/invalid/i', $form[2]->paint());
    }

    public function testValidate(): void
    {
        $post = new Post;
        $post->set('fname', 'Jason');
        $post->set('lname', 'Sweat');
        $post->set('email', 'jsweat_php@yahoo.com');
        $form = FormHandler::build($post);

        $this->assertStringNotMatchesFormat('/invalid/i', $form[0]->paint());
        $this->assertStringNotMatchesFormat('/invalid/i', $form[1]->paint());
        $this->assertStringNotMatchesFormat('/invalid/i', $form[2]->paint());
    }
}