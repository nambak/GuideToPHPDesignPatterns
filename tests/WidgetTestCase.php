<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\TextInput;
use App\Labeled;
use App\Invalid;

final class WidgetTestCase extends TestCase
{
    public function testTextInput(): void
    {
        $text = new TextInput('foo', 'bar');
        $output = $text->paint();

        $this->assertStringMatchesFormat(
            '~^<input type="text[^>]*>$~i',
            $output,
        );
        $this->assertStringMatchesFormat('~name="foo"~i', $output);
        $this->assertStringMatchesFormat('~value="bar"~i', $output);
    }

    public function testLabeled(): void
    {
        $text = new Labeled('Email', new TextInput('email'));
        $output = $text->paint();

        $this->assertStringMatchesFormat('~^<b>Email:</b> <input~i', $output);
    }

    public function testInvalid(): void
    {
        $text = new Invalid(new TextInput('email'));
        $output = $text->paint();

        $this->assertStringMatchesFormat('~^<span class="invali"><input[^>]+></span>$~i', $output);
    }

    public function testInvalidLabeled(): void
    {
        $text = new Invalid(new Labeled('Email', new TextInput('email')));
        $output = $text->paint();

        $this->assertStringMatchesFormat('~<b>Email:</b> <input~i', $output);
        $this->assertStringMatchesFormat('~^<span class="invalid">.*</span>$~i', $output);
    }
}