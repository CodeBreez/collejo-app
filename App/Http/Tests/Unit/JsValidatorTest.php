<?php

namespace Collejo\App\Http\Tests\Unit;

use Collejo\Foundation\Testing\TestCase;
use Collejo\App\Http\JsValidator\JsValidatorFactory;
use Collejo\App\Http\JsValidator\JsValidator;
use Collejo\Foundation\Http\Requests\Request;

class JsValidatorTest extends TestCase
{

    public function testFactoryInstance()
    {
        $validator = JsValidatorFactory::create(new TestableRequest());

        $this->assertFalse(false);
        $this->assertTrue($validator instanceof JsValidator);
    }
}

class TestableRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Batch Name',
        ];
    }
}
